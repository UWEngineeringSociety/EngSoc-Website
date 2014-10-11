<!-- Styles Settings -->

<?php 

$styles = $this -> get_option('styles'); 
$autoheight = $this -> get_option('autoheight');
$resizeimagescrop = $this -> get_option('resizeimagescrop');

?>

<table class="form-table">
	<tbody>
		<?php if ($this -> has_child_theme_folder()) : ?>
			<tr>
				<th><?php _e('Child Theme Folder', $this -> plugin_name); ?></th>
				<td>
					<?php
					
					$theme_folder = basename(get_stylesheet_directory());
					
					?>
					<?php echo sprintf(__('Yes, there is a %s folder inside WordPress theme folder %s', $this -> plugin_name), '<code>slideshow</code>', '<code>' . $theme_folder . '</code>'); ?>
				</td>
			</tr>
		<?php endif; ?>
		<tr>
			<th><label for="layout_responsive"><?php _e('Layout', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('Choose responsive if you have a responsive theme and you want the slideshow to resize width/height in a responsive manner on different devices.<br/><br/><strong>Override per slideshow:</strong> Using parameter <code>layout</code> with value <code>responsive</code> or <code>specific</code> eg. <code>[tribulant_slideshow layout="specific"]</code>.', $this -> plugin_name)); ?></th>
			<td>
				<label><input onclick="jQuery('#layout_specific_div').hide(); jQuery('#layout_responsive_div').show();" <?php echo ($styles['layout'] == "responsive") ? 'checked="checked"' : ''; ?> type="radio" name="styles[layout]" value="responsive" id="layout_responsive" /> <?php _e('Responsive', $this -> plugin_name); ?></label>
				<label><input onclick="jQuery('#layout_specific_div').show(); jQuery('#layout_responsive_div').hide();" <?php echo (empty($styles['layout']) || $styles['layout'] == "specific") ? 'checked="checked"' : ''; ?> type="radio" name="styles[layout]" value="specific" id="layout_specific" /> <?php _e('Fixed', $this -> plugin_name); ?></label>
				<span class="howto"><?php _e('Choose whether you want a responsive or fixed/specific layout for the slideshow.', $this -> plugin_name); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<div id="layout_responsive_div" style="display:<?php echo (!empty($styles['layout']) && $styles['layout'] == "responsive") ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="resheight"><?php _e('Responsive Height', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('The responsive height can be either a fixed height in pixel or a percentage height. The percentage height is a percentage of the width of the slideshow.<br/><br/><strong>Override per slideshow:</strong> Using parameters <code>resheight</code> value a value and <code>resheighttype</code> with <code>px</code> for pixels or <code>%</code> for percentage eg. <code>[tribulant_slideshow resheight="300" resheighttype="px"]</code>.', $this -> plugin_name)); ?></th>
				<td>
					<input class="widefat" style="width:45px;" type="text" name="styles[resheight]" value="<?php echo esc_attr(stripslashes($styles['resheight'])); ?>" id="resheight" />
					<select name="styles[resheighttype]">
						<option <?php echo ($styles['resheighttype'] == "%") ? 'selected="selected"' : ''; ?> value="%"><?php _e('&#37;', $this -> plugin_name); ?></option>
						<option <?php echo ($styles['resheighttype'] == "px") ? 'selected="selected"' : ''; ?> value="px"><?php _e('px', $this -> plugin_name); ?></option>
					</select>
					<span class="howto"><?php _e('Choose a responsive height for your slideshow, either a pixel or percentage height.', $this -> plugin_name); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div id="layout_specific_div" style="display:<?php echo (empty($styles['layout']) || $styles['layout'] == "specific") ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="styles.resizeimages"><?php _e('Resize Images', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('Should images be automatically resized? If you specify No, the images will be used in the slideshow as you originally upload them. If you specify Yes, the images will be cropped/resized to fit the slideshow better which is the recommended setting.', $this -> plugin_name)); ?></th>
				<td>
					<label><input <?php echo (empty($styles['resizeimages']) || $styles['resizeimages'] == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="styles[resizeimages]" value="Y" id="styles.resizeimages_Y" /> <?php _e('Yes', $this -> plugin_name); ?></label>
					<label><input <?php echo ($styles['resizeimages'] == "N") ? 'checked="checked"' : ''; ?> type="radio" name="styles[resizeimages]" value="N" id="styles.resizeimages_N" /> <?php _e('No', $this -> plugin_name); ?></label>
					<span class="howto"><?php _e('Should images be resized proportionally to fit the width of the slideshow area?', $this -> plugin_name); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	
	<div id="resizeimages_div" style="display:<?php echo (!empty($styles['resizeimages']) && $styles['resizeimages'] == "Y") ? 'block' : 'none'; ?>;">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="resizeimagescrop_Y"><?php _e('Crop', $this -> plugin_name); ?></label></th>
					<td>
						<label><input <?php echo (!empty($resizeimagescrop) && $resizeimagescrop == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="resizeimagescrop" value="Y" id="resizeimagescrop_Y" /> <?php _e('Yes', $this -> plugin_name); ?></label>
						<label><input <?php echo (!empty($resizeimagescrop) && $resizeimagescrop == "N") ? 'checked="checked"' : ''; ?> type="radio" name="resizeimagescrop" value="N" id="resizeimagescrop_N" /> <?php _e('No', $this -> plugin_name); ?></label>
						<span class="howto"><?php _e('Should images be cropped?', $this -> plugin_name); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="styles.width"><?php _e('Gallery Width', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('The width of the slideshow in pixels.', $this -> plugin_name)); ?></th>
				<td>
					<input style="width:45px;" id="styles.width" type="text" name="styles[width]" value="<?php echo $styles['width']; ?>" /> <?php _e('px', $this -> plugin_name); ?>
					<span class="howto"><?php _e('Width of the slideshow gallery', $this -> plugin_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="styles.height"><?php _e('Gallery Height', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('The height of the slideshow in pixels.', $this -> plugin_name)); ?></th>
				<td>
					<input style="width:45px;" id="styles.height" type="text" name="styles[height]" value="<?php echo $styles['height']; ?>" /> <?php _e('px', $this -> plugin_name); ?>
					<span class="howto"><?php _e('Height of the slideshow gallery', $this -> plugin_name); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="autoheight"><?php _e('Auto Height', $this -> plugin_name); ?></label></th>
			<td>
				<label><input <?php echo (!empty($autoheight)) ? 'checked="checked"' : ''; ?> type="checkbox" name="autoheight" value="1" id="autoheight" /> <?php _e('Yes, automatically adjust the slideshow height for each slide', $this -> plugin_name); ?></label>
			</td>
		</tr>
		<tr>
			<th><label for="styles.border"><?php _e('Slideshow Border', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('This is a CSS style for the border around the entire slideshow. You can use a value such as "1px #FFFFFF solid" to display a 1 pixel, white, solid border or even a value such as "none" for no border at all.', $this -> plugin_name)); ?></th>
			<td>
				<input type="text" name="styles[border]" value="<?php echo $styles['border']; ?>" id="styles.border" style="width:145px;" />
				<span class="howto"><?php echo sprintf(__('Border style/color for the entire slideshow wrapper eg. %s', $this -> plugin_name), "1px #000000 solid"); ?>
			</td>
		</tr>
		<tr>
			<th><label for="stylesbackground"><?php _e('Slideshow Background', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('The background which will display behind the entire slideshow. It is behind the slides, thumbnails, etc.', $this -> plugin_name)); ?></th>
			<td>				
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Slideshow Background', $this -> plugin_name); ?></span></legend>
					<div class="wp-picker-container">
						<a tabindex="0" id="stylesbackgroundbutton" class="wp-color-result" style="background-color:<?php echo $styles['background']; ?>;" title="Select Color"></a>
						<span class="wp-picker-input-wrap">
							<input type="text" name="styles[background]" id="stylesbackground" value="<?php echo $styles['background']; ?>" class="wp-color-picker" style="display: none;" />
						</span>
					</div>
				</fieldset>
				
				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#stylesbackground').iris({
						hide: true,
						change: function(event, ui) {
							jQuery('#stylesbackgroundbutton').css('background-color', ui.color.toString());
						}
					});
					
					jQuery('#stylesbackground').click(function(event) {
						event.stopPropagation();
					});
				
					jQuery('#stylesbackgroundbutton').click(function(event) {							
						jQuery(this).attr('title', "Current Color");
						jQuery('#stylesbackground').iris('toggle').toggle();								
						event.stopPropagation();
					});
					
					jQuery('html').click(function() {
						jQuery('#stylesbackground').iris('hide').hide();
						jQuery('#stylesbackgroundbutton').attr('title', "Select Color");
					});
				});
				</script>
				
				<span class="howto"><?php echo sprintf(__('Background color (hexidecimal) of the entire slideshow wrapper eg. %s', $this -> plugin_name), "#FFFFFF"); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="styles.infobackground"><?php _e('Information Background', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('The background of the information bar which shows the title and description of each slide. It is automatically half transparent so that it is not obtrusive to the slide image below it though.', $this -> plugin_name)); ?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Information Background', $this -> plugin_name); ?></span></legend>
					<div class="wp-picker-container">
						<a tabindex="0" id="stylesinfobackgroundbutton" class="wp-color-result" style="background-color:<?php echo $styles['infobackground']; ?>;" title="Select Color"></a>
						<span class="wp-picker-input-wrap">
							<input type="text" name="styles[infobackground]" id="stylesinfobackground" value="<?php echo $styles['infobackground']; ?>" class="wp-color-picker" style="display: none;" />
						</span>
					</div>
				</fieldset>
				
				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#stylesinfobackground').iris({
						hide: true,
						change: function(event, ui) {
							jQuery('#stylesinfobackgroundbutton').css('background-color', ui.color.toString());
						}
					});
					
					jQuery('#stylesinfobackground').click(function(event) {
						event.stopPropagation();
					});
				
					jQuery('#stylesinfobackgroundbutton').click(function(event) {							
						jQuery(this).attr('title', "Current Color");
						jQuery('#stylesinfobackground').iris('toggle').toggle();								
						event.stopPropagation();
					});
					
					jQuery('html').click(function() {
						jQuery('#stylesinfobackground').iris('hide').hide();
						jQuery('#stylesinfobackgroundbutton').attr('title', "Select Color");
					});
				});
				</script>
				
				<span class="howto"><?php echo sprintf(__('Background color (hexidecimal) of the information bar eg. %s', $this -> plugin_name), "#000000"); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="styles.infocolor"><?php _e('Information Text Color', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('This is the color of the text of the title and description of each slide which shows in the information bar.', $this -> plugin_name)); ?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Information Text Color', $this -> plugin_name); ?></span></legend>
					<div class="wp-picker-container">
						<a tabindex="0" id="stylesinfocolorbutton" class="wp-color-result" style="background-color:<?php echo $styles['infocolor']; ?>;" title="Select Color"></a>
						<span class="wp-picker-input-wrap">
							<input type="text" name="styles[infocolor]" id="stylesinfocolor" value="<?php echo $styles['infocolor']; ?>" class="wp-color-picker" style="display: none;" />
						</span>
					</div>
				</fieldset>
				
				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#stylesinfocolor').iris({
						hide: true,
						change: function(event, ui) {
							jQuery('#stylesinfocolorbutton').css('background-color', ui.color.toString());
						}
					});
					
					jQuery('#stylesinfocolor').click(function(event) {
						event.stopPropagation();
					});
				
					jQuery('#stylesinfocolorbutton').click(function(event) {							
						jQuery(this).attr('title', "Current Color");
						jQuery('#stylesinfocolor').iris('toggle').toggle();								
						event.stopPropagation();
					});
					
					jQuery('html').click(function() {
						jQuery('#stylesinfocolor').iris('hide').hide();
						jQuery('#stylesinfocolorbutton').attr('title', "Select Color");
					});
				});
				</script>
				
				<span class="howto"><?php echo sprintf(__('Text color (hexidecimal) of the information bar content eg. %s', $this -> plugin_name), "#FFFFFF"); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="thumbactive"><?php _e('Thumbnail Active Border', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('This is the color of the border which displays on the active thumbnail of the slide currently displaying in the slideshow.', $this -> plugin_name)); ?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Thumbnail Active Border', $this -> plugin_name); ?></span></legend>
					<div class="wp-picker-container">
						<a tabindex="0" id="stylesthumbactivebutton" class="wp-color-result" style="background-color:<?php echo $styles['thumbactive']; ?>;" title="Select Color"></a>
						<span class="wp-picker-input-wrap">
							<input type="text" name="styles[thumbactive]" id="stylesthumbactive" value="<?php echo $styles['thumbactive']; ?>" class="wp-color-picker" style="display: none;" />
						</span>
					</div>
				</fieldset>
				
				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#stylesthumbactive').iris({
						hide: true,
						change: function(event, ui) {
							jQuery('#stylesthumbactivebutton').css('background-color', ui.color.toString());
						}
					});
					
					jQuery('#stylesthumbactive').click(function(event) {
						event.stopPropagation();
					});
				
					jQuery('#stylesthumbactivebutton').click(function(event) {							
						jQuery(this).attr('title', "Current Color");
						jQuery('#stylesthumbactive').iris('toggle').toggle();								
						event.stopPropagation();
					});
					
					jQuery('html').click(function() {
						jQuery('#stylesthumbactive').iris('hide').hide();
						jQuery('#stylesthumbactivebutton').attr('title', "Select Color");
					});
				});
				</script>
				
				<span class="howto"><?php echo sprintf(__('Border color (hexidecimal) for the active image thumbnail eg. %s', $this -> plugin_name), "#FFFFFF"); ?></span>
			</td>
		</tr>
	</tbody>
</table>