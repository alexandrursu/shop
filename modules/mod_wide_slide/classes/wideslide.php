<?php
/*
* Pixel Point Creative | Wide Slide Module for Joomla! 
* License: GNU General Public License version 2 
* See: http://www.gnu.org/copyleft/gpl.html
* Copyright (c) Pixel Point Creative LLC.
* More info at http://www.pixelpointcreative.com
*/
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if (! class_exists("Wideslide") ) { 
	abstract class Wideslide {
		/**
		 * WideslideImage class instance
		 * Use for image processing.
		 * @var object
		 */
		private static $image	= null;

		/**
		 * Current module
		 * @var object
		 */
		private static $module	= null;
		private static $listmodule = null;

		/**
		 * Set current module to work with
		 * @param object $module
		 */
		public static function setModule($module=null){
			if (!isset(self::$listmodule)){
				self::$listmodule = array();
			}
			array_push(self::$listmodule, $module->module);
			self::$module = $module;
		}
		public static function listModules(){
			self::dump(self::$listmodule, 'List Modules:<br>');
		}

		/**
		 * Return current module
		 * @return $module
		 */
		public static function getModule(){
			if ( self::$module === null ){
				$module = new stdClass();
				$module->module = 'Wideslide';
				self::$module = $module;
			}
			return self::$module;
		}

		/**
		 * Get WideslideImage object and set source image before.
		 * @param string $image_file
		 */
		public static function getImage($image_file){
			return self::_getImage()->reset()->load($image_file);
		}

		/**
		 * Resize an image to $width x $height.
		 * @param string $image - Is real path or url of image file.
		 * @param int $width
		 * @param int $height
		 * @param array $config
		 * @return image url from image cache.
		 */
		public static function resize($image, $width, $height=null, $config=array()){
			// Compliance with old version call.
			if (is_array($width)){
				$config = $width;
				$width  = isset($config['output_width'])  ? $config['output_width']  : null;
				$height = isset($config['output_height']) ? $config['output_height'] : null;
				$config['function'] = in_array($config['function'], array('none', 'center', 'fill', 'fit', 'stretch'))
				? 'resize_' . $config['function']
				: $config['function'];
			}

			if (!is_string($image)){
				return false;
			} else if (isset($config['function']) && $config['function']=='resize_none'){
				if (!self::isUrl($image)){
					$image = JURI::base(true) . '/' . str_replace('\\', '/', $image);
				}
				return $image;
			} else if (self::isUrl($image)){
				$get_url_cache = self::getRemoteFile($image);
				if (is_array($get_url_cache)){
					$image = array_pop($get_url_cache);
				} else {
					return $image;
				}
			}

			self::_getImage()->applyConfig($config);
			self::_getImage()->load($image)->resize($width, $height);
			$abs_image_path = (string)self::_getImage()->save();

			$searchs  = array(DS);
			$replaces = array('/');
			if (JPATH_SITE!='/' && JURI::base(true)!=''){
					
				array_unshift($searchs,  JPATH_SITE);
				array_unshift($replaces, JURI::base(true));
				return str_replace($searchs, $replaces, $abs_image_path);
			} else {
					
				return str_replace(array(JPATH_SITE), array(JURI::base(true)), $abs_image_path);
			}
		}

		/**
		 * Cache folder for current module
		 *
		 */
		public static function getModuleCache(){
			$cache = JPATH_CACHE . DS . self::getModule()->module;

			if(!file_exists($cache)){
				@mkdir($cache, 0755, true);
			}
			return $cache;
		}

		/**
		 * Include javascript files
		 * @param string $filename
		 */
		public static function script($filename){
			$js_files = self::_getRelativePaths($filename, true, 'js');
			//self::dump($js_files);

			$document = &JFactory::getDocument();
			foreach ($js_files as $include) {
				$document->addScript($include);
			}
		}

		/**
		 * Include stylesheet files
		 * @param string $filename
		 * @param string $type
		 * @param string $media
		 * @param Array $attribs
		 */
		public static function stylesheet($filename, $type = 'text/css', $media = null, $attribs = array()){
			$css_files = self::_getRelativePaths($filename, true, 'css');
			//self::dump($css_files);

			$document = &JFactory::getDocument();
			foreach ($css_files as $include) {
				$document->addStylesheet($include, $type, $media, $attribs);
			}
		}

		/**
		 * @deprecated
		 * Find layout files.
		 * @param string $layout_name
		 */
		public static function layout($layout_name=null){
			return array(
					JModuleHelper::getLayoutPath(self::$module->module, $layout_name)
			);
		}

		private static function _getRelativePaths($filename, $detect_browser=true, $folder){
			if (self::isUrl($filename)){
				$includes = array($filename);
			} else {
				if ($detect_browser){
					$navigator	= JBrowser::getInstance();
					$browser	= $navigator->getBrowser();
					$major		= $navigator->getMajor();
					$minor		= $navigator->getMinor();
					$ext		= JFile::getExt($filename);
					$strip		= JFile::stripExt($filename);

					// Try to include files named filename.ext, filename_browser.ext, filename_browser_major.ext, filename_browser_major_minor.ext
					// where major and minor are the browser version names
					$potential = array($filename, $strip.'_'.$browser.'.'.$ext,  $strip.'_'.$browser.'_'.$major.'.'.$ext, $strip.'_'.$browser.'_'.$major.'_'.$minor.'.'.$ext);
				} else {
					$potential = array($filename);
				}
					
				$app = JFactory::getApplication();
				$template = $app->getTemplate();

				// Prepare array of files
				$includes = array();
				if ($folder==='tmpl'){
					$includes_PATH = array(
							'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS,
							'modules' . DS . self::getModule()->module . DS . $folder . DS
					);
				} else {
					$includes_PATH = array(
							'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS . 'assets' . DS . $folder . DS,
							'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS . 'assets' . DS,
							'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS . $folder  . DS,
							'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS,

							'modules' . DS . self::getModule()->module . DS . 'assets' . DS . $folder . DS,
							'modules' . DS . self::getModule()->module . DS . 'assets' . DS,
							'modules' . DS . self::getModule()->module . DS . $folder  . DS,
							'modules' . DS . self::getModule()->module . DS
					);
				}
					
				foreach ($potential as $file){
					foreach ($includes_PATH as $path){
						//echo "<br>Check File: " . $path . $file;
						if (file_exists($path . $file)){
							$file_url = str_replace(DS, '/', $path . $file);
							array_push($includes, $file_url);
							break;
						}
					}
				}
			}
			return $includes;
		}

		/**
		 * Human readable date format
		 * @param int $timestamp
		 * @param int $granularity
		 * @param string $format
		 */
		public static function timeAgo($timestamp, $granularity=2, $format='Y-m-d H:i:s'){
			$difference = time() - $timestamp;
			if($difference < 0){
				return '0 seconds ago';
			} elseif ($difference < 864000){
				$periods = array('week' => 604800,'day' => 86400,'hr' => 3600,'min' => 60,'sec' => 1);
				$output = '';
				foreach($periods as $key => $value){
					if($difference >= $value){
						$time = round($difference / $value);
						$difference %= $value;
						$output .= ($output ? ' ' : '').$time.' ';
						$output .= (($time > 1 && $key == 'day') ? $key.'s' : $key);
						$granularity--;
					}
					if($granularity == 0) break;
				}
				return ($output ? $output : '0 seconds').' ago';
			}
			return date($format, $timestamp);
		}

		/**
		 * Validate an url
		 * @param string $url
		 */
		public static function isUrl($url){
			if(preg_match('/^(https?)\:\/\/[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*/', $url)){
				return true;
			}
			return false;
		}

		/**
		 * Validate an email
		 * @param string $email
		 * @return boolean
		 */
		public static function isEmail($email){
			if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
				return true;
			}
			return false;
		}

		/**
		 * Parse and build target attribute for links.
		 * @param string $value (_self, _blank, _windowopen, _modal)
		 */
		public static function parseTarget($value='_self'){
			$target = '';
			switch($value){
				default:
				case '0':
				case '_self':
					break;
				case '1':
				case '_blank':
					$target = "target=\"_blank\"";
					break;
				case '2':
				case '_windowopen':
					$target = "onclick=\"window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,false');return false;\"";
					break;
				case '3':
				case '_modal':
					$target = "";
					break;
			}
			return $target;
		}

		/**
		 * Truncate string by $length
		 * @param string $string
		 * @param int $length
		 * @param string $etc
		 * @return string
		 */
		public static function truncate($string, $length, $etc='...'){
			return defined('MB_OVERLOAD_STRING')
			? self::_mb_truncate($string, $length, $etc)
			: self::_truncate($string, $length, $etc);
		}

		/**
		 * Truncate string if it's size over $length
		 * @param string $string
		 * @param int $length
		 * @param string $etc
		 * @return string
		 */
		private static function _truncate($string, $length, $etc='...'){
			if ($length>0 && $length<strlen($string)){
				$buffer = '';
				$buffer_length = 0;
				$parts = preg_split('/(<[^>]*>)/', $string, -1, PREG_SPLIT_DELIM_CAPTURE);
				$self_closing_tag = split(',', 'area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed');

				foreach($parts as $i => $s){
					if( false===strpos($s, '<') ){
						$s_length = strlen($s);
						if ($buffer_length + $s_length < $length){
							$buffer .= $s;
							$buffer_length += $s_length;
						} else if ($buffer_length + $s_length == $length) {
							if ( !empty($etc) ){
								$buffer .= ($s[$s_length - 1]==' ') ? $etc : " $etc";
							}
							break;
						} else {
							$words = preg_split('/([^\s]*)/', $s, - 1, PREG_SPLIT_DELIM_CAPTURE);
							$space_end = false;
							foreach ($words as $w){
								if ($w_length = strlen($w)){
									if ($buffer_length + $w_length < $length){
										$buffer .= $w;
										$buffer_length += $w_length;
										$space_end = (trim($w) == '');
									} else {
										if ( !empty($etc) ){
											$more = $space_end ? $etc : " $etc";
											$buffer .= $more;
											$buffer_length += strlen($more);
										}
										break;
									}
								}
							}
							break;
						}
					} else {
						preg_match('/^<([\/]?\s?)([a-zA-Z0-9]+)\s?[^>]*>$/', $s, $m);
						//$tagclose = isset($m[1]) && trim($m[1])=='/';
						if (empty($m[1]) && isset($m[2]) && !in_array($m[2], $self_closing_tag)){
							array_push($open, $m[2]);
						} else if (trim($m[1])=='/') {
							$tag = array_pop($open);
							if ($tag != $m[2]){
								// uncomment to to check invalid html string.
								// die('invalid close tag: '. $s);
							}
						}
						$buffer .= $s;
					}
				}
				// close tag openned.
				while(count($open)>0){
					$tag = array_pop($open);
					$buffer .= "</$tag>";
				}
				return $buffer;
			}
			return $string;
		}

		/**
		 * Truncate mutibyte string if it's size over $length
		 * @param string $string
		 * @param int $length
		 * @param string $etc
		 * @return string
		 */
		private static function _mb_truncate($string, $length, $etc='...'){
			$encoding = mb_detect_encoding($string);
			if ($length>0 && $length<mb_strlen($string, $encoding)){
				$buffer = '';
				$buffer_length = 0;
				$parts = preg_split('/(<[^>]*>)/', $string, -1, PREG_SPLIT_DELIM_CAPTURE);
				$self_closing_tag = explode(',', 'area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed');
				$open = array();

				foreach($parts as $i => $s){
					if (false === mb_strpos($s, '<')){
						$s_length = mb_strlen($s, $encoding);
						if ($buffer_length + $s_length < $length){
							$buffer .= $s;
							$buffer_length += $s_length;
						} else if ($buffer_length + $s_length == $length) {
							if ( !empty($etc) ){
								$buffer .= ($s[$s_length - 1]==' ') ? $etc : " $etc";
							}
							break;
						} else {
							$words = preg_split('/([^\s]*)/', $s, -1, PREG_SPLIT_DELIM_CAPTURE);
							$space_end = false;
							foreach ($words as $w){
								if ($w_length = mb_strlen($w, $encoding)){
									if ($buffer_length + $w_length < $length){
										$buffer .= $w;
										$buffer_length += $w_length;
										$space_end = (trim($w) == '');
									} else {
										if ( !empty($etc) ){
											$more = $space_end ? $etc : " $etc";
											$buffer .= $more;
											$buffer_length += mb_strlen($more);
										}
										break;
									}
								}
							}
							break;
						}
					} else {
						preg_match('/^<([\/]?\s?)([a-zA-Z0-9]+)\s?[^>]*>$/', $s, $m);
						//$tagclose = isset($m[1]) && trim($m[1])=='/';
						if (empty($m[1]) && isset($m[2]) && !in_array($m[2], $self_closing_tag)){
							array_push($open, $m[2]);
						} else if (trim($m[1])=='/') {
							$tag = array_pop($open);
							if ($tag != $m[2]){
								// uncomment to to check invalid html string.
								// die('invalid close tag: '. $s);
							}
						}
						$buffer .= $s;
					}
				}
				// close tag openned.
				while(count($open)>0){
					$tag = array_pop($open);
					$buffer .= "</$tag>";
				}
				return $buffer;
			}
			return $string;
		}

		/**
		 * Extract images tag from $text
		 * @param string $text
		 * @return array src of images:
		 */
		public static function extractImages(&$text){
			$searchTags = array(
					'img' 		=> '/<img[^>]+>/i',
					'input' 	=> '/<input[^>]+type\s?=\s?"image"[^>]+>/i'
			);
			$searchSrc = '/src\s?=\s?"([^"]*)"/i';
			$images	 = array();
			foreach ($searchTags as $tag => $regex){
				preg_match_all($regex, $text, $m);
				if (count($m)){
					foreach ($m[0] as $htmltag){
						preg_match_all($searchSrc, $htmltag, $msrc);
						if (count($msrc) && isset($msrc[1])){
							foreach ($msrc[1] as $src){
								array_push($images, $src);
							}
						}
						$text = str_replace($htmltag, '', $text);
					}
				}
			}
			return $images;
		}

		/**
		 * Get content of remote file and save it to cache.
		 * @param string $url
		 */
		public static function getRemoteFile($url){
			if (self::isUrl($url)){
				$infourl = self::parseUrl($url);
				if (isset($infourl['path'])){
					preg_match("/^\/[^\.]+\.([^\/]+)$/", $infourl['path'], $ext);
					if (isset($ext[1])){
						$ext = $ext[1];
					} else {
						$ext = 'cache';
					}
				}
				$filename = JPATH_CACHE . DS . md5($url) . ".$ext";
				if (file_exists($filename)){
					// cache exists
					return array($filename);
				}
				$content = '';
				if ( function_exists('curl_init') ){
					// initialize a new curl resource
					$ch = curl_init();

					// set the url to fetch
					curl_setopt($ch, CURLOPT_URL, $url);

					// don't give me the headers just the content
					curl_setopt($ch, CURLOPT_HEADER, 0);

					// return the value instead of printing the response to browser
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

					// use a user agent to mimic a browser
					curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:8.0.1) Gecko/20100101 Firefox/8.0.1');

					$content = curl_exec($ch);

					// remember to always close the session and free all resources
					curl_close($ch);
					if (!$content){
						return "<br>Cannot get content of file.";
					}
				} else if ( ini_get('allow_url_fopen')==1 ){
					$content = file_get_contents($url);
					if (!$content){
						return "Cannot get content of file.";
					}
				} else {
					$host = $infourl['host'];
					$path = isset($infourl['path']) ? $infourl['path'] : '/';
					if (isset($infourl['query'])){
						$path .= '?' . $infourl['query'];
					}
					$port = isset($infourl['port']) ? $infourl['port'] : 80;
					$timeout = 10;

					$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);

					if (!$fp){
						return "Cannot retrieve $url";
					} else {
						fputs($fp,	"GET $path HTTP/1.0\r\n" .
								"Host: $host\r\n" .
								"User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:8.0.1) Gecko/20100101 Firefox/8.0.1\r\n" .
								"Accept: */*\r\n" .
								"Accept-Language: en-us,en;q=0.5\r\n" .
								"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\n" .
								"Keep-Alive: 300\r\n" .
								"Connection: keep-alive\r\n" .
								"Referer: http://$host\r\n\r\n");

						while ( $line = fread($fp, 4096) ){
							$content .= $line;
						}
						fclose($fp);

						// strip the headers
						$pos		= strpos($content, "\r\n\r\n");
						$content	= substr($content, $pos + 4);
					}
				}
				if ($content){
					// file_put_contents($filename, $content);
					// return array($filename);
					return self::writeToFile($filename, $content);
				}
			} else {
				return "Invalid Url.";
			}
		}

		/**
		 * Write $content to file. Check and create folder if it is not exists.
		 * @param string $filename
		 * @param string $content
		 * @param boolean $override
		 */
		public static function writeToFile($filename, $content, $overwrite=true){
			$file_exists = file_exists($filename);
			if (!$overwrite && $file_exists){
				return "File exists!";
			} else if (!$file_exists){
				// create folder if need.
				$pathname = dirname($filename);
				if (!file_exists($pathname)){
					mkdir($pathname, 0755, true);
				}
			}
			$fh = fopen($filename, 'w') or die("Wideslide::writeToFile - Can't open file: $filename");
			fwrite($fh, $content);
			fclose($fh);
			return array($filename);
		}

		/**
		 * Joomla! JString::parse url
		 * @param string $url
		 */
		public static function parseUrl($url){
			$result = array();
			// Build arrays of values we need to decode before parsing
			$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
			$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "$", ",", "/", "?", "%", "#", "[", "]");
			// Create encoded URL with special URL characters decoded so it can be parsed
			// All other charcters will be encoded
			$encodedURL = str_replace($entities, $replacements, urlencode($url));
			// Parse the encoded URL
			$encodedParts = parse_url($encodedURL);
			// Now, decode each value of the resulting array
			foreach ($encodedParts as $key => $value) {
				$result[$key] = urldecode($value);
			}
			return $result;
		}

		/**
		 * debug variable
		 * @param unknown_type $var
		 * @param string $label
		 * @param boolean $echo
		 * @return string
		 */
		public static function dump($var, $label=null, $echo=true){
			// format the label
			$label = ($label===null) ? '' : rtrim($label) . ' ';

			// var_dump the variable into a buffer and keep the output
			ob_start();
			var_dump($var);
			$output = ob_get_clean();

			// neaten the newlines and indents
			$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);

			if(!extension_loaded('xdebug')) {
				$output = htmlspecialchars($output, ENT_QUOTES);
			}

			$output = '<pre>' . $label . $output . '</pre>';

			if ($echo) {
				echo($output);
			}
			return $output;
		}

		/**
		 * Include class file use Wideslide is namespace.
		 * @param string $object - suffix class name.
		 * eg. image -> import WideslideImage class.
		 */
		private static function _import($object){
			
		}

		/**
		 * Get instance of WideslideImage
		 *
		 */
		private static function _getImage(){
			if( self::$image === null ){
				self::_import('image');
				self::$image = &WideslideImage::getInstance();
			}
			return self::$image;
		}

		/**
		 * @deprecated
		 * Set config for Image class in self::resize is recommended.
		 * @param Array $conf
		 */
		public static function getImageResizerHelper($conf=array()){
			isset($conf['background']) && self::_getImage()->setBackground($conf['background']);
			isset($conf['thumbnail_mode']) && self::_getImage()->setFunction('resize_'.$conf['thumbnail_mode']);
		}

		/**
		 * @deprecated
		 * Use self::getModuleCache instead of
		 * @return cahce path for current module
		 */
		public static function getCache(){
			return self::getModuleCache();
		}

		/**
		 * @deprecated
		 * Use self::timeAgo instead of
		 * @param $date
		 * @param $granularity
		 */
		public static function getDateAgo($date, $granularity=2) {
			return self::timeAgo($timestamp, $granularity);
		}

		/**
		 * @deprecated
		 * Use self::parseTarget instead of
		 * @param string $type
		 */
		public static function getTargetAttr($type='_self'){
			return self::parseTarget($type);
		}

		/**
		 * @deprecated
		 * Use self::truncate instead of
		 * @param string $string
		 * @param int $limit_chars
		 */
		public static function shorten($string, $limit_chars=-1){
			return self::truncate($string, $limit_chars);
		}

		/**
		 * @deprecated
		 * Use self::truncate instead of
		 * @param string $str
		 * @param int $limit
		 */
		public static function cut_string($str, $limit=-1){
			return self::_truncate($str, $limit);
		}

		/**
		 * @deprecated
		 * Use self::truncate instead of
		 * @param string $str
		 * @param int $limit
		 */
		public static function mb_shorten($str, $limit=-1){
			return self::_mb_truncate($str, $limit, '...');
		}
	}
}
if (!class_exists('YtUtils')){
	/**
	 * @deprecated
	 * Use Wideslide is recommended.
	 */
	class YtUtils extends Wideslide {

		/**
		 * Resize image
		 * @param string $image - Image true path
		 * @param int $width - resize to this width
		 * @param int $height = resize to this height. If null, fit image by 'width'.
		 * @param string $mode - Resize mode
		 * @param int $image_type - IMAGETYPE_PNG, IMAGETYPE_GIF, ...
		 */
		static function resize($image, $width, $height, $mode='stretch', $image_type=null){
			// Wideslide::dump( func_get_args() );
			$config = array();
			if (isset($mode)){
				$config['function'] = 'resize_'.$mode;
			}
			if (isset($image_type)){
				$config['output_image_type'] = $image_type;
			}
			return parent::resize($image, $width, $height, $config);
		}
	}
}

