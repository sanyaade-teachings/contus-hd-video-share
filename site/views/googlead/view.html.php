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
 * @abstract      : Contushdvideoshare Component googlead View
 * @Creation Date : March 2010
 * @Modified Date : June 2012
 * */
/*
 ***********************************************************/
//No direct acesss
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.view');
class contushdvideoshareViewgooglead extends JView
{
function display($cachable = false, $urlparams = false)
	{
	
    $model = $this->getModel();
   
	$detail = $model->getgooglead();
        $this->assignRef('details',$detail);
parent::display();
	}

}
?>   
