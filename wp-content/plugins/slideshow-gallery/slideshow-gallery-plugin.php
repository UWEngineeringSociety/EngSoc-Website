<?php

class GalleryPlugin {

	var $version = '1.4.9.1';
	var $plugin_name;
	var $plugin_base;
	var $pre = 'Gallery';
	
	var $menus = array();
	var $sections = array(
		'slides'			=>	'slideshow-slides',
		'galleries'			=>	'slideshow-galleries',
		'settings'			=>	'slideshow-settings',
	);
	
	var $helpers = array('Db', 'Html', 'Form', 'Metabox');
	var $models = array('Slide', 'Gallery', 'GallerySlides');
	var $debugging = false;		//set to "true" to turn on debugging
	var $debug_level = 2;		//set to 2 for PHP and DB errors or 1 for just DB errors

	function register_plugin($name, $base) {
		$this -> plugin_name = $name;
		$this -> plugin_base = rtrim(dirname($base), DS);
		$this -> sections = (object) $this -> sections;
		$this -> initialize_classes();
		//$this -> initialize_options();
		
		global $wpdb;
		$debugging = get_option('tridebugging');
		$this -> debugging = (empty($debugging)) ? $this -> debugging : true;
		
		if ($this -> debugging == true) {
			$wpdb -> show_errors();
			
			if ($this -> debug_level == 2) {
				error_reporting(E_ALL & ~(E_STRICT|E_NOTICE));
				@ini_set('display_errors', 1);
			}
		} else {
			$wpdb -> hide_errors();
			error_reporting(0);
			@ini_set('display_errors', 0);
		}
		
		return true;
	}
	
	function ajax_slides_order() {	
		if (!empty($_REQUEST['item'])) {
			foreach ($_REQUEST['item'] as $order => $slide_id) {
				if (empty($_REQUEST['gallery_id'])) {
					$this -> Slide -> save_field('order', ($order + 1), array('id' => $slide_id));
				} else {
					$this -> GallerySlides -> save_field('order', ($order + 1), array('slide_id' => $slide_id, 'gallery_id' => $_REQUEST['gallery_id']));
				}
			}
			
			_e('Slides have been ordered', $this -> plugin_name);
		}
		
		exit();
		die();
	}
	
	function ajax_tinymce() {
		$this -> render('tinymce-dialog', false, true, 'admin');
		
		exit();
		die();
	}
	
	function init_class($name = null, $params = array()) {
		if (!empty($name)) {
			$name = $this -> pre . $name;
				
			if (class_exists($name)) {
				if ($class = new $name($params)) {							
					return $class;
				}
			}
		}
		
		$this -> init_class('Country');
		
		return false;
	}
	
	function initialize_classes() {	
		if (!empty($this -> helpers)) {
			foreach ($this -> helpers as $helper) {
				$hfile = dirname(__FILE__) . DS . 'helpers' . DS . strtolower($helper) . '.php';
				
				if (file_exists($hfile)) {
					require_once($hfile);
					
					if (empty($this -> {$helper}) || !is_object($this -> {$helper})) {
						$classname = $this -> pre . $helper . 'Helper';
						
						if (class_exists($classname)) {
							$this -> {$helper} = new $classname;
						}
					}
				} 
			}
		}
	
		if (!empty($this -> models)) {
			foreach ($this -> models as $model) {
				$mfile = dirname(__FILE__) . DS . 'models' . DS . strtolower($model) . '.php';
				
				if (file_exists($mfile)) {
					require_once($mfile);
					
					if (empty($this -> {$model}) || !is_object($this -> {$model})) {
						$classname = $this -> pre . $model;
						
						if (class_exists($classname)) {
							$this -> {$model} = new $classname;
						}
					}
				} 
			}
		}
	}
	
