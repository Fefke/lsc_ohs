<aside id="sidebar">
  <div id="column-left">
    <?php include vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_BOXES . 'box_customer_service_links.inc.php'); ?>
    <?php include vmod::check(FS_DIR_HTTP_ROOT . WS_DIR_BOXES . 'box_account_links.inc.php'); ?>
  </div>
</aside>

<main id="content">
  {snippet:notices}

  <div id="box-order-history" class="box">

    <h1 class="title"><?php echo language::translate('title_order_history', 'Order History'); ?></h1>

    <table class="table table-striped table-hover data-table">
      <thead>
      <tr>
        <th class="main"><?php echo language::translate('title_order', 'Order'); ?></th>
        <th class="text-center"><?php echo language::translate('title_order_status', 'Order Status'); ?></th>
        <th class="text-right"><?php echo language::translate('title_amount', 'Amount'); ?></th>
        <th class="text-right"><?php echo language::translate('title_date', 'Date'); ?></th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      <?php if ($orders) foreach ($orders as $order) { ?>
      <tr>
        <td><a href="<?php echo htmlspecialchars($order['link']); ?>" class="lightbox-iframe"><?php echo language::translate('title_order', 'Order'); ?> #<?php echo $order['id']; ?></a></td>
        <td class="text-center"><?php echo $order['order_status']; ?></td>
        <td class="text-right"><?php echo $order['payment_due']; ?></td>
        <td class="text-right"><?php echo $order['date_created']; ?></td>
        <td class="text-right">
			<a href="<?php echo htmlspecialchars($order['link']); ?>" target="_blank"><?php echo functions::draw_fonticon('fa-print'); ?></a>
			<a href="mailto:<?php echo settings::get('store_email'); ?>" target="_blank"><?php echo functions::draw_fonticon('fa-support'); ?></a>
		</td>
      </tr>
	  
	<!-- DETAIL's of PRODUCT's -->
	<?php if (isset($order['items'])) {?>
	  <tr>
		<td colspan="5">
			<details <?php if (!isset($firstRound) || $firstRound == true) echo "open";?>>
				<summary><?php echo language::translate('title_products','Products'); ?></summary>
					<table class="OrderHistorySummary table table-striped table-hover data-table">
						<thead>
							<tr>
								<th><?php echo language::translate('title_quantity','Quantity'); ?></th>
								<th><?php echo language::translate('title_sku','SKU'); ?></th>
								<th><?php echo language::translate('title_description','Description'); ?></th>
								<th><?php echo language::translate('title_unit_price','Unit Price'); ?></th>
								<th><?php echo language::translate('title_total','Total'); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						// INIT ITEM'S
						$items = $order['items'];
						
						$firstRound = false;
						$sum = 0;
						//echo "<pre>" . print_r($order["order_totals"] , true) . "</pre>";

						// PRINT ITEMS - ROW's
						foreach ($items as $item) {
							$unit_price = (double) $item['price'] + $item['tax'];
							//	echo "<pre>" . print_r($item, true) . "</pre>";
							// DESCRIPTION Translation
							$short_desciption = (isset($item['name'])) ? $item['name'] : language::translate('text_view_full_page', 'View full page');
							// TOTAL per Item
							$total = 0;// reset
							$total = $unit_price * (int) $item['quantity'];
							// ADD for SUBTOTAL
							$sum += $total;
							// PRINT
						?>
							<tr class="articleOHS">
								<td><?php echo (int) $item['quantity'];?></td>
								<td><?php echo $item['sku'];;?></td>
								<td><?php echo '<a target="_blank" href="' . document::href_ilink('product', array('product_id' => (int)$item['product_id']), false) . '">' . $short_desciption . '</a>';// SHORT DESCRIPTION ?></td>
								<td><?php echo currency::format($unit_price);?></td>
								<td><?php echo currency::format($total);?></td>
							</tr>
						<?php } ?>
						<!-- Subtotal -->
							<tr class="finalAOHS" id="ohs_subtotal">
								<td colspan="4"><?php echo language::translate('title_subtotal', 'Subtotal');?></td>
								<td><?php echo currency::format($sum); ?></td>
							</tr>
						
						<!-- Fee's -->
						<?php 
							$fees = 0;
							foreach ($order["order_totals"] as $fee) { 
								$fees += $fee['value'] + $fee['tax'];
						?>
							<tr class="finalAOHS" id="ohs_fees">
								<td colspan="4"><?php echo $fee['title']; ?></td>
								<td class="text-right"><?php echo !empty(customer::$data['display_prices_including_tax']) ? currency::format($fee['value'] + $fee['tax'], false) : currency::format($fee['value'], false); ?></td>
							</tr>
						<?php }	?>
						
						<!-- Total -->
							<tr class="finalAOHS" id="ohs_total">
								<td colspan="3"><?php if (isset($order['tracking_id']) && $order['tracking_id'] != '') echo language::translate('title_shipping_tracking_id', 'Shipping Tracking ID') . ": " . $order['tracking_id'];?></td>
								<td><?php echo language::translate('title_total', 'Total');?></td>
								<td><?php echo currency::format(($sum + $fees)); ?></td>
							</tr>
						</tbody>
					</table>
			</details>
		</td>
	  </tr>
      <?php }} ?>
      </tbody>
    </table>
	<style>
	
		/* DETAILs */
		details summary {
			padding-left: 15px;
		}
		
		/* TABLE of Products */
			/* thead */
			.OrderHistorySummary thead th {
				border-right: 1px solid black;
			}
		
			/* scope-border */ 
			.OrderHistorySummary {
				border: 1px solid black;
			}
		
			/* Orient last columnt to rigth (Money values) */
			.articleOHS td:last-of-type,
			.articleOHS td:nth-last-child(2),
			.finalAOHS {
				text-align: right;
			}
			
			
			
			/* Articles */
				.articleOHS {
					border-bottom: 1px solid black;
					line-height: 50px;
				}
				
				/* column borders */
				.articleOHS td {
					border-right: 1px solid black;
				}
			
			/* Border before Total */
			.finalAOHS td {
				border-right: none;
			}
			
			/* Border between Final Text and $ */
			.finalAOHS td:nth-last-child(2) {
				border-right: 2px solid black;
				text-align: right;
			}
			
			/* Subtotal */
			.finalAOHS#ohs_subtotal td:last-of-type {
				border-top: 3px solid black;
				border-bottom: 1px solid black;
			}
			
			/* Total */
			.finalAOHS#ohs_total td:last-of-type {
				border-top: 3px solid black;
			}
			
			/* Tracking ID */
			.finalAOHS#ohs_total td:first-of-type {
				text-align: center;
			}

	</style>
	
    <?php echo $pagination; ?>
  </div>
</main>
