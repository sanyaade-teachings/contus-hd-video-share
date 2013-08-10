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
 * @abstract      : Contushdvideoshare Component Hdvideoshare Helper Class 
 * @Creation Date : March 2010
 * @Modified Date : June 2012
 * */

/*
 ***********************************************************/

// No direct access.
defined('_JEXEC') or die;

/**
 * Hdvideoshare component helper.
 */
class HdvideoshareFilterHelper
{
	/**
	 * Get a list of filter options for status
	 *
	 * @return	array
	 */
	public function getStatusOptions()
	{
    	$options	= array('1'=>'Enable',
    						'2'=>'Disable'
    						);
    	return $options;
	}

	/**
	 * Get a list of filter options for feature
	 *
	 * @return	array
	 */
	public function getFeaturedOptions()
	{
    	$options	= array('1'=>'Featured',
    						'2'=>'Unfeatured'
    						);
    	return $options;
	}
	
	/**
	 * Get a list of filter options for ad types
	 *
	 * @return	array
	 */
	public function getAdTypes()
	{
    	$types	= array('mid'=>'Mid Roll Ad',
    					'prepost'=>'Pre/Post Roll Ad'
    						);
    	return $types;
	}
}
