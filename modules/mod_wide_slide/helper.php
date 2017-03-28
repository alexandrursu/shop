<?php
/*
* Pixel Point Creative "Wide Slide" Module for Joomla!
* License: GNU General Public License version 3 
* License URL :http://www.gnu.org/copyleft/gpl.html
* Copyright (c) Pixel Point Creative LLC.
* More info at http://www.pixelpointcreative.com
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
if (! class_exists("modWideSlide") ) { 
class modWideSlide {
	var $params;
	
	function __construct($params){
		$this->params = $params;
	}
	function &getInstance($params){
			$instance = null;
			if( !$instance ){
				$instance = new modWideSlide($params);
			}
		return $instance;
	}
	
	function parseDesc ($description) {
		$description = str_replace("<br />", "\n", $description);
		$description = explode("\n",$description);
		
		$descriptionArray = array();
		foreach($description as $desc){
			if ($desc) {
				$list = preg_split ('/::/', $desc);
				$list[1] = (count($list) > 1) ? preg_split ('/&/', $list[1])  : array();
				$temp = array();			
				for ($i = 0; $i < count($list[1]); ++$i) {
					$l = preg_split ('/=/', $list[1][$i]);
					$temp[trim($l[0])] = trim($l[1]);
				}
				$descriptionArray[$list[0]] = $temp;
			}
		}
		return $descriptionArray;
	}
	
	
	function getInfo($params){
		$items = array();
		$folder 			= 	$params->get( 'folder', 'images/stories/photo/' );
		$bg_img 			= 	$params->get( 'bg_img', '' );
		$play		 		= 	$params->get( 'play',"1");
		$descriptions 		= 	$params->get( 'description',"");
		$orderby 			= 	$params->get( 'orderby', 0);
		$sort 				= 	$params->get( 'sort', '1');
		$lwidth 			= 	$params->get( 'lwidth', 550 );
		$lheight 			= 	$params->get( 'lheight', 200 );
		$twidth 			= 	$params->get( 'twidth', 550 );
		$theight 			= 	$params->get( 'theight', 200 );
		$show_button 		= 	$params->get( 'show_button', 1 );
		$showCaption 		= 	$params->get( 'show_caption', 1 );
		if($descriptions != ''){
			$descriptionArray = $this->parseDesc($descriptions);
		}
		
		
		
		$folder = $this->checkURL(trim($folder));
		if(!$folder){ 
			echo "This folder doesn't exsit."; 
		} else{
			
			$images = $this->getFileInDir($folder, $orderby, $sort );
	
		if (count($images) > 0) {
			$imgcount = 0;
			$firstImage = '';
			$transDetails = '';
			$captionDetails = '';
			$imageArray = array();
			$thumbArray = array();
			$captionArray = array();
			$descArray = array();
			$listDescription = "";
			
			foreach($images as $k=>$img) {
				$img = trim($img);				
				$imageArray[] = "$folder"."$img";				
				$captionsArray[] = (isset($descriptionArray[$img]) && isset($descriptionArray[$img]['caption'])) ? str_replace("'", "\'", $descriptionArray[$img]['caption']) :'';
				$urlsArray[] = (isset($descriptionArray[$img]) && isset($descriptionArray[$img]['url'])) ? $descriptionArray[$img]['url'] :'';				
				$targetsArray[] = (isset($descriptionArray[$img]) && isset($descriptionArray[$img]['target'])) ? $descriptionArray[$img]['target'] :'';	
				
				$descArray[] = (isset($descriptionArray[$img]) && isset($descriptionArray[$img]['desc'])) ? $descriptionArray[$img]['desc'] :'';		
			}
			$items['captions'] = $captionsArray;
			$items['urls'] = $urlsArray;
			$items['target'] = $targetsArray;
			$items['desc'] = $descArray;
			$thumbArray = $imageArray;
			
			$image_config = array(
				'output_width'  => $params->get('lwidth'),
				'output_height' => $params->get('lheight'),
				'function'		=> $params->get('item_image_function_main', 'resize_none'),
				'background'	=> $params->get('item_image_background', null)
			);
		
		$thumbs = array();
			if (function_exists('imagecreatetruecolor')) {
				for ($i=0; $i<count($imageArray); $i++){
					/*if ($image1 = $this->processImage ( trim($imageArray[$i]), $lwidth, $lheight )) {
						$imageArray[$i] = "$image1";
					}*/
					$thumbs[] = Wideslide::resize(trim($imageArray[$i]) , $image_config);
					
				}	
			}
		//$items['imgs'] = $imageArray;
		$items['imgs'] = $thumbs;
		
		foreach ($images as $k => $img ){
			$img = trim($img);				
			$bgArray[$k] = $bg_img;
		}			
		$image_config = array(
			'output_width'  => $params->get('twidth'),
			'output_height' => $params->get('theight'),
			'function'		=> $params->get('item_image_function', 'resize_none'),
			'background'	=> $params->get('item_image_background', null)
		);
		$thumbs = array();
		
		foreach ($thumbArray as $key => $img ) {
			$thumbs[] = Wideslide::resize($img , $image_config);//, 1);
		}
		
		$thumbArray = $thumbs;					
		//$thumbArray = $this->buildThumbnail($thumbArray, $twidth, $theight);
		$items['thumbs'] = $thumbArray;
		$items['bg'] = $bgArray;
		
	 }
		
		
	  }
	 
	 /* print '<pre>';
	  print_r($items);
	  die;*/
		
	 	return $items;
	}
	
	function parseParams($params) {
		$params = html_entity_decode($params, ENT_QUOTES);
		$regex = "/\s*([^=\s]+)\s*=\s*('([^']*)'|\"([^\"]*)\"|([^\s]*))/";
		preg_match_all($regex, $params, $matches);
		
		 $paramarray = null;
		 if(count($matches)){
			$paramarray = array();
				for ($i=0;$i<count($matches[1]);$i++){ 
					$key = $matches[1][$i];
					$val = $matches[3][$i]?$matches[3][$i]:($matches[4][$i]?$matches[4][$i]:$matches[5][$i]);
					$paramarray[$key] = $val;
				}
			}
			return $paramarray;
	}
	
	function processImage ( &$img, $width, $height, $keepratio=1) {
		if(!$img) return;
		if (substr($img, 0, 4)!='http') {
			$img = $img;
		}
		$img = str_replace(JURI::base(),'',$img);
		$img = str_replace("'",'',$img);
		$img = rawurldecode($img);
		$imagesurl = (file_exists(JPATH_SITE .'/'.$img)) ? $this->resize($img,$width,$height, $keepratio) :  '' ;
		return $imagesurl;
	}
	
	function resize($image,$max_width,$max_height, $keepratio=1){
		$path = JPATH_SITE;
		$sizeThumb = getimagesize(JPATH_SITE.'/'.$image);
		$width = $sizeThumb[0];
		$height = $sizeThumb[1];
		if(!$max_width && !$max_height) {
			$max_width = $width;
			$max_height = $height;
		}else{
			if(!$max_width) $max_width = 1000;
			if(!$max_height) $max_height = 1000;
		}
		if ($keepratio) {
			$x_ratio = $max_width / $width;
			$y_ratio = $max_height / $height;
			if (($width <= $max_width) && ($height <= $max_height) ) {
				$tn_width = $width;
				$tn_height = $height;
			} else if (($x_ratio * $height) < $max_height) {
				$tn_height = ceil($x_ratio * $height);
				$tn_width = $max_width;
			} else {
				$tn_width = ceil($y_ratio * $width);
				$tn_height = $max_height;
			}
		}else{
			$tn_width = $max_width;
			$tn_height = $max_height;
		}
		// read image
		$ext = strtolower(substr(strrchr($image, '.'), 1)); // get the file extension
		$rzname = strtolower(substr($image, 0, strpos($image,'.')))."_{$tn_width}_{$tn_height}.{$ext}"; // get the file extension
		$resized = $path.'/cache/mod_wide_slide/resized/'.$rzname;
		if(file_exists($resized)){
			$smallImg = getimagesize($resized);
			if (($smallImg[0] <= $tn_width && $smallImg[1] == $tn_height) ||
					($smallImg[1] <= $tn_height && $smallImg[0] == $tn_width)) {
				return "/cache/mod_wide_slide/resized/".$rzname;
			}
		}
		
		if(!JFolder::exists($path.'/cache/mod_wide_slide/resized/')){
		 		JFolder::create($path.'/cache/mod_wide_slide/resized/');	 
		}
		
		if(!file_exists($path.'/cache/mod_wide_slide/resized/') && !mkdir($path.'/cache/mod_wide_slide/resized/',0755)) return '';
		$folders = explode('/',$image);
		$tmppath = $path.'/cache/mod_wide_slide/resized/';
		for($i=0;$i < count($folders)-1; $i++){
			if(!file_exists($tmppath.$folders[$i]) && !mkdir($tmppath.$folders[$i],0755)) return '';
			$tmppath = $tmppath.$folders[$i].'/';
		}
		$dst = imagecreatetruecolor($tn_width,$tn_height);
		switch ($ext) {
		case 'jpg':     // jpg
			$src = imagecreatefromjpeg(JPATH_SITE.'/'.$image);
			break;
		case 'png':     // png
			imagealphablending($dst, false);
			$color = imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
			imagefill($dst, 0, 0, $color);
			imagesavealpha($dst, true);
				
			$src = imagecreatefrompng(JPATH_SITE.'/'.$image);
			break;
		case 'gif':     // gif
			$src = imagecreatefromgif(JPATH_SITE.'/'.$image);
			break;
		default:
		}
		//$dst = imagecreatetruecolor($tn_width,$tn_height);
		//imageantialias ($dst, true);
		if (function_exists('imageantialias')) imageantialias ($dst, true);
		imagecopyresampled ($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
		//imagejpeg($dst, $resized, 90); // write the thumbnail to cache as well...
		$image_info = getimagesize(JPATH_SITE.'/'.$image);
      	$image_type = $image_info[2];
	  	
	 if( $image_type == IMAGETYPE_JPEG ) {
		imagejpeg($dst, $resized, 90);
	  } elseif( $image_type == IMAGETYPE_GIF ) {
		 imagegif($dst, $resized);         
	  } elseif( $image_type == IMAGETYPE_PNG ) {
		 imagepng($dst, $resized);
	  }   
		
		return "/cache/mod_wide_slide/resized/".$rzname;
	}
	
	function getFileInDir($folder, $orderby, $sort){
		$imagePath 	= JPATH_SITE ."/".$folder;
		$imgFiles 	= JFolder::files( $imagePath );
		$folderPath = $folder .'/';
		$imageFile = array();
		$i = 0;
		foreach ($imgFiles as $file){
			$i_f 	= $imagePath .'/'. $file;
			if ( preg_match( "/bmp|gif|jpg|png|jpeg/i", $file ) && is_file( $i_f ) ) {
				$imageFile[$i][0] = $file;
				$imageFile[$i][1] = filemtime($i_f)	;
				$i++;
			}
		}
		$images = $this->sortImage($imageFile, $orderby , $sort);
		return $images;
	}
	function sortImage($image, $orderby , $sort){
		$sortObj = array();
		$imageName = array();
		if($orderby == 1){
			for($i=0;$i<count($image);$i++){
				$sortObj[$i] = $image[$i][1];
				$imageName[$i] = $image[$i][0];
			}
		}
		else{
			for($i=0;$i<count($image);$i++){
				$sortObj[$i] = $image[$i][0];
			}
			$imageName = $sortObj;
		}
		
		if($sort == 1) array_multisort($sortObj, SORT_ASC, $imageName);
		elseif($sort == 2)	array_multisort($sortObj, SORT_DESC, $imageName);
		else shuffle($imageName);
		return $imageName;
	}
	function checkURL($url){
		if(is_dir($url)){ $url = (substr($url,-1,1) == "/") ? $url : $url."/";	return $url; }
		else { return false; }	
	}
	function buildThumbnail ($imageArray, $twidth, $theight) {
		$thumbs = array();
		foreach ($imageArray as $image) {
			if ($image1 = $this->processImage ( $image, $twidth, $theight, 0 )) {
				$thumbs[] = "$image1";
			}
		}
		return $thumbs;
	}
}	
}
?>