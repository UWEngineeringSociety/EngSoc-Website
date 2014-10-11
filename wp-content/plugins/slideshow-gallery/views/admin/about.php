<?php
/**
 * Slideshow Gallery About Dashboard v1.4.4.3
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );

?>

<div class="wrap slideshow-gallery about-wrap">
	<h1><?php echo sprintf(__( 'Welcome to Slideshow Gallery %s', $this -> plugin_name), $this -> version); ?></h1>
	<div class="about-text">
		<?php echo sprintf(__('Thank you for installing! Slideshow Gallery %s is more powerful, reliable and versatile than before. It includes many features and improvements.', $this -> plugin_name), $this -> version); ?>
	</div>
	<div class="slideshow-gallery-badge"><?php echo sprintf(__('Version %s', $this -> plugin_name), $this -> version); ?></div>
	
	<div class="changelog">
		<h3><?php _e( 'What\'s new in this release', $this -> plugin_name); ?></h3>
		<div class="feature-section col three-col">
			<div class="col-1">
				<img src="<?php echo $this -> url(); ?>/images/about/feature-1.png">
				<h4><?php _e('WordPress 4.0 Compatibility', $this -> plugin_name); ?></h4>
				<p><?php _e('This version is 100% compatible with the latest WordPress version. It will fit nicely into your WordPress dashboard and maximizes the WordPress capabilities for speed, functionality and reliability.', $this -> plugin_name); ?></p>
			</div>
			<div class="col-2">
				<img src="<?php echo $this -> url(); ?>/images/about/feature-2.jpg">
				<h4><?php _e('Multilingual', $this -> plugin_name); ?></h4>
				<p><?php _e('This version of the Slideshow Gallery plugin is fully integrated with (m)qTranslate. It now supports internationalization and multilanguage through (m)qTranslate.', $this -> plugin_name); ?></p>
			</div>
			<div class="col-3 last-feature">
				<img src="<?php echo $this -> url(); ?>/images/about/feature-3.jpg">
				<h4><?php _e('Responsive Slideshow', $this -> plugin_name); ?></h4>
				<p><?php _e('The new, responsive option is a flexible foundation that adapts your slideshow to mobile devices and the desktop or any other viewing environment. In this way your slideshow can easily be viewed on a desktop or mobile device.', $this -> plugin_name); ?></p>
			</div>
		</div>
	</div>
	
	<hr>

	<div class="feature-section col two-col">
		<div class="col-1">
			<img src="<?php echo $this -> url(); ?>/images/about/feature-4.jpg">			
			<h4><?php _e('Compatibility with Thickbox', $this -> plugin_name); ?></h4> 
			<p><?php _e(' Slideshows in this version is compatibile with Thickbox/Lightbox to show slide images in an overlay.', $this -> plugin_name); ?></p>
		</div>
		<div class="col-2 last-feature">
						<img src="<?php echo $this -> url(); ?>/images/about/feature-5.jpg">
						<h4><?php _e('More than one slideshow', $this -> plugin_name); ?></h4>
						<p><?php _e('Create a beautiful page with more than one slideshow. You now have the ability to add unlimited slideshows per page, as many as you want. They will all play along nicely!', $this -> plugin_name); ?>
			<p><?php /*_e('The plugin can automatically send a "Sorry to see you go..." email to a user when they unsubscribe to both confirm their subscription, express your disappointment that they are leaving and it also includes a resubscribe link to convert.', $this -> plugin_name); */?></p>
		</div>
</div>

<hr>
		<div class="changelog under-the-hood">
		<h3>Under the Hood</h3>
	
		<div class="feature-section col three-col">
		<div>
		<h4><?php _e('Auto Slide', $this -> plugin_name); ?></h4>
		<p><?php _e('Set your slideshow to autoslide, when viewing a slideshow it will autoslide and it won\'t be necessary for the user to manually flip through the images.', $this -> plugin_name); ?></p>		
		<h4><?php _e('WordPress Object Cache API', $this -> plugin_name); ?></h4>
		<p><?php _e('Speed up the plugin with the WordPress Object Cache API which is now built in to cache queries through the WordPress database object.', $this -> plugin_name); ?></p>
		</div>
		<div>
		<h4><?php _e('Hide information bar on mobile devices', $this -> plugin_name); ?></h4>
		<p><?php _e('Hide the information bar on mobile devices with a responsive slideshow to view a full slideshow without any text over it..', $this -> plugin_name); ?></p>
		
		<h4><?php _e('Show latest/feature products from Shopping Cart plugin', $this -> plugin_name); ?></h4>
		<p><?php _e('Add a slideshow to show your products from the WordPress Shopping Cart plugin. You can choose to show either latest products or feature products images in the slideshow. The images, titles, descriptions, etc. will be automatically pulled from the Shopping Cart plugin, it is fully automated and integrated.', $this -> plugin_name); ?></p>
		</div>
		<div class="last-feature">
		<h4><?php _e('Revamp of Configuration Settings', $this -> plugin_name); ?></h4>
		<p><?php _e('The Configurations Settings got a Revamp. New Sliders for speed settings, Color picker for color settings, Debugging setting and more.', $this -> plugin_name); ?></p>
		
		<h4><?php _e('Child Theme Folder Support', $this -> plugin_name); ?></h4>
		<p><?php _e('The best way to make modifications to template files in the Slideshow Gallery plugin is to create a child theme folder for the plugin inside your WordPress theme folder. This version now supports a child theme folder.', $this -> plugin_name); ?></p>
		</div>
		
		</div>
		
		<hr>
		
		<div class="return-to-dashboard">
		<a href="<?php echo admin_url('admin.php'); ?>?page=slideshow-gallery"><?php _e('Go to Slideshow Gallery overview', $this -> plugin_name); ?></a>
		</div>
	
	</div>
</div>