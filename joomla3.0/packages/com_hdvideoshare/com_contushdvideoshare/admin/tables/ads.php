<?php
/*
 ***********************************************************/
/**
 * @name          : Joomla HD Video Share
 * @version	      : 3.2.1
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @abstract      : Contus HD Video Share Component Adminvideos Table
 * @Creation Date : March 2010
 * @Modified Date : March 2013
 * */
/*
 ***********************************************************/
// no direct access
defined('_JEXEC') or die('Restricted access');
// table for contushdvideoshareads
class Tableads extends JTable {
    var $id = null;
    var $published = null;
    var $adsname = null;
    var $filepath = null;
    var $postvideopath = null;
    var $home = null;
    var $targeturl = null;
    var $clickurl = null;
    var $impressionurl = null;
    var $clickcounts = null;
    var $impressioncounts=null;
    var $adsdesc=null;
    var $typeofadd=null;

    function __construct(&$db) {
        parent::__construct('#__hdflv_ads', 'id', $db);
    }

}

?>