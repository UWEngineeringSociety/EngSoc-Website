<div class="wrap">
	<h2><?php _e('Order Slides', $this -> plugin_name); ?><?php echo (!empty($gallery)) ? ': ' . __($gallery -> title) : ''; ?></h2>
	
	<div style="float:none;" class="subsubsub">
		<a href="<?php echo $this -> url; ?>"><?php _e('&larr; Manage All Slides', $this -> plugin_name); ?></a>
	</div>
	
	<?php if (!empty($slides)) : ?>
		<div id="slidemessage" class="updated fade" style="display:none; width:31%;"><!-- message will go here --></div>
		<div class="gallery_slides_list">
			<span class="gallery_slides_convert_list"><a href="#" id="gallery_convert_list"></a></span>
			<span class="gallery_slides_convert_grid"><a href="#" id="gallery_convert_grid"></a></span>
			<br class="clear" />
			<ul id="slidelist">
				<?php foreach ($slides as $slide) : ?>
					<li class="gallerylineitem" id="item_<?php echo $slide -> id; ?>">
						<span class="gallery_slide_image" style="display:none;"><img src="<?php echo $this -> Html -> bfithumb_image_src($slide -> image_path, 89, 89, 100); ?>" alt="<?php echo $this -> Html -> sanitize(__($slide -> title)); ?>" /></span>
						<span class="gallery_slide_title"><?php echo __($slide -> title); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<script type="text/javascript">
		var request_slides = false;
		jQuery(document).ready(function() {				
			jQuery('#gallery_convert_list').click(function() {
				jQuery('.gallery_slides_grid').removeClass('gallery_slides_grid').addClass('gallery_slides_list');
				
				return false;
			});
			
			jQuery('#gallery_convert_grid').click(function() {
				jQuery('.gallery_slides_list').removeClass('gallery_slides_list').addClass('gallery_slides_grid');
				
				return false;
			});
			
			jQuery("ul#slidelist").sortable({
				placeholder: "gallery-placeholder",
				revert: 100,
				distance: 5,
				start: function(request) {
					if (request_slides) { request_slides.abort(); }
					jQuery("#slidemessage").slideUp();
				},
				stop: function(request) {					
					jQuery.post(slideshowajax + '?action=slideshow_slides_order<?php echo (!empty($gallery)) ? '&gallery_id=' . $gallery -> id : ''; ?>', jQuery('#slidelist').sortable('serialize'), function(response) {
						jQuery('#slidemessage').html('<p>' + response + '</p>').fadeIn();
					});
				}
			});
		});
		</script>
	<?php else : ?>
		<p style="color:red;"><?php _e('No slides found', $this -> plugin_name); ?></p>
	<?php endif; ?>
</div>