if (! class_exists("WideslideImage") ) { 
	class WideslideImage {

		const POSITION_TOP_LEFT = 'top-left';
		const POSITION_TOP_RIGHT = 'top-right';
		const POSITION_BOTTOM_LEFT = 'bottom-left';
		const POSITION_BOTTOM_RIGHT = 'bottom-right';
		const POSITION_STRETCH = 'stretch';
		const POSITION_TILE = 'tile';
		const POSITION_CENTER = 'center';

		private $_callbacks = array(
				IMAGETYPE_GIF  => array('output' => 'imagegif',  'create' => 'imagecreatefromgif'),
				IMAGETYPE_JPEG => array('output' => 'imagejpeg', 'create' => 'imagecreatefromjpeg'),
				IMAGETYPE_PNG  => array('output' => 'imagepng',  'create' => 'imagecreatefrompng'),
				IMAGETYPE_XBM  => array('output' => 'imagexbm',  'create' => 'imagecreatefromxbm'),
				IMAGETYPE_WBMP => array('output' => 'imagewbmp', 'create' => 'imagecreatefromxbm')
		);

		private $_functions = array(
				'resize',
				'crop',
				'rotate',
				'flip_horizontal',
				'flip_vertical'
		);

		private $_modes = array(
				'center',
				'fill',
				'fit',
				'stretch'
		);

		protected $sFile;
		protected $sImage;
		protected $sImageType;
		protected $sW;
		protected $sH;

		protected $oFile;
		protected $oImage;
		protected $oImageType;
		protected $oW;
		protected $oH;

		protected $outputCache;
		protected $quality;
		protected $background;
		protected $function;

		protected $watermarkFile;
		protected $watermarkImage;
		protected $watermarkHeight;
		protected $watermarkWidth;
		protected $watermarkOpacity;
		protected $watermarkPosition;

		protected $logMessages;
		protected static $_instance = null;

		public function __construct($filename=null){
			is_null($filename) || $this->load($filename);
			$this->quality = 100;
		}

		public function __destruct(){
			$this->_destroy($this->sImage);
			$this->_destroy($this->oImage);
		}

		public function __toString(){
			return $this->getOutputFile();
		}

		public static function getInstance(){
			if( self::$_instance === null ){
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function applyConfig($config=array()){
			if (is_array($config) || is_object($config)){
				foreach ($config as $key => $value){
					$keys = (false===strpos($key, '_')) ? array($key) : explode('_', $key);
					$keys = array_map('strtolower', $keys);
					$keys = array_map('ucfirst', $keys);
					$func = 'set' . implode('', $keys);
					if (method_exists($this, $func)){
						call_user_func(array($this, $func), $value);
					} else {
						$this->log('WideslideImage::'.$func.' is not exists!');
					}
				}
			}
			return $this;
		}

		public function display($image_type=null){
			if ($image_type!=null){
				$this->setOutputImageType($image_type);
			}
			$args = array();
			$args[] = $this->oImage;
			call_user_func_array($this->_getCallback('output', $this->oImageType), $args);
		}

		public function load($filename){
			if (!is_null($this->sFile) && $this->sFile==$filename){
				$this->log('Image: ' . $filename . ' is loaded.');
				return $this;
			}
			$this->reset();
			$this->setSourceFile($filename);
			$this->_initType();
			$this->_initImage();
			$this->_initDimensions();
			return $this;
		}

		public function reset(){
			$this->sFile		= null;
			$this->_destroy($this->sImage);;
			$this->sImageType	= null;
			$this->sW			= 0;
			$this->sH			= 0;

			$this->oFile		= null;
			$this->_destroy($this->oImage);
			$this->oImageType	= null;
			$this->oW			= 0;
			$this->oH			= 0;
			return $this;
		}

		public function save(){
			$fileout = $this->getOutputFile();
			if (file_exists($fileout)){
				return $this;
			} else {
				if ($this->_prepareCacheFolder($fileout)){
					$args = array();
					$args[] = $this->oImage;
					$args[] = $fileout;

					// set quality param for JPG file type
					if (IMAGETYPE_JPEG == $this->oImageType) {
						$args[] = $this->quality;
					} else if (IMAGETYPE_PNG == $this->oImageType){
						$png_quality = round(($this->oImageType / 100) * 10);
						$png_quality = $png_quality < 1 ? 1 : $png_quality;
						$png_quality = $png_quality >10 ? 10: $png_quality;
						$png_quality = 10 - $png_quality;
						$args[] = $png_quality;
					}
					call_user_func_array($this->_getCallback('output', $this->oImageType), $args);
				} else {
					$this->log('Cannot create file: ' . $fileout . '! Please set cache directory permission.');
				}
			}
			return $this;
		}

		public function crop($x, $y, $w=null, $h=null){
			if (is_null($w)) $w=$this->sW-$x;
			if (is_null($h)) $h=$this->sH-$y;
			$this->setOutputWidth($w);
			$this->setOutputHeight($h);
			$this->getOutputImageType();
			$this->setFunction('crop');
			$fileout = $this->getOutputFile(true);
			if (file_exists($fileout)){
				return $this;
			} else {
				return $this->_crop($x, $y);
			}
		}

		public function fit($max_size){
			return $this->resize($max_size);
		}

		public function flip($direction = 'horizontal'){
			$this->setOutputHeight($this->sH);
			$this->setOutputWidth($this->sW);
			$this->getOutputImageType();
			if ($direction == 'horizontal'){
				return $this->flip_horizontal();
			} else {
				return $this->flip_vertical();
			}
		}
		private function flip_horizontal(){
			$this->setFunction('flip_horizontal');
			$fileout = $this->getOutputFile(true);
			if (!file_exists($fileout)){
				$this->getOutputImage(true);
				for($i=0; $i<$this->sW; $i++){
					@imagecopyresampled($this->oImage, $this->sImage, $i, 0, $this->oW-$i-1, 0, 1, $this->oH, 1, $this->sH);
				}
			}
			return $this;
		}
		private function flip_vertical(){
			$this->setFunction('flip_vertical');
			$fileout = $this->getOutputFile(true);
			if (!file_exists($fileout)){
				$this->getOutputImage(true);
				for ($i=0; $i<$this->sH; $i++){
					imagecopyresampled($this->oImage, $this->sImage, 0, $i, 0, $this->oH-$i-1, $this->oW, 1, $this->sW, 1);
				}
			}
			return $this;
		}

		public function resize($w=null, $h=null, $mode=null){
			if (is_null($w) && is_null($h)){
				$this->log('Invalid dimension (0x0)');
			} else if (is_null($h)){
				$mode = $this->_modes[2];
				if ($this->sH > $this->sW){
					$h = $w;
					$w = 0;
				} else {
					$h = 0;
				}
			} else if (is_null($w)){
				$w = 0;
			}

			if ($w + $h == 0){
				$this->log('Cannot resize to 0x0');
			} else if ($w == 0){
				$mode = $this->_modes[3];
				$w = round( $h * $this->sW / $this->sH );
			} else if ($h == 0){
				$mode = $this->_modes[3];
				$h = round( $w * $this->sH / $this->sW );
			} else if ( abs($h-round($w*$this->sH/$this->sW)) <= 1){
				$mode = $this->_modes[3];
				$h = round( $w * $this->sH / $this->sW );
			}

			$this->setOutputWidth($w);
			$this->setOutputHeight($h);
			$this->getOutputImageType();
			$this->setFunction('resize_' . $mode);

			$fileout = $this->getOutputFile(true);
			if (file_exists($fileout)){
				return $this;
			} else {
				return $this->_resize();
			}
		}

		public function rotate($angle){

		}

		public function scale($ratio=1){
			if ($ratio>0 && $ratio!=1){
				$this->setOutputWidth($this->sW*$ratio);
				$this->setOutputHeight($this->sH*$ratio);
				$this->getOutputImageType();
				$this->setFunction('resize_stretch');
				$fileout = $this->getOutputFile(true);
				if (!file_exists($fileout)){
					return $this->_resize();
				}
			} else {
				$this->log("Please use function: scale with ratio>0 and ratio!=1");
			}
			return $this;
		}

		public function watermark($image, $position=null, $opacity=null){
			if (!is_resource($this->oImage)){
				$this->log("Output image is not resource!");
				return $this;
			}
			$this->setWatermarkPosition($position);
			$this->setWatermarkOpacity($opacity);

			$this->setWatermarkImage($image);

			if (is_resource($this->watermarkImage)){
				switch ($this->getWatermarkPosition()){
					case self::POSITION_BOTTOM_LEFT:
						$dx = 0;
						$dy = $this->oH - $this->watermarkHeight;
						break;
					default:
					case self::POSITION_BOTTOM_RIGHT:
						$dx = $this->oW - $this->watermarkWidth;
					$dy = $this->oH - $this->watermarkHeight;
					break;
					case self::POSITION_CENTER:
						$dx = ($this->oW - $this->watermarkWidth)/2;
						$dy = ($this->oH - $this->watermarkHeight)/2;
						break;
					case self::POSITION_TILE: break;
					case self::POSITION_STRETCH:
					case self::POSITION_TOP_LEFT:
						$dx = 0;
						$dy = 0;
						break;
					case self::POSITION_TOP_RIGHT: break;
				}
				imagealphablending($this->oImage, true);
				imagecopy($this->oImage, $this->watermarkImage, $dx, $dy, 0, 0, $this->watermarkWidth, $this->watermarkHeight);
				imagealphablending($this->oImage, false);
				imagesavealpha($this->oImage, true);
			}
			return $this;
		}

		public function html($alt=null, $title=null, $attributes=array()){
			!is_null($alt)   || $alt   = basename($this->getSourceFile());
			!is_null($title) || $title = basename($this->getSourceFile());
			$img_url = str_replace("\\", "/", $this->getOutputFile());
			$img_tag = "<img src=\"$img_url\" title=\"$title\" alt=\"$alt\"";
			if (count($attributes)>0){
				foreach ($attributes as $attr => $val){
					$img_tag .= " $attr=\"" . htmlentities($val) . "\"";
				}
			}
			$img_tag .= " />";
			return $img_tag;
		}

		public function getSourceFile(){
			return $this->sFile;
		}

		public function setSourceFile($filename){
			if (is_readable($filename)){
				$this->sFile = $filename;
			} else {
				$this->log("File: $filename is not readable!");
			}
			return $this;
		}

		public function getSourceImage(){
			return $this->sImage;
		}

		public function setSourceImage($image){
			if (is_resource($image)){
				$this->sImage = $image;
			} else {
				$this->log('setSourceImage: Image is not resource type.');
			}
			return $this;
		}

		public function getSourceImageType(){
			return $this->sImageType;
		}

		public function setSourceImageType($image_type=null){
			$supportTypes = array_keys($this->_callbacks);
			if (in_array($image_type, $supportTypes)){
				$this->sImageType = $image_type;
			} else {
				$this->log("setSourceImageType: Invalid image type.");
			}
			return $this;
		}

		public function getSourceWidth(){
			return $this->sW;
		}

		public function getSourceHeight(){
			return $this->sH;
		}

		public function getOutputFile($renew=false){
			if(is_null($this->oFile) || $renew){
				$values = array(
						$this->sFile,
						$this->oImageType,
						$this->oH,
						$this->oW,
						$this->quality,
						$this->background,
						$this->function,
						$this->watermarkOpacity,
						$this->watermarkPosition,
						$this->watermarkHeight,
						$this->watermarkWidth
				);
				$cache = $this->getOutputCache() ? $this->getOutputCache() . DS : '';
				$serialize = serialize($values);
				$this->oFile = $cache .  md5($serialize) . image_type_to_extension($this->oImageType);
			}
			return $this->oFile;
		}

		public function setOutputFile($filename){
			$this->oFile = $filename;
			return $this;
		}

		public function getOutputImage($renew=false){
			if($renew){
				$this->oImage = $this->_getOutputImage();
			}
			return $this->oImage;
		}

		public function setOutputImage($image){
			if (is_resource($image)){
				$this->oImage = $image;
			} else {
				$this->log('setOutputImage: Image is not resource type.');
			}
			return $this;
		}

		public function getOutputImageType(){
			if(is_null($this->oImageType)){
				$this->oImageType = $this->sImageType;
			}
			return $this->oImageType;
		}

		public function setOutputImageType($image_type){
			$supportTypes = array_keys($this->_callbacks);
			if (in_array($image_type, $supportTypes)){
				$this->oImageType = $image_type;
			} else {
				$this->log("setOutputImageType: Invalid image type.");
			}
			return $this;
		}

		public function getOutputWidth(){
			return $this->oW;
		}

		public function setOutputWidth($imagesx){
			$this->oW = $imagesx > 0 ? $imagesx : 0;
			return $this;
		}

		public function getOutputHeight(){
			return $this->oH;
		}

		public function setOutputHeight($imagesy){
			$this->oH = $imagesy > 0 ? $imagesy : 0;
			return $this;
		}

		public function getQuality(){
			return $this->quality;
		}

		public function setQuality($quality){
			$quality = (int)$quality;
			$quality = $quality < 10 ? 10 : $quality;
			$quality = $quality >100 ? 100: $quality;
			$this->quality = $quality;
		}

		public function getBackground(){
			return $this->background;
		}

		public function setBackground($color){
			if (is_array($color)){
				foreach ($color as $c => $v){
					$v = (int)$v;
					$v = $v < 0 ? 0 : $v;
					$v = $v > 255 ? 255 : $v;
					switch ($c){
						case 0:
						case 'r':
							$this->background['r'] = $v;
							break;
						case 1:
						case 'g':
							$this->background['g'] = $v;
							break;
						case 2:
						case 'b':
							$this->background['b'] = $v;
							break;
					}
				}
			} else if (is_string($color)) {
				if (preg_match('/^#?([a-f]|[0-9]){3}(([a-f]|[0-9]){3})?$/i', $color)){
					$color = ltrim($color);
					if (strlen($color)==3){
						$color = $color[0].$color[0].$color[1].$color[1].$color[2].$color[2];
					}
					$intc = hexdec($color);
					$this->background = array(
							'r' => 0xFF & ($intc >> 0x10),
							'g' => 0xFF & ($intc >> 0x8),
							'b' => 0xFF & $intc
					);
				}
			} else {
				$this->log('Invalid color input');
			}
			return $this;
		}

		public function getFunction(){
			return $this->function;
		}

		public function setFunction($function){
			$mode = str_replace('resize_', '', $function);
			if (in_array($function, $this->_functions) || in_array($mode, $this->_modes)){
				$this->function = $function;
			} else {
				$this->log("setFunction: Invalid function!");
			}
			return $this;
		}

		public function getWatermarkImage(){
			return is_resource($this->watermarkImage) ? $this->watermarkImage : false;
		}

		public function setWatermarkImage($image){
			if (is_string($image)) {
				if ( $this->_watermarkFileLoaded($image) ){
					$this->log('Watermark Image: ' . $image . ' is loaded.');
					return $this;
				}
				list($wmx, $wmy, $wmt) = getimagesize($image);
				$this->watermarkWidth = $wmx;
				$this->watermarkHeight= $wmy;
				if (isset($this->_callbacks[$wmt])){
					$fn_create = $this->_callbacks[$wmt]['create'];
				} else {
					$fn_create = 'imagecreatefromgd2';
				}
				$watermarkImage = call_user_func($fn_create, $image);
				if (is_resource($watermarkImage)){
					if ($this->getWatermarkPosition()==self::POSITION_STRETCH){
						$newWatermark = imagecreatetruecolor($this->oW, $this->oH);
						$color = imagecolorallocatealpha($newWatermark, 255, 255, 255, 127);
						imagefilledrectangle($newWatermark, 0, 0, $this->oW, $this->oH, $color);
						imagealphablending($newWatermark, false);
						imagecopyresampled($newWatermark, $watermarkImage, 0, 0, 0, 0, $this->oW, $this->oH, $wmx, $wmy);
						imagesavealpha($newWatermark, true);
						$watermarkImage = $newWatermark;
						$this->watermarkWidth  = $this->oW;
						$this->watermarkHeight = $this->oH;
					} else {
						$newWatermark = imagecreatetruecolor($this->watermarkWidth, $this->watermarkHeight);
						$color = imagecolorallocatealpha($newWatermark, 255, 255, 255, 64);
						imagefilledrectangle($newWatermark, 0, 0, $this->watermarkWidth, $this->watermarkHeight, $color);
						imagealphablending($newWatermark, false);
						imagecopyresampled($newWatermark, $watermarkImage, 0, 0, 0, 0, $this->watermarkWidth, $this->watermarkHeight, $wmx, $wmy);
						imagesavealpha($newWatermark, true);
						$watermarkImage = $newWatermark;
					}
					for ($y = 0; $y < $this->watermarkHeight; $y++) {
						for ($x = 0; $x < $this->watermarkWidth; $x++) {
							$color = imagecolorat($watermarkImage, $x, $y);
							$cindex = imagecolorsforindex($watermarkImage, $color);
							$newAlpha = 127-$cindex['alpha'];
							$newAlpha = round($newAlpha * $this->getWatermarkOpacity()/100.0);
							$newAlpha = 127 - $newAlpha;
							$newColor = imagecolorallocatealpha($watermarkImage, $cindex['red'], $cindex['green'], $cindex['blue'], $newAlpha);
							imagesetpixel($watermarkImage, $x, $y, $newColor);
						}
					}
				}
				$this->watermarkImage = $watermarkImage;
			} else {
				$this->log('setWatermarkImage: Image is not resource type or file not exists.');
			}
			return $this;
		}

		public function getWatermarkOpacity(){
			return $this->watermarkOpacity;
		}

		public function setWatermarkOpacity($opacity){
			$this->watermarkOpacity = $opacity;
			return $this;
		}

		public function getWatermarkPosition(){
			return $this->watermarkPosition;
		}

		public function setWatermarkPosition($position){
			switch($position){
				case self::POSITION_BOTTOM_LEFT:
				case self::POSITION_BOTTOM_RIGHT:
				case self::POSITION_TOP_LEFT:
				case self::POSITION_TOP_RIGHT:
				case self::POSITION_CENTER:
				case self::POSITION_STRETCH:
				case self::POSITION_TILE:
					$this->watermarkPosition = $position;
					break;
				default:
					$this->watermarkPosition = self::POSITION_BOTTOM_RIGHT;
			}
			return $this;
		}

		public function getWatermarkWidth(){
			return $this->watermarkWidth;
		}

		public function getWatermarkHeight(){
			return $this->watermarkHeight;
		}

		public function getOutputCache(){
			if (is_null($this->outputCache)){
				$this->outputCache = Wideslide::getModuleCache();
			}
			return $this->outputCache;
		}

		public function setOutputCache($path){
			$this->outputCache = $path;
			return $this;
		}

		public function log($message){
			if (is_null($this->logMessages)){
				$this->logMessages = array();
			}
			$date = date('Y-m-d H:i:s - ');
			array_push($this->logMessages, $date.$message);
		}

		public function clearLog(){
			$this->logMessages = array();
		}

		public function showLog(){
			if(!is_null($this->logMessages)){
				foreach ($this->logMessages as $msg){
					echo "<br>" . htmlentities($msg);
				}
			}
		}

		private function _getCallback($cb_type, $image_type){
			if (isset($this->_callbacks[$image_type][$cb_type])){
				return $this->_callbacks[$image_type][$cb_type];
			} else if ($cb_type=='create'){
				$this->log("Unsupported create image in this format. Try with function: imagecreatefromgd2");
				return 'imagecreatefromgd2';
			} else if ($cb_type=='output'){
				$this->log("Unsupported output image in this format. Try with function: imagegd2");
				return 'imagegd2';
			}
		}

		private function _initType(){
			if (!is_null($this->sFile)){
				if (function_exists('exif_imagetype')) {
					$exif_imagetype = exif_imagetype($this->sFile);
					$this->setSourceImageType($exif_imagetype);
				} else {
					$imageinfo = getimagesize($this->sFile);
					$this->setSourceImageType($imageinfo[2]);
				}
			}
		}

		private function _initImage(){
			if (!is_null($this->sImageType)){
				if (isset($this->_callbacks[$this->sImageType])){
					$fn_create = $this->_callbacks[$this->sImageType]['create'];
				} else {
					$fn_create = 'imagecreatefromgd2';
				}
				$this->sImage = call_user_func($fn_create, $this->sFile);
			} else {
				$this->log('Image Type not detected.');
			}
		}
		private function _initDimensions(){
			if (!is_null($this->sImage) && is_resource($this->sImage)){
				$this->sW = imagesx($this->sImage);
				$this->sH = imagesy($this->sImage);
			} else {
				$this->log('Have not image resource.');
			}
		}

		private function _destroy($image){
			if(is_resource($image)){
				imagedestroy($image);
			} else {
				$image = null;
			}
		}

		private function _resize(){
			$args = $this->_getArguments();
			$this->getOutputImage(true);
			count($args) && imagecopyresampled($this->oImage, $this->sImage, $args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7]);
		}
		private function _getArguments(){
			$args = array();
			if ($this->sW<=0 || $this->sH<=0 || $this->oW<=0 || $this->oH<=0){
				$this->log("Image size == 0.");
			} else {
				$sx = $sy = 0;
				$sw = $this->sW;
				$sh = $this->sH;

				$dx = $dy = 0;
				$dw = $this->sW;
				$dh = $this->sH;

				switch(str_replace('resize_', '', $this->function)){
					case 'center':
						if ($this->oW > $dw) {
							$dx = ($this->oW-$dw)/2;
						}
						if ($this->oH > $dh) {
							$dy = ($this->oH-$dh)/2;
						}
						if ($this->sW > $this->oW){
							$sx = ($this->sW-$this->oW)/2;
						}
						if ($this->sH > $this->oH){
							$sy = ($this->sH-$this->oH)/2;
						}
						break;
					case 'fill':
						$or = 1.0*$this->sW/$this->sH;
						if ($this->oW < $this->oH*$or){
							$dw = round($this->oH*$or);
							$dh = $this->oH;
							$dx = ($this->oW-$dw)/2;
							$dy = 0;
						} else {
							$dw = $this->oW;
							$dh = round($this->oW/$or);
							$dx = 0;
							$dy = ($this->oH-$dh)/2;
						}
						break;
					case 'fit':
						$or = 1.0*$this->sW/$this->sH;
						if ($this->oW > $this->oH*$or){
							$dw = round($this->oH*$or);
							$dh = $this->oH;
							$dx = ($this->oW-$dw)/2;
							$dy = 0;
						} else {
							$dw = $this->oW;
							$dh = round($this->oW/$or);
							$dx = 0;
							$dy = ($this->oH-$dh)/2;
						}
						break;
					default:
					case 'stretch':
						$dw = $this->oW;
					$dh = $this->oH;
					break;
				}
				$args = array($dx, $dy, $sx, $sy, $dw, $dh, $sw, $sh);
			}
			return $args;
		}

		private function _crop($x, $y){
			$args = $this->_cropArguments($x, $y);
			$this->getOutputImage(true);
			count($args) && imagecopyresampled($this->oImage, $this->sImage, $args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7]);
		}
		private function _cropArguments($x, $y){
			$nw = $this->sW - $x;
			$nh = $this->sH - $y;
			$args = array(
					0,
					0,
					$x,
					$y,
					$nw,
					$nh,
					$nw,
					$nh
			);
			return $args;
		}

		private function _getOutputImage(){
			$oImage = imagecreatetruecolor($this->oW, $this->oH);
			if (IMAGETYPE_GIF == $this->oImageType){
				$trans_index = imagecolortransparent($this->sImage);
				if ($trans_index >= 0) {
					$trans_color = imagecolorsforindex($this->sImage, $trans_index);
					$trans_index = imagecolorallocate($oImage, $trans_color['red'], $trans_color['green'], $trans_color['blue']);
					imagefill($oImage, 0, 0, $trans_index);
					imagecolortransparent($oImage, $trans_index);
				}
			} else if(IMAGETYPE_PNG == $this->oImageType) {
				$png_alpha = ((ord(file_get_contents($this->sFile, false, null, 25, 1)) & 6) & 4) == 4;
				if ($png_alpha){
					imagealphablending($oImage, false);
					$transparent = imagecolorallocatealpha($oImage, 0, 0, 0, 127);
					imagefilledrectangle($oImage, 0, 0, $this->oW, $this->oH, $transparent);
					imagesavealpha($oImage, true);
				}
			} else if (is_array($this->background)
					&& isset($this->background['r'])
					&& isset($this->background['g'])
					&& isset($this->background['b'])
					&& in_array($this->function, array('resize_center', 'resize_fit'))){
				$background = imagecolorallocate(
						$oImage,
						$this->background['r'],
						$this->background['g'],
						$this->background['b']
				);
				imagefilledrectangle($oImage, 0, 0, $this->oW, $this->oH, $background);
			}
			return $oImage;
		}

		private function _watermarkFileLoaded($filename){
			$hash = md5(serialize(array($filename, $this->watermarkPosition)));
			if ($this->watermarkFile != $hash){
				$this->watermarkFile = $hash;
				return false;
			}
			return true;
		}

		private function _prepareCacheFolder($filename){
			$folder = dirname($filename);
			$stack = array();
			while($folder && !file_exists($folder)){
				$top = basename($folder);
				$folder = dirname($folder);
				array_push($stack, $top);
			}
			while(count($stack)){
				$top = array_pop($stack);
				$folder = $folder . DIRECTORY_SEPARATOR . $top;
				if (!@mkdir($folder, 0755)){
					return false;
				}
			}
			return true;
		}
	}
}