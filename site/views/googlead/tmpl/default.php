<?php 
/*
 ***********************************************************/
/**
 * @name          : Joomla HD Video Share
 * @version	  : 3.4
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @abstract      : Contus HD Video Share Component googlead View
 * @Creation Date : March 2010
 * @Modified Date : May 2013
 * */
/*
 ***********************************************************/
//No direct acesss
defined('_JEXEC') or die('Restricted access');
ob_clean();
?>
<?php echo $this->details;?>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<?php exit();?>