<?php
/**
 * @name          : Joomla HD Video Share
 * @version	  : 3.2.1
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @abstract      : Contus HD Video Share Component Googlead Model
 * @Creation Date : March 2010
 * @Modified Date : March 2013
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import Joomla model library
jimport( 'joomla.application.component.model' );
/**
 * Contushdvideoshare Component Googlead Model
 */
class Modelcontushdvideosharegooglead extends JModelList
{	
	function getgooglead()
	{
            global $db;
            $db = JFactory::getDBO();
            $query1 = "SELECT * FROM #__hdflv_googlead WHERE publish='1' and id='1'";
            $db->setQuery( $query1 );
            $fields = $db->loadObjectList();
            return  html_entity_decode(stripcslashes($fields[0]->code));

	}
}