	function updating_plugin() {
		if (!is_admin()) return;
		
		global $wpdb;
	
		if (!$this -> get_option('version')) {
			$this -> add_option('version', $this -> version);
			$this -> initialize_options();
			return;
		}

		$cur_version = $this -> get_option('version');
		$version = $this -> version;

		if (version_compare($this -> version, $cur_version) === 1) {			
			if (version_compare($cur_version, "1.4.8") < 0) {
				$this -> initialize_options();
				
				$query = "ALTER TABLE `" . $this -> Slide -> table . "` CHANGE `image` `image` TEXT NOT NULL;";
				$wpdb -> query($query);
				
				$version = "1.4.8";
			}
			
			if (version_compare($cur_version, "1.4.9.1") < 0) {
				$this -> initialize_options();
				$version = "1.4.9.1";
			}
		
			//the current version is older.
			//lets update the database
			$this -> update_option('version', $version);
		}	
	}
	
	function initialize_options() {
		if (!is_admin()) { return; }
		
		$this -> init_roles();
	
		$styles = array(
			'layout'			=>	"responsive",
			'width'				=>	"450",
			'height'			=>	"250",
			'resheight'			=>	"30",
			'resheighttype' 	=>  "%",
			'border'			=>	"1px solid #CCCCCC",
			'background'		=>	"#000000",
			'infobackground'	=>	"#000000",
			'infocolor'			=>	"#FFFFFF",
			'resizeimages'		=>	"N",
		);
		
		$this -> add_option('resizeimagescrop', "Y");
		$this -> update_option('imagespath', $this -> Html -> uploads_url() . '/slideshow-gallery/');
		$this -> add_option('styles', $styles);
		$this -> add_option('fadespeed', 10);
		$this -> add_option('shownav', "Y");
		$this -> add_option('navopacity', 25);
		$this -> add_option('navhover', 70);
		$this -> add_option('information', "Y");
		$this -> add_option('infospeed', 10);
		$this -> add_option('infohideonmobile', 1);
		$this -> add_option('thumbnails', "N");
		$this -> add_option('thumbwidth', "100");
		$this -> add_option('thumbheight', "75");
		$this -> add_option('thumbposition', "bottom");
		$this -> add_option('thumbopacity', 70);
		$this -> add_option('thumbscrollspeed', 5);
		$this -> add_option('thumbspacing', 5);
		$this -> add_option('thumbactive', "#FFFFFF");
		$this -> add_option('autoslide', "Y");
		$this -> add_option('autospeed', 10);
		$this -> add_option('alwaysauto', "true");
		$this -> add_option('imagesthickbox', "N");
		
		$ratereview_scheduled = $this -> get_option('ratereview_scheduled');
		if (empty($ratereview_scheduled)) {
			wp_schedule_single_event(strtotime("+7 days"), 'slideshow_ratereviewhook', array(7));
			wp_schedule_single_event(strtotime("+14 days"), 'slideshow_ratereviewhook', array(14));
			wp_schedule_single_event(strtotime("+30 days"), 'slideshow_ratereviewhook', array(30));
			wp_schedule_single_event(strtotime("+60 days"), 'slideshow_ratereviewhook', array(60));
			$this -> update_option('ratereview_scheduled', true);
		}
		
		return;
	}
	
	function ratereview_hook($days = 7) {
		$this -> update_option('showmessage_ratereview', $days);
	} 
	
	function check_roles() {
		global $wp_roles;
		$permissions = $this -> get_option('permissions');
		
		if ($role = get_role('administrator')) {					
			if (!empty($this -> sections)) {			
				foreach ($this -> sections as $section_key => $section_menu) {								
					if (empty($role -> capabilities['slideshow_' . $section_key])) {
						$role -> add_cap('slideshow_' . $section_key);
						$permissions['administrator'][] = $section_key;
					}
				}
				
				$this -> update_option('permissions', $permissions);
			}
		}
		
		return false;		
	}
	
