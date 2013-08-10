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
 * @abstract      : Contushdvideoshare Component Category Model 
 * @Creation Date : March 2010
 * @Modified Date : June 2012
 * */

/*
 ***********************************************************/
//No direct acesss
defined('_JEXEC') or die();
// import joomla model library
jimport('joomla.application.component.model');
// import joomla pagination library
jimport('joomla.html.pagination');
/**
 * Contushdvideoshare Component Administrator Category Model
 */
class contushdvideoshareModelcategory extends JModel {
	
	function __construct() {
        global $mainframe,$db,$option;
        parent::__construct();
        $mainframe = JFactory::getApplication();
        $db =  JFactory::getDBO();
        $option = JRequest::getCmd('option');
        $config = JFactory::getConfig();
    }

	/**
	 * function to get category list
	 */
	function getcategory() { 
		global $option,$mainframe,$db;
		$total = 0;		
		$filter_order = $mainframe->getUserStateFromRequest($option . 'filter_order_category', 'filter_order', 'ordering', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option . 'filter_order_Dir_category', 'filter_order_Dir', 'asc', 'word');
		$search = $mainframe->getUserStateFromRequest($option . 'category_search', 'category_search', '', 'string');
		$state_filter = $mainframe->getUserStateFromRequest($option . 'category_status', 'category_status', '', 'int');
					
		// page navigation
		// Default List Limit
		$limit = $mainframe->getUserStateFromRequest($option . '.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option . '.limitstart', 'limitstart', 0, 'int');

		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		$where = ' WHERE ';
		if($search || $state_filter)
		$where = ' WHERE';
		//query to fetch sub categories
		if ($search)
		{		
			$where .= " a.category LIKE '%$search%'";						
			$lists['category_search'] = $search;						
		}
		// filtering based on status
		if($state_filter) {			
			if($state_filter == 1) {
				$state_filterval = 1;
			}elseif ($state_filter == 2) {
				$state_filterval = 0;
			}else {
				$state_filterval = -2;
			}
			if($search)
			$where .= ' AND ';
			$where .= " a.published = $state_filterval";										 			
			$lists['category_status'] = $state_filter;				
		} else {
			if($search)
			$where .= ' AND ';
			$where .= " a.published != -2";
		} 		
		
		
		$query = 'SELECT a.id AS value, a.category AS text, a.ordering, a.published, COUNT(DISTINCT b.id) AS level' .
				' FROM #__hdflv_category AS a' .
				' LEFT JOIN `#__hdflv_category` AS b ON a.lft > b.lft AND a.rgt < b.rgt' . $where .
				' GROUP BY a.id, a.category, a.lft, a.rgt' .
				' ORDER BY a.lft ASC';
		$db->setQuery($query);
		$db->query();
		$categoryCount = $db->getNumRows();
		
		// set pagination
		$pageNav = new JPagination($categoryCount, $limitstart, $limit);
		
		$query = "$query LIMIT $pageNav->limitstart,$pageNav->limit";
		$db->setQuery($query);
		$categorylist = $db->loadObjectList();	
		
		/** get the most recent database error code
		 * display the last database error message in a standard format
		 *
		 */
		if ($db->getErrorNum())
		{
			JError::raiseWarning($db->getErrorNum(), $db->stderr());
		}
		return array('pageNav' => $pageNav, 'limitstart' => $limitstart, 'categoryFilter' => $lists, 'categorylist' => $categorylist);
	}
	
	/**
	 * function to get parent categories
	 */
	function getcategorydetails($id) {
		//query to fetch details of selected category
		$query = 'SELECT `id`,`member_id`,`category`,`seo_category`,`parent_id`,`ordering`,`published` 
				  FROM `#__hdflv_category` 
				  WHERE `id` = ' . $id;
		$db = $this->getDBO();
		$db->setQuery($query);
		$category = $db->loadObject();


		$db->setQuery(
			'SELECT a.id AS value, a.category AS text, COUNT(DISTINCT b.id) AS level' .
			' FROM #__hdflv_category AS a' .
			' LEFT JOIN `#__hdflv_category` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
			' WHERE a.published = 1 AND a.id != '.$id.
			' GROUP BY a.id, a.category, a.lft, a.rgt' .
			' ORDER BY a.lft ASC'
		);
		$categorylist = $db->loadObjectList();

		foreach ($categorylist as &$option)
		{
			$option->text = str_repeat('- ', $option->level).$option->text;
		}			
					
		/** get the most recent database error code
		 * display the last database error message in a standard format
		 *
		 */
		if ($db->getErrorNum())
		{
			JError::raiseWarning($db->getErrorNum(), $db->stderr());
		}
		
		return array($category, $categorylist);
	}

	/**
	 * function to get list of existing categories
	 */
	function getNewcategory() {
		
		global $db;
		$db->setQuery(
			'SELECT a.id AS value, a.category AS text, COUNT(DISTINCT b.id) AS level' .
			' FROM #__hdflv_category AS a' .
			' LEFT JOIN `#__hdflv_category` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
			' WHERE a.published = 1' .
			' GROUP BY a.id, a.category, a.lft, a.rgt' .
			' ORDER BY a.lft ASC'
		);
		$options = $db->loadObjectList();

		foreach ($options as &$option)
		{
			$option->text = str_repeat('- ', $option->level).$option->text;
		}		
		
		$objCategoryTable = $this->getTable('category');
		$objCategoryTable->id = 0;
		$objCategoryTable->category = '';
		$objCategoryTable->published = '';
		
		/** get the most recent database error code
		 * display the last database error message in a standard format
		 *
		 */
		if ($db->getErrorNum())
		{
			JError::raiseWarning($db->getErrorNum(), $db->stderr());
		}
		
		return array($objCategoryTable, $options);
	}

	/**
	 * fuction to save category
	 */
	function savecategory($arrFormData) { 
		$objCategoryTable = & $this->getTable('category');
		//code for seo category name
		$seo_category = $arrFormData['category'];
		$seo_category = preg_replace('/[&:\s]+/i','-',$seo_category);
		$arrFormData['seo_category'] = preg_replace('/[\"\']+/i','',$seo_category);

		if (!$objCategoryTable->bind($arrFormData)) {
			JError::raiseWarning(500, $objCategoryTable->getError());
		}
		if (!$objCategoryTable->check()) {
			JError::raiseWarning(500, $objCategoryTable->getError());
		}
		if (!$objCategoryTable->store()) {
			JError::raiseWarning(500, $objCategoryTable->getError());
		}
		$this->rebuild(0, 0);
	}
	
	public function rebuild($parent_id = 0, $left = 0)
	{
		// get the database object
		$db = JFactory::getDBO();

		// get all children of this node
		$db->setQuery(
			'SELECT id FROM #__hdflv_category
			 WHERE parent_id='. (int)$parent_id .
			' ORDER BY parent_id, category'
		);
		$children = $db->loadObjectList();

		// the right value of this node is the left value + 1
		$right = $left + 1;

		// execute this function recursively over all children
		for ($i=0, $n=count($children); $i < $n; $i++)
		{
			// $right is the current right value, which is incremented on recursion return
			$right = $this->rebuild($children[$i]->id, $right);

			// if there is an update failure, return false to break out of the recursion
			if ($right === false) {
				return false;
			}
		}

		// we've got the left value, and now that we've processed
		// the children of this node we also know the right value
		$db->setQuery(
			'UPDATE #__hdflv_category
			 SET lft='. (int)$left .', rgt='. (int)$right .
			' WHERE id='. (int)$parent_id
		);
		// if there is an update failure, return false to break out of the recursion
		if (!$db->query()) {
			return false;
		}

		// return the right value of this node + 1
		return $right + 1;
	}

	/**
	 * function to delete category
	 */
	function deletecategary($arrayIDs) { 	
		global $db;	
		if(count($arrayIDs))
		{
			$cids = implode( ',', $arrayIDs );
			$query = "SELECT lft,rgt FROM `#__hdflv_category` WHERE `id` IN ( $cids )";
			$db->setQuery( $query );
			$options = $db->loadObjectList();

			foreach ($options as &$option)
			{
				$lft = $option->lft;
				$rgt = $option->rgt;
				$query = "DELETE FROM `#__hdflv_category` WHERE `lft` BETWEEN $lft AND $rgt";
			    $db->setQuery( $query );
			$db->query();
		}		
			$this->rebuild(0, 0);

	}
	}

	/**
	 * function to publish or unpublish categories
	 */
	function changeStatus($arrayIDs) {	
		global $mainframe,$db;	
		if ($arrayIDs['task'] == "publish") {
			$publish = 1;
			$msg = 'Published Successfully';
		} elseif($arrayIDs['task'] == 'trash') {
			$publish = -2;
			$msg = 'Trashed Successfully';
		} else {
			$publish = 0;
			$msg = 'Unpublished Successfully';
		}
		$cids = $arrayIDs['cid'];	
		$categoryTable =& JTable::getInstance('category', 'Table');
        $categoryTable->publish($cids, $publish);
        $cids = implode( ',', $cids );
        $query = "UPDATE #__hdflv_category set published=" . $publish . " WHERE parent_id IN ( $cids )";           
        $db->setQuery($query);
        $db->query();
        $link = 'index.php?option=com_contushdvideoshare&layout=category';
        $mainframe->redirect($link, $msg);			
    }
}
?>
