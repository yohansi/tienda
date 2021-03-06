<?php
/**
 * @package	Tienda
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

Tienda::load( 'TiendaPluginBase', 'library.plugins._base' );

class plgTiendaCheckoutExample extends TiendaPluginBase
{
	/**
	 * @var $_element  string  Should always correspond with the plugin's filename, 
	 *                         forcing it to be unique 
	 */
    var $_element    = 'checkoutexample';
    
	function plgTiendaCheckoutExample(& $subject, $config) 
	{
		parent::__construct($subject, $config);
		$this->loadLanguage( '', JPATH_ADMINISTRATOR );
	}
	
    /**
     * 
     * @param array $values     The input values from the form
     * @return unknown_type
     */
    function onBeforeAddToCart( $item, $values )
    {
        $return = new JObject();
        
        $return->error = false; // set this to true to have fun!
        $return->message = "Checkout Example says FAIL!"; // string
        
        return $return;
    }
	
    /**
     * 
     * @param $object The current order object
     * @return unknown_type
     */
    function onDisplayProductAttributeOptions( $order )
    {
        $vars = new JObject();
        $vars->message = "Inside: onDisplayProductAttributeOptions"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * This event is fired after an item is added to the cart
     * 
     * @param $item obj         The cart item object
     * @param array $values     The input values from the form
     * @return unknown_type
     */
    function onAfterAddToCart( $item, $values )
    {
        return null;
    }
    
    /**
     * 
     * @param $object The current order object
     * @return unknown_type
     */
    function onBeforeDisplaySelectShipping( $order )
    {
        $vars = new JObject();
        $vars->message = "Inside: onBeforeDisplaySelectShipping"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * 
     * @param $object The current order object
     * @return unknown_type
     */
    function onAfterDisplaySelectShipping( $order )
    {
        $vars = new JObject();
        $vars->message = "Inside: onAfterDisplaySelectShipping"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * 
     * @param array $values     The input values from the form
     * @return unknown_type
     */
    function onValidateSelectShipping( $values )
    {
        $return = new JObject();
        
        $return->error = null; // boolean
        $return->message = null; // string
        
        return $return;
    }
    
    /**
     * 
     * @param $object The current order object
     * @return unknown_type
     */
    function onBeforeDisplaySelectPayment( $order )
    {
        $vars = new JObject();
        $vars->message = "Inside: onBeforeDisplaySelectPayment"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * 
     * @param $object The current order object
     * @return unknown_type
     */
    function onAfterDisplaySelectPayment( $order )
    {
        $vars = new JObject();
        $vars->message = "Inside: onAfterDisplaySelectPayment"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * 
     * @param array $values     The input values from the form
     * @return unknown_type
     */
    function onValidateSelectPayment( $values )
    {
        $return = new JObject();
        
        $return->error = null; // boolean
        $return->message = null; // string
        
        return $return;
    }
    
    /**
     * 
     * @param $object The current order object
     * @return unknown_type
     */
    function onBeforeDisplayPrePayment( $order )
    {
        $vars = new JObject();
        $vars->message = "Inside: onBeforeDisplayPrePayment"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * 
     * @param $object The current order object
     * @return unknown_type
     */
    function onAfterDisplayPrePayment( $order )
    {
        $vars = new JObject();
        $vars->message = "Inside: onAfterDisplayPrePayment"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * 
     * @param $order_id int The current order id number
     * @return unknown_type
     */
    function onBeforeDisplayPostPayment( $order_id )
    {
        $vars = new JObject();
        $vars->message = "Inside: onBeforeDisplayPostPayment"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * 
     * @param $order_id int The current order id number
     * @return unknown_type
     */
    function onAfterDisplayPostPayment( $order_id )
    {
        $vars = new JObject();
        $vars->message = "Inside: onAfterDisplayPostPayment"; 
        
        echo $this->_getLayout( 'message', $vars );
        return null;
    }
    
    /**
     * This event is fired after an order has been successfully paid for
     * and it's status becomes 'Payment Received'
     * 
     * @param $order_id int The current order id number
     * @return unknown_type
     */
    function doCompletedOrderTasks( $order_id )
    {
        return null;
    }
    
}