	function init_roles($sections = null) {
		global $wp_roles;
		$sections = $this -> sections;
	
		/* Get the administrator role. */
		$role = get_role('administrator');

		/* If the administrator role exists, add required capabilities for the plugin. */
		if (!empty($role)) {
			if (!empty($sections)) {			
				foreach ($sections as $section_key => $section_menu) {
					$role -> add_cap('slideshow_' . $section_key);
				}
			}
		} else if (empty($role) && !is_multisite()) {
			$newrolecapabilities = array();
			$newrolecapabilities[] = 'read';
		
			if (!empty($sections)) {
				foreach ($sections as $section_key => $section_menu) {
					$newrolecapabilities[] = 'slideshow_' . $section_key;
				}
			}

			add_role(
				'slideshow',
				_e('Slideshow Manager', $this -> plugin_name),
				$newrolecapabilities
			);
		}
		
		if (!empty($sections)) {
			$permissions = array();
		
			foreach ($sections as $section_key => $section_menu) {
				$wp_roles -> add_cap('administrator', 'slideshow_' . $section_key);
				$permissions['administrator'][] = $section_key;
			}
			
			$this -> update_option('permissions', $permissions);
		}
	}
	
	function render_msg($message = null) {
		$this -> render('msg-top', array('message' => $message), true, 'admin');
	}
	
	function render_err($message = null) {
		$this -> render('err-top', array('message' => $message), true, 'admin');
	}
	
	function redirect($location = null, $msgtype = null, $message = null) {
		$url = $location;
		
		if ($msgtype == "message") {
			$url .= '&' . $this -> pre . 'updated=true';
		} elseif ($msgtype == "error") {
			$url .= '&' . $this -> pre . 'error=true';
		}
		
		if (!empty($message)) {
			$url .= '&' . $this -> pre . 'message=' . urlencode($message);
		}
		
		?>
		
		<script type="text/javascript">
		window.location = '<?php echo (empty($url)) ? get_option('home') : $url; ?>';
		</script>
		
		<?php
		
		flush();
	}
	
	function paginate($model = null, $fields = '*', $sub = null, $conditions = null, $searchterm = null, $per_page = 10, $order = array('modified', "DESC")) {
		global $wpdb;
	
		if (!empty($model)) {
			global $paginate;
			$paginate = $this -> vendor('Paginate');
			$paginate -> table = $this -> {$model} -> table;
			$paginate -> sub = (empty($sub)) ? $this -> {$model} -> controller : $sub;
			$paginate -> fields = (empty($fields)) ? '*' : $fields;
			$paginate -> where = (empty($conditions)) ? false : $conditions;
			$paginate -> searchterm = (empty($searchterm)) ? false : $searchterm;
			$paginate -> per_page = $per_page;
			$paginate -> order = $order;
			
			$data = $paginate -> start_paging($_GET[$this -> pre . 'page']);
			
			if (!empty($data)) {
				$newdata = array();
			
				foreach ($data as $record) {
					$newdata[] = $this -> init_class($model, $record);
				}
				
				$data = array();
				$data[$model] = $newdata;
				$data['Paginate'] = $paginate;
			}
			
			return $data;
		}
		
		return false;
	}
	
	function vendor($name = null, $folder = null) {
		if (!empty($name)) {
			$filename = 'class.' . strtolower($name) . '.php';
			$filepath = rtrim(dirname(__FILE__), DS) . DS . 'vendors' . DS . $folder . '';
			$filefull = $filepath . $filename;
		
			if (file_exists($filefull)) {
				require_once($filefull);
				$class = 'Gallery' . $name;
				
				if (${$name} = new $class) {
					return ${$name};
				}
			}
		}
	
		return false;
	}
	
	function check_uploaddir() {
		$uploaddir = $this -> Html -> uploads_path() . DS . $this -> plugin_name . DS;
		$cachedir = $uploaddir . 'cache' . DS;
		
		if (!file_exists($uploaddir)) {
			if (@mkdir($uploaddir, 0777)) {
				@chmod($uploaddir, 0777);
				return true;
			} else {
				$message = sprintf(__('Uploads folder named "%s" cannot be created inside "%s"', $this -> plugin_name), $this -> plugin_name, "wp-content/uploads/");
				$this -> render_msg($message);
			}
		}
		
		if (!file_exists($cachedir)) {
			if (@mkdir($cachedir, 0777)) {
				@chmod($cachedir, 0777);
			} else {
				$message = sprintf(__('Slideshow cache folder "%s" for resizing images cannot be created inside "%s"', $this -> plugin_name), 'cache', 'wp-content/uploads/' . $this -> plugin_name . '/');
				$this -> render_msg($message);
			}
		}
		
		return false;
	}
	
