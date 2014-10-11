<?php

class GalleryHtmlHelper extends GalleryPlugin {

	function help($help = null) {
		if (!empty($help)) {
			ob_start();
		
			?>
			
			<span class="galleryhelp">
				<a href="" onclick="return false;" title="<?php echo esc_attr(stripslashes($help)); ?>"></a>
			</span>
			
			<?php
			
			$html = ob_get_clean();
			return $html;
		}
	}
	
	public static function uploads_path() {
		if ($upload_dir = wp_upload_dir()) {		
			return str_replace("\\", "/", $upload_dir['basedir']);
		}
		
		return str_replace("\\", "/", WP_CONTENT_DIR . '/uploads');
	}
	
	public static function uploads_url() {
		if ($upload_dir = wp_upload_dir()) {
			return $upload_dir['baseurl'];
		}
		
		return site_url() . '/wp-content/uploads';
	}

	function section_name($section = null) {
		if (!empty($section)) {
			switch ($section) {
				case 'slides'			:
					$name = __('Manage Slides', $this -> plugin_name);
					break;
				case 'galleries'		:
					$name = __('Manage Galleries', $this -> plugin_name);
					break;
				case 'settings'			:
					$name = __('Configuration', $this -> plugin_name);
					break;
			}
			
			return $name;
		}
		
		return false;
	}

	function link($name = '', $href = '/', $args = array()) {
		$defaults = array(
			'title'			=>	(empty($args['title'])) ? $title : $args['title'],
			'target'		=>	"_self",
			'class' 		=>	"wpco",
			'rel'			=>	"",
			'onclick'		=>	"",
		);
		
		$r = wp_parse_args($args, $defaults);
		extract($r, EXTR_SKIP);
		
		ob_start();
		
		?><a class="<?php echo $class; ?>" rel="<?php echo $rel; ?>" <?php echo (!empty($onclick)) ? 'onclick="' . $onclick . '"' : ''; ?> href="<?php echo $href; ?>" target="<?php echo $target; ?>" title="<?php echo $title; ?>"><?php echo $name; ?></a><?php
		
		$link = ob_get_clean();
		return $link;
	}
	
	function filename($url = null) {
		if (!empty($url)) {
			return basename($url);
		}
		
		return false;
	}
	
	function thumbname($filename = null, $append = "thumb") {
		if (!empty($filename)) {
			$name = $this -> strip_ext($filename, "name");
			$ext = $this -> strip_ext($filename, "ext");
			
			return $name . '-' . $append . '.' . $ext;
		}
		
		return false;
	}
	
	function bfithumb_image($image = null, $width = null, $height = null, $quality = 100, $class = "slideshow", $rel = "") {		
		require_once($this -> plugin_base() . DS . 'vendors' . DS . 'BFI_Thumb.php');
		
		$params = array();
		if (!empty($width)) { $params['width'] = $width; }
		if (!empty($height)) { $params['height'] = $height; }
		$resizeimagescrop = $this -> get_option('resizeimagescrop');
		$crop = (!empty($resizeimagescrop) && $resizeimagescrop == "Y") ? true : false;
		$params['crop'] = $crop;
		
		$src = bfi_thumb($image, $params);
		
		$oldimagename = basename($src);
		$name = $this -> strip_ext($oldimagename, 'name');
		$imagename = $name . '.' . $this -> strip_ext($oldimagename, 'ext');
		$src = str_replace($oldimagename, $imagename, $src);
		
		$tt_image = '<img src="' . $src . '" />';
		return $tt_image;
	}
	
	function bfithumb_image_src($image = null, $width = null, $height = null, $quality = 100) {			
		require_once($this -> plugin_base() . DS . 'vendors' . DS . 'BFI_Thumb.php');
		
		$params = array();
		if (!empty($width)) { $params['width'] = $width; }
		if (!empty($height)) { $params['height'] = $height; }
		$resizeimagescrop = $this -> get_option('resizeimagescrop');
		$crop = (!empty($resizeimagescrop) && $resizeimagescrop == "Y") ? true : false;
		$params['crop'] = $crop;
		
		$src = bfi_thumb($image, $params);
		
		$oldimagename = basename($src);
		$name = $this -> strip_ext($oldimagename, 'name');
		$imagename = $name . '.' . $this -> strip_ext($oldimagename, 'ext');
		$src = str_replace($oldimagename, $imagename, $src);
		
		$tt_image = $src;
		return $tt_image;
	}
	
