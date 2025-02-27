<?php $this->load->view("partial/header"); ?>

<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  -->
<script src="bower_components/jquery-ui/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Data storage for different periods
        var data = {
            day: {
                total_customers_added: <?php echo json_encode($total_customers_added_day); ?>,
                total_sales: <?php echo json_encode($total_sales_day); ?>,
                // total_invoices: <?php echo json_encode($total_invoices_day); ?>,
                total_sold_quantity: <?php echo json_encode($total_sold_quantity_day); ?>,
                total_customers: <?php echo json_encode($total_customers_day); ?>,
                total_sale_returns: <?php echo json_encode($total_sale_returns_day); ?>,
                total_revenue: <?php echo json_encode($total_revenue_day); ?>,
                total_receivings: <?php echo json_encode($total_receivings_day); ?>,
                total_purchases: <?php echo json_encode($total_purchases_day); ?>,
                total_bills: <?php echo json_encode($total_bills_day); ?>,
                total_suppliers: <?php echo json_encode($total_suppliers_day); ?>,
                purchase_returns: <?php echo json_encode($purchase_returns_day); ?>,
                total_receiving: <?php echo json_encode($total_receiving_day); ?>,
                total_expense: <?php echo json_encode($total_expense_day); ?>,
                total_profit: <?php echo json_encode($total_profit_day); ?>,
                margin_percentage: <?php echo json_encode($margin_percentage_day); ?>,
                total_revenue_after_discount: <?php echo json_encode($total_revenue_after_discount_day); ?>,
                most_selling_products: <?php echo json_encode($most_selling_products_day); ?>,
                least_selling_products: <?php echo json_encode($least_selling_products_day); ?>,
                top_customers_by_sales: <?php echo json_encode($top_customers_by_sales_day); ?>
            },
            week: {
                total_customers_added: <?php echo json_encode($total_customers_added_week); ?>,
                total_sales: <?php echo json_encode($total_sales_week); ?>,
                // total_invoices: <?php echo json_encode($total_invoices_week); ?>,
                total_sold_quantity: <?php echo json_encode($total_sold_quantity_week); ?>,
                total_customers: <?php echo json_encode($total_customers_week); ?>,
                total_sale_returns: <?php echo json_encode($total_sale_returns_week); ?>,
                total_revenue: <?php echo json_encode($total_revenue_week); ?>,
                total_receivings: <?php echo json_encode($total_receivings_week); ?>,
                total_purchases: <?php echo json_encode($total_purchases_week); ?>,
                total_bills: <?php echo json_encode($total_bills_week); ?>,
                total_suppliers: <?php echo json_encode($total_suppliers_week); ?>,
                purchase_returns: <?php echo json_encode($purchase_returns_week); ?>,
                total_receiving: <?php echo json_encode($total_receiving_week); ?>,
                total_expense: <?php echo json_encode($total_expense_week); ?>,
                total_profit: <?php echo json_encode($total_profit_week); ?>,
                margin_percentage: <?php echo json_encode($margin_percentage_week); ?>,
                total_revenue_after_discount: <?php echo json_encode($total_revenue_after_discount_week); ?>,
                most_selling_products: <?php echo json_encode($most_selling_products_week); ?>,
                least_selling_products: <?php echo json_encode($least_selling_products_week); ?>,
                top_customers_by_sales: <?php echo json_encode($top_customers_by_sales_week); ?>
            },
            month: {
                total_customers_added: <?php echo json_encode($total_customers_added_month); ?>,
                total_sales: <?php echo json_encode($total_sales_month); ?>,
                // total_invoices: <?php echo json_encode($total_invoices_month); ?>,
                total_sold_quantity: <?php echo json_encode($total_sold_quantity_month); ?>,
                total_customers: <?php echo json_encode($total_customers_month); ?>,
                total_sale_returns: <?php echo json_encode($total_sale_returns_month); ?>,
                total_revenue: <?php echo json_encode($total_revenue_month); ?>,
                total_receivings: <?php echo json_encode($total_receivings_month); ?>,
                total_purchases: <?php echo json_encode($total_purchases_month); ?>,
                total_bills: <?php echo json_encode($total_bills_month); ?>,
                total_suppliers: <?php echo json_encode($total_suppliers_month); ?>,
                purchase_returns: <?php echo json_encode($purchase_returns_month); ?>,
                total_receiving: <?php echo json_encode($total_receiving_month); ?>,
                total_expense: <?php echo json_encode($total_expense_month); ?>,
                total_profit: <?php echo json_encode($total_profit_month); ?>,
                margin_percentage: <?php echo json_encode($margin_percentage_month); ?>,
                total_revenue_after_discount: <?php echo json_encode($total_revenue_after_discount_month); ?>,
                most_selling_products: <?php echo json_encode($most_selling_products_month); ?>,
                least_selling_products: <?php echo json_encode($least_selling_products_month); ?>,
                top_customers_by_sales: <?php echo json_encode($top_customers_by_sales_month); ?>
            },
            '3months': {
                total_customers_added: <?php echo json_encode($total_customers_added_3months); ?>,
                total_sales: <?php echo json_encode($total_sales_3months); ?>,
                // total_invoices: <?php echo json_encode($total_invoices_3months); ?>,
                total_sold_quantity: <?php echo json_encode($total_sold_quantity_3months); ?>,
                total_customers: <?php echo json_encode($total_customers_3months); ?>,
                total_sale_returns: <?php echo json_encode($total_sale_returns_3months); ?>,
                total_revenue: <?php echo json_encode($total_revenue_3months); ?>,
                total_receivings: <?php echo json_encode($total_receivings_3months); ?>,
                total_purchases: <?php echo json_encode($total_purchases_3months); ?>,
                total_bills: <?php echo json_encode($total_bills_3months); ?>,
                total_suppliers: <?php echo json_encode($total_suppliers_3months); ?>,
                purchase_returns: <?php echo json_encode($purchase_returns_3months); ?>,
                total_receiving: <?php echo json_encode($total_receiving_3months); ?>,
                total_expense: <?php echo json_encode($total_expense_3months); ?>,
                total_profit: <?php echo json_encode($total_profit_3months); ?>,
                margin_percentage: <?php echo json_encode($margin_percentage_3months); ?>,
                total_revenue_after_discount: <?php echo json_encode($total_revenue_after_discount_3months); ?>,
                most_selling_products: <?php echo json_encode($most_selling_products_3months); ?>,
                least_selling_products: <?php echo json_encode($least_selling_products_3months); ?>,
                top_customers_by_sales: <?php echo json_encode($top_customers_by_sales_3months); ?>
            },
            '6months': {
                total_customers_added: <?php echo json_encode($total_customers_added_6months); ?>,
                total_sales: <?php echo json_encode($total_sales_6months); ?>,
                // total_invoices: <?php echo json_encode($total_invoices_6months); ?>,
                total_sold_quantity: <?php echo json_encode($total_sold_quantity_6months); ?>,
                total_customers: <?php echo json_encode($total_customers_6months); ?>,
                total_sale_returns: <?php echo json_encode($total_sale_returns_6months); ?>,
                total_revenue: <?php echo json_encode($total_revenue_6months); ?>,
                total_receivings: <?php echo json_encode($total_receivings_6months); ?>,
                total_purchases: <?php echo json_encode($total_purchases_6months); ?>,
                total_bills: <?php echo json_encode($total_bills_6months); ?>,
                total_suppliers: <?php echo json_encode($total_suppliers_6months); ?>,
                purchase_returns: <?php echo json_encode($purchase_returns_6months); ?>,
                total_receiving: <?php echo json_encode($total_receiving_6months); ?>,
                total_expense: <?php echo json_encode($total_expense_6months); ?>,
                total_profit: <?php echo json_encode($total_profit_6months); ?>,
                margin_percentage: <?php echo json_encode($margin_percentage_6months); ?>,
                total_revenue_after_discount: <?php echo json_encode($total_revenue_after_discount_6months); ?>,
                most_selling_products: <?php echo json_encode($most_selling_products_6months); ?>,
                least_selling_products: <?php echo json_encode($least_selling_products_6months); ?>,
                top_customers_by_sales: <?php echo json_encode($top_customers_by_sales_6months); ?>
            },
            year: {
                total_customers_added: <?php echo json_encode($total_customers_added_year); ?>,
                total_sales: <?php echo json_encode($total_sales_year); ?>,
                // total_invoices: <?php echo json_encode($total_invoices_year); ?>,
                total_sold_quantity: <?php echo json_encode($total_sold_quantity_year); ?>,
                total_customers: <?php echo json_encode($total_customers_year); ?>,
                total_sale_returns: <?php echo json_encode($total_sale_returns_year); ?>,
                total_revenue: <?php echo json_encode($total_revenue_year); ?>,
                total_receivings: <?php echo json_encode($total_receivings_year); ?>,
                total_purchases: <?php echo json_encode($total_purchases_year); ?>,
                total_bills: <?php echo json_encode($total_bills_year); ?>,
                total_suppliers: <?php echo json_encode($total_suppliers_year); ?>,
                total_receiving: <?php echo json_encode($total_receiving_year); ?>,
                total_expense: <?php echo json_encode($total_expense_year); ?>,
                total_profit: <?php echo json_encode($total_profit_year); ?>,
                margin_percentage: <?php echo json_encode($margin_percentage_year); ?>,
                total_revenue_after_discount: <?php echo json_encode($total_revenue_after_discount_year); ?>,
                most_selling_products: <?php echo json_encode($most_selling_products_year); ?>,
                least_selling_products: <?php echo json_encode($least_selling_products_year); ?>,
                top_customers_by_sales: <?php echo json_encode($top_customers_by_sales_year); ?>
            },
            whole: {
                total_customers_added: <?php echo json_encode($total_customers_added_whole); ?>,
                total_sales: <?php echo json_encode($total_sales_whole); ?>,
                // total_invoices: <?php echo json_encode($total_invoices_whole); ?>,
                total_sold_quantity: <?php echo json_encode($total_sold_quantity_whole); ?>,
                total_customers: <?php echo json_encode($total_customers_whole); ?>,
                total_sale_returns: <?php echo json_encode($total_sale_returns_whole); ?>,
                total_revenue: <?php echo json_encode($total_revenue_whole); ?>,
                total_receivings: <?php echo json_encode($total_receivings_whole); ?>,
                total_purchases: <?php echo json_encode($total_purchases_whole); ?>,
                total_bills: <?php echo json_encode($total_bills_whole); ?>,
                total_suppliers: <?php echo json_encode($total_suppliers_whole); ?>,
                purchase_returns: <?php echo json_encode($purchase_returns_whole); ?>,
                total_receiving: <?php echo json_encode($total_receiving_whole); ?>,
                total_expense: <?php echo json_encode($total_expense_whole); ?>,
                total_profit: <?php echo json_encode($total_profit_whole); ?>,
                total_revenue_after_discount: <?php echo json_encode($total_revenue_after_discount_whole); ?>,
                most_selling_products: <?php echo json_encode($most_selling_products_whole); ?>,
                least_selling_products: <?php echo json_encode($least_selling_products_whole); ?>,
                top_customers_by_sales: <?php echo json_encode($top_customers_by_sales_whole); ?>
            }
        };

        // function formatCurrency(amount) {
        //     return 'RS ' + parseFloat(amount).toFixed(2);
        // }
        function formatCurrency(amount) {
            // Function to add commas to numbers
            function addCommas(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        
            // If the amount is greater than or equal to a Crore (1 Cr = 10,000,000)
            if (amount >= 10000000) {
                return '₹ ' + addCommas((amount / 10000000).toFixed(2)) + ' Cr';  // Formatting to 1 decimal place for Crores
            }
            // If the amount is greater than or equal to a Lakh (1 L = 100,000)
            else if (amount >= 100000) {
                return '₹ ' + addCommas((amount / 100000).toFixed(2)) + ' L';  // Formatting to 1 decimal place for Lakhs
            }
            // If the amount is less than 1 Lakh, show the normal amount with commas
            else {
                return '₹ ' + addCommas(parseFloat(amount).toFixed(2));  // Show the amount with two decimal places and commas
            }
        }
        
        var totalDue = <?php echo $total_due_receivings; ?>; 
        var totalStockPrice = <?php echo $total_stock_price; ?>;
    
        // Format value and Insert the formatted value into the HTML element
        document.getElementById('total-due-receiving').textContent = formatCurrency(totalDue);
        document.getElementById('total-stock-price').textContent = formatCurrency(totalStockPrice);
        
        var topCustomersByDue = <?php echo json_encode($top_customers_by_due); ?>;
        // Get today's date for the URL (current date, format YYYY-MM-DD)
        var currentDate = new Date();
        var startDate = '2010-01-01';  // Static start date
        var endDate = currentDate.toISOString().split('T')[0];  // Dynamic end date: current date 
        // Create the "View More" link dynamically using the current date
        var viewMoreLink = 'reports/detailed_sales/' + encodeURIComponent(startDate) + '/' + encodeURIComponent(endDate) + '/complete/all/0';
        document.getElementById('view-more-link').href = viewMoreLink;
        var topCustomerDueTable = '';
        // Populate the customer data in the table
        if (topCustomersByDue && topCustomersByDue.length > 0) {
            $.each(topCustomersByDue.slice(0, 20), function(index, customer) {
                // Create the dynamic URL for the customer details
                var customerLink = 'reports/specific_customer/' + encodeURIComponent(startDate) + '/' + encodeURIComponent(endDate) + '/' + customer.customer_id + '/complete/due';
                
                // Append each customer row to the table
               topCustomerDueTable += '<tr>' +
                        '<td><a href="' + customerLink + '" style="color: #4987bd;">' + customer.customer_name + '</a></td>' + 
                        '<td>' + customer.phone_number + '</td>' +
                        '<td>' + customer.total_due_amount + '</td>' +
                        '<td>' + customer.due_count + '</td>' +
                        '</tr>';
            });
        } else {
            topCustomerDueTable += '<tr><td colspan="4">No data available</td></tr>';
        }
        // Insert the dynamically generated rows into the table
        $('#top-customers-by-due tbody').html(topCustomerDueTable);


        function updateDashboard(period) {
            $('#total-customers-added').text(data[period].total_customers_added);
            $('#total-sales').text(data[period].total_sales);
            // $('#total-invoices').text(data[period].total_invoices);
            $('#total-sold-quantity').text(data[period].total_sold_quantity);
            $('#total-customers').text(data[period].total_customers);
            $('#total-sale-returns').text(data[period].total_sale_returns);
            $('#total-revenue').text(formatCurrency(data[period].total_revenue));
            $('#total-receivings').text(data[period].total_receivings);
            $('#total-purchases').text(formatCurrency(data[period].total_purchases));
            $('#total-bills').text(formatCurrency(data[period].total_bills));
            $('#total-suppliers').text(data[period].total_suppliers);
            $('#purchase-returns').text(data[period].purchase_returns);
            $('#total-receiving').text(formatCurrency(data[period].total_receiving));
            $('#total-expense').text(formatCurrency(data[period].total_expense));
            $('#total-profit').text(formatCurrency(data[period].total_profit));
            $('#margin-percentage').text((Number(data[period].margin_percentage).toFixed(2) || '0.00' )+ '%');
            $('#total-revenue-after-discount').text(formatCurrency(data[period].total_revenue_after_discount));
            
            // console.log('ajnshjs',data);
            // updateTrendIndicator(data[period].total_sales, data[week].total_sales, '#sales-change-indicator'); 
            
            // Update most selling products table
            var mostProductsTable = '<tr><th>Name</th><th>Total Sold</th><th>Total Price (MRP)</th><th>Number of Sales</th></tr>';
            if (data[period].most_selling_products.length > 0) {
                $.each(data[period].most_selling_products.slice(0, 10), function(index, product) {
                    mostProductsTable += '<tr><td>' + product.name + '</td><td>' + product.total_sold + '</td><td>' + product.total_price + '</td><td>' + product.num_transactions + '</td></tr>';
                });
            } else {
                mostProductsTable += '<tr><td colspan="4">No data available</td></tr>';
            }
            $('#most-selling-products').html(mostProductsTable);


            // Update least selling products table
            var leastProductsTable = '<tr><th>Name</th><th>Total Sold</th><th>Total Price (MRP)</th><th>Number of Sales</th></tr>';
            if (data[period].least_selling_products.length > 0) {
                $.each(data[period].least_selling_products.slice(0, 10), function(index, product) {
                    leastProductsTable += '<tr><td>' + product.name + '</td><td>' + product.total_sold + '</td><td>' + product.total_price + '</td><td>' + product.num_transactions + '</td></tr>';
                });
            } else {
                leastProductsTable += '<tr><td colspan="2">No data available</td></tr>';
            }
            $('#least-selling-products').html(leastProductsTable);

            var topCustomerTable = '<tr><th>Name</th><th>Total Sold Price</th></tr>';
            if (data[period].top_customers_by_sales.length > 0) {
                $.each(data[period].top_customers_by_sales.slice(0, 10), function(index, sale) {
                    topCustomerTable += '<tr><td>' + sale.customer_name + '</td><td>' + sale.total_sold_price + '</td></tr>';
                });
            } else {
                topCustomerTable += '<tr><td colspan="2">No data available</td></tr>';
            }
            $('#top-customers-by-sale').html(topCustomerTable);
        }

        // Initial display
        updateDashboard('day');
        
        // function updateTrendIndicator(current, previous, elementId) {
        //     var changePercentage = ((current - previous) / previous * 100).toFixed(2);
        //     var trendIndicator = '';
        
        //     if (current > previous) {
        //         trendIndicator = '<span class="glyphicon glyphicon-arrow-up" style="color: green;"></span> +' + changePercentage + '%';
        //     } else if (current < previous) {
        //         trendIndicator = '<span class="glyphicon glyphicon-arrow-down" style="color: red;"></span> ' + changePercentage + '%';
        //     } else {
        //         trendIndicator = '<span class="glyphicon glyphicon-minus" style="color: gray;"></span> No change';
        //     }
        
        //     $(elementId).html(trendIndicator);
        // }


        // Dropdown change event
        $('#period-dropdown').change(function() {
            var selectedPeriod = $(this).val();
            updateDashboard(selectedPeriod);
        });
    });
