<?php $this->load->view("partial/header"); ?>
<style>
    .print_receipt
    {
        width: 80mm;
    }
    .token {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 10px;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .store-info
    {
        text-align: center;
        color: #000;
    }
    .attribute-group
    {
        margin-bottom: 20px;
    }
    td {
        padding: 2px;
    }
    .token-item {
        text-align: center;
    }
    table
    {
        margin:auto;
    }
    /* Styling for print-specific layout */
</style>
<div class="print_hide" id="control_buttons" style="text-align:right">
	<?php echo anchor("sales", '<span class="glyphicon glyphicon-shopping-cart">&nbsp</span>' . $this->lang->line('sales_register'), array('class'=>'btn btn-info btn-sm', 'id'=>'show_sales_button')); ?>
</div>
<div class="print_receipt">
<?php foreach ($groupedData as $attributeValue => $items): ?>
    <div class="attribute-group" id="counter-<?php echo $attributeValue; ?>">
    <div class="store-info">
        Shop No. 5&6, Panchsheel Arcade Chsl,<br>
        plot no.32, sector-5, Airoli, Navi Mumbai-400708<br><br>
        Token No.:  <?php echo $items[0]['token_number']; ?>
        
    </div>
        <div class="token-item">
            <div class="item-description">
                <table>
                    <tr>
                    <td style="padding-right:20px">Counter No.:  <?php echo $attributeValue; ?></td>
                    <td>Date: <?php echo date("d/m/Y"); ?></td>
                    </tr>
                    <tr style="text-align:center;">
                        <td>DESCRIPTION</td>
                        <td>QTY</td>
                    </tr>
                <?php foreach ($items as $item): ?> 
                    <tr style="text-align:center;">
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<script>
    window.onload = function() {
        // Get all counter elements
        const counters = document.querySelectorAll('.attribute-group');
        
        // Print each counter one by one
        counters.forEach((counter, index) => {
            setTimeout(() => {
                // Create a new window for printing
                const printWindow = window.open('', '_blank');
                printWindow.document.write('<html><head><title>Print Counter</title>');
                printWindow.document.write(`
                    <style>
                        .print_receipt {
                            width: 80mm;
                        }
                        .token {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 10px;
                        }
                        h2 {
                            text-align: center;
                            margin-bottom: 20px;
                        }
                        .store-info {
                            text-align: center;
                            color: #000;
                        }
                        .attribute-group {
                            border-width: 1px;
                            border-style: solid;
                            border-color: black;
                        }
                        td {
                            padding: 2px;
                        }
                        .token-item {
                            text-align: center;
                        }
                        table {
                            margin: auto;
                        }
                    </style>
                `);
                printWindow.document.write('</head><body>');
                printWindow.document.write(counter.innerHTML); // Add counter's HTML
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
                printWindow.close();
            }, index * 3000); // Delay to allow for each print dialog to show sequentially
        });
    };
</script>

<?php $this->load->view("partial/footer"); ?>
