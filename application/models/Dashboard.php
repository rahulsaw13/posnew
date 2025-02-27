<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Model
{
    /**
     * Helper fnction - Apply date filter based on the period
     */
    private function apply_period_filter($column, $period)
    {
        switch ($period) {
            case 'day':
                $this->db->where("DATE($column) = CURDATE()");
                break;
            case 'week':
                $this->db->where("YEARWEEK($column, 1) = YEARWEEK(CURDATE(), 1)");
                break;
            case 'month':
                $this->db->where("MONTH($column) = MONTH(CURDATE())");
                break;
            case '3months':
                $this->db->where("$column >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)");
                break;
            case '6months':
                $this->db->where("$column >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)");
                break;
            case 'year':
                $this->db->where("YEAR($column) = YEAR(CURDATE())");
                break;
            case 'whole':
            default:
                // No date filter
                break;
        }
    }
    private function get_date_range($period)
    {
        $start_date = null;
        $end_date = date('Y-m-d'); // Default to today for end date
    
        switch ($period) {
            case 'day':
                $start_date = $end_date; // Same day
                break;
            case 'week':
                $start_date = date('Y-m-d', strtotime('monday this week'));
                break;
            case 'month':
                $start_date = date('Y-m-01'); // First day of the current month
                break;
            case '3months':
                $start_date = date('Y-m-d', strtotime('-3 months'));
                break;
            case '6months':
                $start_date = date('Y-m-d', strtotime('-6 months'));
                break;
            case 'year':
                $start_date = date('Y-01-01'); // First day of the current year
                break;
            case 'whole':
            default:
                // No date filter, use earliest possible date
                $start_date = '1970-01-01'; // You can set a far past date as needed
                break;
        }
    
        return array('start_date' => $start_date, 'end_date' => $end_date);
    }
    /**
     * Get total number of customers added within a given period
     */
    public function get_customers_added($period)
    {
        $this->db->select('COUNT(person_id) as total_customers_added');
        $this->db->from('ospos_customers');
        $this->apply_period_filter('date', $period);      
        $query = $this->db->get();
        $result = $query->row()->total_customers_added;
        return $result ? $result : 0;
    }

    /**
     * Get total sales within a given period
     */
    public function get_total_sales($period)
    {
        $this->db->select('COUNT(sale_id) as total_sales');
        $this->db->from('ospos_sales');
        $this->apply_period_filter('sale_time', $period);     
        $query = $this->db->get();
        $result = $query->row()->total_sales;
        return $result ? $result : 0;
    }

    //Get total sale -invoice within given period
    public function get_total_invoices($period)
    {
        $this->db->select('COUNT(DISTINCT invoice_number) as total_invoices');
        $this->db->from('ospos_sales');
        $this->apply_period_filter('sale_time', $period);
        $query = $this->db->get();
        $result = $query->row()->total_invoices;
        return $result ? $result : 0;
    }

    // Get total sold quantity within a given period
    public function get_total_sold_quantity($period)
    {
        $this->db->select('SUM(quantity_purchased) as total_sold_quantity');
        $this->db->from('ospos_sales_items');
        $this->db->join('ospos_sales', 'ospos_sales.sale_id = ospos_sales_items.sale_id', 'inner');
        $this->apply_period_filter('sale_time', $period);
        $query = $this->db->get();
        $result = $query->row()->total_sold_quantity;
        return $result ? $result : 0;
    }

    // Get total customer - sale within a given period
    public function get_total_customers($period)
    {
        $this->db->select('COUNT(DISTINCT customer_id) as total_customers');
        $this->db->from('ospos_sales');
        $this->apply_period_filter('sale_time', $period);
        $query = $this->db->get();
        $result = $query->row()->total_customers;
        return $result ? $result : 0;
    }

    // Gettotal sale return within given time
     public function get_total_sale_returns($period)
    {
        $this->db->select('COUNT(distinct(s.sale_id)) as total_sale_returns');
        $this->db->from('sales s'); // Corrected this line to only refer to 'sales'
        $this->db->join('sales_items si', 'si.sale_id = s.sale_id'); // Moved the join to be with 'sales'
    
        $this->apply_period_filter('s.sale_time', $period);
        $this->db->where('s.sale_status', COMPLETED);
        $this->db->group_start();
        $this->db->where('s.sale_type', SALE_TYPE_POS);
        $this->db->or_where('s.sale_type', SALE_TYPE_INVOICE);
        $this->db->or_where('s.sale_type', SALE_TYPE_RETURN);
        $this->db->group_end(); 
        $this->db->where('si.quantity_purchased <', 0); // Corrected the syntax for the condition
    
        $query = $this->db->get();
        $result = $query->row()->total_sale_returns;
        return $result ? $result : 0;
    }

    /**
     * Get total revenue within a given period
     */
      public function get_total_revenue($period)
    {
        $this->db->select('SUM(si.item_unit_price * si.quantity_purchased) AS total_revenue', FALSE);
        $this->db->from('sales_items si');
        $this->db->join('sales s', 'si.sale_id = s.sale_id');
        $this->apply_period_filter('s.sale_time', $period);
        $this->db->where('s.sale_status', COMPLETED);
        $this->db->group_start();
        $this->db->where('s.sale_type', SALE_TYPE_POS);
        $this->db->or_where('s.sale_type', SALE_TYPE_INVOICE);
        $this->db->or_where('s.sale_type', SALE_TYPE_RETURN);
        $this->db->group_end();    
    
        $query = $this->db->get();
        
        $result = $query->row()->total_revenue;
    
        return $result ? $result : 0;
    }


    // ge total receiving within given period
    public function get_total_receivings($period)
    {
        $this->db->select('COUNT(receiving_id) as total_receivings');
        $this->db->from('ospos_receivings');
        $this->apply_period_filter('receiving_time', $period);
        $query = $this->db->get();
        $result = $query->row()->total_receivings;
        return $result ? $result : 0;
    }

    /**
     * Get total purchases within a given period
     */
    public function get_total_purchases($period)
    {
        $this->db->select('COALESCE(SUM(ri.quantity_purchased), 0) as total_purchases', FALSE);
        $this->db->from('receivings_items ri');
        $this->db->join('receivings r', 'ri.receiving_id = r.receiving_id');
        $this->apply_period_filter('r.receiving_time', $period);
        $query = $this->db->get();
        $result = $query->row()->total_purchases;
        return $result ? $result : 0;
    }

    /**
     * Get total bills within a given period
     */
    public function get_total_bills($period)
    {
        $this->db->select('SUM(item_cost_price * quantity_purchased) as total_bills');
        $this->db->from('ospos_receivings_items');
        $this->db->join('ospos_receivings', 'ospos_receivings.receiving_id = ospos_receivings_items.receiving_id', 'inner');
        $this->apply_period_filter('receiving_time', $period);
        $query = $this->db->get();
        $result = $query->row()->total_bills;
        return $result ? $result : 0;
    }

    // get total suppliers for receviving within given period
    public function get_total_suppliers($period)
    {
        $this->db->select('COUNT(DISTINCT supplier_id) as total_suppliers');
        $this->db->from('ospos_receivings');
        $this->apply_period_filter('receiving_time', $period);
        $query = $this->db->get();
        $result = $query->row()->total_suppliers;
        return $result ? $result : 0;
    }

    // Get total purchage return within given period
    public function get_purchase_returns($period)
    {
        $this->db->select('SUM(quantity_purchased) as purchase_returns');
        $this->db->from('ospos_receivings_items');
        $this->db->join('ospos_receivings', 'ospos_receivings.receiving_id = ospos_receivings_items.receiving_id', 'inner');
        $this->db->where('quantity_purchased <', 0); // Assuming negative quantity indicates a return
        $this->apply_period_filter('receiving_time', $period);
        $query = $this->db->get();
        // Return the absolute value of returns
        $result = abs($query->row()->purchase_returns);
        return $result ? $result : 0;
    }

    /**
     * Get total receiving within a given period
     */
    public function get_total_receiving($period)
    {
        $this->db->select('COALESCE(SUM(ri.quantity_purchased), 0) as total_receiving', FALSE);
        $this->db->from('receivings_items ri');
        $this->db->join('receivings r', 'ri.receiving_id = r.receiving_id');
        $this->apply_period_filter('r.receiving_time', $period);
        $query = $this->db->get();
        $result = $query->row()->total_receiving;
        return $result ? $result : 0;
    }

    /**
     * Get stock value by category within a given period
     */
    public function get_stock_value_by_category($period)
    {
        $this->db->select('i.category as category_name, COALESCE(SUM(iv.trans_inventory * i.unit_price), 0) as total_stock_value', FALSE);
        $this->db->from('inventory iv');
        $this->db->join('items i', 'iv.trans_items = i.item_id');
        $this->apply_period_filter('iv.trans_date', $period);
        $this->db->group_by('i.category');
        $query = $this->db->get();
        $results = $query->result();
        foreach ($results as $result) {
            $result->total_stock_value = $result->total_stock_value ? $result->total_stock_value : 0;
        }
        return $results;
    }

    /**
     * Get expense categories within a given period
     */
    public function get_expense_categories($period)
    {
        $this->db->select('ec.category_name, COALESCE(SUM(e.amount), 0) as total_expense', FALSE);
        $this->db->from('expenses e');
        $this->db->join('expense_categories ec', 'e.expense_category_id = ec.expense_category_id');
        $this->apply_period_filter('e.date', $period);
        $this->db->group_by('ec.category_name');
        $query = $this->db->get();
        $results = $query->result();
        foreach ($results as $result) {
            $result->total_expense = $result->total_expense ? $result->total_expense : 0;
        }
        return $results;
    }

    public function get_total_expense($period)
    {
        $this->db->select('COALESCE(SUM(amount), 0) as total_expense');
        $this->db->from('ospos_expenses');
        $this->apply_period_filter('date', $period);
        $query = $this->db->get();
        $result = $query->row()->total_expense;
        return $result ? $result : 0;
    }

    public function get_total_products()
    {
        $this->db->select('COUNT(item_id) as total_products');
        $this->db->from('ospos_items');
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        $result = $query->row()->total_products;
        return $result ? $result : 0;
    }

    public function get_total_stock()
    {
        $this->db->select('SUM(quantity) as total_stock');
        $this->db->from('ospos_item_quantities');
        $this->db->join('ospos_items', 'ospos_item_quantities.item_id = ospos_items.item_id');
        $this->db->where('ospos_items.deleted', 0); 
        $query = $this->db->get();
        $result = $query->row()->total_stock;
        return $result ? $result : 0;
    }

    public function get_total_stock_price()
    {
        $this->db->select('SUM(ospos_item_quantities.quantity * ospos_items.cost_price) as total_stock_price');
        $this->db->from('ospos_items');
        $this->db->join('ospos_item_quantities', 'ospos_item_quantities.item_id = ospos_items.item_id');
        $this->db->where('ospos_items.deleted', 0);
        $query = $this->db->get();
        $result = $query->row()->total_stock_price;
        return $result ? $result : 0;
    }


    public function fetchSummaryData($start_date, $end_date, $location_id = 'all', $sale_type = 'complete')
    {

        $inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_sales');
		$model = $this->Summary_sales;

		$report_data = $model->getData($inputs);
		// $summary = $this->xss_clean($model->getSummaryData($inputs));

        // Fetch the summary data using getSummaryData()
        $summary_data =$model->getSummaryData($inputs) ;

        // Return the fetched data
        return $summary_data;
    }

    // This function will display the fetched summary data on a webpage
    public function displaySummaryData($start_date, $end_date, $location_id = 'all', $sale_type = 'complete')
    {
        // Fetch the data
        $summary_data = $this->fetchSummaryData($start_date, $end_date, $location_id, $sale_type);

        // Display the data on the page
        // echo "<h3>Summary Report</h3>";
        // echo "<p><strong>Subtotal: </strong>" . number_format($summary_data['subtotal'], 2) . "</p>";
        // echo "<p><strong>Tax: </strong>" . number_format($summary_data['tax'], 2) . "</p>";
        // echo "<p><strong>Total: </strong>" . number_format($summary_data['total'], 2) . "</p>";
        // echo "<p><strong>Wholesale Cost: </strong>" . number_format($summary_data['cost'], 2) . "</p>";
        // echo "<p><strong>Profit: </strong>" . number_format($summary_data['profit'], 2) . "</p>";

        return $summary_data;
    }

    public function get_total_profit($period)
    {
        // Get the date range for the specified period
        $dates = $this->get_date_range($period);

        // Get the summary data
        $data = $this->displaySummaryData($dates['start_date'], $dates['end_date'], 'all', 'complete');

        // Check if 'profit' is set and not null; if not, return 0
        $profit = isset($data['profit']) && $data['profit'] !== null ? $data['profit'] : 0;

        return $profit;
    }


    public function get_margin_percentage($period)
    {
        // Get the date range for the specified period
        $dates = $this->get_date_range($period);

        // Get the summary data
        $data = $this->displaySummaryData($dates['start_date'], $dates['end_date'], 'all', 'complete');

        // Check if 'profit', 'tax', and 'total' are set and not null; if not, set defaults
        $profit = isset($data['profit']) && $data['profit'] !== null ? $data['profit'] : 0;
        $tax = isset($data['tax']) && $data['tax'] !== null ? $data['tax'] : 0;
        $total = isset($data['total']) && $data['total'] !== null ? $data['total'] : 0;

        // Calculate margin percentage; ensure total is not zero to avoid division by zero
        $margin_percentage = ($total > 0) ? (($profit + $tax) / $total) * 100 : 0;

        return $margin_percentage;
    }

    public function get_total_revenue_after_discount($period)
    {
        $dates = $this->get_date_range($period);

        // Get the summary data
        $data = $this->displaySummaryData($dates['start_date'], $dates['end_date'], 'all', 'complete');
    
        // Safely extract 'total' from the data, defaulting to 0 if not set
        $total_revenue_after_discount = !empty($data['total']) ? $data['total'] : 0;
    
        return $total_revenue_after_discount;
    }

    /**
     * Get most selling products within a given period
     */
    public function get_most_selling_products($period, $limit = 10)
    {
        // Select item_id, item name, total quantity sold, total sales price (MRP), and number of transactions
        $this->db->select('
            ospos_items.item_id, 
            ospos_items.name, 
            SUM(ospos_sales_items.quantity_purchased) AS total_sold, 
            SUM(ospos_sales_items.quantity_purchased * ospos_items.unit_price) AS total_price,
            COUNT(DISTINCT ospos_sales.sale_id) AS num_transactions  -- Add count of distinct sales (transactions)
        ');
    
        $this->db->from('ospos_sales_items');
        $this->db->join('ospos_items', 'ospos_sales_items.item_id = ospos_items.item_id', 'inner');
        $this->db->join('ospos_sales', 'ospos_sales_items.sale_id = ospos_sales.sale_id', 'inner');
        $this->apply_period_filter('ospos_sales.sale_time', $period);
        $this->db->where('ospos_sales.sale_type', 0); //complete sales
        $this->db->group_by('ospos_items.item_id');
        $this->db->order_by('total_sold', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        
        return $query->result();
    }



    /**
     * Get least selling products within a given period
     */
    public function get_least_selling_products($period, $limit = 10)
    {
        // Select item_id, item name, total quantity sold, total sales price (MRP), and number of transactions
        $this->db->select('
            ospos_items.item_id, 
            ospos_items.name, 
            SUM(ospos_sales_items.quantity_purchased) AS total_sold, 
            SUM(ospos_sales_items.quantity_purchased * ospos_items.unit_price) AS total_price,
            COUNT(DISTINCT ospos_sales.sale_id) AS num_transactions  -- Add count of distinct sales (transactions)
        ');
    
        $this->db->from('ospos_sales_items');
        $this->db->join('ospos_items', 'ospos_sales_items.item_id = ospos_items.item_id', 'inner');
        $this->db->join('ospos_sales', 'ospos_sales_items.sale_id = ospos_sales.sale_id', 'inner');
        $this->apply_period_filter('ospos_sales.sale_time', $period);
        $this->db->where('ospos_sales.sale_type', 0); //complete sales
        $this->db->group_by('ospos_items.item_id');
        $this->db->order_by('total_sold', 'asc');
        $this->db->limit($limit);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_top_customers_by_sales($period, $limit = 10)
    {
        $this->db->select("s.customer_id, CONCAT(p.first_name, ' ', p.last_name) AS customer_name, SUM(si.item_unit_price * si.quantity_purchased) AS total_sold_price");
        $this->db->from('ospos_people p');
        $this->db->join('ospos_sales s', 'p.person_id = s.customer_id');
        $this->db->join('ospos_sales_items si', 'si.sale_id = s.sale_id');
        $this->apply_period_filter('s.sale_time', $period);
        $this->db->group_by('p.person_id, customer_name');
        $this->db->order_by('total_sold_price', 'DESC');
        $this->db->limit($limit); 
        $query = $this->db->get();

        // var_dump($query->result());
        // return $query->result();
        
        $top_customers = $query->result();

        // Loop through the customers and get stats for each, then return the updated array
        foreach ($top_customers as &$customer) {
            $customer_stats = $this->Customer->get_stats($customer->customer_id);
            $customer->stats = $customer_stats; // Add stats to the customer
        }
        // print_r($top_customers);
    
        return $top_customers; // Return the array with stats included
    }

    public function get_total_due_receivings()
    {
        // Select the total amount based on items in the receivings_items table
        $this->db->select('SUM(ospos_receivings_items.quantity_purchased * ospos_receivings_items.item_unit_price) AS total_due_receivings');
        $this->db->from('ospos_receivings');
        $this->db->join('ospos_receivings_items', 'ospos_receivings.receiving_id = ospos_receivings_items.receiving_id', 'left');
        $this->db->where('ospos_receivings.payment_type', 'Due');
        $query = $this->db->get();
        // return $query->row()->total_due_receivings;
        $result = $query->row()->total_due_receivings;
        return $result ? $result : 0;
        
    }
    
    public function get_top_20_customers_due()
    {
        $this->db->select('s.customer_id AS customer_id, 
                           CONCAT(COALESCE(p.first_name, ""), " ", COALESCE(p.last_name, "")) AS customer_name, 
                           p.phone_number AS phone_number, 
                           SUM(sp.payment_amount) AS total_due_amount, 
                           COUNT(sp.payment_id) AS due_count');
        $this->db->from('ospos_sales s');
        $this->db->join('ospos_sales_payments sp', 'sp.sale_id = s.sale_id');
        $this->db->join('ospos_people p', 'p.person_id = s.customer_id');
        $this->db->where('sp.payment_type', 'Due');
        $this->db->group_by('s.customer_id, p.first_name, p.last_name, p.phone_number');
        $this->db->order_by('total_due_amount', 'DESC');
        $this->db->limit(20);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_customer_visit_frequency() {
        // Get customer data and count their visits
        $this->db->select('customer_id, COUNT(*) AS visit_count');
        $this->db->from('ospos_sales'); // Sales table or any table that stores customer visits
        $this->db->group_by('customer_id');
        
        $query = $this->db->get();
        $result = $query->result();
    
        // Categorize customers based on their visit frequency
        $frequent = 0;
        $occasional = 0;
        $infrequent = 0;
    
        foreach ($result as $customer) {
            if ($customer->visit_count > 5) {
                $frequent++;
            } elseif ($customer->visit_count > 1) {
                $occasional++;
            } else {
                $infrequent++;
            }
        }
    
        // Return data in a format suitable for the chart
        return [
            'Frequent' => $frequent,
            'Occasional' => $occasional,
            'Infrequent' => $infrequent
        ];
    }


    
   public function get_fortnight_sales()
    {
        // Get the current date
        $current_date = date('Y-m-d');
        $fortnight_sales = [];
    
        // Get today's day and month
        $day_of_month = date('d', strtotime($current_date));
        $current_year = date('Y');
        $current_month = date('m');
    
        // Get the first and last date of the current month
        $month_start_date = date('Y-m-01'); // First day of the current month
        $month_end_date = date('Y-m-t');   // Last day of the current month (handles month-end automatically)
    
        // Handle the current month's first fortnight
        if ($day_of_month <= 15) {
            $first_fortnight_start = date('Y-m-01'); // 1st of the current month
            $first_fortnight_end = $current_date;    // End date is today
        } else {
            $first_fortnight_start = date('Y-m-01'); // 1st of the current month
            $first_fortnight_end = date('Y-m-15');   // 15th of the current month
        }
    
        // Add the first fortnight sales data
        $data = $this->displaySummaryData($first_fortnight_start, $first_fortnight_end, 'all', 'complete');
        $total_sales = !empty($data['total']) ? $data['total'] : 0;
        $fortnight_sales[] = [
            'start_date' => $first_fortnight_start,
            'end_date' => $first_fortnight_end,
            'total_sales' => $total_sales
        ];
    
        // If today's date is after the 15th, calculate the second fortnight
        if ($day_of_month > 15) {
            $second_fortnight_start = date('Y-m-16');  // 16th of the current month
            $second_fortnight_end = $month_end_date;   // End of the current month
    
            $data = $this->displaySummaryData($second_fortnight_start, $second_fortnight_end, 'all', 'complete');
            $total_sales = !empty($data['total']) ? $data['total'] : 0;
            $fortnight_sales[] = [
                'start_date' => $second_fortnight_start,
                'end_date' => $second_fortnight_end,
                'total_sales' => $total_sales
            ];
        }
    
        // Now, handle the previous 6 fortnights (going back 14 days each time)
        $end_date = date('Y-m-d', strtotime($first_fortnight_start . ' -1 day'));  // The day before the first fortnight start
        for ($i = 0; $i < 6; $i++) {
            // Calculate the start date of the fortnight (14 days before the current end date)
            $start_date = date('Y-m-d', strtotime($end_date . ' -14 days'));
            $fortnight_end_date = $end_date;
    
            // Get the sales data for this fortnight
            $data = $this->displaySummaryData($start_date, $fortnight_end_date, 'all', 'complete');
            $total_sales = !empty($data['total']) ? $data['total'] : 0;
    
            // Add this fortnight to the result
            $fortnight_sales[] = [
                'start_date' => $start_date,
                'end_date' => $fortnight_end_date,
                'total_sales' => $total_sales
            ];
    
            // Update the end date for the next iteration
            $end_date = date('Y-m-d', strtotime($start_date . ' -1 day'));
        }
    
        return $fortnight_sales;
    }

    
    // In your model or controller, create a utility function
    public function calculate_percentage_change($current_value, $previous_value)
    {
        // Case 1: Both current and previous values are 0 -> No change
        if ($current_value == 0 && $previous_value == 0) {
            return [
                'percentage_change' => 0,
                'trend' => 'no_change'  // Indicating no change (neutral)
            ];
        }
    
        // Case 2: If current value is 0 and previous value is not 0 -> 100% decrease
        if ($current_value == 0) {
            return [
                'percentage_change' => 100,
                'trend' => 'down'  // 100% decrease (downtrend)
            ];
        }
    
        // Case 3: If previous value is 0 and current value is not 0 -> 100% increase
        if ($previous_value == 0) {
            return [
                'percentage_change' => 100,
                'trend' => 'up'  // 100% increase (uptrend)
            ];
        }
    
        // Case 4: Normal calculation of percentage change
        $percentage_change = (($current_value - $previous_value) / $previous_value) * 100;
    
        // Determine the trend (up or down)
        $trend = $percentage_change >= 0 ? 'up' : 'down';
    
        return [
            'percentage_change' => number_format(abs($percentage_change), 2),  // Return absolute percentage
            'trend' => $trend
        ];
    }


    
    public function get_sales_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total sales for the last 7 days
        $this->db->select('COUNT(sale_id) as total_sales');
        $this->db->from('ospos_sales');
        $this->db->where('sale_time >=', $last_7_days_start);
        $this->db->where('sale_time <=', $today);
        $last_7_days_sales = $this->db->get()->row()->total_sales;
    
        // Query to get total sales for the previous 7 days
        $this->db->select('COUNT(sale_id) as total_sales');
        $this->db->from('ospos_sales');
        $this->db->where('sale_time >=', $previous_7_days_start);
        $this->db->where('sale_time <', $last_7_days_start); // Less than last_7_days_start
        $previous_7_days_sales = $this->db->get()->row()->total_sales;
    
        // Calculate the percentage change and trend using the utility function
        $sales_comparison = $this->calculate_percentage_change($last_7_days_sales, $previous_7_days_sales);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_sales' => $last_7_days_sales,
            'previous_7_days_sales' => $previous_7_days_sales,
            'percentage_change' => $sales_comparison['percentage_change'],
            'trend' => $sales_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }

    
    public function get_receivings_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total receivings for the last 7 days
        $this->db->select('COUNT(receiving_id) as total_receivings');
        $this->db->from('ospos_receivings');
        $this->db->where('receiving_time >=', $last_7_days_start);
        $this->db->where('receiving_time <=', $today);
        $last_7_days_receivings = $this->db->get()->row()->total_receivings;
    
        // Query to get total receivings for the previous 7 days
        $this->db->select('COUNT(receiving_id) as total_receivings');
        $this->db->from('ospos_receivings');
        $this->db->where('receiving_time >=', $previous_7_days_start);
        $this->db->where('receiving_time <', $last_7_days_start); // Less than last_7_days_start
        $previous_7_days_receivings = $this->db->get()->row()->total_receivings;
    
        // Calculate the percentage change and trend using the utility function
        $receiving_comparison = $this->calculate_percentage_change($last_7_days_receivings, $previous_7_days_receivings);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_receivings' => $last_7_days_receivings,
            'previous_7_days_receivings' => $previous_7_days_receivings,
            'percentage_change' => $receiving_comparison['percentage_change'],
            'trend' => $receiving_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_revenue_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total revenue for the last 7 days
        $this->db->select('SUM(si.item_unit_price * si.quantity_purchased) AS total_revenue', FALSE);
        $this->db->from('sales_items si');
        $this->db->join('sales s', 'si.sale_id = s.sale_id');
        $this->apply_period_filter('s.sale_time', $last_7_days_start . ' AND ' . $today);  // Date range filter
        $this->db->where('s.sale_status', COMPLETED);
        $this->db->group_start();
        $this->db->where('s.sale_type', SALE_TYPE_POS);
        $this->db->or_where('s.sale_type', SALE_TYPE_INVOICE);
        $this->db->or_where('s.sale_type', SALE_TYPE_RETURN);
        $this->db->group_end();
        
        $last_7_days_revenue = $this->db->get()->row()->total_revenue;
    
        // Query to get total revenue for the previous 7 days
        $this->db->select('SUM(si.item_unit_price * si.quantity_purchased) AS total_revenue', FALSE);
        $this->db->from('sales_items si');
        $this->db->join('sales s', 'si.sale_id = s.sale_id');
        $this->apply_period_filter('s.sale_time', $previous_7_days_start . ' AND ' . $last_7_days_start); // Date range filter
        $this->db->where('s.sale_status', COMPLETED);
        $this->db->group_start();
        $this->db->where('s.sale_type', SALE_TYPE_POS);
        $this->db->or_where('s.sale_type', SALE_TYPE_INVOICE);
        $this->db->or_where('s.sale_type', SALE_TYPE_RETURN);
        $this->db->group_end();
    
        $previous_7_days_revenue = $this->db->get()->row()->total_revenue;
    
        // Calculate the percentage change and trend using the utility function
        $revenue_comparison = $this->calculate_percentage_change($last_7_days_revenue, $previous_7_days_revenue);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_revenue' => $last_7_days_revenue,
            'previous_7_days_revenue' => $previous_7_days_revenue,
            'percentage_change' => $revenue_comparison['percentage_change'],
            'trend' => $revenue_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_sold_quantity_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total sold quantity for the last 7 days
        $this->db->select('SUM(si.quantity_purchased) AS total_sold_quantity');
        $this->db->from('sales_items si');
        $this->db->join('sales s', 'si.sale_id = s.sale_id');
        $this->db->where('s.sale_time >=', $last_7_days_start);
        $this->db->where('s.sale_time <=', $today);
        $this->db->where('s.sale_status', COMPLETED);
        $this->db->group_start();
        $this->db->where('s.sale_type', SALE_TYPE_POS);
        $this->db->or_where('s.sale_type', SALE_TYPE_INVOICE);
        $this->db->or_where('s.sale_type', SALE_TYPE_RETURN);
        $this->db->group_end();
        
        $last_7_days_sold_quantity = $this->db->get()->row()->total_sold_quantity;
    
        // Query to get total sold quantity for the previous 7 days
        $this->db->select('SUM(si.quantity_purchased) AS total_sold_quantity');
        $this->db->from('sales_items si');
        $this->db->join('sales s', 'si.sale_id = s.sale_id');
        $this->db->where('s.sale_time >=', $previous_7_days_start);
        $this->db->where('s.sale_time <', $last_7_days_start); // Less than last_7_days_start
        $this->db->where('s.sale_status', COMPLETED);
        $this->db->group_start();
        $this->db->where('s.sale_type', SALE_TYPE_POS);
        $this->db->or_where('s.sale_type', SALE_TYPE_INVOICE);
        $this->db->or_where('s.sale_type', SALE_TYPE_RETURN);
        $this->db->group_end();
    
        $previous_7_days_sold_quantity = $this->db->get()->row()->total_sold_quantity;
    
        // Calculate the percentage change and trend using the utility function
        $sold_quantity_comparison = $this->calculate_percentage_change($last_7_days_sold_quantity, $previous_7_days_sold_quantity);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_sold_quantity' => $last_7_days_sold_quantity,
            'previous_7_days_sold_quantity' => $previous_7_days_sold_quantity,
            'percentage_change' => $sold_quantity_comparison['percentage_change'],
            'trend' => $sold_quantity_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }

    
    public function get_total_customers_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total customers for the last 7 days
        $this->db->select('COUNT(DISTINCT customer_id) as total_customers');
        $this->db->from('ospos_sales');
        $this->db->where('sale_time >=', $last_7_days_start);
        $this->db->where('sale_time <=', $today);
        $last_7_days_customers = $this->db->get()->row()->total_customers;
    
        // Query to get total customers for the previous 7 days
        $this->db->select('COUNT(DISTINCT customer_id) as total_customers');
        $this->db->from('ospos_sales');
        $this->db->where('sale_time >=', $previous_7_days_start);
        $this->db->where('sale_time <', $last_7_days_start); // Less than last_7_days_start
        $previous_7_days_customers = $this->db->get()->row()->total_customers;
    
        // Calculate the percentage change and trend using the utility function
        $customer_comparison = $this->calculate_percentage_change($last_7_days_customers, $previous_7_days_customers);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_customers' => $last_7_days_customers,
            'previous_7_days_customers' => $previous_7_days_customers,
            'percentage_change' => $customer_comparison['percentage_change'],
            'trend' => $customer_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_total_sale_returns_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total sale returns for the last 7 days
        $this->db->select('COUNT(DISTINCT s.sale_id) as total_sale_returns');
        $this->db->from('sales s');
        $this->db->join('sales_items si', 'si.sale_id = s.sale_id');
        $this->db->where('s.sale_time >=', $last_7_days_start);
        $this->db->where('s.sale_time <=', $today);
        $this->db->where('s.sale_status', COMPLETED);
        $this->db->group_start();
        $this->db->where('s.sale_type', SALE_TYPE_POS);
        $this->db->or_where('s.sale_type', SALE_TYPE_INVOICE);
        $this->db->or_where('s.sale_type', SALE_TYPE_RETURN);
        $this->db->group_end();
        $this->db->where('si.quantity_purchased <', 0); // Sale return condition (negative quantity)
    
        $last_7_days_sale_returns = $this->db->get()->row()->total_sale_returns;
    
        // Query to get total sale returns for the previous 7 days
        $this->db->select('COUNT(DISTINCT s.sale_id) as total_sale_returns');
        $this->db->from('sales s');
        $this->db->join('sales_items si', 'si.sale_id = s.sale_id');
        $this->db->where('s.sale_time >=', $previous_7_days_start);
        $this->db->where('s.sale_time <', $last_7_days_start); // Less than last_7_days_start
        $this->db->where('s.sale_status', COMPLETED);
        $this->db->group_start();
        $this->db->where('s.sale_type', SALE_TYPE_POS);
        $this->db->or_where('s.sale_type', SALE_TYPE_INVOICE);
        $this->db->or_where('s.sale_type', SALE_TYPE_RETURN);
        $this->db->group_end();
        $this->db->where('si.quantity_purchased <', 0); // Sale return condition (negative quantity)
    
        $previous_7_days_sale_returns = $this->db->get()->row()->total_sale_returns;
    
        // Calculate the percentage change and trend using the utility function
        $sale_returns_comparison = $this->calculate_percentage_change($last_7_days_sale_returns, $previous_7_days_sale_returns);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_sale_returns' => $last_7_days_sale_returns,
            'previous_7_days_sale_returns' => $previous_7_days_sale_returns,
            'percentage_change' => $sale_returns_comparison['percentage_change'],
            'trend' => $sale_returns_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_total_bills_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total bills for the last 7 days
        $this->db->select('SUM(item_cost_price * quantity_purchased) as total_bills');
        $this->db->from('ospos_receivings_items');
        $this->db->join('ospos_receivings', 'ospos_receivings.receiving_id = ospos_receivings_items.receiving_id');
        $this->db->where('ospos_receivings.receiving_time >=', $last_7_days_start);
        $this->db->where('ospos_receivings.receiving_time <=', $today);
        $last_7_days_bills = $this->db->get()->row()->total_bills;
    
        // Query to get total bills for the previous 7 days
        $this->db->select('SUM(item_cost_price * quantity_purchased) as total_bills');
        $this->db->from('ospos_receivings_items');
        $this->db->join('ospos_receivings', 'ospos_receivings.receiving_id = ospos_receivings_items.receiving_id');
        $this->db->where('ospos_receivings.receiving_time >=', $previous_7_days_start);
        $this->db->where('ospos_receivings.receiving_time <', $last_7_days_start); // Less than last_7_days_start
        $previous_7_days_bills = $this->db->get()->row()->total_bills;
    
        // Calculate the percentage change and trend using the utility function
        $bills_comparison = $this->calculate_percentage_change($last_7_days_bills, $previous_7_days_bills);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_bills' => $last_7_days_bills,
            'previous_7_days_bills' => $previous_7_days_bills,
            'percentage_change' => $bills_comparison['percentage_change'],
            'trend' => $bills_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_total_suppliers_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total suppliers for the last 7 days
        $this->db->select('COUNT(DISTINCT supplier_id) as total_suppliers');
        $this->db->from('ospos_receivings');
        $this->db->where('receiving_time >=', $last_7_days_start);
        $this->db->where('receiving_time <=', $today);
        $last_7_days_suppliers = $this->db->get()->row()->total_suppliers;
    
        // Query to get total suppliers for the previous 7 days
        $this->db->select('COUNT(DISTINCT supplier_id) as total_suppliers');
        $this->db->from('ospos_receivings');
        $this->db->where('receiving_time >=', $previous_7_days_start);
        $this->db->where('receiving_time <', $last_7_days_start); // Less than last_7_days_start
        $previous_7_days_suppliers = $this->db->get()->row()->total_suppliers;
    
        // Calculate the percentage change and trend using the utility function
        $suppliers_comparison = $this->calculate_percentage_change($last_7_days_suppliers, $previous_7_days_suppliers);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_suppliers' => $last_7_days_suppliers,
            'previous_7_days_suppliers' => $previous_7_days_suppliers,
            'percentage_change' => $suppliers_comparison['percentage_change'],
            'trend' => $suppliers_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_purchase_returns_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total purchase returns for the last 7 days
        $this->db->select('SUM(quantity_purchased) as purchase_returns');
        $this->db->from('ospos_receivings_items');
        $this->db->join('ospos_receivings', 'ospos_receivings.receiving_id = ospos_receivings_items.receiving_id', 'inner');
        $this->db->where('quantity_purchased <', 0); // Negative quantity indicates return
        $this->db->where('receiving_time >=', $last_7_days_start);
        $this->db->where('receiving_time <=', $today);
        $last_7_days_purchase_returns = abs($this->db->get()->row()->purchase_returns);  // Return absolute value
    
        // Query to get total purchase returns for the previous 7 days
        $this->db->select('SUM(quantity_purchased) as purchase_returns');
        $this->db->from('ospos_receivings_items');
        $this->db->join('ospos_receivings', 'ospos_receivings.receiving_id = ospos_receivings_items.receiving_id', 'inner');
        $this->db->where('quantity_purchased <', 0); // Negative quantity indicates return
        $this->db->where('receiving_time >=', $previous_7_days_start);
        $this->db->where('receiving_time <', $last_7_days_start); // Less than last_7_days_start
        $previous_7_days_purchase_returns = abs($this->db->get()->row()->purchase_returns);  // Return absolute value
    
        // Calculate the percentage change and trend using the utility function
        $purchase_returns_comparison = $this->calculate_percentage_change($last_7_days_purchase_returns, $previous_7_days_purchase_returns);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_purchase_returns' => $last_7_days_purchase_returns,
            'previous_7_days_purchase_returns' => $previous_7_days_purchase_returns,
            'percentage_change' => $purchase_returns_comparison['percentage_change'],
            'trend' => $purchase_returns_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_customers_added_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total customers added for the last 7 days
        $this->db->select('COUNT(person_id) as total_customers_added');
        $this->db->from('ospos_customers');
        $this->db->where('date >=', $last_7_days_start);
        $this->db->where('date <=', $today);
        $last_7_days_customers_added = $this->db->get()->row()->total_customers_added;
    
        // Query to get total customers added for the previous 7 days
        $this->db->select('COUNT(person_id) as total_customers_added');
        $this->db->from('ospos_customers');
        $this->db->where('date >=', $previous_7_days_start);
        $this->db->where('date <', $last_7_days_start);  // Less than last_7_days_start
        $previous_7_days_customers_added = $this->db->get()->row()->total_customers_added;
    
        // Calculate the percentage change and trend using the utility function
        $customers_added_comparison = $this->calculate_percentage_change($last_7_days_customers_added, $previous_7_days_customers_added);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_customers_added' => $last_7_days_customers_added,
            'previous_7_days_customers_added' => $previous_7_days_customers_added,
            'percentage_change' => $customers_added_comparison['percentage_change'],
            'trend' => $customers_added_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_total_expenses_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Query to get total expenses for the last 7 days
        $this->db->select('COALESCE(SUM(e.amount), 0) as total_expense', FALSE);
        $this->db->from('expenses e');
        $this->db->where('e.date >=', $last_7_days_start);
        $this->db->where('e.date <=', $today);
        $last_7_days_expenses = $this->db->get()->row()->total_expense;
    
        // Query to get total expenses for the previous 7 days
        $this->db->select('COALESCE(SUM(e.amount), 0) as total_expense', FALSE);
        $this->db->from('expenses e');
        $this->db->where('e.date >=', $previous_7_days_start);
        $this->db->where('e.date <', $last_7_days_start);
        $previous_7_days_expenses = $this->db->get()->row()->total_expense;
    
        // Calculate the percentage change and trend
        $expense_comparison = $this->calculate_percentage_change($last_7_days_expenses, $previous_7_days_expenses);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_expenses' => $last_7_days_expenses,
            'previous_7_days_expenses' => $previous_7_days_expenses,
            'percentage_change' => $expense_comparison['percentage_change'],
            'trend' => $expense_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    public function get_total_profit_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Get total profit for the last 7 days
        $last_7_days_profit = $this->get_profit_in_range($last_7_days_start, $today);
    
        // Get total profit for the previous 7 days
        $previous_7_days_profit = $this->get_profit_in_range($previous_7_days_start, $last_7_days_start);
    
        // Calculate the percentage change and trend
        $profit_comparison = $this->calculate_percentage_change($last_7_days_profit, $previous_7_days_profit);
        
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_profit' => $last_7_days_profit,
            'previous_7_days_profit' => $previous_7_days_profit,
            'percentage_change' => $profit_comparison['percentage_change'],
            'trend' => $profit_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    private function get_profit_in_range($start_date, $end_date)
    {
        // Call displaySummaryData directly passing start and end dates
        $data = $this->displaySummaryData($start_date, $end_date, 'all', 'complete');
    
        // Check if 'profit' is set and not null; if not, return 0
        return isset($data['profit']) && $data['profit'] !== null ? $data['profit'] : 0;
    }
    
    public function get_margin_percentage_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Get margin percentage for the last 7 days
        $last_7_days_margin = $this->get_margin_percentage_in_range($last_7_days_start, $today);
    
        // Get margin percentage for the previous 7 days
        $previous_7_days_margin = $this->get_margin_percentage_in_range($previous_7_days_start, $last_7_days_start);
    
        // Calculate the percentage change and trend
        $margin_comparison = $this->calculate_percentage_change($last_7_days_margin, $previous_7_days_margin);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_margin' => $last_7_days_margin,
            'previous_7_days_margin' => $previous_7_days_margin,
            'percentage_change' => $margin_comparison['percentage_change'],
            'trend' => $margin_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    private function get_margin_percentage_in_range($start_date, $end_date)
    {
        // Get the margin percentage for a given range (start and end dates)
        $data = $this->displaySummaryData($start_date, $end_date, 'all', 'complete');
    
        // Assuming 'profit', 'tax', and 'total' are set
        $profit = isset($data['profit']) && $data['profit'] !== null ? $data['profit'] : 0;
        $tax = isset($data['tax']) && $data['tax'] !== null ? $data['tax'] : 0;
        $total = isset($data['total']) && $data['total'] !== null ? $data['total'] : 0;
    
        // Calculate the margin percentage: (profit + tax) / total
        return ($total > 0) ? (($profit + $tax) / $total) * 100 : 0; // If total is 0, return 0%
    }
    
    public function get_total_revenue_after_discount_for_comparison()
    {
        // Get the current date
        $today = date('Y-m-d');
        $last_7_days_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));
        $previous_7_days_start = date('Y-m-d', strtotime('-14 days', strtotime($today)));
    
        // Get total revenue after discount for the last 7 days
        $last_7_days_revenue = $this->get_total_revenue_after_discount_in_range($last_7_days_start, $today);
    
        // Get total revenue after discount for the previous 7 days
        $previous_7_days_revenue = $this->get_total_revenue_after_discount_in_range($previous_7_days_start, $last_7_days_start);
    
        // Calculate the percentage change and trend
        $revenue_comparison = $this->calculate_percentage_change($last_7_days_revenue, $previous_7_days_revenue);
    
        // Return the data for modal (or AJAX)
        return [
            'last_7_days_revenue' => $last_7_days_revenue,
            'previous_7_days_revenue' => $previous_7_days_revenue,
            'percentage_change' => $revenue_comparison['percentage_change'],
            'trend' => $revenue_comparison['trend'],
            'count_of_days' => 'Last 7 Days'
        ];
    }
    
    private function get_total_revenue_after_discount_in_range($start_date, $end_date)
    {
        // Get the revenue after discount for a given range (start and end dates)
        $data = $this->displaySummaryData($start_date, $end_date, 'all', 'complete');
    
        // Safely extract 'total' from the data, defaulting to 0 if not set
        $total_revenue_after_discount = !empty($data['total']) ? $data['total'] : 0;
    
        return $total_revenue_after_discount;
    }

    
}
