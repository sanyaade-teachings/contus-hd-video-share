<?php
/*
 ***********************************************************/
/**
 * @name          : Joomla Hdvideoshare
 * @version	  	  : 3.0
 * @package       : apptha
 * @since         : Joomla 1.5
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @abstract      : Contushdvideoshare Component Showvideos Uploadfile Helper
 * @Creation Date : March 2010
 * @Modified Date : June 2012
 * */

/*
 ***********************************************************/
// No direct access to this file
defined('_JEXEC') or die;
//Import filesystem libraries.
jimport('joomla.filesystem.file');
/**
 * uploading videos 
 * type : FILE
 * Contushdvideoshare Component Showvideos Uploadfile Helper
 */
class uploadFileHelper
{
	// function to upload normal video
	function uploadFile($arrFormData,$idval)
	{		
		$strVideoName = $strHdVideoName = $strThumbImg = $strPreviewImg = '';		
		// get video and set video name
		$strVideoName = $arrFormData['normalvideoform-value'];
		$arrVideoName = explode('uploads/', $strVideoName);
		if(isset($arrVideoName[1]))
		$strVideoName = $arrVideoName[1];
			
		// get hdvideo and set hdvideo name
		$strHdVideoName = $arrFormData['hdvideoform-value'];
		$arrHdVideoName = explode('uploads/', $strHdVideoName);
		if(isset($arrHdVideoName[1]))
		$strHdVideoName = $arrHdVideoName[1];

		// get thumb image name and set thumb image name
		$strThumbImg = $arrFormData['thumbimageform-value'];
		$arrThumbImg = explode('uploads/', $strThumbImg);
		if(isset($arrThumbImg[1]))
		$strThumbImg = $arrThumbImg[1];
			
		// get preview image name and set preview image name
		$strPreviewImg = $arrFormData['previewimageform-value'];
		$arrPreviewImg = explode('uploads/', $strPreviewImg);
		if (isset($arrPreviewImg[1]))
		$strPreviewImg = $arrPreviewImg[1];		
			
		/**
		 *  function to upload video
		 */
		uploadFileHelper::uploadVideoProcessing($idval, $strVideoName, $strThumbImg, $strPreviewImg, $strHdVideoName, $arrFormData['newupload'], $arrFormData['fileoption']);
		
		/**
		 * DELETE TEMPORARY FILES
		 * delete temporary existing videos,hd videos,thumb image and preview image
		 * after files moved from temporary path to target path
		 * @ Temp Path : components/com_contushdvideoshare/images/uploads/ 
		 * @ Target Path : components/com_contushdvideoshare/videos		 		 
		 */
		if ($strVideoName != '')
		uploadFileHelper::unlinkUploadedTmpFiles($strVideoName);
		if ($strHdVideoName != '')
		uploadFileHelper::unlinkUploadedTmpFiles($strHdVideoName);
		if ($strThumbImg != '')
		uploadFileHelper::unlinkUploadedTmpFiles($strThumbImg);
		if ($strPreviewImg != '')
		uploadFileHelper::unlinkUploadedTmpFiles($strPreviewImg);				
	}
	
