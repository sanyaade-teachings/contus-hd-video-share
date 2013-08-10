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
 * @license       : GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
 * @abstract      : Contus HD Video Share Component Languagexml View
 * @Creation Date : March 2010
 * @Modified Date : March 2013
 * */
/*
 ***********************************************************/
//No direct acesss
defined('_JEXEC') or die('Restricted access');
ob_clean();
header ("content-type: text/xml");
    echo '<?xml version="1.0" encoding="utf-8"?>';
    echo '<language>';
    echo'<play>';
    echo '<![CDATA['.JText::_('HDVS_PLAY').']]>';
    echo  '</play>';
    echo '<pause>';
    echo '<![CDATA['.JText::_('HDVS_PAUSE').']]>';
    echo '</pause>';
    echo '<hdison>';
    echo '<![CDATA['.JText::_('HDVS_HD_IS_ON').']]>';
    echo '</hdison>';
    echo '<hdisoff>';
    echo '<![CDATA['.JText::_('HDVS_HD_IS_OFF').']]>';
    echo '</hdisoff>';
    echo '<zoom>';
    echo '<![CDATA['.JText::_('HDVS_ZOOM').']]>';
    echo '</zoom>';
    echo'<share>';
    echo '<![CDATA['.JText::_('HDVS_SHARE').']]>';
    echo '</share>';
    echo'<fullscreen>';
    echo '<![CDATA['.JText::_('HDVS_FULL_SCREEN').']]>';
    echo '</fullscreen>';
    echo'<relatedvideos>';
    echo '<![CDATA['.JText::_('HDVS_RELATED_VIDEOS').']]>';
    echo '</relatedvideos>';
    echo'<sharetheword>';
    echo '<![CDATA['.JText::_('HDVS_SHARE_THE_WORD').']]>';
    echo '</sharetheword>';
    echo'<sendanemail>';
    echo '<![CDATA['.JText::_('HDVS_SEND_AN_EMAIL').']]>';
    echo '</sendanemail>';
    echo'<to>';
    echo '<![CDATA['.JText::_('HDVS_TO').']]>';
    echo '</to>';
    echo'<from>';
    echo '<![CDATA['.JText::_('HDVS_FROM').']]>';
    echo '</from>';
    echo'<note>';
    echo '<![CDATA['.JText::_('HDVS_NOTE').']]>';
    echo '</note>';
    echo'<send>';
    echo '<![CDATA['.JText::_('HDVS_SEND').']]>';
    echo '</send>';
    echo'<copylink>';
    echo '<![CDATA['.JText::_('HDVS_COPY_LINK').']]>';
    echo '</copylink>';
    echo'<copyembed>';
    echo '<![CDATA['.JText::_('HDVS_COPY_EMBED').']]>';
    echo '</copyembed>';
    echo'<facebook>';
    echo '<![CDATA['.JText::_('HDVS_FACEBOOK').']]>';
    echo '</facebook>';
    echo'<reddit>';
    echo '<![CDATA['.JText::_('HDVS_RED_IT').']]>';
    echo '</reddit>';
    echo'<friendfeed>';
    echo '<![CDATA['.JText::_('HDVS_FRIEND_FEED').']]>';
    echo '</friendfeed>';
    echo'<slashdot>';
    echo '<![CDATA['.JText::_('HDVS_SLASH_DOT').']]>';
    echo '</slashdot>';
    echo'<delicious>';
    echo '<![CDATA['.JText::_('HDVS_DELICIOUS').']]>';
    echo '</delicious>';
    echo'<myspace>';
    echo '<![CDATA['.JText::_('HDVS_MY_SPACE').']]>';
    echo '</myspace>';
    echo'<wong>';
    echo '<![CDATA['.JText::_('HDVS_WONG').']]>';
    echo '</wong>';
    echo'<digg>';
    echo '<![CDATA['.JText::_('HDVS_DIGG').']]>';
    echo '</digg>';
    echo'<blinklist>';
    echo '<![CDATA['.JText::_('HDVS_BLINK_LINT').']]>';
    echo '</blinklist>';
    echo'<bebo>';
    echo '<![CDATA['.JText::_('HDVS_BEBO').']]>';
    echo '</bebo>';
    echo'<fark>';
    echo '<![CDATA['.JText::_('HDVS_FARK').']]>';
    echo '</fark>';
    echo'<tweet>';
    echo '<![CDATA['.JText::_('HDVS_TWEET').']]>';
    echo '</tweet>';
    echo'<furl>';
    echo '<![CDATA['.JText::_('HDVS_FURL').']]>';
    echo '</furl>';
    echo '<adindicator><![CDATA['.JText::_('HDVS_ADINDICATOR').']]>';
    echo '</adindicator>';
    echo '<skip><![CDATA['.JText::_('HDVS_SKIP').']]></skip>';
    echo '<volume><![CDATA['.JText::_('HDVS_VOLUME').']]></volume>';
    echo '<download><![CDATA['.JText::_('HDVS_DOWNLOAD').']]></download>';
    echo '</language>';
exit();
?>