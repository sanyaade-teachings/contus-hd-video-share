<?php

/**
 * @version     1.3, Creation Date : March-24-2011
 * @name        mod_HDVideoShareFeatured.php
 * @location    /components/modules/mod_HDVideoShareFeatured/mod_HDVideoShareFeatured.php
 * @package	Joomla 1.6
 * @subpackage	contushdvideoshare
 * @author      Contus Support - http://www.contussupport.com
 * @copyright   Copyright (C) 2011 Contus Support
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @link        http://www.hdvideoshare.net
 */
/*
 * Description : Modules HDVideoShare Featured
 */

// No direct Access
defined('_JEXEC') or die('Restricted access');
require_once( dirname(__FILE__) . DS . 'helper.php' );
$db = & JFactory::getDBO();
if(version_compare(JVERSION,'1.7.0','ge')) {
    $version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
    $version='1.6';
} else {
    $version='1.5';
}
if($version == '1.5'){
    if(!class_exists('JHtmlString')){
        JLoader::register('JHtmlString', JPATH_SITE.'/components/com_contushdvideoshare/string.php');
    }
}
$class	= $params->get( 'moduleclass_sfx' );
$query = "select language_settings from #__hdflv_site_settings "; //and id=2";
$db->setQuery($query);
$rows = $db->loadObjectList();
require_once("components/com_contushdvideoshare/language/".$rows[0]->language_settings );
$result = modfeaturedVideos::getfeaturedVideos();
$result1 = modfeaturedVideos::getfeaturedVideossettings();
require(JModuleHelper::getLayoutPath('mod_HDVideoShareFeatured'));
?>
