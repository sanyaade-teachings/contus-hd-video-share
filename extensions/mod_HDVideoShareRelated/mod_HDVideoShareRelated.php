<?php
/*
 ***********************************************************/
/**
 * @name          : Joomla HD Video Share
 *** @version	  : 3.4.1
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2012 Powered by Apptha
 * @license       : http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @abstract      : Contus HD Video Share Related Videos Module
 * @Creation Date : March 2010
 * @Modified Date : May 2013
 * */

/*
 ***********************************************************/
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// Define DS
        if (!defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }
require_once( dirname(__FILE__) . DS . 'helper.php' );
$db = JFactory::getDBO();
$document = JFactory::getDocument();
if(version_compare(JVERSION,'1.7.0','ge')) {
	$version='1.7';
} elseif(version_compare(JVERSION,'1.6.0','ge')) {
	$version='1.6';
} else {
	$version='1.5';
        $document->addStyleSheet( JURI::base().'components/com_contushdvideoshare/css/tool_tip_15.css' );
}
if($version == '1.5'){
	if(!class_exists('JHtmlString')){
		JLoader::register('JHtmlString', JPATH_SITE.'/components/com_contushdvideoshare/string.php');
	}
}
if(version_compare(JVERSION,'1.6.0','ge')) {
	$jlang = JFactory::getLanguage();
        $jlang->load('mod_HDVideoShareRelated', JPATH_SITE, $jlang->get('tag'), true);
        $jlang->load('mod_HDVideoShareRelated', JPATH_SITE, null, true);
}
$class	= $params->get( 'moduleclass_sfx' );
$result1 = '';
$result = modrelatedvideos::getrelatedvideos();
$result1 = modrelatedvideos::getrelatedvideossettings();
require(JModuleHelper::getLayoutPath('mod_HDVideoShareRelated'));
?>
