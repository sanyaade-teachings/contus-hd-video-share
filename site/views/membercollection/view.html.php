<?php
/*
 ***********************************************************/
/**
 * @name          : Joomla Hdvideoshare
 * @version	      : 3.1
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @abstract      : Contushdvideoshare Component Membercollection View
 * @Creation Date : March 2010
 * @Modified Date : June 2012
 * */
/*
 ***********************************************************/
//No direct acesss
defined( '_JEXEC' ) or die( 'Restricted access' );
// import Joomla view library
jimport('joomla.application.component.view');
/**
 * Contushdvideoshare Component Membercollection View
 */
class contushdvideoshareViewmembercollection extends JView
{
function display($cachable = false, $urlparams = false)
	{
			$model = $this->getModel();
			/* function call for fetching member videos */
            $membercollection = $model->getmembercollection();
            $this->assignRef('membercollection', $membercollection);
            /* function call for fetching membercollection settings */
            $memberpagerowcol = $model->getmemberpagerowcol();
            $this->assignRef('memberpagerowcol', $memberpagerowcol);
            parent::display();
	}
}
?>