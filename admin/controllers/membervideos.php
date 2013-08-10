<?php
/*
* "ContusHDVideoShare Component" - Version 1.3
* Author: Contus Support - http://www.contussupport.com
* Copyright (c) 2010 Contus Support - support@hdvideoshare.net
* License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
* Project page and Demo at http://www.hdvideoshare.net
* Creation Date: March 30 2011
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

   /**
     * videos Component Administrator Controller
     */
class contushdvideoshareControllermembervideos extends JController
{

   function display()
	{

		$viewName   = JRequest::getVar( 'view', 'membervideos' );

		$viewLayout = JRequest::getVar( 'layout', 'membervideos' );
        //$viewLayout='listLayout';
		$view = & $this->getView($viewName);
        if ($model = & $this->getModel('membervideos'))
        {
			$view->setModel($model, true);
		}
		$view->setLayout($viewLayout);
		$view->display();
	}


	function remove()
    {
		
        $arrayIDs = JRequest::getVar('cid', null, 'default', 'array' ); //Reads cid as an array
       
		if($arrayIDs === null)
        { //Make sure the cid parameter was in the request
			JError::raiseError(500, 'cid parameter missing from the request');
		}
		$model = & $this->getModel('membervideos');
		$model->deletevideo($arrayIDs);
		$this->setRedirect('index.php?layout=membervideos&option='.JRequest::getVar('option'), 'Deleted...');

        }

       function publish()
        {
        $detail = JRequest::get('POST');
        $model = & $this->getModel('membervideos');
        $model->pubvideo($detail);
        $this->setRedirect('index.php?layout=membervideos&option='.JRequest::getVar('option'));
        }

       function unpublish()
        {
        $detail = JRequest::get('POST');
        $model = & $this->getModel('membervideos');
        $model->pubvideo($detail);
        $this->setRedirect('index.php?layout=membervideos&option='.JRequest::getVar('option'));
        }
        function featured()
        {
        $detail = JRequest::get('POST');
        $model = & $this->getModel('membervideos');
        $model->featuredvideo($detail);
        $this->setRedirect('index.php?layout=membervideos&option='.JRequest::getVar('option'));
        }
        function unfeatured()
        {
        $this->featured();
        }

        function cancel()
        {        
        $this->setRedirect('index.php?layout=membervideos&option='.JRequest::getVar('option'));
        }


        function comment()
        {
         $this->display();
//        $this->setRedirect('index.php?layout=videos&option='.JRequest::getVar('option'));
        }

}





?>
