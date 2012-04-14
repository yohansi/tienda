<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('script', 'tienda.js', 'media/com_tienda/js/');?>
<?php $state = @$vars->state; ?>
<?php $items = @$vars->items; ?>

<h2><?php echo JText::_('COM_TIENDA_RESULTS'); ?></h2>

    <table class="adminlist" style="clear: both;">
        <thead>
            <tr>
                <th style="width: 5px;">
                    <?php echo JText::_('COM_TIENDA_NUM'); ?>
                </th>
                <th style="width: 50px;">
                    <?php echo JText::_('COM_TIENDA_ID'); ?>
                </th>
                <th style=" width: 200px;">
                    <?php echo JText::_('COM_TIENDA_DATE_OF_ORDER'); ?>
                </th>
                <th style="text-align: left;">
                    <?php echo JText::_('COM_TIENDA_CUSTOMER'); ?>
                </th>
                <th style="width: 100px;">
                    <?php echo JText::_('COM_TIENDA_TOTAL'); ?>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="20">

                </td>
            </tr>
        </tfoot>
        <tbody>
        <?php $i=0; $k=0; ?>
        <?php foreach (@$items as $item) : ?>
            <tr class='row<?php echo $k; ?>'>
                <td align="center">
                    <?php echo $i + 1; ?>
                </td>
				<td style="text-align: center;">
					<a href="<?php echo $item->link; ?>">
						<?php echo $item->order_id; ?>
					</a>
				</td>
               <td style="text-align: center;">
                    <a href="<?php echo $item->link; ?>">
                        <?php echo JHTML::_('date', $item->created_date, TiendaConfig::getInstance()->get('date_format')); ?>
                    </a>
                </td>
                <td style="text-align: left;">
					<?php echo $item->user_name .' [ '.$item->user_id.' ]'; ?>
					&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php echo $item->email .' [ '.$item->user_username.' ]'; ?>
					<br/>
					<b><?php echo JText::_('COM_TIENDA_SHIP_TO'); ?></b>:
					<?php 
					if (empty($item->shipping_address_1)) 
					{
					   echo JText::_('COM_TIENDA_UNDEFINED_SHIPPING_ADDRESS'); 
					}
					   else
					{
	                    echo $item->shipping_address_1.", ";
	                    echo $item->shipping_address_2 ? $item->shipping_address_2.", " : "";
	                    echo $item->shipping_city.", ";
	                    echo $item->shipping_zone_name." ";
	                    echo $item->shipping_postal_code." ";
	                    echo $item->shipping_country_name;
					}
					?>
                    <?php 
                    if (!empty($item->order_number))
                    {
                        echo "<br/><b>".JText::_('COM_TIENDA_ORDER_NUMBER')."</b>: ".$item->order_number;
                    }
                    ?>
				</td>
                <td style="text-align: center;">
					<?php echo TiendaHelperBase::currency( $item->order_total, $item->currency ); ?>
                    <?php if (!empty($item->commissions)) { ?>
                        <br/>
                        <?php JHTML::_('behavior.tooltip'); ?>
                        <a href="index.php?option=com_amigos&view=commissions&filter_orderid=<?php echo $item->order_id; ?>" target="_blank">
                            <img src='<?php echo JURI::root(true); ?>/media/com_amigos/images/amigos_16.png' title="<?php echo JText::_('COM_TIENDA_ORDER_HAS_A_COMMISSION'); ?>::<?php echo JText::_('COM_TIENDA_VIEW_COMMISSION_RECORDS'); ?>" class="hasTip" />
                        </a>
                    <?php } ?>
				</td>
            </tr>
            <?php ++$i; $k = (1 - $k); ?>
            <?php endforeach; ?>

            <?php if (!count(@$items)) : ?>
            <tr>
                <td colspan="10" align="center">
                    <?php echo JText::_('COM_TIENDA_NO_ITEMS_FOUND'); ?>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
