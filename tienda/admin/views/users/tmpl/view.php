<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $form = @$this->form; ?>
<?php $row = @$this->row; ?>
<?php $carts = @$this->carts; ?>
<?php $procoms=@$this->procoms; ?>
<?php $orders=@$this->orders; ?>
<?php $subs=@$this->subs; ?>
<?php Tienda::load( 'TiendaHelperProduct', 'helpers.product' ); ?>
<?php Tienda::load( 'TiendaHelperUser', 'helpers.user' ); ?>
<form action="<?php echo JRoute::_( @$form['action'] )?>" method="post" name="adminForm" enctype="multipart/form-data">
<?php echo TiendaGrid::pagetooltip( 'users_view' ); ?>
<table width="100%" border="0">
	<tr>
		<td>
			<h2 style="padding:0px; margin:0px;"><div class="id"><?php echo @$row->first_name; ?>&nbsp;<?php echo @$row->last_name?></div> </h2>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<fieldset>
				<legend><?php echo JText::_('Basic User Info'); ?></legend>
				<div id="tienda_header">
					<table class="admintable" style="width: 100%;" border="0">					
						<tr>
							<td  align="right" class="key">
		                        <label for="name">
		                        	<?php echo JText::_( 'Username' ); ?>:
		                        </label>
	                    	</td>
	                    	<td style="width:120px;">
	                        	<div class="name"><?php echo @$row->username; ?></div>          
	                    	</td>
	                    	<td  align="right" class="key">
		                        <label for="registerDate">
		                        	<?php echo JText::_( 'Registered' ); ?>:
		                        </label>
		                    </td>
		                    <td>
		                        <div class="registerDate"><?php echo JHTML::_('date', @$row->registerDate, "%a, %d %b %Y, %H:%M"); ?></div>         
		                    </td>
		                    <td rowspan="3" align="center" valign="top">
		                    	<div style="padding:0px; margin-bottom:5px;width:auto;">
									<?php echo TiendaHelperUser::getAvatar($row->id);?>
								</div>
		                        <?php
		                        $config = TiendaConfig::getInstance();
		                        $url = $config->get( "user_edit_url", "index.php?option=com_users&view=user&task=edit&cid[]=");
		                        $url .= @$row->id; 
		                        $text = "<button>".JText::_('Edit User')."</button>"; 
		                        ?>		                        
		                        <div ><?php echo TiendaUrl::popup( $url, $text, array('update' => true) ); ?></div>
		                    </td>  
						</tr>
						<tr>
							<td align="right" class="key" key">
		                        <label for="email">
		                        	<?php echo JText::_( 'Email' ); ?>:
		                        </label>
	                    	</td>
	                    	<td>
	                        	<div class="name"><?php echo @$row->email; ?></div>          
	                    	</td>  
	                    	<td align="right" class="key">
		                        <label for="lastvisitDate">
		                        	<?php echo JText::_( 'Last Visited' ); ?>:
		                        </label>
		                    </td>
		                    <td colspan="3">
		                        <div class="lastvisitDate"><?php echo JHTML::_('date', @$row->lastvisitDate, "%a, %d %b %Y, %H:%M"); ?></div>           
		                    </td>
						</tr>
						<tr>
							<td  align="right" class="key" key" style="width:85px;">
		                        <label for="id">
		                        	<?php echo JText::_( 'ID' ); ?>:
		                        </label>
		                    </td>
		                    <td>
		                        <div class="id"><?php echo @$row->id; ?></div>          
		                    </td>
		                    <td align="right" class="key" style="width:85px;">
		                        <label for="group_name">
		                        	<?php echo JText::_( 'User Group' ); ?>:
		                        </label>
		                    </td>
		                    <td colspan="3">
		                      	<div class="id"><?php echo @$row->group_name; ?></div>		                      	
		                    </td>
						</tr>
					</table>
				</div>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td width="50%" valign="top">
				<fieldset>
					<legend><?php echo JText::_('Summary Data'); ?></legend>
						<table class="admintable"  width="100%">
							<tr>
								<td class="key" align="right" style="width:250px;">
									<?php echo JText::_( 'Number of Completed Orders' ); ?>:
								</td>
								<td align="right">
									<div class="id"><?php echo count($orders); ?></div>
								</td>
							</tr>
							<tr>
								<td class="key" align="right" style="width:250px;">
									<?php echo JText::_( 'Total Amount Spent' ); ?>:
								</td>
								<td align="right">
									<div class="id"><?php echo TiendaHelperBase::currency (@$this->spent); ?></div>
								</td>
							</tr>
							<tr>
								<td class="key" align="right" style="width:250px;">
									<?php echo JText::_( 'Total User Reviews' ); ?>:
								</td>
								<td align="right">
									<div class="id"><?php echo count($procoms); ?></div>
								</td>
							</tr>
						</table>
				</fieldset>			
			<fieldset>
					<legend><?php echo JText::_('Last 5 Completed Orders'); ?></legend>
					<div id="tienda_header">
					<table class="adminlist" style="width: 100%;">
						<thead>
							<tr>
								<th style="width: 5px;">
									<?php echo JText::_("Num"); ?>
								</th>
								<th style="width: 200px;">
									<?php echo JText::_("Product"); ?>
								</th>
								<th style="width: 100px;">
									<?php echo JText::_("Price"); ?>
								</th>
								<th style="width:100px;">
									<?php echo JText::_("Tax"); ?>
								</th>
								<th>
									<?php echo JText::_("Quantity"); ?>
								</th>
								<th style="width: 150px; text-align: right;">
									<?php echo JText::_("Total"); ?>
								</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="20"></td>
							</tr>
						</tfoot>
						<tbody>
							<?php $i=0; $k=0; ?>
							<?php foreach (@$orders as $order) : ?>
								<tr class='row <?php echo $k; ?>'>
									<td align="center">
										<?php echo $i + 1; ?>
									</td>
									<td style="text-align:left;">
										<a href="index.php?option=com_tienda&view=products&task=edit&id=<?php echo $order->product_id; ?>" target="_blank">
											<?php echo $order->orderitem_name; ?>
										</a>
									</td>
									<td style="text-align:right;">
										<?php echo TiendaHelperBase::currency($order->orderitem_price); ?>										
									</td>
									<td style="text-align:right;">
										<?php echo TiendaHelperBase::currency($order->orderitem_tax); ?>										
									</td>
									<td style="text-align:center;">
										<?php echo $order->orderitem_quantity;?>
									</td>
									<td style="text-align:right;">
										<?php echo TiendaHelperBase::currency($order->total_price); ?>										
									</td>
								</tr>
								<?php if ($i==4) break;?>
							<?php ++$i; $k = (1 - $k); ?>
							<?php endforeach; ?>
							<?php if (!count(@$order)) : ?>
								<tr>
									<td colspan="10" align="center"><?php echo JText::_('No items found'); ?>
									</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
					</div>
				</fieldset>
		</td>
		<td width="50%" valign="top">					
			<fieldset>
					<legend><?php echo JText::_('List of Active Subscriptions'); ?></legend>
					<table class="adminlist" style="width: 100%;">
						<thead>
							<tr>
								<th style="width: 5px;">
									<?php echo JText::_("Num"); ?>
								</th>
								<th style="width: 200px;">
									<?php echo JText::_("Type"); ?>
								</th>
								<th style="width: 200px;">
									<?php echo JText::_("Order"); ?>
								</th>
								<th style="text-align: center;  width: 200px;">
									<?php echo JText::_("Expires"); ?>
								</th>								
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="20"></td>
							</tr>
						</tfoot>
						<tbody>
							<?php $i=0; $k=0; ?>
							<?php foreach (@$subs as $sub) : ?>
								<tr class='row <?php echo $k; ?>'>
									<td align="center">
										<?php echo $i + 1; ?>
									</td>
									<td style="text-align:left;">
										<a href="	index.php?option=com_tienda&view=subscriptions&task=view&id=<?php echo $sub->subscription_id; ?>" target="_blank">
											<?php echo $sub->product_name; ?>
										</a>
									</td>
									<td style="text-align:center;">
										<a href="	index.php?option=com_tienda&view=subscriptions&task=view&id=<?php echo $sub->subscription_id; ?>" target="_blank">
											<?php echo $sub->order_id; ?>										
										</a>
									</td>									
									<td style="text-align:center;">
										<a href="	index.php?option=com_tienda&view=subscriptions&task=view&id=<?php echo $sub->subscription_id; ?>" target="_blank">											
											<?php if($sub->subscription_lifetime == 1)
												{
													 echo JText::_("Lifetime"); 
												}
											?>											
											<?php echo JHTML::_('date', $sub->expires_datetime, "%a, %d %b %Y, %H:%M"); ?>
										</a>
									</td>				
								</tr>
							<?php ++$i; $k = (1 - $k); ?>
							<?php endforeach; ?>
							<?php if (!count(@$sub)) : ?>
								<tr>
									<td colspan="10" align="center"><?php echo JText::_('No items found'); ?>
									</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</fieldset>
			<fieldset>
					<legend><?php echo JText::_('Cart'); ?></legend>
					<table class="adminlist" style="width: 100%;">
						<thead>
							<tr>
								<th style="width: 5px;">
									<?php echo JText::_("Num"); ?>
								</th>
								<th style="width: 200px;">
									<?php echo JText::_("Products"); ?>
								</th>
								<th style="width: 200px;">
									<?php echo JText::_("Price"); ?>
								</th>
								<th style="text-align: center;  width: 200px;">
									<?php echo JText::_("Quantity"); ?>
								</th>
								<th style="width: 150px; text-align: right;">
									<?php echo JText::_("Total"); ?>
								</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="20"></td>
							</tr>
						</tfoot>
						<tbody>
							<?php $i=0; $k=0; ?>
							<?php foreach (@$carts as $cart) : ?>
								<tr class='row <?php echo $k; ?>'>
									<td align="center">
										<?php echo $i + 1; ?>
									</td>
									<td style="text-align:left;">
										<a href="index.php?option=com_tienda&view=products&task=edit&id=<?php echo $cart->product_id; ?>" target="_blank">
											<?php echo $cart->product_name; ?>
										</a>
									</td>
									<td style="text-align:right;">
										<?php echo TiendaHelperBase::currency($cart->product_price); ?>										
									</td>
									<td style="text-align:center;">
										<?php echo $cart->product_qty;?>
									</td>
									<td style="text-align:right;">
										<?php echo TiendaHelperBase::currency($cart->total_price); ?>										
									</td>
								</tr>
							<?php ++$i; $k = (1 - $k); ?>
							<?php endforeach; ?>
							<?php if (!count(@$cart)) : ?>
								<tr>
									<td colspan="10" align="center"><?php echo JText::_('No items found'); ?>
									</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</fieldset>
			<fieldset>
					<legend><?php echo JText::_('Last 5 Reviews Posted'); ?></legend>
					<table class="adminlist" style="width: 100%;">
						<thead>
							<tr>
								<th style="width: 5px;">
									<?php echo JText::_("Num"); ?>
								</th>
								<th>
									<?php echo JText::_("Products + Comments"); ?>
								</th>
								<th style="width: 200px;">
									<?php echo JText::_("User Rating"); ?>
								</th>													
							</tr>
						</thead>		
						<tfoot>
							<tr>
								<td colspan="20"></td>
							</tr>
						</tfoot>
						<tbody>
							<?php $i=0; $k=0; ?>
							<?php foreach (@$procoms as $procom) : ?>
								<tr class='row <?php echo $k; ?>'>
									<td align="center">
										<?php echo $i + 1; ?>
									</td>
									<td style="text-align:left;">
										<a href="index.php?option=com_tienda&view=productcomments&task=edit&id=<?php echo $procom->product_id; ?>" target="_blank">
											<?php echo $procom->p_name; ?></a><br/><?php echo $procom->trimcom; ?>							
									</td>
									<td style="text-align:center;">
										<?php echo TiendaHelperProduct::getRatingImage( $procom->productcomment_rating ); ?>						
									</td>
								</tr>
								<?php if ($i==4) break;?>
							<?php ++$i; $k = (1 - $k); ?>
							<?php endforeach; ?>
							<?php if (!count(@$procom)) : ?>
								<tr>
									<td colspan="10" align="center"><?php echo JText::_('No items found'); ?>
									</td>
								</tr>
							<?php endif; ?>
						</tbody>	
					</table>
				</fieldset>
		</td>
	</tr>
</table>
    
    <input type="hidden" name="id" value="<?php echo @$row->id; ?>" />
    <input type="hidden" name="task" value="" />
</form>