	function bfithumb_url() {
		return plugins_url() . '/slideshow-gallery/vendors/bfithumb.php';
	}
	
	function image_url($filename = null) {
		if (!empty($filename)) {
			return GalleryHtmlHelper::uploads_url() . '/slideshow-gallery/' . $filename;
		}
		
		return false;
	}
	
	function field_name($name = '') {
		if (!empty($name)) {
			if ($mn = $this -> strip_mn($name)) {
				return $mn[1] . '[' . $mn[2] . ']';
			}
		}
	
		return $name;
	}
	
	function field_error($name = '', $el = "p") {
		if (!empty($name)) {
			if ($mn = $this -> strip_mn($name)) {
				$errors = array();
				
				switch ($mn[1]) {
					case 'Slide'		:
						$errors = GallerySlide::validate($_POST);
						break;
				}			
						
				if (!empty($errors[$mn[2]])) {
					$error = '<' . $el . ' class="' . $this -> pre . 'error">' . $errors[$mn[2]] . '</' . $el . '>';
					
					return $error;
				}
			}
		}
		
		return false;
	}
	
	function field_value($name = null) {
		if ($mn = $this -> strip_mn($name)) {					
			$value = $this -> {$mn[1]} -> data -> {$mn[2]};
			
			return $value;
		}
		
		return false;
	}
	
	public static function queryString($params, $name = null) {
	
		$ret = "";
		foreach ($params as $key => $val) {
			if (is_array($val)) {
				if ($name == null) {
					$ret .= GalleryHtmlHelper::queryString($val, $key);
				} else {
					$ret .= GalleryHtmlHelper::queryString($val, $name . "[$key]");   
				}
			} else {
				if ($name != null) {
					$ret .= $name . "[$key]" . "=" . $val . "&";
				} else {
					$ret .= $key . "=" . $val . "&";
				}
			}
		}
		
		return rtrim($ret, "&");   
	} 
	
	public static function retainquery($add = null, $old_url = null, $endslash = true) {
		$url = (empty($old_url)) ? $_SERVER['REQUEST_URI'] : rtrim($old_url, '&');
		$urls = @explode("?", $url);
		$add = ltrim($add, '&');
		
		$url_parts = @parse_url($url);
		parse_str($url_parts['query'], $path_parts);
		$add = str_replace("&amp;", "&", $add);
		parse_str($add, $add_parts);
		
		if (empty($path_parts) || !is_array($path_parts)) {
			$path_parts = array();	
		}
			
		if (!empty($add_parts) && is_array($add_parts)) {
			foreach ($add_parts as $addkey => $addvalue) {
				$path_parts[$addkey] = $addvalue;
			}
		}

		$querystring = GalleryHtmlHelper::queryString($path_parts);
		
		$urls[1] = preg_replace("/[\&|\?]Gallerymessage\=([0-9a-z-_+]*)/i", "", $urls[1]);
		$urls[1] = preg_replace("/[\&|\?]page\=/si", "", $urls[1]);
		
		$url = $urls[0];
		$url .= '?';
		
		if (!empty($querystring)) {
			$url .= '&' . $querystring;
		}
				
		return preg_replace("/\?(\&)?/si", "?", $url);
	}
	
	function strip_ext($filename = null, $return = 'ext') {
		if (!empty($filename)) { 
			$extArray = preg_split("/[\.]/", $filename); 
			
			if ($return == 'ext') {
				$p = count($extArray) - 1; 
				$extension = $extArray[$p]; 
				return strtolower($extension);
			} else {
				$p = count($extArray) - 2;
				$filename = $extArray[$p];
				return $filename;
			}
		}
		
		return false;
	}
	
	function strip_mn($name = null) {	
		if (!empty($name)) {
			if (preg_match("/^(.*?)\.(.*?)$/si", $name, $matches)) {
				return $matches;
			}
		}
	
		return false;
	}
	
	public static function gen_date($format = "Y-m-d H:i:s", $time = false) {
		$time = (empty($time)) ? time() : $time;
		$date = date($format, $time);
		
		return $date;
	}
	
	function array_to_object($array = array()) {
		//type casting...
		return (object) $array;
	}
	
	function sanitize($string = '', $sep = '-') {
		if (!empty($string)) {
			$string = preg_replace("/[^0-9a-z" . $sep . "]/si", "", strtolower(str_replace(" ", $sep, $string)));
			$string = preg_replace("/" . $sep . "[" . $sep . "]*/i", $sep, $string);
			
			return $string;
		}
	
		return false;
	}
}

?>