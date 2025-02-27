<?php $this->load->view('partial/header'); ?>

<style>/* Ensure Full-Width Layout */
    .container {
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Elegant Page Header */
    .page-header {
        margin-bottom: 0 0 0;
        /* padding: 1.5rem 0;
        border-bottom: 2px solid #e9ecef; */
    }

    .page-header h3.text-center {
        color: #344d66;
        font-size: 2.6rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin: 0;
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }

    .page-header h3.text-center::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, #1a237e, #3949ab);
        border-radius: 2px;
    }

    /* Enhanced Item Info Block */
    .item-info-block {
        background: #ffffff;
        border-radius: 16px;
        padding: 2.5rem;
        margin: 2rem 0;
        box-shadow: 0 8px 24px rgba(149, 157, 165, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .item-info-block:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(149, 157, 165, 0.2);
    }

    .row {
        margin-bottom: 1.5rem;
    }

    /* Stylish Labels and Fields */
    .label-custom {
        font-weight: 600;
        color: #4a739d;
        font-size: 1.4rem;
        width: 160px;
        margin-bottom: 0.5rem;
        display: inline-block;
        position: relative;
    }

    .static-field {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        color: #2c3e50;
        font-size: 1.4rem;
        transition: all 0.3s ease;
        width: calc(100% - 180px);
        display: inline-block;
        margin-left: 10px;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .static-field:hover {
        border-color: #3f51b5;
        background-color: #ffffff;
    }

    /* Modern Table Styling */
    .table-container {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(149, 157, 165, 0.15);
        overflow: hidden;
        margin: 2rem 0;
    }

    .table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
    }

    .table thead th {
        background: linear-gradient(to right, #97999b, #34495E);
        color: #ffffff;
        padding: 1.2rem;
        font-weight: 600;
        font-size: 1.4rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f5f7ff;
    }

    .table tbody td {
        padding: 1.2rem;
        border-bottom: 1px solid #e0e0e0;
        color: #2c3e50;
        font-size: 1.4rem;
    }

    /* Inventory Data Section */
    .inventory-data {
        background: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 8px 24px rgba(149, 157, 165, 0.15);
    }

    .inventory-header {
        cursor: pointer;
        padding: 1.5rem;
        border-radius: 10px;
        background: linear-gradient(to right, #f8f9fa, #ffffff);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .inventory-header:hover {
        background: linear-gradient(to right, #e8eaf6, #f5f7ff);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .inventory-header h4 {
        color: #1a237e;
        font-size: 1.8rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .expand-icon {
        display: inline-block;
        font-size: 2.4rem;
        font-weight: bold;
        transform: rotate(90deg);
        transition: transform 0.3s ease;
    }

    .expand-icon.expanded {
        transform: rotate(270deg);
    }

    .collapse {
        display: none;
        padding: 2rem;
        border-top: 1px solid #e0e0e0;
    }

    .collapse.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-control {
        height: 40px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 0.5rem 1rem;
        font-size: 1.4rem;
        transition: all 0.3s ease;
        background-color: #ffffff;
        color: #2c3e50;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .form-control:focus {
        border-color: #3f51b5;
        box-shadow: 0 0 0 2px rgba(63, 81, 181, 0.2);
        outline: none;
    }</style>

<div class="container">
    <div class="page-header">
        <h3 class="text-center">Item Details</h3>
    </div>

    <!-- Item Info Block -->
    <div class="item-info-block">
        <div class="row">
            <div class="col-md-6">
                <label class="label-custom">Item Number:</label>
                <div class="static-field"><?php echo $item_info->item_number ?: '-'; ?></div>
            </div>
            <div class="col-md-6">
                <label class="label-custom">Item Name:</label>
                <div class="static-field"><?php echo $item_info->name ?: '-'; ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="label-custom">Batch Number:</label>
                <div class="static-field"><?php echo $item_info->batch_number ?: '-'; ?></div>
            </div>
            <div class="col-md-6">
                <label class="label-custom">Category:</label>
                <div class="static-field"><?php echo $item_info->category ?: '-'; ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="label-custom">HSN Code:</label>
                <div class="static-field"><?php echo $item_info->hsn_code ?: '-'; ?></div>
            </div>
            <div class="col-md-6">
                <label class="label-custom">Cost Price:</label>
                <div class="static-field"><?php echo $item_info->cost_price ?: '-'; ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="label-custom">Unit Price:</label>
                <div class="static-field"><?php echo $item_info->unit_price ?: '-'; ?></div>
            </div>
            <div class="col-md-6">
                <label class="label-custom">Pack Name:</label>
                <div class="static-field"><?php echo $item_info->pack_name ?: '-'; ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="label-custom">Description:</label>
                <div class="static-field"><?php echo !empty($item_info->description) ? $item_info->description : 'No description available.'; ?></div>
            </div>
        </div>
    </div>

    <!-- Stock Locations and Quantities Section -->
    <h4 class="text-center">
        Stock Locations & Quantities
    </h4>
    <div class="table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Current Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stock_locations as $location_id => $location_name) {
                    $quantity = isset($item_quantities[$location_id]) ? $item_quantities[$location_id] : 0;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($location_name); ?></td>
                        <td>
                            <div class="static-field"><?php echo (int) $quantity; ?></div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Expandable Inventory Data Section -->
    <div class="inventory-data">
        <div class="inventory-header" id="inventory-toggle">
            <h4 class="text-center">
                Inventory Data
                <span class="expand-icon">›</span>
            </h4>
        </div>
        <div class="collapse" id="inventory-collapse">
        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('items_stock_location'), 'stock_location', array('class'=>'control-label col-xs-3')); ?>
            <div class='col-xs-8'>
                <?php 
                // Add a default "Select" option at the beginning of the dropdown
                $stock_locations_with_select = array('' => '- select -') + $stock_locations;

                echo form_dropdown('stock_location', $stock_locations_with_select, current($stock_locations), array('onchange'=>'display_stock(this.value);', 'class'=>'form-control'));
                ?>
            </div>
        </div>

            <!-- Inventory Data Table -->
            <table id="items_count_details" class="table table-striped table-hover">
                <thead>
                    <tr style="background-color: #999 !important;">
                        <th colspan="4"><?php echo $this->lang->line('items_inventory_data_tracking'); ?></th>
                    </tr>
                    <tr>
                        <th width="30%"><?php echo $this->lang->line('items_inventory_date'); ?></th>
                        <th width="20%"><?php echo $this->lang->line('items_inventory_employee'); ?></th>
                        <th width="20%"><?php echo $this->lang->line('items_inventory_in_out_quantity'); ?></th>
                        <th width="30%"><?php echo $this->lang->line('items_inventory_remarks'); ?></th>
                    </tr>
                </thead>
                <tbody id="inventory_result">
		<?php
		/*
		 * the tbody content of the table will be filled in by the javascript (see bottom of page)
		*/

		$inventory_array = $this->Inventory->get_inventory_data_for_item($item_info->item_id)->result_array();
		$employee_name = array();

		foreach($inventory_array as $row)
		{
			$employee = $this->Employee->get_info($row['trans_user']);
			array_push($employee_name, $employee->first_name . ' ' . $employee->last_name);
		}
		?>
	</tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('partial/footer'); ?>

<script>
// JavaScript for handling the collapsible section
document.getElementById('inventory-toggle').addEventListener('click', function() {
    var collapseElement = document.getElementById('inventory-collapse');
    var expandIcon = this.querySelector('.expand-icon');
    
    if (collapseElement.classList.contains('show')) {
        collapseElement.classList.remove('show');
        expandIcon.classList.remove('expanded');
    } else {
        collapseElement.classList.add('show');
        expandIcon.classList.add('expanded');
    }
});

function display_stock(location_id) {
    var inventory_data = <?php echo json_encode($inventory_array); ?>;
    var employee_data = <?php echo json_encode($employee_name); ?>;

    var table = document.getElementById("inventory_result");

    // Clear previous table rows
    var rowCount = table.rows.length;
    for (var i = rowCount - 1; i >= 0; i--) {
        table.deleteRow(i);
    }

    // If no inventory data for the selected location
    var hasData = false;

    // Add new rows based on selected location
    for (var i = 0; i < inventory_data.length; i++) {
        var data = inventory_data[i];
        if (data['trans_location'] == location_id) {
            hasData = true;

            var tr = document.createElement('tr');

            var td = document.createElement('td');
            td.appendChild(document.createTextNode(data['trans_date']));
            tr.appendChild(td);

            td = document.createElement('td');
            td.appendChild(document.createTextNode(employee_data[i]));
            tr.appendChild(td);

            td = document.createElement('td');
            td.appendChild(document.createTextNode(parseFloat(data['trans_inventory']).toFixed(<?php echo quantity_decimals(); ?>)));
            td.setAttribute("style", "text-align:center");
            tr.appendChild(td);

            td = document.createElement('td');
            td.appendChild(document.createTextNode(data['trans_comment']));
            tr.appendChild(td);

            table.appendChild(tr);
        }
    }

    // If no data found for this location, display a message
    if (!hasData) {
        var tr = document.createElement('tr');
        var td = document.createElement('td');
        td.setAttribute('colspan', '4');
        td.appendChild(document.createTextNode('No inventory data available for this location.'));
        tr.appendChild(td);
        table.appendChild(tr);
    }
}

</script>