	function add_action($action, $function = null, $priority = 10, $params = 1) {
		if (add_action($action, array($this, (empty($function)) ? $action : $function), $priority, $params)) {
			return true;
		}
		
		return false;
	}
	
	function add_filter($filter, $function = null, $priority = 10, $params = 1) {
		if (add_filter($filter, array($this, (empty($function)) ? $filter : $function), $priority, $params)) {
			return true;
		}
		
		return false;
	}
	
	function print_scripts() {
		$this -> enqueue_scripts();
	}
	
	function enqueue_scripts() {	
		wp_enqueue_script('jquery');
		
		if (is_admin()) {
			if (!empty($_GET['page']) && in_array($_GET['page'], (array) $this -> sections)) {
				wp_enqueue_script(
			        'iris',
			        admin_url('js/iris.min.js'),
			        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
			        false,
			        1
			    );
			    
			    wp_enqueue_script(
			        'wp-color-picker',
			        admin_url('js/color-picker.min.js'),
			        array( 'iris' ),
			        false,
			        1
			    );
			
				wp_enqueue_script('jquery-ui-tabs');
				wp_enqueue_script('jquery-ui-tooltip');
				wp_enqueue_script('jquery-ui-slider');
						
				if ($_GET['page'] == 'slideshow-settings') {
					wp_enqueue_script('common');
					wp_enqueue_script('wp-lists');
					wp_enqueue_script('postbox');
					wp_enqueue_script('plugin-install');
					wp_enqueue_script('settings-editor', plugins_url() . '/' . $this -> plugin_name . '/js/settings-editor.js', array('jquery'), '1.0');
				}
				
				if ($_GET['page'] == "slideshow-slides" && $_GET['method'] == "order") {
					wp_enqueue_script('jquery-ui-sortable');
				}
				
				add_thickbox();
			}
			
			wp_enqueue_script('colorbox', plugins_url() . '/' . $this -> plugin_name . '/js/colorbox.js', array('jquery'), '1.3.19');
			wp_enqueue_script($this -> plugin_name . 'admin', plugins_url() . '/' . $this -> plugin_name . '/js/admin.js', null, '1.0');
		} else {
			wp_enqueue_script($this -> plugin_name, plugins_url() . '/' . $this -> plugin_name . '/js/gallery.js', null, '1.0');
			wp_enqueue_script('colorbox', plugins_url() . '/' . $this -> plugin_name . '/js/colorbox.js', array('jquery'), '1.3.19');
		}
		
		return true;
	}
	
	function get_css_url($attr = null, $layout = null) {
		$file = (empty($layout) || $layout == "specific") ? 'css' : 'css-responsive';
		$css_url = plugins_url() . '/' . $this -> plugin_name . '/views/default/' . $file . '.php?';
		
		$default_attr = $this -> get_option('styles');
		$styles = wp_parse_args($attr, $default_attr);
		
		if (!empty($styles)) {	
			$s = 1;
			
			foreach ($styles as $skey => $sval) {			
				$css_url .= $skey . '=' . urlencode($sval);
				if ($s < count($styles)) { $css_url .= '&'; }
				$s++;
			}
		}
		
		return $css_url;
	}
	
	function print_styles() {
		$this -> enqueue_styles();
	}
	
	function enqueue_styles() {
		if (is_admin()) {
			$src = plugins_url() . '/' . $this -> plugin_name . '/css/admin.css';			
			wp_enqueue_style($this -> plugin_name, $src, null, "1.0", "all");
			wp_enqueue_style('wp-color-picker');
			$jquery_ui_src = plugins_url() . '/' . $this -> plugin_name . '/css/jquery-ui.css';
			wp_enqueue_style('jquery-ui', $jquery_ui_src, null, "1.0", "all");
		}
		
		$colorbox_src = plugins_url() . '/' . $this -> plugin_name . '/css/colorbox.css';
		wp_enqueue_style('colorbox', $colorbox_src, null, "1.3.19", "all");
	
		return true;
	}
	
	function plugin_base() {
		return rtrim(dirname(__FILE__), '/');
	}
	
