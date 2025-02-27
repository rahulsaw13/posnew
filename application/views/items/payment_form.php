<!-- NEw design css KH -->
<link rel="stylesheet" type="text/css" href="css/payment_form.css" />

<?php echo form_open('items/save/' . $item_info->item_id, array('id' => 'payment_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
<?php echo form_close(); ?>
<div class="sales-modal-container" id="calulator" style="display:none;">
	<div>	
		<div class="modal-row">
			<div class="display w-30 due-amount">
				<label for="dueAmount">Due Amount</label>
				<input type="text" id="dueAmount" name="dueAmount" onkeypress="return isNumber(event)" value="0" readonly>
			</div>
			<div class="display w-30 tendered-amount">
				<label for="tendered">Tendered</label>
				<input type="text" id="tendered" name="tendered" onkeypress="return isNumber(event)" value="0">
			</div>
			<div class="display w-30 change-amount">
				<label for="change">Change</label>
				<input type="text" id="change" name="change" value="0" onkeypress="return isNumber(event)" readonly>
			</div>
		</div>
		<div class="d-flex gap-25">
			<div class="numpad">
				<div class="keys">
					<button onclick="appendValue(1)">1</button>
					<button onclick="appendValue(2)">2</button>
					<button onclick="appendValue(3)">3</button>
					<button onclick="addValue(5)">+05</button>
					<button onclick="addValue(100)">+100</button>
					<button onclick="appendValue(4)">4</button>
					<button onclick="appendValue(5)">5</button>
					<button onclick="appendValue(6)">6</button>
					<button onclick="addValue(10)">+10</button>
					<button onclick="addValue(500)">+500</button>
					<button onclick="appendValue(7)">7</button>
					<button onclick="appendValue(8)">8</button>
					<button onclick="appendValue(9)">9</button>
					<button onclick="addValue(20)">+20</button>
					<button onclick="addValue(2000)">+2000</button>
					<button onclick="clearInput()">C</button>
					<button onclick="appendValue(0)">0</button>
					<button onclick="appendValue('.')">.</button>
					<button onclick="addValue(50)">+50</button>
					<button onclick="backspace()">&#x232B;</button>
				</div>
			</div>
			<div class="buttons w-45">
				<button class="submit w-100" id="submit_cash" onclick="closeModal()">Submit</button>
				<button class="cancel w-100 margin-top-2" onclick="reset()">Cancel</button>
			</div>
		</div>
	</div>	
</div>
<div class="sales-debit-card-modal-container " id="payment_info" style="display:none;">
	<div>
		<div class="display due-amount upi-card-modal-paymenttype-container">
			<label for="type_payment" class="upi-card-modal-label">Payment Type</label>
			<input type="text" name="type_payment" id="type_payment" value="0" style="font-weight:bold;" readonly>
		</div>
		<div class="display change-amount upi-card-modal-amount-container">
			<label for="amount" class="upi-card-modal-label">Amount</label>
			<input type="text" name="amount" id="amount" value="0" style="font-weight:bold;" onkeypress="return isNumber(event)" readonly>
		</div>
		<div class="buttons w-full display margin-top-2 upi-card-modal-submit-container">
			<button class="cancel w-100" onclick="reset()">Cancel</button>
			<button class="submit w-100 margin-left-2" onclick="closeModal()">Submit</button>
		</div>
	</div>
</div>


<div class="sales-debit-card-modal-container d-none" id="multiplePayment">	
	<div>
		<div class="display due-amount multiple-payment-modal-payment-container">
			<label for="type_payment" class="multiple-payment-modal-container-label">Payment Type</label>
			<select name="type_payment" id="multiple_payment_type" class="multiple-payment-dropdown" style="font-weight:bold;">
				<option value="Cash">Cash</option>
				<option value="Debit Card">Debit Card</option>
				<option value="Credit Card">Credit Card</option>
				<option value="Check">Cheque</option>
			</select>
			<!-- <input type="text" name="type_payment" id="type_payment" value="0" style="font-weight:bold;" readonly> -->
		</div>
		<div class="display change-amount multiple-payment-modal-amount-container">
			<label for="amount" class="multiple-payment-modal-container-label">Amount</label>
			<input type="text" name="amount" id="multiple_amount" value="0" style="font-weight:bold;" onkeypress="return isNumber(event)">
		</div>
		<div class="buttons w-full display margin-top-2 multiple-payment-modal-action-buttons">
			<button class="cancel w-100" onclick="reset()">Cancel</button>
			<button class="submit w-100 margin-left-2" onclick="closeModal()">Submit</button>
		</div>
	</div>
</div>


<script type="text/javascript">
	//validation and submit handling
	$(document).ready(function() {
		$("#normal").css({"color":"#ffffff","background-color":"#28b62c","border-color":"#23a127"});
		$("#cancel").css({"color":"#ffffff","background-color":"#ff4136","border-color":"#CF241A"});
		$(".modal-footer").hide();
		/** Code created by kevin */
		var total_amount = $('#total_amount').val();
		var amount_tendered = $('#amount_tendered').val();
		var title = $('.bootstrap-dialog-title').text();
		var additional_changes = $('#additional_charges').val();
		$("#tendered").change(function() {   
			var tendered = $('#tendered').val();
			if(parseInt(total_amount) < parseInt(tendered)){
				alert('You have not added the actual amount to the total amount.');
				$('#tendered').val(amount_tendered);
				$('#change').val(amount_tendered);
			}
			calculateChange();
		});
		if(amount_tendered != null){
			$('#dueAmount').val(amount_tendered);
			$('#tendered').val(amount_tendered);
			if(title == "Cash"){
				$('select[name="payment_type"]').val(title);
				$('.selectpicker').selectpicker('refresh');
				$(".modal-dialog").css({"width": "50%", "height": "70vh", "display": "block", "padding-top": "2vh"});
				$(".modal-body").css({"max-height": "calc(100vh - 180px)"});
				$('#cash_additional_charges').val(additional_changes ? parseInt(additional_changes) : "0");
				$('#calulator').show();
			} 
			else if(title == "Multiple Payment") {
				$(".modal-dialog").css({"width": "40%", "height": "90vh", "display": "block", "padding-top": "10vh"});
				$('#multiple_dueAmount').val(amount_tendered.replace(/,/g, ''));
				$('#multiple_tendered').val(amount_tendered.replace(/,/g, ''));
				$('#multiple_amount').val(amount_tendered.replace(/,/g, ''));
				$('#multiplePayment').show();
				// $('#multiplePayment').modal('show');
			} 
			else {
				// if(title == "Cheque"){
				// 	title = "Check";
				// }
				// if(title != "Credit Card"){
				// 	$('#additional_charge').show();
				// }
				// if(title == "Gift Card"){
				// 	$(".giftcard-input:enabled").val('').focus();
				// }
				$(".modal-dialog").css({"width": "40%", "height": "90vh", "display": "block", "padding-top": "20vh"});
				if(title == "UPI"){
					$('#type_payment').val("UPI");
					$('select[name="payment_type"]').val("UPI");
					$('.selectpicker').selectpicker('refresh');
				} else {
					$('#type_payment').val(title);
					$('select[name="payment_type"]').val(title);
					$('.selectpicker').selectpicker('refresh');
				}
				$('#other_additional_charges').val(additional_changes);
				$('#amount').val(amount_tendered);
				$('#payment_info').show();
			}
		} else {
			alert("Firstly you have add a iteam then you perform payment.");
		}
		
		$('#new').click(function() {
			stay_open = true;
			$('#item_form').submit();
		});

		// This is final function to submit the form and request.
		$('#normal').click(function() {
			let tendered = $('#tendered').val();
			let dueAmount = $('#dueAmount').val();
			if(dueAmount.replace(/,/g, '') == tendered.replace(/,/g, '')){ 
				$('#amount_tendered').val(tendered);
				$('#add_payment_form').submit();
			} else {
				alert('Please make sure your entered amount is equal to the actual amount. Enter the correct amount.');
			}	
			stay_open = false;
		});
		$('#cancel').click(function() {
			BootstrapDialog.closeAll();
		});
	});

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	 // Event listener for changes in Additional Charges
	var csrf_hash_value= "<?=$this->security->get_csrf_hash()?>";
	// function addCharges(charges){
	// 	var additional_charges = parseInt(charges) || 0;
   	// 	var current_total = parseInt($('#sale_total').text().replace(/[^0-9.-]+/g, "")) || 0;
   	// 	$.ajax({
   	// 		url: "<?php echo site_url('sales/update_additional_charges'); ?>",
   	// 		method: 'post',
   	// 		data: {
   	// 			"<?=$this->security->get_csrf_token_name()?>": "<?=$this->security->get_csrf_hash()?>",
   	// 			'additional_charges': additional_charges,
   	// 			'current_total': current_total,
   	// 		},
   	// 		dataType: 'json'
   	// 	});
	// }
	function refresh_sales(){
   		const currentUrl = window.location.href; // Get the current URL
   		const salesUrl = "<?php echo site_url('sales'); ?>"; // Define the sales URL
   		if (currentUrl === salesUrl) {
   			location.reload(); // Refresh the page if already on the sales page
   		} else {
   			window.location.href = salesUrl; // Redirect to sales page if not
   		}
	}
	function closeModal(){
		$('#normal').click();
	}
	// This code for calculator
	function appendValue(val) {
		var tenderedInput = $('#tendered').val() || 0;
		tendered = (tenderedInput == '0' ? parseInt(val) : (parseInt(tenderedInput) + parseInt(val)));
		$('#tendered').val(tendered);
		var total_amount = parseInt($('#total_amount').val());
		var tendered_amount = (parseInt(tendered) + parseInt(val));
		if(total_amount.replace(/,/g, '') < tendered_amount.replace(/,/g, '')){
			alert('You have not added the actual amount to the total amount.');
			$('#tendered').val(total_amount);
			$('#change').val(total_amount);
		} else {
			calculateChange();
		}
	}
	function addValue(val) {
		var tenderedInput = $('#tendered').val() || 0;
		tendered = (parseInt(tenderedInput) + parseInt(val));
		var total_amount = parseInt($('#total_amount').val());
		var tendered_amount = tendered;
		$('#tendered').val(tendered_amount);
		if(total_amount.replace(/,/g, '') < tendered_amount.replace(/,/g, '')){
			alert('You have not added the actual amount to the total amount.');
			$('#tendered').val(total_amount);
			$('#change').val(total_amount);
		} else {
			calculateChange();
		}
	}
	function clearInput() {
		document.getElementById('tendered').value = '0';
		calculateChange();
	}
	function backspace() {
		const tenderedInput = document.getElementById('tendered');
		tenderedInput.value = tenderedInput.value.slice(0, -1) || '0';
		calculateChange();
	}
	function calculateChange() {
		var dueAmount = document.getElementById('dueAmount').value;
		var tendered = document.getElementById('tendered').value;
		var change =  (dueAmount.replace(/,/g, '') - tendered.replace(/,/g, ''));
		document.getElementById('change').value = change;
	}
	function reset() {
		BootstrapDialog.closeAll();
	}
</script>
