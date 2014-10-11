<?php

class GallerySlide extends GalleryDbHelper {

	var $table;
	var $model = 'Slide';
	var $controller = "slides";
	var $plugin_name = 'slideshow-gallery';
	
	var $data = array();
	var $errors = array();
	
	var $fields = array(
		'id'				=>	"INT(11) NOT NULL AUTO_INCREMENT",
		'title'				=>	"VARCHAR(150) NOT NULL DEFAULT ''",
		'description'		=>	"TEXT NOT NULL",
		'showinfo'			=>	"VARCHAR(50) NOT NULL DEFAULT 'both'",
		'iopacity'			=>	"INT(11) NOT NULL DEFAULT '70'",
		'image'				=>	"TEXT NOT NULL",
		'type'				=>	"ENUM('file','url') NOT NULL DEFAULT 'file'",
		'image_url'			=>	"TEXT NOT NULL",
		'uselink'			=>	"ENUM('Y','N') NOT NULL DEFAULT 'N'",
		'linktarget'		=>	"ENUM('self','blank') NOT NULL DEFAULT 'self'",
		'link'				=>	"VARCHAR(200) NOT NULL DEFAULT ''",
		'order'				=>	"INT(11) NOT NULL DEFAULT '0'",
		'created'			=>	"DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'",
		'modified'			=>	"DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'",
		'key'				=>	"PRIMARY KEY (`id`)",
	);

	function GallerySlide($data = array()) {
		global $wpdb;
		$this -> table = $wpdb -> prefix . strtolower($this -> pre) . "_" . $this -> controller;
		if (is_admin()) { $this -> check_table($this -> model); }
	
		if (!empty($data)) {
			foreach ($data as $dkey => $dval) {
				$this -> {$dkey} = stripslashes_deep($dval);
				
				switch ($dkey) {
					case 'id'					:
						$this -> galleries = array();
						$this -> gallery = array();
						
						$galleryslidesquery = "SELECT * FROM `" . $wpdb -> prefix . strtolower($this -> pre) . "_galleriesslides` WHERE `slide_id` = '" . $dval . "'";
						
						$query_hash = md5($galleryslidesquery);
						if ($oc_galleryslides = wp_cache_get($query_hash, 'slideshowgallery')) {
							$galleryslides = $oc_galleryslides;
						} else {
							$galleryslides = $wpdb -> get_results($galleryslidesquery);
							wp_cache_set($query_hash, $galleryslides, 'slideshowgallery', 0);
						}
						
						if (!empty($galleryslides)) {
							foreach ($galleryslides as $galleryslide) {
								$this -> galleries[] = $galleryslide -> gallery_id;
								$this -> gallery[$galleryslide -> gallery_id] = $wpdb -> get_row("SELECT * FROM `" . $wpdb -> prefix . strtolower($this -> pre) . "_galleries` WHERE `id` = '" . $galleryslide -> gallery_id . "'");
							}
						}
						break;
					case 'image'				:
						$imagespath = $this -> get_option('imagespath');
						if (empty($imagespath)) {
							$this -> image_path = GalleryHtmlHelper::uploads_path() . DS . 'slideshow-gallery' . DS . $dval;
						} else {
							$this -> image_path = rtrim($imagespath, DS) . DS . $dval;
						}
						break;
				}
			}
		}
		
		return true;
	}
	
	function defaults() {
		$defaults = array(
			'galleries'			=>	false,
			'order'				=>	0,
			'created'			=>	GalleryHtmlHelper::gen_date(),
			'modified'			=>	GalleryHtmlHelper::gen_date(),
		);
		
		return $defaults;
	}
	