</script>

<?php
if (isset($error)) {
    echo "<div class='alert alert-dismissible alert-danger'>" . $error . "</div>";
}
?>

<div class="dashboard_body">
    <div class="header">
        <label for="period-dropdown">Select Period:</label>
        <select id="period-dropdown">
            <option value="day">Today</option>
            <option value="week">This Week</option>
            <option value="month">This Month</option>
            <option value="3months">Last 3 Months</option>
            <option value="6months">Last 6 Months</option>
            <option value="year">This Year</option>
            <option value="whole">Overall</option>
        </select>
    </div>

   <div class="dashboard">
    <div class="cardnew light-pink total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-stats glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Sales</h5>
                <p id="total-sales" class="sales-value"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $sale_comparison['trend'] === 'up' ? 'profit' : ($sale_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $sale_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($sale_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $sale_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $sale_comparison['trend'] === 'up' ? 'Increased' : 
                    ($sale_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $sale_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-pink total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon rupee glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Revenue</h5>
                <p id="total-revenue" class="revenue-value"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
        <!-- Display trend icon and percentage change -->
        <span class="glyphicon <?= $revenue_comparison['trend'] === 'up' ? 'profit' : ($revenue_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
            <!-- For Up trend (Increase) -->
            <i class="glyphicon <?= $revenue_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                   ($revenue_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
               style="vertical-align: middle;">
            </i>
            <?= $revenue_comparison['percentage_change'] ?>%
        </span>
    
        <!-- Display count of days or "No Change" if there's no trend -->
        <span id="countOfDays" class="count-days" style="line-height: 1;">
            <?= $revenue_comparison['trend'] === 'up' ? 'Increased' : 
                ($revenue_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
            in <?= $revenue_comparison['count_of_days'] ?>
        </span>
    </div>
    </div>
    
    <div class="cardnew light-pink total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-th glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Sold Quantity</h5>
                <p id="total-sold-quantity"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $total_sale_returns_comparison['trend'] === 'up' ? 'profit' : ($total_sale_returns_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $total_sale_returns_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($total_sale_returns_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $total_sale_returns_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $total_sale_returns_comparison['trend'] === 'up' ? 'Increased' : 
                    ($total_sale_returns_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $total_sale_returns_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-pink total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-user glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Customers</h5>
                <p id="total-customers"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $total_customers_comparison['trend'] === 'up' ? 'profit' : ($total_customers_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $total_customers_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($total_customers_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $total_customers_comparison['percentage_change'] ?>%
            </span>
        
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $total_customers_comparison['trend'] === 'up' ? 'Increased' : 
                    ($total_customers_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $total_customers_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-pink total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-remove glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Sale Returns</h5>
                <p id="total-sale-returns"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $sold_quantity_comparison['trend'] === 'up' ? 'profit' : ($sold_quantity_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $sold_quantity_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($sold_quantity_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $sold_quantity_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $sold_quantity_comparison['trend'] === 'up' ? 'Increased' : 
                    ($sold_quantity_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $sold_quantity_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-purple total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-inbox glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Receivings</h5>
                <p id="total-receivings"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
        <!-- Display trend icon and percentage change -->
        <span class="glyphicon <?= $receiving_comparison['trend'] === 'up' ? 'profit' : ($receiving_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
            <!-- For Up trend (Increase) -->
            <i class="glyphicon <?= $receiving_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                   ($receiving_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
               style="vertical-align: middle;">
            </i>
            <?= $receiving_comparison['percentage_change'] ?>%
        </span>
    
        <!-- Display count of days or "No Change" if there's no trend -->
        <span id="countOfDays" class="count-days" style="line-height: 1;">
            <?= $receiving_comparison['trend'] === 'up' ? 'Increased' : 
                ($receiving_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
            in <?= $receiving_comparison['count_of_days'] ?>
        </span>
    </div>
    </div>
    
    <div class="cardnew light-purple total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-file glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Bills</h5>
                <p id="total-bills"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $total_bills_comparison['trend'] === 'up' ? 'profit' : ($total_bills_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $total_bills_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($total_bills_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $total_bills_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $total_bills_comparison['trend'] === 'up' ? 'Increased' : 
                    ($total_bills_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $total_bills_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-purple total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-briefcase glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Suppliers</h5>
                <p id="total-suppliers"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $total_suppliers_comparison['trend'] === 'up' ? 'profit' : ($total_suppliers_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $total_suppliers_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($total_suppliers_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $total_suppliers_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $total_suppliers_comparison['trend'] === 'up' ? 'Increased' : 
                    ($total_suppliers_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $total_suppliers_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-purple total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-arrow-up glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Purchase Returns</h5>
                <p id="purchase-returns"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $purchase_returns_comparison['trend'] === 'up' ? 'profit' : ($purchase_returns_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $purchase_returns_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($purchase_returns_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $purchase_returns_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $purchase_returns_comparison['trend'] === 'up' ? 'Increased' : 
                    ($purchase_returns_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $purchase_returns_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-purple total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-credit-card glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Due</h5>
                <!--<p id="total-due-receiving"><?php echo to_currency($total_due_receivings, 2); ?></p>-->
                <p id="total-due-receiving"></p>
            </div>
        </div>
    </div>
    
    <div class="cardnew light-blue total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-plus glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Customers Added</h5>
                <p id="total-customers-added"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $customers_added_comparison['trend'] === 'up' ? 'profit' : ($customers_added_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $customers_added_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($customers_added_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $customers_added_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $customers_added_comparison['trend'] === 'up' ? 'Increased' : 
                    ($customers_added_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $customers_added_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-blue total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-piggy-bank glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Expenses</h5>
                <p id="total-expense"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $expense_categories_comparison['trend'] === 'up' ? 'profit' : ($expense_categories_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $expense_categories_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($expense_categories_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $expense_categories_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $expense_categories_comparison['trend'] === 'up' ? 'Increased' : 
                    ($expense_categories_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $expense_categories_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-blue total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-th glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Products</h5>
                <p id="total-products"><?php echo $total_products; ?></p>
            </div>
        </div>
    </div>
    
    <div class="cardnew light-blue total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-inbox glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Stock</h5>
                <p id="total-stock"><?php echo $total_stock; ?></p>
            </div>
        </div>
    </div>
    
    <div class="cardnew light-blue total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon rupee glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Stock Price</h5>
                <p id="total-stock-price"></p>
            </div>
        </div>
    </div>
    
    <div class="cardnew light-green total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-signal glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Total Profit</h5>
                <p id="total-profit"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $profit_comparison['trend'] === 'up' ? 'profit' : ($profit_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $profit_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($profit_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $profit_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $profit_comparison['trend'] === 'up' ? 'Increased' : 
                    ($profit_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $profit_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-green total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon glyphicon-stats glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Margin Percentage</h5>
                <p id="margin-percentage"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $margin_percentage_comparison['trend'] === 'up' ? 'profit' : ($margin_percentage_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $margin_percentage_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($margin_percentage_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $margin_percentage_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $margin_percentage_comparison['trend'] === 'up' ? 'Increased' : 
                    ($margin_percentage_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $margin_percentage_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-green total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2><span class="glyphicon rupee glyphicon-icon">&nbsp;</span></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5>Revenue After Discounts</h5>
                <p id="total-revenue-after-discount"></p>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: flex-end; gap: 5px;">
            <!-- Display trend icon and percentage change -->
            <span class="glyphicon <?= $revenue_after_discount_comparison['trend'] === 'up' ? 'profit' : ($revenue_after_discount_comparison['trend'] === 'down' ? 'loss' : 'neutral') ?>" style="line-height: 1;">
                <!-- For Up trend (Increase) -->
                <i class="glyphicon <?= $revenue_after_discount_comparison['trend'] === 'up' ? 'glyphicon-arrow-up up-arrow text-success' : 
                                       ($revenue_after_discount_comparison['trend'] === 'down' ? 'glyphicon-arrow-down down-arrow text-danger' : 'glyphicon-minus text-muted') ?>" 
                   style="vertical-align: middle;">
                </i>
                <?= $revenue_after_discount_comparison['percentage_change'] ?>%
            </span>
            <!-- Display count of days or "No Change" if there's no trend -->
            <span id="countOfDays" class="count-days" style="line-height: 1;">
                <?= $revenue_after_discount_comparison['trend'] === 'up' ? 'Increased' : 
                    ($revenue_after_discount_comparison['trend'] === 'down' ? 'Decreased' : 'No Change') ?> 
                in <?= $revenue_after_discount_comparison['count_of_days'] ?>
            </span>
        </div>
    </div>
    
    <div class="cardnew light-green empty total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5></h5>
                <p></p>
            </div>
        </div>
    </div>
    
    <div class="cardnew light-green empty total-sales-card">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4 col-xl-4 col-sm-3 col-xs-3">
                <h2></h2>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-8 col-sm-9 col-xs-9">
                <h5></h5>
                <p></p>
            </div>
        </div>
    </div>
</div>


<div class="tables-container">
    <div class="table-card">
        <h4 style="text-align: center">Top Customers</h4>
        <!-- Color Indicators for Highest and Lowest Sales -->
        <div class="color-indicators">
            <div class="indicator max-sale">
                <div class="color-box max-color"></div>
                <span>Max Purchase</span>
            </div>
            <div class="indicator min-sale">
                <div class="color-box min-color"></div>
                <span>Min Purchase</span>
            </div>
        </div>
        <!-- Chart container -->
        <div>
            <canvas id="customerChart"></canvas>
        </div>
    </div>
    
    <!-- Sales Performance Over Last 7 Fortnights -->
    <div class="table-card">
        <h4 class="title">Sales Performance Over Last 7 Fortnights</h4>
        <!-- Color Indicators for Highest and Lowest Sales -->
        <div class="color-indicators">
            <div class="indicator max-sale">
                <div class="color-box max-color"></div>
                <span>Max Sale</span>
            </div>
            <div class="indicator min-sale">
                <div class="color-box min-color"></div>
                <span>Min Sale</span>
            </div>
        </div>
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
    
            <div class="table-card">
            <h4 class="table-card-header">
                <span>Top Customers by Due Amount</span>
                <a id="view-more-link" href="#" class="view-more-link">
                    View More <span class="right-arrow">&gt;</span>
                </a>
            </h4>
            <div class="table-wrapper">
                <table id="top-customers-by-due" class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Phone Number</th>
                            <th>Total Due Amount</th>
                            <th>Number of Due Entries</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be inserted here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="table-card">
            <h4 style="text-align: center">Customer Visit Frequency</h4>
            <canvas id="visitFrequencyChart" ></canvas>
        </div>
        
    <div class="light-grey table-card">
        <h4 style="text-align: center">Most Selling Products</h4>
        <div class="table-wrapper">
            <table id="most-selling-products" class="dashboard-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity Sold</th>
                        <th>Total Price (MRP)</th>
                        <th>Number of Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be inserted here dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    
        <div class="table-card">
            <h4 style="text-align: center">Least Selling Products</h4>
            <div class="table-wrapper">
                <table id="least-selling-products" class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity Sold</th>
                            <th>Total Price (MRP)</th>
                            <th>Number of Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be inserted here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

</div>

<!-- Start - chart js specific example -->
<script type="text/javascript" src="js/Chart.min.js"></script>
<script>
    $(document).ready(function() {
        const data = {
            day: <?php echo json_encode($top_customers_by_sales_day); ?>,
            week: <?php echo json_encode($top_customers_by_sales_week); ?>,
            month: <?php echo json_encode($top_customers_by_sales_month); ?>,
            '3months': <?php echo json_encode($top_customers_by_sales_3months); ?>,
            '6months': <?php echo json_encode($top_customers_by_sales_6months); ?>,
            year: <?php echo json_encode($top_customers_by_sales_year); ?>,
            whole: <?php echo json_encode($top_customers_by_sales_whole); ?>
        };

        // Helper function to format currency
        function formatCurrency(amount) {
            return '₹ ' + parseFloat(amount).toFixed(2);
        }

        // Helper function to determine bar colors
        function getBarColors(data, max, min) {
            return data.map(value => {
                if (value === max) return '#81C784'; // Light Green for max
                if (value === min) return '#E57373'; // Light Red for min
                return '#5285bb'; // Default blue
            });
        }

        // Helper function to create and update a chart
        function createChart(ctx, chartData, chartOptions) {
            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: chartOptions
            });
        }

        // Function to update customer chart based on period
        function updateCustomerChart(period) {
            const topCustomers = data[period];

            // Extract data for the chart
            const customerNames = topCustomers.map(customer => customer.customer_name);
            const totalPurchases = topCustomers.map(customer => parseFloat(customer.total_sold_price).toFixed(2));
            const numberOfPurchases = topCustomers.map(customer => customer.number_of_purchases);
            const averagePurchaseValue = topCustomers.map(customer => customer.average_purchase_value);

            const maxSales = Math.max(...totalPurchases).toFixed(2);
            const minSales = Math.min(...totalPurchases).toFixed(2);
            
            const barColors = getBarColors(totalPurchases, maxSales, minSales);

            const chartData = {
                labels: customerNames,
                datasets: [{
                    label: 'Total Purchases in ₹',
                    data: totalPurchases,
                    backgroundColor: barColors,
                    borderColor: barColors,
                    borderWidth: 1
                }]
            };

            const chartOptions = {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItem) {
                                return tooltipItem[0].label;
                            },
                            label: function(context) {
                                const index = context.dataIndex;
                                const totalSales = context.raw;
                                const numPurchases = numberOfPurchases[index];
                                const avgPurchase = averagePurchaseValue[index];

                                return [
                                    `Total Sales: ₹${totalSales.toLocaleString()}`,
                                    `Number of Purchases: ${numPurchases}`,
                                    `Average Purchase: ₹${avgPurchase.toFixed(2)}`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Purchases (₹)',
                            font: { size: 14, weight: 'bold' }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Customers',
                            font: { size: 14, weight: 'bold' }
                        }
                    }
                }
            };

            const ctx = document.getElementById('customerChart').getContext('2d');
            createChart(ctx, chartData, chartOptions);
        }

        // Function to update fortnight sales chart
        function updateFortnightSalesChart() {
            const fortnightSalesData = <?php echo json_encode($fortnight_sales); ?>;

            // Sort and format the data
            fortnightSalesData.sort((a, b) => new Date(a.start_date) - new Date(b.start_date));
            const salesData = fortnightSalesData.map(item => item.total_sales);
            const labels = fortnightSalesData.map(item => {
                const startDate = new Date(item.start_date);
                const endDate = new Date(item.end_date);
                const startMonth = startDate.toLocaleString('default', { month: 'short' });
                const endMonth = endDate.toLocaleString('default', { month: 'short' });
                const startDay = startDate.getDate();
                const endDay = endDate.getDate();
                return startMonth === endMonth ? `${startMonth} ${startDay} - ${endDay}` : `${startMonth} ${startDay} - ${endMonth} ${endDay}`;
            });

            const maxSales = Math.max(...salesData).toFixed(2);
            const minSales = Math.min(...salesData).toFixed(2);
            const barColors = getBarColors(salesData, maxSales, minSales);

            const chartData = {
                labels: labels,
                datasets: [{
                    label: 'Sales in ₹',
                    data: salesData,
                    backgroundColor: barColors,
                    borderWidth: 1
                }]
            };

            const chartOptions = {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `₹${context.raw.toLocaleString()}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Sales in Rupees (₹)',
                            font: { size: 14, weight: 'bold' }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fortnight Period',
                            font: { size: 14, weight: 'bold' }
                        },
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 7
                        }
                    }
                }
            };

            const ctx = document.getElementById('myChart').getContext('2d');
            createChart(ctx, chartData, chartOptions);
        }
        
        // Function to update visit frequency pie chart
        function updateVisitFrequencyChart() {
            // Data passed from PHP to JavaScript
            const visitFrequencyData = <?php echo json_encode($customer_visit_frequency); ?>;
        
            // Prepare data for the pie chart (total visits per frequency type)
            const labels = Object.keys(visitFrequencyData);
            const data = Object.values(visitFrequencyData);
        
            // Data for the Pie chart
            const pieData = {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: generateRandomColors(data.length),
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            };
        
            // Options for the Pie chart
            const pieOptions = {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const index = tooltipItem.dataIndex;
                                const frequency = labels[index];
                                const totalVisits = data[index];
                                return `${frequency}: ${totalVisits} visits`;
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 15
                        }
                    },
                    // Custom plugin to display the visit frequency on each slice
                    datalabels: {
                        formatter: function(value, context) {
                            const index = context.dataIndex;
                            return `${data[index]} visits`;
                        },
                        color: 'white',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        anchor: 'center', // Position the text in the center of the slice
                        align: 'center'
                    }
                }
            };
        
            // Get the context of the canvas and create or update the pie chart
            const ctx = document.getElementById('visitFrequencyChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie', // You can change it to 'doughnut' if preferred
                data: pieData,
                options: pieOptions
            });
        }
    
        // Function to generate random colors for the remaining slices
        function generateRandomColors(count) {
            const colors = [];
        
            // Fixed colors for the first two slices: pink and Light Blue
            if (count > 0) colors.push('rgb(255, 182, 193)'); 
            if (count > 1) colors.push('rgb(135, 206, 250)'); 
        
            // Generate softer and vibrant random colors for the remaining slices
            for (let i = 2; i < count; i++) {
                const r = Math.floor(Math.random() * 150 + 100); // Ensures the red component is moderate
                const g = Math.floor(Math.random() * 150 + 100); // Ensures the green component is moderate
                const b = Math.floor(Math.random() * 150 + 100); // Ensures the blue component is moderate
                colors.push(`rgb(${r}, ${g}, ${b})`);
            }
        
            return colors;

        }


        // Initialize charts
        updateCustomerChart('day');
        updateFortnightSalesChart();
        updateVisitFrequencyChart();

        // Update charts when dropdown changes
        $('#period-dropdown').change(function() {
            const selectedPeriod = $(this).val();
            updateCustomerChart(selectedPeriod);
        });
    });
</script>


<?php $this->load->view("partial/footer"); ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
        margin: 0;
        padding: 0;
    }
    
    .dashboard_body {
        display: flex;
        flex-direction: column;
        align-items: center;
        /*padding: 20px;*/
        /*background-color: #ffffff;*/
        /*max-width: 1200px;*/
        margin: auto;
        box-shadow: 0 0 10px rgba (0,0,0,0.1);
        border-radius: 8px;
    }
    
    .header {
        width: 100%;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 0 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .header label {
        margin-right: 15px;
        font-size: 16px;
        font-weight: bold;
    }
    
    .header select {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #ffffff;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    
    .header select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.5);
        outline: none;
    }
    
    .dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
        width: 100%;
        padding: 20px;
    }
    
    .card {
        padding: 20px;
        text-align: center;
        border-radius: 12px; /* More rounded corners */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.13);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card h3 {
        margin: 0 0 10px;
        font-size: 18px;
        font-weight: bold;
    }
    
    .card p {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }
    
    /*.card.light-green {*/
    /*    background-color: #b6e9cf;*/
    /*}*/
    
    /*.card.light-blue {*/
    /*    background-color: #e1f5fe;*/
    /*}*/
    
    /*.card.light-purple {*/
    /*    background-color: #f3e5f5;*/
    /*}*/
    
    /*.card.light-pink {*/
    /*    background-color: #fce4ec;*/
    /*}*/
    /*.card.light-grey {*/
    /*    background-color: #e0e0e0;*/
    /*}*/

    /*.card.empty {*/
    /*    background-color: #f2f2f2; */
    /*    border: 2px dashed #ccc; */
    /*}*/

    .cardnew {
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 5px;
        background-color: #5C8997;
        color: #f4f4f4;
        border-radius: 12px; /* More rounded corners */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.13);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Ensure content is spaced between top and bottom */
        height: 100%;
        
        .row{
            padding-top: 7px;
        }
    }
    
    /* Hover effect to scale up the card */
    .cardnew:not(.empty):hover {
        transform: scale(1.05); /* Makes the card 5% larger */
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* Adds a stronger shadow on hover */
    }

    .cardnew h3 {
        margin: 0 0 10px;        
        font-size: 18px;
        font-weight: bold;
    }
    
    .cardnew p {
        margin: 0;
        font-size: 22px;
        font-weight: bold;
    }

    .cardnew.light-purple {
        background-color: #f3e5f5;
    }

    .cardnew.empty {
        background-color: #f2f2f2; 
        border: 2px dashed #ccc; 
    }

    .glyphicon.profit {
        color: #4CAF50;
    }

    .glyphicon.loss {
        color: #dc3545;
    }
    
    .cardnew.light-green {
        background-color: #b6e9cf;
    }
    
    .cardnew.light-blue {
        background-color: #e1f5fe;
    }
    
    .cardnew.light-purple {
        background-color: #f3e5f5;
    }
    
    .cardnew.light-pink {
        background-color: #fce4ec;
    }
    
    .cardnew.light-grey {
        background-color: #e0e0e0;
    }
    
    .cardnew.empty {
        background-color: #f2f2f2; 
        border: 2px dashed #ccc; 
    }

    .card h3, .card p,
    .cardnew h3, .cardnew p {
        color: black; /* Set text color to black */
    }
    
    .glyphicon-icon {
        color: black; /* Set glyphicon color to black */
    }
    
    .cardnew h5 {
        color: black; /* Set h5 color to black */
    }
    
    .tables-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        width: 100%;
        gap: 20px;
        padding: 20px;
    }

    .table-card {
        width: 50%;
        min-width: 300px;
        max-height: 400px;
        overflow: auto;
        flex: 1 1 calc(50% - 20px);
        border-radius: 8px;
        /*background-color: #f9f9f9;*/
        /*box-shadow: 0 4px 6px rgba(0, 0, 0, 0.13);*/
        transition: all 0.3s ease; /* Smooth transition for hover effect */
        position: relative;
        overflow: hidden;
        padding: 15px;  
        box-shadow: 0 0 10px rgba(0,0,0,0.2); 
        background-color: #ffffff; 
    }
    
    /* Make the table inside the card scrollable */
    .table-card .table-wrapper {
        overflow-y: auto; /* Enable vertical scrolling */
        max-height: 300px; /* Set a height limit for the table body */
        padding-right: 10px; /* Prevent scrollbar overlap */
    }
    
    /* Table card hover effect */
    .table-card:hover {
        transform: translateY(-5px);  /* Slight lift on hover */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15); /* Larger shadow */
        background-color: rgba(75, 192, 192, 0.1);  /* Light background change */
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        background-color: #ffffff; 
        box-shadow: 0 0 10px rgba(0,0,0,0.12); 
        border-radius: 8px; 
        overflow: hidden; 
    }

    /* Table Header Styling */
    .dashboard-table th {
        background-color: #34495e; 
        color: white; 
        font-weight: bold;
        padding: 12px; 
        border-bottom: 2px solid #dddddd;
    }

    .dashboard-table td {
        padding: 12px; 
        text-align: left; 
        border-bottom: 1px solid #dddddd; 
    }

    /* Row Striping for Better Readability */
    .dashboard-table tr:nth-child(even) {
        background-color: #f2f2f2; 
    }

    .dashboard-table td[colspan="2"] {
        text-align: center;
        font-style: italic;
    }
    
    .table-card-header {
        text-align: center;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .view-more-link {
        font-size: 14px;
        font-weight: bold;
        color: #4987bd;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .view-more-link:hover {
        text-decoration: underline;
    }

    .right-arrow {
        margin-left: 5px;
    }
    
    .rupee {
        font-size: 1.7em;  /* Makes the symbol bigger */
        font-weight: bold; /* Makes the symbol bold */
        margin-top: -0.37em;
    }
    .rupee::before {
            content: "₹";          /* Adds the Indian Rupee symbol */
        }
        
    /* Styling for the Chart*/
    .title {
      text-align: center;
    }
    
    /* Container for color indicators */
    .color-indicators {
      display: flex;
      justify-content: center;
      margin-bottom: 10px;
    }
    
    /* Styling for each individual indicator (max and min sales) */
    .indicator {
      display: flex;
      align-items: center;
      margin-right: 20px;
    }
    
    .color-box {
      width: 20px;
      height: 10px;
      margin-right: 5px;
    }
    
    .max-color {
      background-color: #81C784; /* Green for max sale */
    }
    
    .min-color {
      background-color: #E57373; /* Red for min sale */
    }
    
    /* Rotate the up and down arrows */
     .glyphicon .up-arrow {
        transform: rotate(45deg); /* Tilt the up arrow 45 degrees */
        display: inline-block;    /* Ensure proper alignment */
        color: #4CAF50;
    }
    
    .glyphicon .down-arrow {
        transform: rotate(-45deg); /* Tilt the down arrow -45 degrees */
        display: inline-block;     /* Ensure proper alignment */
        color: #F44336;
    }
    .glyphicon-minus {
        color: gray;
        /*font-size: 16px;*/
        }
    
    /* Style for the count of days */
    .count-days {
        font-size: 8.4px;        /* Adjust the font size */
        font-weight: 700;      /* Make it bold */
        color: #808080;            /* Set a neutral color for the days */
        margin-left: 10px;      /* Space between the arrow and the count of days */
        font-style: italic;     /* Optional: make it italic */
    }


</style>