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
 * @abstract      : Contus HD Video Share Component Hdvideoshare Midrollxml View
 * @Creation Date : March 2010
 * @Modified Date : March 2013
 * */
/*
 ***********************************************************/
//No direct acesss
defined('_JEXEC') or die('Restricted access');

//importing Default Component Model
jimport('joomla.application.component.view');

/*
 * Description : getads()
 *  This Function Call To UserDefined Ads Function
 */

class contushdvideoshareViewmidrollxml extends JView {

    function display($cachable = false, $urlparams = false) {
        $model = & $this->getModel();
        $detail = $model->getads();
        print_r($detail);
        exit();
    }

}
?>   