	function validate($data = null) {
		$this -> errors = array();
	
		if (!empty($data)) {
			$data = (empty($data[$this -> model])) ? $data : $data[$this -> model];
			$data = stripslashes_deep($data);			
			extract($data, EXTR_SKIP);
			
			if (empty($title)) { $this -> errors['title'] = __('Please fill in a title', $this -> plugin_name); }
			if (empty($showinfo)) { $this -> data -> showinfo = "both"; }
			
			if (empty($type)) { $this -> errors['type'] = __('Please select an image type', $this -> plugin_name); }
			elseif ($type == "file") {
				if (!empty($image_oldfile) && empty($_FILES['image_file']['name'])) {
					$imagename = $image_oldfile;
					$imagepath = GalleryHtmlHelper::uploads_path() . DS . $this -> plugin_name . DS;
					$imagefull = $imagepath . $imagename;
					
					$this -> data -> image = $imagename;					
					$imagespath = $this -> get_option('imagespath');
					if (empty($imagespath)) {
						$this -> data -> image_path = GalleryHtmlHelper::uploads_path() . DS . 'slideshow-gallery' . DS . $imagename;
					} else {
						$this -> data -> image_path = rtrim($imagespath, DS) . DS . $imagename;
					}
				} else {								
					if ($_FILES['image_file']['error'] <= 0) {
						$imagename = $_FILES['image_file']['name'];
						$image_name = GalleryHtmlHelper::strip_ext($imagename, "name");
						$image_ext = GalleryHtmlHelper::strip_ext($imagename, "ext");
						$imagename = GalleryHtmlHelper::sanitize($image_name) . '.' . $image_ext;
						
						$imagepath = GalleryHtmlHelper::uploads_path() . DS . 'slideshow-gallery' . DS;
						$imagefull = $imagepath . $imagename;
						
						$issafe = false;
						$mimes = get_allowed_mime_types();						
						foreach ($mimes as $type => $mime) {
							if (strpos($type, $image_ext) !== false) {
								$issafe = true;
							}
						}
						
						if (empty($issafe) || $issafe == false) {
							$this -> errors['image_file'] = __('This file type is not allowed for security reasons', $this -> plugin_name);
						} else {
							if (!is_uploaded_file($_FILES['image_file']['tmp_name'])) { $this -> errors['image_file'] = __('The image did not upload, please try again', $this -> plugin_name); }
							elseif (!move_uploaded_file($_FILES['image_file']['tmp_name'], $imagefull)) { $this -> errors['image_file'] = __('Image could not be moved from TMP to "wp-content/uploads/", please check permissions', $this -> plugin_name); }
							else {
								@chmod($imagefull, 0644);
							
								$this -> data -> image = $imagename;
								$imagespath = $this -> get_option('imagespath');
								if (empty($imagespath)) {
									$this -> image_path = GalleryHtmlHelper::uploads_path() . DS . 'slideshow-gallery' . DS . $imagename;
								} else {
									$this -> image_path = rtrim($imagespath, DS) . DS . $imagename;
								}
							}	
						}
					} else {					
						switch ($_FILES['image_file']['error']) {
							case UPLOAD_ERR_INI_SIZE		:
							case UPLOAD_ERR_FORM_SIZE 		:
								$this -> errors['image_file'] = __('The image file is too large', $this -> plugin_name);
								break;
							case UPLOAD_ERR_PARTIAL 		:
								$this -> errors['image_file'] = __('The image was partially uploaded, please try again', $this -> plugin_name);
								break;
							case UPLOAD_ERR_NO_FILE 		:
								$this -> errors['image_file'] = __('No image was chosen for uploading, please choose an image', $this -> plugin_name);
								break;
							case UPLOAD_ERR_NO_TMP_DIR 		:
								$this -> errors['image_file'] = __('No TMP directory has been specified for PHP to use, please ask your hosting provider', $this -> plugin_name);
								break;
							case UPLOAD_ERR_CANT_WRITE 		:
								$this -> errors['image_file'] = __('Image cannot be written to disc, please ask your hosting provider', $this -> plugin_name);
								break;
						}
					}
				}
			} elseif ($type == "url") {
				if (empty($image_url)) { $this -> errors['image_url'] = __('Please specify an image', $this -> plugin_name); }
				else {
					if ($image = wp_remote_fopen(str_replace(" ", "%20", $image_url))) {
						$filename = basename($image_url);
						$file_name = GalleryHtmlHelper::strip_ext($filename, "name");
						$file_ext = GalleryHtmlHelper::strip_ext($filename, "ext");
						$filename = GalleryHtmlHelper::sanitize($file_name) . '.' . $file_ext;
						$filepath = GalleryHtmlHelper::uploads_path() . DS . $this -> plugin_name . DS;
						$filefull = $filepath . $filename;
						
						if (!file_exists($filefull)) {
							$fh = @fopen($filefull, "w");
							@fwrite($fh, $image);
							@fclose($fh);
						}
					}
				}
			}
		} else {
			$this -> errors[] = __('No data was posted', $this -> plugin_name);
		}
		
		return $this -> errors;
	}
}

?>