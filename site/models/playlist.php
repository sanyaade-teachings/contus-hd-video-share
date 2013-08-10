<?php
/*
 ***********************************************************/
/**
 * @name          : Joomla Hdvideoshare
 * @version	      : 3.0
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2012 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @abstract      : Contushdvideoshare Component Playlist Model
 * @Creation Date : March 2010
 * @Modified Date : June 2012
 * */

/*
 ***********************************************************/
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );
// import joomla model library
jimport( 'joomla.application.component.model' );

/**
 * Contushdvideoshare Component Playlist Model
 */
class Modelcontushdvideoshareplaylist extends JModel {

	/**
	 * initializing constructor
	 */
	function __construct()
	{
		global $db;
		parent::__construct();
		global $usergroup;
		$db = $this->getDBO();
	}

	/**
	 * function to get myvideos
	 */
	function getMyvideos(){
		global $db;
		$user = JFactory::getUser();
		$memberId = $user->get('id');
		$query = "SELECT `id`, `memberid`, `published`, `title`, `seotitle`, `featured`, `type`, `rate`,
				  `ratecount`, `times_viewed`, `videos`, `filepath`, `videourl`, `thumburl`, `previewurl`, `hdurl`, 
				  `home`, `playlistid`, `duration`, `ordering`, `streamerpath`, `streameroption`, `postrollads`, 
				  `prerollads`, `midrollads`, `description`, `targeturl`, `download`, `prerollid`, `postrollid`, 
				  `created_date`, `addedon`, `usergroupid`, `tags`, `useraccess` 
				  FROM #__hdflv_upload WHERE memberid = $memberId";
		$db->setQuery($query);
		$myVideos = $db->loadObjectList();
		return $myVideos;
	}

	/**
	 * function to save playlist
	 */
	function savePlaylist() {
		global $db;
		$app = JFactory::getApplication();
		$playlistVideos = JRequest::getVar('playlist_videos');
		if(isset($playlistVideos)) {
			$playlistVideos = implode( ',', $playlistVideos );
		}
		$user = JFactory::getUser();
		$memberId = $user->get('id');
		JRequest::setVar( 'member_id', $memberId, 'post' );
		JRequest::setVar( 'published', '1', 'post' );
		JRequest::setVar( 'parent_id', '-1', 'post' );
		$row =& $this->getTable('playlist');

		$data = JRequest::get( 'post' );
		$data['seo_category'] = $data['category'];
		// Bind the form fields to the hello table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the hello record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		} else {
			$app->enqueueMessage( 'New playlist was created successfully. Add videos to playlist.' );
		}
		
		$lastinsertedId = $row->id;
		if(isset($playlistVideos)) {	
		$query="UPDATE #__hdflv_upload
	    		SET playlistid=$lastinsertedId 
	    		WHERE id IN ($playlistVideos)";
		$db->setQuery($query);
		$db->query();

		$query1="UPDATE #__hdflv_video_category
        		 SET catid=$lastinsertedId
        		 WHERE vid IN ($playlistVideos)";
		$db->setQuery($query1);
		$db->query();
		}
		/**
		 * get the most recent database error code
		 * display the last database error message in a standard format
		 *
		 */
		if ($db->getErrorNum())
		{
			JError::raiseWarning($db->getErrorNum(), $db->stderr());
		}
		
