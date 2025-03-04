<?php $this->load->view("partial/header"); ?>

<div id="page_title"><?php echo $title ?></div>

<div id="page_subtitle"><?php echo $subtitle ?></div>

<div id="table_holder">
	<table id="table"></table>
</div>

<div id="report_summary">
	<?php
	foreach($overall_summary_data as $name=>$value)
	{
	?>
		<div class="summary_row"><?php echo $this->lang->line('reports_'.$name). ': '.to_currency($value); ?></div>
	<?php
	}
	?>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
	 	<?php $this->load->view('partial/bootstrap_tables_locale'); ?>

		var details_data = <?php echo json_encode($details_data); ?>;
		<?php
		if($this->config->item('customer_reward_enable') == TRUE && !empty($details_data_rewards))
		{
		?>
			var details_data_rewards = <?php echo json_encode($details_data_rewards); ?>;
		<?php
		}
		?>
		var init_dialog = function() {
			<?php
			if(isset($editable))
			{
			?>
				table_support.submit_handler('<?php echo site_url("reports/get_detailed_" . $editable . "_row")?>');
				dialog_support.init("a.modal-dlg");
			<?php
			}
			?>
		};

		$('#table')
			.addClass("table-striped")
			.addClass("table-bordered")
			.bootstrapTable({
				columns: <?php echo transform_headers($headers['summary'], TRUE); ?>,
				stickyHeader: true,
				stickyHeaderOffsetLeft: $('#table').offset().left + 'px',
				stickyHeaderOffsetRight: $('#table').offset().right + 'px',
				pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
				pagination: true,
				sortable: true,
				showColumns: true,
				uniqueId: 'id',
				showExport: true,
				exportDataType: 'all',
				exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
				data: <?php echo json_encode($summary_data); ?>,
				iconSize: 'sm',
				paginationVAlign: 'bottom',
				detailView: true,
				escape: false,
				search: true,
				onPageChange: init_dialog,
				onPostBody: function() {
					dialog_support.init("a.modal-dlg");
				},
				onExpandRow: function (index, row, $detail) {
					$detail.html('<table></table>').find("table").bootstrapTable({
						columns: <?php echo transform_headers_readonly($headers['details']); ?>,
						data: details_data[(!isNaN(row.id) && row.id) || $(row[0] || row.id).text().replace(/(POS|RECV)\s*/g, '')]
					});

					<?php
					if($this->config->item('customer_reward_enable') == TRUE && !empty($details_data_rewards))
					{
					?>
						$detail.append('<table></table>').find("table").bootstrapTable({
							columns: <?php echo transform_headers_readonly($headers['details_rewards']); ?>,
							data: details_data_rewards[(!isNaN(row.id) && row.id) || $(row[0] || row.id).text().replace(/(POS|RECV)\s*/g, '')]
						});
					<?php
					}
					?>
				}
		});

		var updateRowsDue = function() {
			$('#table').find('tr').each(function() {
				// Check if any cell in the row contains 'Due'
				var containsDue = $(this).find('td').toArray().some(function(td) {
					return $(td).text().includes('Due');
				});

				// If 'Due' is found in the row, update the row color
				if (containsDue) {
					$(this).css('background-color', '#fdd'); // Change color as needed
				}
			});
		};

		// Call the function immediately on page load
		updateRowsDue();

		// Bind the function to the post-body.bs.table event to handle updates
		$('#table').on('post-body.bs.table', function() {
			updateRowsDue();
		});

		init_dialog();
	});
</script>

<?php $this->load->view("partial/footer"); ?>
