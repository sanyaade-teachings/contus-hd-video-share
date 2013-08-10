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
 * @abstract      : Contushdvideoshare Component Related Videos View
 * @Creation Date : March 2010
 * @Modified Date : June 2012
 * */
/*
 ***********************************************************/
//No direct acesss
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.view');
class contushdvideoshareViewrelatedvideos extends JView
{
function display()
	{
			$model = $this->getModel();
            $relatedvideos = $model->getrelatedvideos();
            $this->assignRef('relatedvideos', $relatedvideos);
            $relatedvideosrowcol = $model->getrelatedvideosrowcol();
            $this->assignRef('relatedvideosrowcol', $relatedvideosrowcol);
            parent::display();
	}
}
?>