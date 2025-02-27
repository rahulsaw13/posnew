<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Dashboards extends Secure_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard');
    }

    public function index()
    {
        // Fetch data for different periods
        $data['total_customers_added_day'] = $this->Dashboard->get_customers_added('day');
        $data['total_customers_added_week'] = $this->Dashboard->get_customers_added('week');
        $data['total_customers_added_month'] = $this->Dashboard->get_customers_added('month');
        $data['total_customers_added_3months'] = $this->Dashboard->get_customers_added('3months');
        $data['total_customers_added_6months'] = $this->Dashboard->get_customers_added('6months');
        $data['total_customers_added_year'] = $this->Dashboard->get_customers_added('year');
        $data['total_customers_added_whole'] = $this->Dashboard->get_customers_added('whole');

        $data['total_sales_day'] = $this->Dashboard->get_total_sales('day');
        $data['total_sales_week'] = $this->Dashboard->get_total_sales('week');
        $data['total_sales_month'] = $this->Dashboard->get_total_sales('month');
        $data['total_sales_3months'] = $this->Dashboard->get_total_sales('3months');
        $data['total_sales_6months'] = $this->Dashboard->get_total_sales('6months');
        $data['total_sales_year'] = $this->Dashboard->get_total_sales('year');
        $data['total_sales_whole'] = $this->Dashboard->get_total_sales('whole');
       
        $data['total_invoices_day'] = $this->Dashboard->get_total_invoices('day');
        $data['total_invoices_week'] = $this->Dashboard->get_total_invoices('week');
        $data['total_invoices_month'] = $this->Dashboard->get_total_invoices('month');
        $data['total_invoices_3months'] = $this->Dashboard->get_total_invoices('3months');
        $data['total_invoices_6months'] = $this->Dashboard->get_total_invoices('6months');
        $data['total_invoices_year'] = $this->Dashboard->get_total_invoices('year');
        $data['total_invoices_whole'] = $this->Dashboard->get_total_invoices('whole');
       
        $data['total_sold_quantity_day'] = $this->Dashboard->get_total_sold_quantity('day');
        $data['total_sold_quantity_week'] = $this->Dashboard->get_total_sold_quantity('week');
        $data['total_sold_quantity_month'] = $this->Dashboard->get_total_sold_quantity('month');
        $data['total_sold_quantity_3months'] = $this->Dashboard->get_total_sold_quantity('3months');
        $data['total_sold_quantity_6months'] = $this->Dashboard->get_total_sold_quantity('6months');
        $data['total_sold_quantity_year'] = $this->Dashboard->get_total_sold_quantity('year');
        $data['total_sold_quantity_whole'] = $this->Dashboard->get_total_sold_quantity('whole');
        
        $data['total_customers_day'] = $this->Dashboard->get_total_customers('day');
        $data['total_customers_week'] = $this->Dashboard->get_total_customers('week');
        $data['total_customers_month'] = $this->Dashboard->get_total_customers('month');
        $data['total_customers_3months'] = $this->Dashboard->get_total_customers('3months');
        $data['total_customers_6months'] = $this->Dashboard->get_total_customers('6months');
        $data['total_customers_year'] = $this->Dashboard->get_total_customers('year');
        $data['total_customers_whole'] = $this->Dashboard->get_total_customers('whole');

        $data['total_revenue_day'] = $this->Dashboard->get_total_revenue('day');
        $data['total_revenue_week'] = $this->Dashboard->get_total_revenue('week');
        $data['total_revenue_month'] = $this->Dashboard->get_total_revenue('month');
        $data['total_revenue_3months'] = $this->Dashboard->get_total_revenue('3months');
        $data['total_revenue_6months'] = $this->Dashboard->get_total_revenue('6months');
        $data['total_revenue_year'] = $this->Dashboard->get_total_revenue('year');
        $data['total_revenue_whole'] = $this->Dashboard->get_total_revenue('whole');
        
        $data['total_sale_returns_day'] = $this->Dashboard->get_total_sale_returns('day');
        $data['total_sale_returns_week'] = $this->Dashboard->get_total_sale_returns('week');
        $data['total_sale_returns_month'] = $this->Dashboard->get_total_sale_returns('month');
        $data['total_sale_returns_3months'] = $this->Dashboard->get_total_sale_returns('3months');
        $data['total_sale_returns_6months'] = $this->Dashboard->get_total_sale_returns('6months');
        $data['total_sale_returns_year'] = $this->Dashboard->get_total_sale_returns('year');
        $data['total_sale_returns_whole'] = $this->Dashboard->get_total_sale_returns('whole');
        
        $data['total_receivings_day'] = $this->Dashboard->get_total_receivings('day');
        $data['total_receivings_week'] = $this->Dashboard->get_total_receivings('week');
        $data['total_receivings_month'] = $this->Dashboard->get_total_receivings('month');
        $data['total_receivings_3months'] = $this->Dashboard->get_total_receivings('3months');
        $data['total_receivings_6months'] = $this->Dashboard->get_total_receivings('6months');
        $data['total_receivings_year'] = $this->Dashboard->get_total_receivings('year');
        $data['total_receivings_whole'] = $this->Dashboard->get_total_receivings('whole');

        $data['total_purchases_day'] = $this->Dashboard->get_total_purchases('day');
        $data['total_purchases_week'] = $this->Dashboard->get_total_purchases('week');
        $data['total_purchases_month'] = $this->Dashboard->get_total_purchases('month');
        $data['total_purchases_3months'] = $this->Dashboard->get_total_purchases('3months');
        $data['total_purchases_6months'] = $this->Dashboard->get_total_purchases('6months');
        $data['total_purchases_year'] = $this->Dashboard->get_total_purchases('year');
        $data['total_purchases_whole'] = $this->Dashboard->get_total_purchases('whole');

        $data['total_bills_day'] = $this->Dashboard->get_total_bills('day');
        $data['total_bills_week'] = $this->Dashboard->get_total_bills('week');
        $data['total_bills_month'] = $this->Dashboard->get_total_bills('month');
        $data['total_bills_3months'] = $this->Dashboard->get_total_bills('3months');
        $data['total_bills_6months'] = $this->Dashboard->get_total_bills('6months');
        $data['total_bills_year'] = $this->Dashboard->get_total_bills('year');
        $data['total_bills_whole'] = $this->Dashboard->get_total_bills('whole');
        
        $data['total_suppliers_day'] = $this->Dashboard->get_total_suppliers('day');
        $data['total_suppliers_week'] = $this->Dashboard->get_total_suppliers('week');
        $data['total_suppliers_month'] = $this->Dashboard->get_total_suppliers('month');
        $data['total_suppliers_3months'] = $this->Dashboard->get_total_suppliers('3months');
        $data['total_suppliers_6months'] = $this->Dashboard->get_total_suppliers('6months');
        $data['total_suppliers_year'] = $this->Dashboard->get_total_suppliers('year');
        $data['total_suppliers_whole'] = $this->Dashboard->get_total_suppliers('whole');
        
        $data['purchase_returns_day'] = $this->Dashboard->get_purchase_returns('day');
        $data['purchase_returns_week'] = $this->Dashboard->get_purchase_returns('week');
        $data['purchase_returns_month'] = $this->Dashboard->get_purchase_returns('month');
        $data['purchase_returns_3months'] = $this->Dashboard->get_purchase_returns('3months');
        $data['purchase_returns_6months'] = $this->Dashboard->get_purchase_returns('6months');
        $data['purchase_returns_year'] = $this->Dashboard->get_purchase_returns('year');
        $data['purchase_returns_whole'] = $this->Dashboard->get_purchase_returns('whole');

        $data['total_receiving_day'] = $this->Dashboard->get_total_receiving('day');
        $data['total_receiving_week'] = $this->Dashboard->get_total_receiving('week');
        $data['total_receiving_month'] = $this->Dashboard->get_total_receiving('month');
        $data['total_receiving_3months'] = $this->Dashboard->get_total_receiving('3months');
        $data['total_receiving_6months'] = $this->Dashboard->get_total_receiving('6months');
        $data['total_receiving_year'] = $this->Dashboard->get_total_receiving('year');
        $data['total_receiving_whole'] = $this->Dashboard->get_total_receiving('whole');

        $data['total_expense_day'] = $this->Dashboard->get_total_expense('day');
        $data['total_expense_week'] = $this->Dashboard->get_total_expense('week');
        $data['total_expense_month'] = $this->Dashboard->get_total_expense('month');
        $data['total_expense_3months'] = $this->Dashboard->get_total_expense('3months');
        $data['total_expense_6months'] = $this->Dashboard->get_total_expense('6mohths');
        $data['total_expense_year'] = $this->Dashboard->get_total_expense('year');
        $data['total_expense_whole'] = $this->Dashboard->get_total_expense('whole');

        $data['total_profit_day'] = $this->Dashboard->get_total_profit('day');
        $data['total_profit_week'] = $this->Dashboard->get_total_profit('week');
        $data['total_profit_month'] = $this->Dashboard->get_total_profit('month');
        $data['total_profit_3months'] = $this->Dashboard->get_total_profit('3months');
        $data['total_profit_6months'] = $this->Dashboard->get_total_profit('6mohths');
        $data['total_profit_year'] = $this->Dashboard->get_total_profit('year');
        $data['total_profit_whole'] = $this->Dashboard->get_total_profit('whole');

        $data['margin_percentage_day'] = $this->Dashboard->get_margin_percentage('day');
        $data['margin_percentage_week'] = $this->Dashboard->get_margin_percentage('week');
        $data['margin_percentage_month'] = $this->Dashboard->get_margin_percentage('month');
        $data['margin_percentage_3months'] = $this->Dashboard->get_margin_percentage('3months');
        $data['margin_percentage_6months'] = $this->Dashboard->get_margin_percentage('6mohths');
        $data['margin_percentage_year'] = $this->Dashboard->get_margin_percentage('year');
        $data['margin_percentage_whole'] = $this->Dashboard->get_margin_percentage('whole');

        $data['total_revenue_after_discount_day'] = $this->Dashboard->get_total_revenue_after_discount('day');
        $data['total_revenue_after_discount_week'] = $this->Dashboard->get_total_revenue_after_discount('week');
        $data['total_revenue_after_discount_month'] = $this->Dashboard->get_total_revenue_after_discount('month');
        $data['total_revenue_after_discount_3months'] = $this->Dashboard->get_total_revenue_after_discount('3months');
        $data['total_revenue_after_discount_6months'] = $this->Dashboard->get_total_revenue_after_discount('6mohths');
        $data['total_revenue_after_discount_year'] = $this->Dashboard->get_total_revenue_after_discount('year');
        $data['total_revenue_after_discount_whole'] = $this->Dashboard->get_total_revenue_after_discount('whole');

        $data['total_products'] = $this->Dashboard->get_total_products('whole');
        $data['total_stock'] = $this->Dashboard->get_total_stock('whole');
        $data['total_stock_price'] = $this->Dashboard->get_total_stock_price('whole');
        $data['total_due_receivings'] = $this->Dashboard->get_total_due_receivings('whole');

        $data['most_selling_products_day'] = $this->Dashboard->get_most_selling_products('day', 10);
        $data['most_selling_products_week'] = $this->Dashboard->get_most_selling_products('week', 10);
        $data['most_selling_products_month'] = $this->Dashboard->get_most_selling_products('month', 10);
        $data['most_selling_products_3months'] = $this->Dashboard->get_most_selling_products('3months', 10);
        $data['most_selling_products_6months'] = $this->Dashboard->get_most_selling_products('6months', 10);
        $data['most_selling_products_year'] = $this->Dashboard->get_most_selling_products('year', 10);
        $data['most_selling_products_whole'] = $this->Dashboard->get_most_selling_products('whole', 10);

        $data['least_selling_products_day'] = $this->Dashboard->get_least_selling_products('day', 10);
        $data['least_selling_products_week'] = $this->Dashboard->get_least_selling_products('week', 10);
        $data['least_selling_products_month'] = $this->Dashboard->get_least_selling_products('month', 10);
        $data['least_selling_products_3months'] = $this->Dashboard->get_least_selling_products('3months', 10);
        $data['least_selling_products_6months'] = $this->Dashboard->get_least_selling_products('6months', 10);
        $data['least_selling_products_year'] = $this->Dashboard->get_least_selling_products('year', 10);
        $data['least_selling_products_whole'] = $this->Dashboard->get_least_selling_products('whole', 10);
        
        $data['top_customers_by_sales_day'] = $this->Dashboard->get_top_customers_by_sales('day', 10);
        $data['top_customers_by_sales_week'] = $this->Dashboard->get_top_customers_by_sales('week', 10);
        $data['top_customers_by_sales_month'] = $this->Dashboard->get_top_customers_by_sales('month', 10);
        $data['top_customers_by_sales_3months'] = $this->Dashboard->get_top_customers_by_sales('3months', 10);
        $data['top_customers_by_sales_6months'] = $this->Dashboard->get_top_customers_by_sales('6months', 10);
        $data['top_customers_by_sales_year'] = $this->Dashboard->get_top_customers_by_sales('year', 10);
        $data['top_customers_by_sales_whole'] = $this->Dashboard->get_top_customers_by_sales('whole', 10);
        
         // Fetch the sales data for the last 7 fortnights
        $data['fortnight_sales'] = $this->Dashboard->get_fortnight_sales();  // This function fetches the sales data
        $data['top_customers_by_due'] = $this->Dashboard->get_top_20_customers_due();  // This function fetches the due customers
        $data['customer_visit_frequency'] = $this->Dashboard->get_customer_visit_frequency();
        
        
        $data['sale_comparison'] = $this->Dashboard->get_sales_for_comparison();
        $data['receiving_comparison'] = $this->Dashboard->get_receivings_for_comparison();
        $data['revenue_comparison'] = $this->Dashboard->get_revenue_for_comparison();
        $data['sold_quantity_comparison'] = $this->Dashboard->get_sold_quantity_for_comparison();
        $data['total_customers_comparison'] = $this->Dashboard->get_total_customers_for_comparison();
        $data['total_sale_returns_comparison'] = $this->Dashboard->get_total_sale_returns_for_comparison();
        $data['total_bills_comparison'] = $this->Dashboard->get_total_bills_for_comparison();
        $data['total_suppliers_comparison'] = $this->Dashboard->get_total_suppliers_for_comparison();
        $data['purchase_returns_comparison'] = $this->Dashboard->get_purchase_returns_for_comparison();
        $data['customers_added_comparison'] = $this->Dashboard->get_customers_added_for_comparison();
        $data['expense_categories_comparison'] = $this->Dashboard->get_total_expenses_for_comparison();
        $data['profit_comparison'] = $this->Dashboard->get_total_profit_for_comparison();
        $data['margin_percentage_comparison'] = $this->Dashboard->get_margin_percentage_for_comparison();
        $data['revenue_after_discount_comparison'] = $this->Dashboard->get_total_revenue_after_discount_for_comparison();


        // Load view with data
        $this->load->view('dashboard/index', $data);
    }

}