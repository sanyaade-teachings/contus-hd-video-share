<?php
/*
 ***********************************************************/
/**
 * @name          : Joomla Hdvideoshare
 * @version	      : 3.0
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @abstract      : Contushdvideoshare Component Googlead Model
 * @Creation Date : March 2010
 * @Modified Date : June 2012
 * */

/*
 ***********************************************************/
// No direct access to this file
defined('_JEXEC') or die();
// import joomla model library
jimport('joomla.application.component.model');
/**
 * Contushdvideoshare Component Administrator Googlead Model
 */
class contushdvideoshareModelgooglead extends JModel {

	/**
	 * Fuction to get google ad
	 */
	function getgooglead()
	{
		$db = $this->getDBO();
		$rs_googlead = JTable::getInstance('googlead', 'Table');
		// To get the id no to be edited...
		$id = 1;
		$rs_googlead->load($id);
		$lists['published'] = JHTML::_('select.booleanlist','published',$rs_googlead->publish);
		return $rs_googlead;
	}
	/**
	 * Fuction to save google ad
	 */

	function savegooglead()
	{
		$option = JRequest::getCmd('option');
		$arrFormData = JRequest::get('POST');
		$mainframe = JFactory::getApplication();
		$db = JFactory::getDBO();
		$objGoogleAdTable =& JTable::getInstance('googlead', 'Table');
		$id = 1;
		if(JRequest::getVar('showoption') == '0') {
			$arrFormData['closeadd'] = '';
		}
		if(JRequest::getVar('reopenadd') == '') {
			$arrFormData['reopenadd'] = '1';
			$arrFormData['ropen'] = '';
		}
		$code = $_POST['code'];
		//Convert all applicable characters to HTML entities
		$arrFormData['code'] = htmlentities(stripslashes($code));
		// Get the node from the table.
		$objGoogleAdTable->load($id);
		// Bind data to the table object.
		if (!$objGoogleAdTable->bind($arrFormData)) {
			JError::raiseWarning(500, $objGoogleAdTable->getError());
		}
		// Store the node in the database table.
		if (!$objGoogleAdTable->store()) {
			JError::raiseWarning(500, $objGoogleAdTable->getError());
		}
		// page redirect
		$link = 'index.php?option=' . $option.'&layout=googlead';
		$mainframe->redirect($link, 'Saved Successfully');
	}
}
?>
