<?php
/**
 * @name          : Joomla HD Video Share
 * @version	  : 3.2.1
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @abstract      : Contus HD Video Share Component Email Model
 * @Creation Date : March 2010
 * @Modified Date : March 2013
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import Joomla model library
jimport( 'joomla.application.component.model' );
/**
 * Contushdvideoshare Component Email Model
 */
class Modelcontushdvideoshareemail extends JModelList
{
	
        function getemail()
        {
            $to = JRequest::getVar('to','','post','string');
            $from = JRequest::getVar('from','','post','string');
            //$url = JRequest::getVar('url','','post','string');
            $url = JRequest::getVar('url','','post','string');

            $subject = "You have received a video!";

            // header information not including sendTo and Subject
            // these all go in one variable.  First, include From:
            $headers = "From: "."<" . JRequest::getVar('from','','post','string') .">\r\n";
            // next include a replyto
            $headers1 .= "Reply-To: " . JRequest::getVar('from','','post','string') . "\r\n";            
            $headers .= "Return-path: " . JRequest::getVar('from','','post','string');

            // now we can add the content of the message to a body variable
            $message = JRequest::getVar('note','','post','string') . "\n\n";
            $message .= "Video URL: " . $url;

            // once the variables have been defined, they can be included
            // in the mail function call which will send you an email
            if(mail($to, $subject, $message, $headers))
            {
                echo "output=sent";
                $headers = "From: "."<" . JRequest::getVar('to','','post','string') .">\r\n";
                $message="Thank You ";
                mail($from, $subject, $message, $headers);
            } else {
                echo "output=error";
            }
            exit();

    }

	
}