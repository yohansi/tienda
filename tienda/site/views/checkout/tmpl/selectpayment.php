<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('stylesheet', 'tienda.css', 'media/com_tienda/css/'); ?>
<?php JHTML::_('script', 'tienda.js', 'media/com_tienda/js/'); ?>
<?php JHTML::_('script', 'tienda_checkout.js', 'media/com_tienda/js/'); ?>
<?php $form = @$this->form; ?>
<?php $shipping_info = @$this->shipping_info; ?>
<?php $billing_info = @$this->billing_info; ?>
<?php $items = @$this->items ? @$this->items : array();?>
<?php $values = @$this->values; ?>

<div class='componentheading'>
    <span><?php echo JText::_( "Select Payment Method" ); ?></span>
</div>

    <?php // echo TiendaMenu::display(); ?>
    
    <!-- Progress Bar -->
	<?php echo $this->progress; ?>

<form action="<?php echo JRoute::_( @$form['action'] ); ?>" method="post" name="adminForm" enctype="multipart/form-data">

    <div id='onCheckoutReview_wrapper'>
        <!--    ORDER SUMMARY   -->
        <h3><?php echo JText::_("Order Summary") ?></h3>
        <div id='onCheckoutReview_wrapper'> 
            <?php
                echo @$this->orderSummary;
            ?>
        </div>
        
	   <div id="payment_info" class="address">
		<h3><?php echo JText::_("Billing Information"); ?></h3>
		<strong><?php echo JText::_("Total Amount Due"); ?></strong>: <?php echo TiendaHelperBase::currency( $this->order->order_total ); ?><br/>
        <strong><?php echo JText::_("Billing Address"); ?></strong>:<br/> 
                    <?php
                    echo $billing_info['first_name']." ". $billing_info['last_name']."<br/>";
                    echo $billing_info['address_1'].", ";
                    echo $billing_info['address_2'] ? $billing_info['address_2'] .", " : "";
                    echo $billing_info['city'] .", ";
                    echo $billing_info['zone_name'] ." ";
                    echo $billing_info['postal_code'] ." ";
                    echo $billing_info['country_name'];
                    ?>
            <br/>
	   </div>

        <div id="shipping_info" class="address">
        <h3><?php echo JText::_("Shipping Information"); ?></h3>
        <strong><?php echo JText::_("Shipping Method"); ?></strong>: <?php echo JText::_( $this->shipping_method_name ); ?><br/>
        <strong><?php echo JText::_("Shipping Address"); ?></strong>:<br/> 
                    <?php
                    echo $shipping_info['first_name']." ". $shipping_info['last_name']."<br/>";
                    echo $shipping_info['address_1'].", ";
                    echo $shipping_info['address_2'] ? $shipping_info['address_2'] .", " : "";
                    echo $shipping_info['city'] .", ";
                    echo $shipping_info['zone_name'] ." ";
                    echo $shipping_info['postal_code'] ." ";
                    echo $shipping_info['country_name'];
                    ?>
            <br/>
        </div>
    
	    <div class="reset"></div>
	    <?php 
	    	if(!empty($this->customer_note)){
	    		?>
	   			<div id="shipping_comments">
	    		<h3><?php echo JText::_("Shipping Notes"); ?></h3><br/>
	 			<?php echo $this->customer_note; ?>
	    		</div>
	    	<?php } ?>
	 	<br/>
 	
        <!--    PAYMENT METHODS   -->        
        <h3><?php echo JText::_("Payment Method") ?></h3>
        <p><?php echo JText::_("Please select your preferred payment method below"); ?>:</p>
        <div id='onCheckoutPayment_wrapper'>
            <?php
                if ($this->plugins) 
                {                  
                    foreach ($this->plugins as $plugin) 
                    {
                        ?>
                        <input value="<?php echo $plugin->element; ?>" onclick="tiendaGetPaymentForm('<?php echo $plugin->element; ?>', 'payment_form_div')" name="payment_plugin" type="radio" />
                        <?php echo JText::_( $plugin->name ); ?>
                        <br/>
                        <?php
                    }
                }
            ?>
            
            <div id='payment_form_div' style="padding-top: 10px;"></div>
            
            <div id="validationmessage" style="padding-top: 10px;"></div>
        </div>
    </div>

    <p>
        <input type="button" class="button" onclick="window.location = '<?php echo JRoute::_('index.php?option=com_tienda&view=carts'); ?>'" value="<?php echo JText::_('Return to Shopping Cart'); ?>" />
        <input type="button" class="button" onclick="tiendaFormValidation( '<?php echo @$form['validation']; ?>', 'validationmessage', 'preparePayment', document.adminForm )" value="<?php echo JText::_('Click Here to Review Order Before Submitting Payment'); ?>" />
    </p>
        
    <input type="hidden" id="currency_id" name="currency_id" value="<?php echo $this->order->currency_id; ?>" />
    <input type="hidden" id="shipping_address_id" name="shipping_address_id" value="<?php echo $values['shipping_address_id']; ?>" />
    <input type="hidden" id="billing_address_id" name="billing_address_id" value="<?php echo $values['billing_address_id']; ?>" />
    <input type="hidden" id="shipping_method_id" name="shipping_method_id" value="<?php echo $values['shipping_method_id']; ?>" />
    <input type="hidden" id="customer_note" name="customer_note" value="<?php echo $values['customer_note']?>" />
	<input type="hidden" id="task" name="task" value="" />
	<input type="hidden" id="step" name="step" value="selectpayment" />
	<input type="hidden" id="guest" name="guest" value="<?php if($this->guest)echo "1"; else echo "0"; ?>" />
	<?php
	if($this->guest){
	?>
	<input type="hidden" id="email_address" name="email_address" value="<?php echo $values['email_address']; ?>" />
	<?php 
	}
	?>

    <?php echo JHTML::_( 'form.token' ); ?>
</form>