		$app->redirect('index.php?option=com_contushdvideoshare&view=playlist');
	}

	/**
	 * function for getting playlist
	 */
	function getPlaylist() {
		$limit = '';
		global $db;
		if(JRequest::getVar('channelid')) {
			$channelId = JRequest::getVar('channelid');
			$query = "SELECT user_id
    				  FROM #__hdflv_channel 
    				  WHERE id = $channelId";
			$db->setQuery($query);
			$memberId = $db->loadResult();
		}else {
			$user = JFactory::getUser();
			$memberId = $user->get('id');
		}
		$query = "SELECT distinct(a.playlistid)
    			  FROM #__hdflv_upload a
    			  LEFT JOIN #__hdflv_video_category e on e.vid=a.id 
        		  LEFT JOIN #__hdflv_category b on e.catid=b.id 
    			  WHERE memberid=$memberId and b.published=1";
		$db->setQuery($query);
		$total = $db->loadobjectList();
		$total = count($total);
		$pageno = 1;
		if(JRequest::getVar('page'))
		{
			$pageno = JRequest::getVar('page');
		}
		$length = 12;
		if($length != 0) {
			$pages = ceil($total/$length);
		}
		if($pageno==1)
		$start=0;
		else
		$start= ($pageno - 1) * $length;
		$playlistquery = "SELECT distinct(a.playlistid)
    					  FROM #__hdflv_upload a
    					  LEFT JOIN #__hdflv_video_category e on e.vid=a.id 
        			  	  LEFT JOIN #__hdflv_category b on e.catid=b.id 
    					  WHERE memberid=$memberId and b.published=1
    					  LIMIT $start,$length";    	
		$db->setQuery($playlistquery);
		$playlist = $db->loadobjectList();
		if(!empty($playlist)) {
			for($i=0;$i<count($playlist);$i++) {
			$playlistId = $playlist[$i]->playlistid;
			$query = "SELECT a.`id`, a.`memberid`, a.`published`, a.`title`, a.`seotitle`,
					  a.`featured`, a.`type`, a.`rate`, a.`ratecount`, a.`times_viewed`, a.`videos`, a.`filepath`, 
					  a.`videourl`, a.`thumburl`, a.`previewurl`, a.`hdurl`, a.`home`, a.`playlistid`, a.`duration`, 
					  a.`ordering`, a.`streamerpath`, a.`streameroption`, a.`postrollads`, a.`prerollads`, 
					  a.`midrollads`,a.`description`, a.`targeturl`, a.`download`, a.`prerollid`, a.`postrollid`, 
					  a.`created_date`,a.`addedon`, a.`usergroupid`, a.`tags`, a.`useraccess`,b.category,
					  b.seo_category,d.username,e.vid,e.catid 
        			  FROM  #__hdflv_upload a 
        			  LEFT JOIN #__users d ON a.memberid=d.id 
        			  LEFT JOIN #__hdflv_video_category e ON e.vid=a.id 
        			  LEFT JOIN #__hdflv_category b ON e.catid=b.id 
        			  WHERE a.published='1' 
        			  AND a.type='0' 
        			  AND b.published=1 
        			  AND a.memberid=$memberId 
        			  AND a.playlistid=$playlistId
        			  LIMIT 1";
			$db->setQuery($query);
        	$playlistdvideos = $db->loadobjectList();
        	$playList[$i] = $playlistdvideos;

        }
        return $playList;
        }
	}

	/**
	 * function to get channel settings
	 */
	function channelSettings(){
		global $db;
		if(JRequest::getVar('channelid')) {
			$channelId = JRequest::getVar('channelid');
		}else {
			$channelId = $this->getChannel();
		}
		$query = "SELECT `id`, `channel_id`, `player_width`, `player_height`, `video_row`, `video_colomn`, `logo`,
				  `recent_videos`, `popular_videos`, `top_videos`, `playlist`, `type`, `start_videotype`, 
				  `start_video`, `start_playlist`, `fb_comment` 
				  FROM #__hdflv_channelsettings 
				  WHERE channel_id = $channelId";
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	/**
	 * function to get channel id
	 */
	function getChannel() {
		global $db;
		$user = JFactory::getUser();
		$memberId = $user->get('id');
		$query = "SELECT channel_name
    			  FROM #__hdflv_channel 
    			  WHERE user_id = $memberId";
		$db->setQuery($query);
		return $db->loadResult();
	}

	/**
	 * function to get playlist videos
	 */
	function getplaylistVideos() {
		global $db;
		if(JRequest::getVar('channelid')) {
			$channelId = JRequest::getVar('channelid');
			$query = "SELECT user_id
    				  FROM #__hdflv_channel 
    				  WHERE id = $channelId";
			$db->setQuery($query);
			$memberId = $db->loadResult();
		}else {
			$user = JFactory::getUser();
			$memberId = $user->get('id');
		}
		$playlistName = JRequest::getString('category');
		$playlistName = trim($playlistName);
		$query = "SELECT id
        		  FROM #__hdflv_category 
        		  WHERE category = '$playlistName'";
		$db->setQuery($query);
		$playlistId = $db->loadResult();
		$featuredtotal = "SELECT COUNT(id)
					  FROM #__hdflv_upload 
					  WHERE memberid=$memberId 
					  AND playlistid=$playlistId";
		$db->setQuery($featuredtotal);
		$total = $db->loadResult();
		$pageno = 1;
		if(JRequest::getVar('page','','post','int'))
		{
			$pageno = JRequest::getVar('page','','post','int');
		}
		$length=12;
		$pages = ceil($total/$length);
		if($pageno==1)
		$start=0;
		else
		$start= ($pageno - 1) * $length;
		$playlistquery = "SELECT a.`id`, a.`memberid`, a.`published`, a.`title`, a.`seotitle`,
					  a.`featured`, a.`type`, a.`rate`, a.`ratecount`, a.`times_viewed`, a.`videos`, a.`filepath`, 
					  a.`videourl`, a.`thumburl`, a.`previewurl`, a.`hdurl`, a.`home`, a.`playlistid`, a.`duration`, 
					  a.`ordering`, a.`streamerpath`, a.`streameroption`, a.`postrollads`, a.`prerollads`, 
					  a.`midrollads`,a.`description`, a.`targeturl`, a.`download`, a.`prerollid`, a.`postrollid`, 
					  a.`created_date`,a.`addedon`, a.`usergroupid`, a.`tags`, a.`useraccess`,b.category,
					  b.seo_category,d.username,e.vid,e.catid 
					  FROM  #__hdflv_upload a 
					  LEFT JOIN #__users d ON a.memberid=d.id 
					  LEFT JOIN #__hdflv_video_category e ON e.vid=a.id 
					  LEFT JOIN #__hdflv_category b ON e.catid=b.id 
					  WHERE a.type='0' AND a.published=1 AND b.published=1
					  AND a.memberid=$memberId 
					  AND a.playlistid=$playlistId 
					  LIMIT $start,$length";
		$db->setQuery($playlistquery);
		$playlistvideos = $db->loadobjectList();
		$rows = $playlistvideos;
		if(count($rows)>0){
			$rows['pageno'] = $pageno;
			$rows['pages'] = $pages;
			$rows['start'] = $start;
			$rows['length'] = $length;			
		}
		return $rows;
	}

	/**
	 *  function for updating recent activity
	 */
	function updateRecentactivity() {
		global $db;
		$channelId = $this->getChannel();
		$query='UPDATE #__hdflv_channel
        		SET updated_date=now() 
        		WHERE id='.$channelId;
		$db->setQuery($query);
		$db->query();
	}

	/**
	 * function to check playlist availability
	 */
	function playlistExists() {
		global $db;
		$data = JRequest::get( 'post' );
		$category = $data['category'];
		$query = "SELECT `id`, `member_id`, `category`, `seo_category`, `parent_id`, `ordering`, `lft`, `rgt`,
    			  `published` 
    			  FROM #__hdflv_category 
    			  WHERE category='$category'";
		$db->setQuery($query);
		return $db->loadobjectList();
	}
}
?>