	/**
	 * function to get file from temporary path
	 * and prepare file extension	 
	 */
	function uploadVideoProcessing($idval, $file_video, $file_timage, $file_pimage, $file_hvideo, $newupload, $filepath)
	{
		/**
		 * VPATH to get target path
		 * target path @ /components/com_contushdvideoshare/videos
		 * FVPATH to get temporary path
		 * temp path @ /components/com_contushdvideoshare/images/uploads
		 * */
		$strTargetPath = VPATH . "/";
		// for videos
		if ($file_video <> '')
		{
			$exts = uploadFileHelper::getFileExtension($file_video);
			$strVidTempPath = FVPATH . "/images/uploads/" . $file_video;
			$strVidTargetPath = $strTargetPath . $idval . "_video" . "." . $exts;
			$fv = $idval . "_video" . "." . $exts;
			// function to copy from imasges/uploads to /components/com_hdvideoshare/videos/
			uploadFileHelper::copytovideos($strVidTempPath, $strVidTargetPath, $fv, $idval, 'videourl',$newupload, $filepath);
		}

		// for thumb image
		if ($file_timage <> '')
		{
			$exts = uploadFileHelper::getFileExtension($file_timage);
			$strThumbImgTempPath = FVPATH . "/images/uploads/" . $file_timage;
			$strThumbImgTargetPath = $strTargetPath . $idval . "_thumb" . "." . $exts;
			$ft = $idval . "_thumb" . "." . $exts;
			// function to copy from imasges/uploads to /components/com_hdvideoshare/videos/
			uploadFileHelper::copytovideos($strThumbImgTempPath, $strThumbImgTargetPath, $ft, $idval, 'thumburl',$newupload, $filepath);
		}
		// for preview image
		if ($file_pimage <> '')
		{
			$exts = uploadFileHelper::getFileExtension($file_pimage);
			$strPreImgTempPath = FVPATH . "/images/uploads/" . $file_pimage;
			$strPreImgTargetPath = $strTargetPath . $idval . "_preview" . "." . $exts;
			$fp = $idval . "_preview" . "." . $exts;
			// function to copy from imasges/uploads to /components/com_hdvideoshare/videos/
			uploadFileHelper::copytovideos($strPreImgTempPath, $strPreImgTargetPath, $fp, $idval, 'previewurl', $newupload, $filepath);
		}
		// for hdvideo
		if ($file_hvideo <> '')
		{
			$exts = uploadFileHelper::getFileExtension($file_hvideo);
			$strHdVidTempPath = FVPATH . "/images/uploads/" . $file_hvideo;
			$strHdVidTargetPath = $strTargetPath . $idval . "_hd" . "." . $exts;
			$fh = $idval . "_hd" . "." . $exts;
			// function to copy from imasges/uploads to /components/com_hdvideoshare/videos/
			uploadFileHelper::copytovideos($strHdVidTempPath, $strHdVidTargetPath, $fh, $idval, 'hdurl', $newupload, $filepath);
		}
	}	

	/**
	* function to files move from temp path to target path 
	* Temp path @ /components/com_contushdvideoshare/images/uploads 
	* Target path @ /components/com_hdvideoshare/videos/ 
	* param @ video path,target path,thumb image,id,url type,upload type,file path.
	*/ 
	function copytovideos($strFileTempPath, $strFileTargetPath, $vmfile, $idval, $dbname, $newupload, $filepath)
	{		
		$db = & JFactory::getDBO();		
		// check thumb image is default thumb image
		if ($strFileTempPath <> 'default_thumb')
		{			
			// To make sure in edit mode video ,hd, thumb image or preview image file is exists
			// if exists then remove the old one
			if ($newupload == 1)
			{
				if (JFile::exists($strFileTempPath) && JFile::exists($strFileTargetPath))
				{								
					JFile::delete($strFileTargetPath);
				}
			}
			// function to files move from temp folder to target path

			if (JFile::exists($strFileTempPath)){		
				rename($strFileTempPath, $strFileTargetPath);				
			}
		} else {
			$vmfile = 'default_thumb.jpg';
		}
		
		// update streamer option,thumb url and file path
		$query = "UPDATE `#__hdflv_upload`
      			  SET streameroption='None',$dbname='$vmfile',filepath='$filepath' 
      			  WHERE id = $idval "; 
		$db->setQuery($query);
		$db->query();
		
		$arrVideoName = explode('uploads/', $strFileTempPath);
		if(isset($arrVideoName[1]))
		$arrVideoName[] = $arrVideoName[1];
		
	}
	
	/**	 
	 * function to DELETE TEMPORARY FILES
	 * delete temporary existing videos,hd videos,thumb image and preview image	 
	 * @ Temp Path : components/com_contushdvideoshare/images/uploads/	 
	 */
	
	function unlinkUploadedTmpFiles($strFileName)
	{
		$strFilePath = FVPATH . "/images/uploads/$strFileName";		
		if (JFile::exists($strFilePath))
		{						
			JFile::delete($strFilePath);
		}
	}
	
	/**
	 * function to get file extensions	 
	 */
	
	function getFileExtension($strFileName)
	{
		$strFileName = strtolower($strFileName);
		return JFile::getExt($strFileName);
	}
}
?>