-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2010 at 01:29 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `musicplayer`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_ads`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published` tinyint(4) NOT NULL,
  `adsname` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `postvideopath` varchar(255) NOT NULL,
  `home` int(11) NOT NULL,
  `targeturl` varchar(255) NOT NULL,
  `clickurl` varchar(255) NOT NULL,
  `impressionurl` varchar(255) NOT NULL,
  `impressioncounts` int(11) NOT NULL DEFAULT '0',
  `clickcounts` int(11) NOT NULL DEFAULT '0',
  `adsdesc` varchar(500) NOT NULL,
  `typeofadd` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `#__hdflv_ads`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_category`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8 NOT NULL,
  `seo_category` varchar(255) CHARACTER SET utf8 NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `#__hdflv_category`
--

INSERT INTO `#__hdflv_category` (`id`, `category`,`seo_category`, `parent_id`, `ordering`, `published`) VALUES
(1, 'Speeches','Speeches', -1, 1, 1),
(2, 'Interviews','Interviews', -1, 2, 1),
(3, 'Talk Shows ','Talk-Shows', -1, 3, 1),
(4, 'News & Info','News-and-Info', -1, 4, 1),
(5, 'Documentary','Documentary', -1, 5, 1),
(6, 'Travel','Travel', -1, 6, 1),
(7, 'Cooking','Cooking', -1, 7, 1),
(8, 'Music','Music', -1, 8, 1),
(9, 'Trailers','Trailers', -1, 9, 1),
(10, 'Religious','Religious', -1, 10, 1),
(11, 'TV Serials & Shows','TV-Serials-and-Shows', -1, 11, 1),
(12, 'Greetings','Greetings', -1, 12, 1),
(13, 'Comedy','Comedy', -1, 13, 1),
(14, 'Actors','Actors', -1, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_comments`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL,
  `videoid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `#__hdflv_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_googlead`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_googlead` (
  `id` int(2) NOT NULL,
  `code` text NOT NULL,
  `showoption` tinyint(1) NOT NULL,
  `closeadd` int(6) NOT NULL,
  `reopenadd` tinytext NOT NULL,
  `publish` int(1) NOT NULL,
  `ropen` int(6) NOT NULL,
  `showaddc` tinyint(1) NOT NULL,
  `showaddm` tinytext NOT NULL,
  `showaddp` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__hdflv_googlead`
--

INSERT INTO `#__hdflv_googlead` (`id`, `code`, `showoption`, `closeadd`, `reopenadd`, `publish`, `ropen`, `showaddc`, `showaddm`, `showaddp`) VALUES
(1, '&lt;script type=&quot;text/javascript&quot;&gt;&lt;!--\r\ngoogle_ad_client = &quot;pub-2847326838202418&quot;;\r\n/* 468x60, created 2/13/10 */\r\ngoogle_ad_slot = &quot;8176283039&quot;;\r\ngoogle_ad_width = 600;\r\ngoogle_ad_height = 60;\r\n//--&gt;\r\n&lt;/script&gt;\r\n&lt;script type=&quot;text/javascript&quot;\r\nsrc=&quot;http://pagead2.googlesyndication.com/pagead/show_ads.js&quot;&gt;\r\n&lt;/script&gt;', 1, 10, '0', 0, 10, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_player_settings`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_player_settings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `published` tinyint(4) NOT NULL,
  `buffer` int(10) NOT NULL,
  `normalscale` varchar(100) NOT NULL,
  `fullscreenscale` varchar(100) NOT NULL,
  `autoplay` tinyint(1) NOT NULL,
  `volume` int(10) NOT NULL,
  `logoalign` varchar(10) NOT NULL,
  `logoalpha` int(50) NOT NULL,
  `skin_autohide` tinyint(2) NOT NULL,
  `stagecolor` varchar(20) NOT NULL,
  `skin` varchar(255) NOT NULL,
  `embedpath` varchar(50) NOT NULL,
  `fullscreen` tinyint(1) NOT NULL,
  `zoom` tinyint(1) NOT NULL,
  `width` int(20) NOT NULL,
  `height` int(20) NOT NULL,
  `uploadmaxsize` int(10) NOT NULL,
  `ffmpegpath` varchar(255) NOT NULL,
  `ffmpeg` varchar(20) NOT NULL,
  `related_videos` tinyint(1) NOT NULL,
  `timer` tinyint(1) NOT NULL,
  `logopath` varchar(255) NOT NULL,
  `logourl` varchar(255) NOT NULL,
  `nrelated` int(11) NOT NULL,
  `shareurl` tinyint(1) NOT NULL,
  `playlist_autoplay` int(11) NOT NULL,
  `hddefault` int(1) NOT NULL,
  `ads` tinyint(4) NOT NULL,
  `prerollads` tinyint(4) NOT NULL,
  `postrollads` tinyint(4) NOT NULL,
  `random` tinyint(4) NOT NULL,
  `midrollads` tinyint(4) NOT NULL,
  `midbegin` int(11) NOT NULL,
  `midinterval` int(11) NOT NULL,
  `midrandom` tinyint(4) NOT NULL,
  `midadrotate` tinyint(4) NOT NULL,
  `playlist_open` tinyint(4) NOT NULL,
  `licensekey` varchar(255) NOT NULL,
  `vast` tinyint(1) NOT NULL,
  `vast_pid` int(20) NOT NULL,
  `Youtubeapi` tinyint(1) NOT NULL DEFAULT '1',
  `scaletologo` tinyint(4) NOT NULL,
  `googleanalyticsID` text NOT NULL,
  `googleana_visible` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__hdflv_player_settings`
--

INSERT INTO `#__hdflv_player_settings` (`id`, `published`, `buffer`, `normalscale`, `fullscreenscale`, `autoplay`, `volume`, `logoalign`, `logoalpha`, `skin_autohide`, `stagecolor`, `skin`, `embedpath`, `fullscreen`, `zoom`, `width`, `height`, `uploadmaxsize`, `ffmpegpath`, `ffmpeg`, `related_videos`, `timer`, `logopath`, `logourl`, `nrelated`, `shareurl`, `playlist_autoplay`, `hddefault`, `ads`, `prerollads`, `postrollads`, `random`, `midrollads`, `midbegin`, `midinterval`, `midrandom`, `midadrotate`, `playlist_open`, `licensekey`, `vast`, `vast_pid`, `Youtubeapi`, `scaletologo`, `googleanalyticsID`, `googleana_visible`) VALUES
(1, 1, 15, '0', '0', 1, 34, 'TL', 35, 1, '000000', 'skin_black.swf', 'http://localhost/joomlatry/', 1, 1, 700, 475, 100, 'usr/bin/ffmpeg/', '0', 1, 1, '', 'http://www.hdvideoshare.net', 8, 1, 1, 1, 0, 1, 1, 0, 0, 1, 5, 0, 0, 1, '', 0, 0, 1, 1, '00000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_site_settings`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published` tinyint(4) NOT NULL,
  `seo_option` tinyint(4) NOT NULL,
  `featurrow` int(5) NOT NULL DEFAULT '3',
  `featurcol` int(5) NOT NULL DEFAULT '3',
  `recentrow` int(5) NOT NULL DEFAULT '3',
  `recentcol` int(5) NOT NULL DEFAULT '4',
  `categoryrow` int(5) NOT NULL DEFAULT '3',
  `categorycol` int(5) NOT NULL DEFAULT '5',
  `popularrow` int(5) NOT NULL DEFAULT '3',
  `popularcol` int(5) NOT NULL DEFAULT '4',
  `searchrow` int(5) NOT NULL DEFAULT '3',
  `searchcol` int(5) NOT NULL DEFAULT '4',
  `relatedrow` int(5) NOT NULL DEFAULT '3',
  `relatedcol` int(5) NOT NULL DEFAULT '4',
  `memberpagerow` int(5) NOT NULL DEFAULT '3',
  `memberpagecol` int(5) NOT NULL DEFAULT '4',
  `homepopularvideo` tinyint(4) NOT NULL DEFAULT '0',
  `homepopularvideorow` int(5) NOT NULL DEFAULT '2',
  `homepopularvideocol` int(5) NOT NULL DEFAULT '2',
  `homefeaturedvideo` tinyint(4) NOT NULL DEFAULT '1',
  `homefeaturedvideorow` int(5) NOT NULL DEFAULT '2',
  `homefeaturedvideocol` int(5) NOT NULL DEFAULT '2',
  `homerecentvideo` tinyint(4) NOT NULL DEFAULT '1',
  `homerecentvideorow` int(5) NOT NULL DEFAULT '2',
  `homerecentvideocol` int(5) NOT NULL DEFAULT '2',
  `myvideorow` int(5) NOT NULL DEFAULT '5',
  `myvideocol` int(5) NOT NULL DEFAULT '2',
  `sidepopularvideorow` int(3) NOT NULL DEFAULT '3',
  `sidepopularvideocol` int(3) NOT NULL DEFAULT '1',
  `sidefeaturedvideorow` int(3) NOT NULL DEFAULT '3',
  `sidefeaturedvideocol` int(3) NOT NULL DEFAULT '1',
  `siderelatedvideorow` int(3) NOT NULL DEFAULT '3',
  `siderelatedvideocol` int(3) NOT NULL DEFAULT '1',
  `siderecentvideorow` int(3) NOT NULL DEFAULT '3',
  `siderecentvideocol` int(3) NOT NULL DEFAULT '1',
  `allowupload` tinyint(4) NOT NULL,
  `comment` int(2) NOT NULL DEFAULT '0',
  `language_settings` varchar(100) NOT NULL DEFAULT 'English.php',
  `homepopularvideoorder` int(2) NOT NULL DEFAULT '1',
  `homefeaturedvideoorder` int(2) NOT NULL DEFAULT '2',
  `homerecentvideoorder` int(2) NOT NULL DEFAULT '3',
  `user_login` int(2) NOT NULL DEFAULT '1',
`ratingscontrol` tinyint(4) NOT NULL,
`viewedconrtol` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__hdflv_site_settings`
--

INSERT INTO `#__hdflv_site_settings` (`id`, `published`, `featurrow`, `featurcol`, `recentrow`, `recentcol`, `categoryrow`, `categorycol`, `popularrow`, `popularcol`, `searchrow`, `searchcol`, `relatedrow`, `relatedcol`, `memberpagerow`, `memberpagecol`, `homepopularvideo`, `homepopularvideorow`, `homepopularvideocol`, `homefeaturedvideo`, `homefeaturedvideorow`, `homefeaturedvideocol`, `homerecentvideo`, `homerecentvideorow`, `homerecentvideocol`, `myvideorow`, `myvideocol`, `sidepopularvideorow`, `sidepopularvideocol`, `sidefeaturedvideorow`, `sidefeaturedvideocol`, `siderelatedvideorow`, `siderelatedvideocol`, `siderecentvideorow`, `siderecentvideocol`, `allowupload`, `comment`, `language_settings`, `homepopularvideoorder`, `homefeaturedvideoorder`, `homerecentvideoorder`, `user_login`,`ratingscontrol`,`viewedconrtol`,`seo_option`) VALUES
(1, 1, 3, 4, 3, 4, 3, 4, 3, 4, 3, 4, 3, 4, 3, 4, 1, 1, 4, 1, 1, 4, 1, 1, 4, 4, 2, 3, 1, 2, 1, 3, 1, 3, 1, 1, 1, 'English.php', 1, 2, 3, 1,1,1,0);

-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_upload`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_upload` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `memberid` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `seotitle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `rate` int(11) NOT NULL,
  `ratecount` int(11) NOT NULL,
  `times_viewed` int(11) NOT NULL,
  `videos` varchar(255) CHARACTER SET utf8 NOT NULL,
  `filepath` varchar(10) CHARACTER SET utf8 NOT NULL,
  `videourl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `thumburl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `previewurl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `hdurl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `home` int(11) NOT NULL,
  `playlistid` int(11) NOT NULL,
  `duration` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ordering` int(11) NOT NULL,
  `streamerpath` varchar(255) CHARACTER SET utf8 NOT NULL,
  `streameroption` varchar(255) CHARACTER SET utf8 NOT NULL,
  `postrollads` tinyint(4) NOT NULL,
  `prerollads` tinyint(4) NOT NULL,
  `midrollads` tinyint(4) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `targeturl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `download` tinyint(4) NOT NULL,
  `prerollid` int(11) NOT NULL,
  `postrollid` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `addedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `usergroupname` varchar(250) NOT NULL,
  `tags` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__hdflv_upload`
--

INSERT INTO `#__hdflv_upload` (`id`, `memberid`, `published`, `title`,`seotitle`, `featured`, `type`, `rate`, `ratecount`, `times_viewed`, `videos`, `filepath`, `videourl`, `thumburl`, `previewurl`, `hdurl`, `home`, `playlistid`, `duration`, `ordering`, `streamerpath`, `streameroption`, `postrollads`, `prerollads`, `description`, `targeturl`, `download`, `prerollid`, `postrollid`, `created_date`, `addedon`) VALUES
(1, 62, 1, 'Avatar Movie Trailer [HD]','Avatar-Movie-Trailer-[HD]', 1, 0, 9, 2, 3, '', 'Youtube', 'http://www.youtube.com/watch?v=d1_JBMrrYw8', 'http://img.youtube.com/vi/d1_JBMrrYw8/1.jpg', 'http://img.youtube.com/vi/d1_JBMrrYw8/0.jpg', '', 0, 9, '', 0, '', '', 0, 0, '', '', 0, 0, 0, '2010-06-05 01:06:06', '2010-06-28 16:26:39'),
(2, 62, 1, 'HD: Super Slo-mo Surfer! - South Pacific - BBC Two', 'HD-Super-Slo-mo-Surfer!-South-Pacific-BBC-Two',1, 0, 0, 0, 95, '', 'Youtube', 'http://www.youtube.com/watch?v=7BOhDaJH0m4', 'http://img.youtube.com/vi/7BOhDaJH0m4/1.jpg', 'http://img.youtube.com/vi/7BOhDaJH0m4/0.jpg', '', 0, 14, '', 0, '', '', 0, 0, '', '', 0, 0, 0, '2010-06-05 01:06:28', '2010-06-28 16:45:59'),
(3, 62, 1, 'Fatehpur Sikri, Taj Mahal - India (in HD)','Fatehpur-Sikri,-Taj-Mahal-India-(in HD)', 1, 0, 5, 1, 9, '', 'Youtube', 'http://www.youtube.com/watch?v=UNWROFjIwvQ', 'http://img.youtube.com/vi/UNWROFjIwvQ/1.jpg', 'http://img.youtube.com/vi/UNWROFjIwvQ/0.jpg', '', 0, 5, '', 0, '', '', 0, 0, '', '', 0, 0, 0, '2010-06-05 01:06:25', '2010-06-28 16:29:39'),
(4, 62, 1, 'East India Company (HD) PC Gameplay','East-India-Company-HD)-PC-Gameplay', 1, 0, 0, 0, 29, '', 'Youtube', 'http://www.youtube.com/watch?v=ASJjhChzkJM', 'http://img.youtube.com/vi/ASJjhChzkJM/1.jpg', 'http://img.youtube.com/vi/ASJjhChzkJM/0.jpg', '', 0, 5, '', 0, '', '', 0, 0, '', '', 0, 0, 0, '2010-06-05 01:06:57', '2010-06-28 17:09:46'),
(5, 62, 1, 'The Best of Mr Beans Holiday The Movie HD', 'The-Best-of-Mr-Beans-Holiday-The-Movie-HD',1, 0, 0, 0, 8, '', 'Youtube', 'http://www.youtube.com/watch?v=vCqCIAnyyXU', 'http://img.youtube.com/vi/vCqCIAnyyXU/1.jpg', 'http://img.youtube.com/vi/vCqCIAnyyXU/0.jpg', '', 0, 5, '', 0, '', '', 0, 0, '', '', 0, 0, 0, '2010-06-05 01:06:46', '2010-06-28 16:16:11'),
(6, 62, 1, 'Harry Potter and the Deathly Hallows Trailer Official HD','Harry-Potter-and-the-Deathly-Hallows-Trailer-Official-HD', 1, 0, 0, 0, 8, '', 'Youtube', 'http://www.youtube.com/watch?v=_EC2tmFVNNE', 'http://img.youtube.com/vi/_EC2tmFVNNE/1.jpg', 'http://img.youtube.com/vi/_EC2tmFVNNE/0.jpg', '', 0, 11, '', 0, '', '', 0, 0, '', '', 0, 0, 0, '2011-01-24 06:01:26', '2011-01-24 11:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_user`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `allowupload` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__hdflv_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `#__hdflv_video_category`
--

CREATE TABLE IF NOT EXISTS `#__hdflv_video_category` (
  `vid` int(11) NOT NULL,
  `catid` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `#__hdflv_video_category`
--

INSERT INTO `#__hdflv_video_category` (`vid`, `catid`) VALUES
(1, '9'),
(2, '14'),
(3, '5'),
(4, '5'),
(5, '5'),
(6, '11');