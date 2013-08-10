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
$user =& JFactory::getUser();

//$user->get('username');

if($user->get('id')=='')
{
$url = $baseurl."index.php?option=com_user&view=register";
header("Location: $url");
}
?>
<script src="<?php echo JURI::base(); ?>components/com_contushdvideoshare/js/popup.js"></script>
<div class="player clearfix">
<div id="clsdetail">
<div class="lodinpad">

<?php if($this->editdetails[1]->allowupload==1){ ?>
<?php
if($user->get('id')!='')
{?>

<span style='float:right'><b><a href="index.php?option=com_hdvideoshare&view=myvideos">My Videos</a> | <a href="index.php?option=com_user&task=logout&return=<?php echo base64_encode('index.php?option=com_contushdvideoshare'); ?>">Logout</a></b></span>

<?php }else{
?>

<span style='float:right'><b><a href="index.php?option=com_user&view=register">Register</a> | <a  onclick="javascript:popUpWindow('<?php echo JURI::base(); ?>index.php?option=com_contushdvideoshare&view=commentlogin&rmode=true', '200', '200', '320', '240')">Login</a></b></span>
<?php
}
}
?>
<br/>
<div class="floatleft"><h1>Edit Video</h1></div>
<div align="right"><a href="index.php?option=com_hdvideoshare&view=myvideos" class="button" style="text-decoration:none">back</a></div><br />
<div  class="underline"></div>

<div class="clear"></div>

<?php
$totalrecords = count($this->editdetails[0]);
                        for($i=0; $i<$totalrecords ; $i++) {
                            if($this->editdetails[0][$i]->filepath=="File" || $this->editdetails[0][$i]->filepath=="FFmpeg")
							{
							if($this->editdetails[$i]->thumburl!="")
                            $src_path="components/com_hdvideoshare/videos/".$this->editdetails[0][$i]->thumburl;
							else
							$src_path="";
							}
                            if($this->editdetails[0][$i]->filepath=="Url" || $this->editdetails[0][$i]->filepath=="Youtube")
                            $src_path =  $this->editdetails[0][$i]->thumburl;
                            if($this->editdetails[0][$i]->id!='')
                             { ?>
                            <div id="imiddlecontent1" >
                        <div class="featurecontent clearfix">
                        <div class="videopic">
                                        <?php
                                        $orititle=$this->editdetails[0][$i]->title;       //Title name changed here for seo url purpose
                                        $newtitle=explode(' ',$orititle);
                                        $displaytitle1=implode('-',$newtitle);
                                        $displaytitle=str_replace('.','',$displaytitle1);

                                        $oriname=$this->editdetails[0][$i]->category;     //category name changed here for seo url purpose
                                        $newrname=explode(' ',$oriname);
                                        $link=implode('-',$newrname);
                                        $link1=explode('&',$link);
                                        $category=implode('and',$link1);
                                        $img_path="components/com_hdvideoshare/images/default_thumb.jpg";
                                        ?>
                                        <br/> <br/>
                                <p><a href="index.php?option=com_hdvideoshare&view=player&id=<?php echo $this->editdetails[0][$i]->id;?>&category=<?php echo $category;?>"><img src="<?php if($src_path=="") echo $img_path; else echo $src_path ;?>" width="124" height="76"></a></p>
                                <div class="videotime">
                                <p><?php echo $this->editdetails[0][$i]->duration;?></p>
                                </div>
                        </div>
                        <div class="featureright">
                        <form name="editdetails[0]" method="post" action="index.php?option=com_hdvideoshare&view=editvideo&id=<?php echo $this->editdetails[0][$i]->id;?>">
                        <div style="color:#40701A;font-weight:bold;width:auto;"><?php if(($this->editdetails[1])) { echo $this->editdetails[1].'<br/><br/>';} ?></div>
                        <br/><br/>
                        <div class="allform" >
                        <ul style="margin-top:-8px;">
                        <li>
                        <div class="form-label"><label>Title:</label></div>
                        <div class="form-input"><input type="text" name="title" value="<?echo $this->editdetails[0][$i]->title;?>" class="text" size="20" id="title"/></div>
                        </li>
                        
                        <!-- <li>
                        <div class="form-label"><label>Tagname:</label></div>
                        <div class="form-input"><input type="text" name="title" value="<?php//echo $this->editdetails[0][$i]->tagname;?>" class="text" size="20" id="title"/></div>
                        </li>-->
                        <li>
                        <div class="form-label"><label>Type:</label></div>
                        <?php $private=$this->editdetails[0][$i]->type;
                        ?>
                        <div class="radiobtn" ><input type="radio" name="type" value="1" <?php if ($private == "1") { echo 'checked="checked"';} ?> />&nbsp;&nbsp;Private</div>
                        <div class="radiobtn" ><input type="radio" name="type" value="0" <?php if ($private != "1") { echo 'checked="checked"';}?> />&nbsp;&nbsp;Public</div>
                        </li>
                        </ul>
                        </div>
                        <div class="clear"></div>
                        <input type="submit" value="save" name="editbtn" id="editbtn" class="button"  />
                        </form>
                        </div>
                        </div>
                        </div>
                           <?php } 
                    }
                    ?>
                    </div>
                    </div>
</div>