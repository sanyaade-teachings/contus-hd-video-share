<?php
/**
 * @name          : Joomla HD Video Share
 * @version	  : 3.2.1
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @abstract      : Contus HD Video Share Component Edit video Model
 * @Creation Date : March 2010
 * @Modified Date : March 2013
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class Modelhdvideoshareeditvideo extends JModelList {
    /* Following function is to save a particular video which is being edited */

    function geteditdetails()
    {
        $user = & JFactory::getUser();
        $session = & JFactory::getSession();
        $success = "";
        $editbtn = JRequest::getVar('editbtn','','post');
        if (isset($editbtn))
         {
            if ($user->get('id')) {
                $memberid = $user->get('id'); // Getting the memberid
            }
            if (JRequest::getVar('id', '', 'get', 'int')) {
                $videoid = JRequest::getVar('id', '', 'get', 'int'); //Getting the video id
            }
            $title = JRequest::getVar('title', '', 'post', 'string');
            $description = JRequest::getVar('descr', '', 'post', 'string');
            $type = JRequest::getVar('type', '', 'post', 'string');
            $db = & JFactory::getDBO();
            $query = "update #__hdflv_upload set title='$title',description='$description',type='$type' where id='$videoid' and memberid='$memberid'"; //Query is to update a particular video details
            $db->setQuery($query);
            $db->query();
            $success = "Your video Details Updated Successfully";
            $url = $baseurl . "index.php?option=com_hdvideoshare&view=myvideos";
            header("Location: $url");
        }
// Following code is to get a particulat video for edit
        if (JRequest::getVar('id', '', 'get', 'int')) {
            $videoid = JRequest::getVar('id', '', 'get', 'int'); // Getting the video id of a particular video
        }
        $db = $this->getDBO();
        $query = "select a.*,b.category,d.username,e.* from  #__hdflv_upload a left join #__users d on a.memberid=d.id left join #__hdflv_video_category e on e.vid=a.id left join #__hdflv_category b on e.catid=b.id where a.published=1 and a.id=$videoid group by e.vid"; // Query to get a particular video for edit action
        $db->setQuery($query);
        $rows = $db->LoadObjectList();
        $memberid = "";
        $user = & JFactory::getUser();
        if ($user->get('id')) {
            $memberid = $user->get('id'); //Setting the loginid into session
        }
        if ($memberid != "")
            $myvideorowcolquery = "select allowupload  from #__hdflv_user  where member_id=" . $memberid;
        else
            $myvideorowcolquery="select allowupload  from #__hdflv_site_settings";
        $db = $this->getDBO();
        $db->setQuery($myvideorowcolquery);
        $row = $db->LoadObjectList();
        if (count($row) == 0)
         {
            $myvideorowcolquery = "select allowupload  from #__hdflv_site_settings";
            $db = $this->getDBO();
            $db->setQuery($myvideorowcolquery);
            $row = $db->LoadObjectList();
            $query = " insert into #__hdflv_user (member_id,allowupload) values ('$memberid','$row[0]->allowupload')";
            $db->setQuery($query);
            $db->query();
        }
        $rows = array_merge($rows, $row);
        return array($rows, $success);
    }
}
?>