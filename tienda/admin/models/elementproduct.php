<?php
/**
 * @version		$Id: element.php 10381 2008-06-01 03:35:53Z pasamio $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.helper');
jimport( 'joomla.application.component.model');

/**
 * Content Component User Model
 *
 * @package		Joomla
 * @subpackage	Content
 * @since		1.5
 */
class TiendaModelElementProduct extends JModel
{
	/**
	 * Content data in category array
	 *
	 * @var array
	 */
	var $_list = null;

	var $_page = null;

	/**
	 * Method to get content article data for the frontpage
	 *
	 * @since 1.5
	 */
	function getList()
	{
		$where = array();
		global $mainframe;

		if (!empty($this->_list)) {
			return $this->_list;
		}

		// Initialize variables
		$db		=& $this->getDBO();
		$filter	= null;

		// Get some variables from the request
//		$sectionid			= JRequest::getVar( 'sectionid', -1, '', 'int' );
//		$redirect			= $sectionid;
//		$option				= JRequest::getCmd( 'option' );
		$filter_order		= $mainframe->getUserStateFromRequest('userelement.filter_order',		'filter_order',		'',	'cmd');
		$filter_order_Dir	= $mainframe->getUserStateFromRequest('userelement.filter_order_Dir',	'filter_order_Dir',	'',	'word');
		$limit				= $mainframe->getUserStateFromRequest('global.list.limit',					'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart			= $mainframe->getUserStateFromRequest('userelement.limitstart',			'limitstart',		0,	'int');
		$search				= $mainframe->getUserStateFromRequest('userelement.search',				'search',			'',	'string');
		$search				= JString::strtolower($search);

		if (!$filter_order) {
			$filter_order = 'c.product_id';
		}
		$order = ' ORDER BY '. $filter_order .' '. $filter_order_Dir;
		$all = 1;

		// Keyword filter
		if ($search) {
			$where[] = 'LOWER( c.product_id ) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			$where[] = 'LOWER( c.product_name ) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}
		// Build the where clause of the query
		$where = (count($where) ? ' WHERE '.implode(' OR ', $where) : '');

		// Get the total number of records
		$query = 'SELECT COUNT(c.product_id)' .
				' FROM #__tienda_products AS c' .
				$where;
		$db->setQuery($query);
		$total = $db->loadResult();

		// Create the pagination object
		jimport('joomla.html.pagination');
		$this->_page = new JPagination($total, $limitstart, $limit);

		// Get the products
		$query = 'SELECT c.*, pp.* ' .
				' FROM #__tienda_products AS c' .
				' LEFT JOIN #__tienda_productprices pp ON pp.product_id = c.product_id '.
				$where .
				' GROUP BY c.product_id '.
				$order;
		$db->setQuery($query, $this->_page->limitstart, $this->_page->limit);
		$this->_list = $db->loadObjectList();
		
		//currency formatting
		Tienda::load( 'TiendaHelperBase', 'helpers._base' );
		foreach($this->_list as $item)
		{
			$item->product_price = TiendaHelperBase::currency($item->product_price); 
		}

		// If there is a db query error, throw a HTTP 500 and exit
		if ($db->getErrorNum()) {
			JError::raiseError( 500, $db->stderr() );
			return false;
		}

		return $this->_list;
	}

	/**
	 * 
	 * @return unknown_type
	 */
	function getPagination()
	{
		if (is_null($this->_list) || is_null($this->_page)) {
			$this->getList();
		}
		return $this->_page;
	}
	
	/**
	 *
	 * @return
	 * @param object $name
	 * @param object $value[optional]
	 * @param object $node[optional]
	 * @param object $control_name[optional]
	 */
	function _fetchElement($name, $value='', $node='', $control_name='')
	{
		$html = "";
		$doc 		=& JFactory::getDocument();
		$fieldName	= $control_name ? $control_name.'['.$name.']' : $name;
		$title = JText::_('COM_TIENDA_SELECT_PRODUCTS');
		if ($value) {
			JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_tienda'.DS.'tables' );
			$tbl = JTable::getInstance( 'Products', 'TiendaTable' );
			$tbl->load( $value );			
			$title = $tbl->product_name;
		}
		else
		{
			$title=JText::_('COM_TIENDA_SELECT_A_PRODUCT');
		}

 $js = "
		function jSelectProducts(id, title, object) {
			document.getElementById(object + '_id').value = id;
			document.getElementById(object + '_name').value = title;
			document.getElementById('sbox-window').close();
		}";
		
		$doc->addScriptDeclaration($js);

		$link = 'index.php?option=com_tienda&task=elementproduct&tmpl=component&object='.$name;

		JHTML::_('behavior.modal', 'a.modal');
		$html = "\n".'<div style="float: left;"><input style="background: #ffffff;" type="text" id="'.$name.'_name" value="'.htmlspecialchars($title, ENT_QUOTES, 'UTF-8').'" disabled="disabled" /></div>';
		$html .= '<div class="button2-left"><div class="blank"><a class="modal" title="'.JText::_('COM_TIENDA_SELECT_A_USER').'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 800, y: 500}}">'.JText::_('COM_TIENDA_SELECT').'</a></div></div>'."\n";
		$html .= "\n".'<input type="hidden" id="'.$name.'_id" name="'.$fieldName.'" value="'.(int)$value.'" />';

		return $html;
	}

	/**
	 *
	 * @return
	 * @param object $name
	 * @param object $value[optional]
	 * @param object $node[optional]
	 * @param object $control_name[optional]
	 */
	function _clearElement($name, $value='', $node='', $control_name='')
	{
		
		global $mainframe;

		$db			=& JFactory::getDBO();
		$doc 		=& JFactory::getDocument();
		$template 	= $mainframe->getTemplate();
		$fieldName	= $control_name ? $control_name.'['.$name.']' : $name;
		
		$js = "
		function resetElement(id, title, object) {
			document.getElementById(object + '_id').value = id;
			document.getElementById(object + '_name').value = title;
		}";
		$doc->addScriptDeclaration($js);
		
		$html = '<div class="button2-left">
		<div class="blank">
		
		<a href="javascript::void();" onclick="resetElement( \''.$value.'\', \''.JText::_('COM_TIENDA_SELECT_PRODUCTS').'\', \''.$name.'\' )">'.JText::_('COM_TIENDA_CLEAR_SELECTION').'</span>
		</div></div>'."\n";

		return $html;
	}
	
}
?>