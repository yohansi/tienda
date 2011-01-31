<?php 
defined('_JEXEC') or die('Restricted access'); 
?>

<form action="<?php echo plg_tienda_escape($vars->action_url); ?>" method="post">

    <div id="payment_paypal">
    	<div class="prepayment_message">
        	<?php echo JText::_( "Tienda Moneybookers Payment Standard Preparation Message" ); ?>
        </div>
        <div class="prepayment_action">
            <div style="float: left; padding: 10px;">
            	<input type="image" src="http://www.moneybookers.com/images/logos/checkout_logos/checkout_120x40px.gif" alt="Pay!">
            </div>
        	<div style="float: left; padding: 10px;">
        		<?php echo "<b>".JText::_( "Checkout Amount").":</b> ".TiendaHelperBase::currency( @$vars->orderpayment_amount ); ?>
        	</div>         	
         </div>
    </div>
    
	<input type="hidden" name="pay_to_email" value="<?php echo plg_tienda_escape($vars->pay_to_email); ?>" />
	<input type="hidden" name="return_url" value="<?php echo plg_tienda_escape($vars->return_url); ?>" /> 
	<input type="hidden" name="cancel_url" value="<?php echo plg_tienda_escape($vars->cancel_url); ?>" /> 
	<input type="hidden" name="status_url" value="<?php echo plg_tienda_escape($vars->status_url); ?>" /> 
	<input type="hidden" name="status_url2" value="<?php echo plg_tienda_escape($vars->status_url2); ?>" />
	<input type="hidden" name="language" value="<?php echo plg_tienda_escape($vars->language); ?>" /> 
	<input type="hidden" name="merchant_fields" value="user_id, type_id" /> 
	<input type="hidden" name="user_id" value="<?php echo plg_tienda_escape($vars->user_id); ?>" /> 
	<input type="hidden" name="type_id" value="<?php echo plg_tienda_escape($vars->type_id); ?>" />
<!-- THIS IS COMMENTED OUT BECAUSE WE ARE BUILDING FIRST WITHOUT RECCURING PAYMENT	<?php //if ($vars->is_recurring): ?>
	<input type="hidden" name="rec_amount" value="<?php //echo plg_tienda_escape($vars->rec_amount); ?>" />
	<input type="hidden" name="rec_start_date" value="<?php //echo plg_tienda_escape($vars->rec_start_date); ?>" />
	<input type="hidden" name="rec_period" value="<?php //echo plg_tienda_escape($vars->rec_period); ?>" />
	<input type="hidden" name="rec_cycle" value="<?php //echo plg_tienda_escape($vars->rec_cycle); ?>" />
	<input type="hidden" name="rec_grace_period" value="<?php //echo plg_tienda_escape($vars->rec_grace_period); ?>" />
	<?php //else: ?> -->
	<input type="hidden" name="amount" value="<?php echo plg_tienda_escape($vars->amount); ?>" />
	<?php // endif; ?>
	<input type="hidden" name="currency" value="<?php echo plg_tienda_escape($vars->currency); ?>" />			
	<input type="hidden" name="detail1_description" value="<?php echo plg_tienda_escape($vars->detail1_description); ?>" /> 
	<input type="hidden" name="detail1_text" value="<?php echo plg_tienda_escape($vars->detail1_text); ?>" /> 
	<input type="hidden" name="detail2_description" value="<?php echo plg_tienda_escape($vars->detail2_description); ?>" /> 
	<input type="hidden" name="detail2_text" value="<?php echo plg_tienda_escape($vars->detail2_text); ?>" /> 
	<input type="hidden" name="logo_url" value="<?php echo plg_tienda_escape($vars->logo_url); ?>" />
 				
	
	
	
	
	<input type='hidden' name='task' value='confirmPayment'>
	<input type='hidden' name='paction' value='process'>
</form>