	function url() {
		return site_url() . '/' . substr(preg_replace("/\\" . DS . "/si", "/", $this -> plugin_base()), strlen(ABSPATH));
	}
	
	function add_option($name = '', $value = '') {
		if (add_option($this -> pre . $name, $value)) {
			return true;
		}
		
		return false;
	}
	
	function update_option($name = null, $value = null) {	
		if (update_option($this -> pre . $name, $value)) {
			return true;
		}
		
		return false;
	}
	
	function get_option($name = null) {	
		if (!empty($name)) {
			if ($value = get_option($this -> pre . $name)) {
				return $value;
			}
		}
		
		return false;
	}
	
	function delete_option($name = null) {
		if (delete_option($this -> pre . $name)) {
			return true;
		}
		
		return false;
	}
	
	function debug($var = array()) {
		$debugging = get_option('tridebugging');
		$this -> debugging = (empty($debugging)) ? $this -> debugging : true;
	
		if ($this -> debugging) {
			echo '<pre>' . print_r($var, true) . '</pre>';
			return true;
		}
		
		return false;
	}
	
	function check_table($model = null) {
		global $wpdb;
	
		if (!empty($model)) {			
			if (!empty($this -> fields) && is_array($this -> fields)) {			
				if (!$wpdb -> get_var("SHOW TABLES LIKE '" . $this -> table . "'")) {				
					$query = "CREATE TABLE `" . $this -> table . "` (";
					$c = 1;
					
					foreach ($this -> fields as $field => $attributes) {
						if ($field != "key") {
							$query .= "`" . $field . "` " . $attributes . "";
						} else {
							$query .= "" . $attributes . "";
						}
						
						if ($c < count($this -> fields)) {
							$query .= ",";
						}
						
						$c++;
					}
					
					$query .= ") ENGINE=MyISAM AUTO_INCREMENT=1 CHARSET=UTF8;";
					
					if (!empty($query)) {
						$this -> table_query[] = $query;
					}
				} else {
					$field_array = $this -> get_fields($this -> table);
					
					foreach ($this -> fields as $field => $attributes) {					
						if ($field != "key") {
							$this -> add_field($this -> table, $field, $attributes);
						}
					}
				}
				
				if (!empty($this -> table_query)) {				
					require_once(ABSPATH . 'wp-admin' . DS . 'upgrade-functions.php');
					dbDelta($this -> table_query, true);
				}
			}
		}
		
		return false;
	}
	
	function get_fields($table = null) {	
		global $wpdb;
	
		if (!empty($table)) {
			$fullname = $table;			
			$field_array = array();
			if ($fields = $wpdb -> get_results("SHOW COLUMNS FROM " . $fullname)) {
				foreach ($fields as $field) {
					$field_array[] = $field -> Field;
				}
				
				return $field_array;
			}
		}
		
		return false;
	}
	
	function delete_field($table = null, $field = null) {
		global $wpdb;
		
		if (!empty($table)) {
			if (!empty($field)) {
				$query = "ALTER TABLE `" . $wpdb -> prefix . "" . $table . "` DROP `" . $field . "`";
				
				if ($wpdb -> query($query)) {
					return false;
				}
			}
		}
		
		return false;
	}
	
	function change_field($table = null, $field = null, $newfield = null, $attributes = "TEXT NOT NULL") {
		global $wpdb;
		
		if (!empty($table)) {		
			if (!empty($field)) {			
				if (!empty($newfield)) {
					$field_array = $this -> get_fields($table);
					
					if (!in_array($field, $field_array)) {
						if ($this -> add_field($table, $newfield)) {
							return true;
						}
					} else {
						$query = "ALTER TABLE `" . $table . "` CHANGE `" . $field . "` `" . $newfield . "` " . $attributes . ";";
						
						if ($wpdb -> query($query)) {
							return true;
						}
					}
				}
			}
		}
		
		return false;
	}
	
	function add_field($table = null, $field = null, $attributes = "TEXT NOT NULL") {
		global $wpdb;
	
		if (!empty($table)) {
			if (!empty($field)) {
				$field_array = $this -> get_fields($table);
				
				if (!empty($field_array)) {				
					if (!in_array($field, $field_array)) {					
						$query = "ALTER TABLE `" . $table . "` ADD `" . $field . "` " . $attributes . ";";
						
						if ($wpdb -> query($query)) {
							return true;
						}
					}
				}
			}
		}
		
		return false;
	}
	
