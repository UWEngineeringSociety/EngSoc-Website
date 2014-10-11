<?php

global $wpdb;
if(!current_user_can('edit_posts')) die;

$galleriesquery = "SELECT * FROM `" . $wpdb -> prefix . "gallery_galleries` ORDER BY `title` ASC";

$query_hash = md5($galleriesquery);
if ($oc_galleries = wp_cache_get($query_hash, 'slideshowgallery')) {
	$galleries = $oc_galleries;
} else {
	$galleries = $wpdb -> get_results($galleriesquery);
	wp_cache_set($query_hash, $galleries, 'slideshowgallery', 0);
}

$checkout_active = is_plugin_active('wp-checkout' . DS . 'wp-checkout.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php _e('Insert a Slideshow Gallery', $this -> plugin_name); ?></title>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/jquery/jquery.js"></script>
	<script language="javascript" type="text/javascript">	
	var _self = tinyMCEPopup;
	
	function insertTag () {	
		var slideshow_type = jQuery('input[name="slideshow_type"]:checked').val();
		var exclude = jQuery('#exclude').val();
		
		if (slideshow_type == "post") {		
			var post_id = jQuery('#post_id').val();
			if (post_id == "") { alert('<?php _e('Please fill in a post ID.', $this -> plugin_name); ?>'); return false; }
			var tag = '[tribulant_slideshow post_id="' + post_id + '"';
		
			if (exclude != "" && exclude != "undefined" && exclude != undefined) {
				tag += ' exclude="' + exclude + '"';
			}
			
			tag += ']';
		} else if (slideshow_type == "custom") {
			var tag = '[tribulant_slideshow';
			if (exclude != "" && exclude != "undefined" && exclude != undefined) { tag += ' exclude="' + exclude + '"'; }
			tag += ']';
		} else if (slideshow_type == "gallery") {
			var gallery_id = jQuery('#gallery_id').val();
			if (gallery_id == "") { alert('<?php _e('Please select a gallery.', $this -> plugin_name); ?>'); return false; }
			var tag = '[tribulant_slideshow gallery_id="' + gallery_id + '"';
			if (exclude != "" && exclude != "undefined" && exclude != undefined) { tag += ' exclude="' + exclude + '"'; }
			tag += ']';
		} else if (slideshow_type == "products") {
			var slideshow_products = jQuery('#slideshow_products').val();
			var slideshow_productsnumber = jQuery('#slideshow_productsnumber').val();
			var tag = '[tribulant_slideshow products="' + slideshow_products + '" productsnumber="' + slideshow_productsnumber + '"]';
		}
		
		if (window.tinyMCE) {
			window.tinyMCE.execCommand('mceInsertContent', false, tag);
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
	}
	
	function closePopup() {
		tinyMCEPopup.close();
	}		
	</script>
	
	<style type="text/css">
		@import url('<?php echo $this -> url(); ?>/css/admin.css');
		table th { vertical-align: top; }
		.panel_wrapper { border-top: 1px solid #909B9C; }
		.panel_wrapper div.current { height:auto !important; }
		#product-menu { width: 180px; }
	</style>
	
</head>
<body>

<div id="wpwrap">

<form onsubmit="insertTag(); return false;" action="#">
	<div class="panel_wrapper">
		<label style="font-weight:bold; cursor:pointer;"><input onclick="jQuery('#products_div').hide(); jQuery('#post_div').show(); jQuery('#gallery_div').hide();" type="radio" name="slideshow_type" value="post" id="type_post" /> <?php _e('Images From a Post', $this -> plugin_name); ?></label><br/>
		<label style="font-weight:bold; cursor:pointer;"><input onclick="jQuery('#products_div').hide(); jQuery('#post_div').hide(); jQuery('#gallery_div').show();" type="radio" name="slideshow_type" value="gallery" id="type_gallery" /> <?php _e('Slides From a Gallery', $this -> plugin_name); ?></label><br/>
		<label style="font-weight:bold; cursor:pointer;"><input onclick="jQuery('#products_div').hide(); jQuery('#post_div').hide(); jQuery('#gallery_div').hide();" type="radio" name="slideshow_type" value="custom" id="type_custom" /> <?php _e('All Available Slides', $this -> plugin_name); ?></label><br/>
		<label style="font-weight:bold; cursor:pointer;"><input <?php echo (!$checkout_active) ? 'disabled="disabled"' : ''; ?> onclick="jQuery('#products_div').show(); jQuery('#post_div').hide(); jQuery('#gallery_div').hide();" type="radio" name="slideshow_type" value="products" id="type_products" /> <?php _e('Products', $this -> plugin_name); ?></label>
		<?php if (!$checkout_active) : ?>
			<small>(<span class="slideshow_error"><?php echo sprintf(__('Requires the %sShopping Cart plugin%s', $this -> plugin_name), '<a href="http://tribulant.com/plugins/view/10/wordpress-shopping-cart-plugin" target="_blank">', '</a>'); ?></span>)</small>
		<?php endif; ?>
		
		<div id="products_div" style="display:none;">
			<p>
				<label for="slideshow_products" style="font-weight:bold;"><?php _e('Products Source:', $this -> plugin_name); ?></label><br/>
				<select name="slideshow_products" id="slideshow_products">
					<option value="latest"><?php _e('Latest Products', $this -> plugin_name); ?></option>
					<option value="featured"><?php _e('Featured Products', $this -> plugin_name); ?></option>
				</select>
				<br/><small><?php _e('Choose the source of the products', $this -> plugin_name); ?></small>
			</p>
			<p>
				<label for="slideshow_productsnumber" style="font-weight:bold;"><?php _e('Number of Products:', $this -> plugin_name); ?></label>
				<input type="text" style="width:50px;" class="" name="slideshow_productsnumber" value="10" id="slideshow_productsnumber" />
				<br/><small><?php _e('The number of products to display', $this -> plugin_name); ?></small>
			</p>
		</div>
		
		<div id="post_div" style="display:none;">
			<script type="text/javascript">
			jQuery(document).ready(function() {
				var id = jQuery("#post_ID", window.parent.document).val();
				jQuery('#post_id').attr('value', id).val(id);
			});
			</script>
		
			<p>
				<label for="post_id" style="font-weight:bold;"><?php _e('Post ID:', $this -> plugin_name); ?></label><br/>
				<input type="text" class="" name="post_id" value="" id="post_id" /><br/>
				<small><?php _e('ID of the post to take images from.', $this -> plugin_name); ?></small>
			</p>
		</div>
		
		<div id="gallery_div" style="display:none;">
			<p>
				<label for="gallery_id" style="font-weight:bold;"><?php _e('Gallery:', $this -> plugin_name); ?></label>
				<select name="gallery_id" id="gallery_id">
					<option value=""><?php _e('- Select Gallery -', $this -> plugin_name); ?></option>
					<?php if (!empty($galleries)) : ?>
						<?php foreach ($galleries as $gallery) : ?>
							<?php $slidescount = $wpdb -> get_var("SELECT COUNT(`id`) FROM `" . $wpdb -> prefix . "gallery_galleriesslides` WHERE `gallery_id` = '" . $gallery -> id . "'"); ?>
							<option value="<?php echo $gallery -> id; ?>"><?php echo __($gallery -> title); ?> (<?php echo $slidescount; ?>)</option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</p>
		</div>
		
		<p>
			<label style="font-weight:bold;"><?php _e('Exclude:', $this -> plugin_name); ?></label><br/>
			<input type="text" name="exclude" value="" id="exclude" /><br/>
			<small><?php _e('Comma separated IDs of attachments/slides to exclude', $this -> plugin_name); ?></small>
		</p>
	</div>
	
	<p><?php echo sprintf(__('For more settings/parameters, see the %sSlideshow Gallery plugin%s page.', $this -> plugin_name), '<a href="http://wordpress.org/plugins/slideshow-gallery/" target="_blank">', '</a>'); ?></p>
	
	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="closePopup()"/>
		</div>

		<div style="float: right">
			<input type="button" id="insert" name="insert" value="{#insert}" onclick="insertTag()" />
		</div>
	</div>
</form>
</div>

</body>
</html>