	function language_do() {
		
		if ($this -> is_plugin_active('qtranslate')) {
			return true;
		}
		
		return false;
	}
	
	function language_getlanguages() {
		if ($this -> language_do()) {
			if (function_exists('qtrans_getSortedLanguages')) {
				if ($languages = qtrans_getSortedLanguages()) {
					return $languages;
				}
			}
		}
		
		return false;
	}
	
	function language_flag($language = null) {
		$flag = false;
	
		if ($this -> language_do()) {
			global $q_config;
			$flag = '<img src="' . content_url() . '/' . $q_config['flag_location'] . '/' . $q_config['flag'][$language] . '" alt="' . $language . '" />';
		}
		
		return $flag;
	}
	
	function is_plugin_active($name = null, $orinactive = false) {
		if (!empty($name)) {		
			require_once ABSPATH . 'wp-admin' . DS . 'includes' . DS . 'admin.php';
			
			if (empty($path)) {
				switch ($name) {
					case 'qtranslate'			:
						$path = 'qtranslate' . DS . 'qtranslate.php';
						break;
					case 'captcha'				:
						$path = 'really-simple-captcha' . DS . 'really-simple-captcha.php';
						break;
					default						:
						$path = $name;
						break;
				}
			}
			
			$path2 = str_replace("\\", "/", $path);
			
			if (!empty($name) && $name == "qtranslate") {
				$path2 = 'mqtranslate' . DS . 'mqtranslate.php';
			}
			
			if (!empty($path)) {
				$plugins = get_plugins();
				
				if (!empty($plugins)) {
					if (array_key_exists($path, $plugins) || array_key_exists($path2, $plugins)) {
						/* Let's see if the plugin is installed and activated */
						if (is_plugin_active(plugin_basename($path)) ||
							is_plugin_active(plugin_basename($path2))) {
							return true;
						}
						
						/* Maybe the plugin is installed but just not activated? */
						if (!empty($orinactive) && $orinactive == true) {
							if (is_plugin_inactive(plugin_basename($path)) ||
								is_plugin_inactive(plugin_basename($path2))) {
								return true;	
							}
						}	
					}
				}
			}
		}
		
		return false;
	}
	
	function has_child_theme_folder() {
		$theme_path = get_stylesheet_directory();
		$full_path = $theme_path . DS . 'slideshow';
		
		if (file_exists($full_path)) {
			return true;
		}
		
		return false;
	}
	
	function render($file = null, $params = array(), $output = true, $folder = 'admin') {	
		if (!empty($file)) {
			$this -> plugin_name = 'slideshow-gallery';
			$this -> plugin_base = rtrim(dirname(__FILE__), DS);
			$theme_serve = false;
			$filename = $file . '.php';
			$filepath = $this -> plugin_base() . DS . 'views' . DS . $folder . DS;
			
			if (!empty($folder) && $folder != "admin") {				
				$theme_path = get_stylesheet_directory();
				$full_path = $theme_path . DS . 'slideshow' . DS . $filename;
				
				if (!empty($theme_path) && file_exists($full_path)) {
					$folder = $theme_path . DS . 'slideshow';
					$theme_serve = true;
				}
			}
			
			if (empty($theme_serve)) {
				$filepath = $this -> plugin_base() . DS . 'views' . DS . $folder . DS;
			} else {
				$filepath = $folder . DS;
			}
			
			$filefull = $filepath . $filename;
		
			if (file_exists($filefull)) {
				if (!empty($params)) {
					foreach ($params as $pkey => $pval) {
						${$pkey} = $pval;
					}
				}
				
				$this -> initialize_classes();
			
				if ($output == false) {
					ob_start();
				}
				
				include($filefull);
				
				if ($output == false) {					
					$data = ob_get_clean();					
					return $data;
				} else {
					flush();
					return true;
				}
			}
		}
		
		return false;
	}
}

?>