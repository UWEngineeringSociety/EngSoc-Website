<!-- General Settings -->

<?php

$autospeed = $this -> get_option('autospeed');
$fadespeed = $this -> get_option('fadespeed');
$navopacity = $this -> get_option('navopacity');
$navhover = $this -> get_option('navhover');
$infospeed = $this -> get_option('infospeed');
$infohideonmobile = $this -> get_option('infohideonmobile');
$thumbopacity = $this -> get_option('thumbopacity');
$thumbscrollspeed = $this -> get_option('thumbscrollspeed');

?>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="autoslideY"><?php _e('Auto Slide', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('Turn this on so that the slideshow can automatically slide through the slides.<br/><br/><strong>Override per slideshow:</strong> Using parameter <code>auto</code> with value <code>true</code> or <code>false</code> eg. <code>[tribulant_slideshow auto="false"]</code>.', $this -> plugin_name)); ?></th>
			<td>
				<label><input onclick="jQuery('#autoslide_div').show();" <?php echo ($this -> get_option('autoslide') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="autoslide" value="Y" id="autoslideY" /> <?php _e('Yes', $this -> plugin_name); ?></label>
				<label><input onclick="jQuery('#autoslide_div').hide();" <?php echo ($this -> get_option('autoslide') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="autoslide" value="N" id="autoslideN" /> <?php _e('No', $this -> plugin_name); ?></label>
				<span class="howto"><?php _e('Should image slides automatically slide?', $this -> plugin_name); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<div id="autoslide_div" style="display:<?php echo ($this -> get_option('autoslide') == "Y") ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="alwaysauto_true"><?php _e('Always Auto', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('With the "Auto Slide" setting turned on above, the slideshow will automatically go through the slides but it will stop automatically navigating once the user started navigating. You can override this behaviour and force automatic navigation by turning this on.', $this -> plugin_name)); ?></th>
				<td>
					<label><input <?php echo ($this -> get_option('alwaysauto') == "true") ? 'checked="checked"' : ''; ?> type="radio" name="alwaysauto" value="true" id="alwaysauto_true" /> <?php _e('Yes', $this -> plugin_name); ?></label>
					<label><input <?php echo ($this -> get_option('alwaysauto') == "false") ? 'checked="checked"' : ''; ?> type="radio" name="alwaysauto" value="false" id="alwaysauto_false" /> <?php _e('No', $this -> plugin_name); ?></label>
					<span class="howto"><?php _e('Should the slideshow always continue auto sliding, even after navigation by the user?', $this -> plugin_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="autospeed"><?php _e('Auto Speed', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('Set the speed at which auto sliding will occur, meaning the interval between auto sliding. The default is 10 which is recommended but you can specify a smaller number for quicker sliding or a larger number for slower sliding.', $this -> plugin_name)); ?></th>
				<td>
					<input type="hidden" style="width:45px;" name="autospeed" value="<?php echo $autospeed; ?>" id="autospeed" />
					<div id="autospeed_slider"></div>
					<span class="slider-value" id="autospeed_slider_value"><?php echo (empty($autospeed)) ? 0 : $autospeed; ?></span>
					<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#autospeed_slider').slider({
							min: 1, 
							max: 20,
							value: <?php echo (empty($autospeed)) ? 0 : $autospeed; ?>,
							slide: function(event, ui) {
								jQuery('#autospeed').val(ui.value);
								jQuery('#autospeed_slider_value').text(ui.value);
							}
						});
					});
					</script>
					<span class="howto"><?php _e('Speed for auto sliding. Lower number for shorter interval between images.', $this -> plugin_name); ?> <small><?php _e('(Default/Recommended: 10)', $this -> plugin_name); ?></small></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="fadespeed"><?php _e('Image Fading Speed', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('Choose the speed at which images fade in and out. The default is 10 and a number between 1 and 20 is recommended. Use a low number for quick fading and a higher number for slower fading.', $this -> plugin_name)); ?></th>
			<td>
				<input style="width:45px;" type="hidden" name="fadespeed" value="<?php echo $fadespeed; ?>" id="fadespeed" />
				<div id="fadespeed_slider"></div>
				<span class="slider-value" id="fadespeed_slider_value"><?php echo (empty($fadespeed)) ? 0 : $fadespeed; ?></span>
				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#fadespeed_slider').slider({
						min: 1, 
						max: 20,
						value: <?php echo (empty($fadespeed)) ? 0 : $fadespeed; ?>,
						slide: function(event, ui) {
							jQuery('#fadespeed').val(ui.value);
							jQuery('#fadespeed_slider_value').text(ui.value);
						}
					});
				});
				</script>
				<span class="howto"><?php _e('Speed for fading of images. Lower number for quicker fading of images.', $this -> plugin_name); ?> <small><?php _e('(Default: 10, Recommended: 1-20)', $this -> plugin_name); ?><br/></small></span>
			</td>
		</tr>
		<tr>
			<th><label for="shownav_Y"><?php _e('Show Image Navigation', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('Turn this on to show the Next and Previous arrows on either sides of the slideshow for the user to navigate through slides. Once turned on, you can set the opacity of these navigation arrows below.', $this -> plugin_name)); ?></th>
			<td>
				<label><input <?php echo ($this -> get_option('shownav') == "Y") ? 'checked="checked"' : ''; ?> onclick="jQuery('#shownavdiv').show();" type="radio" name="shownav" value="Y" id="shownav_Y" /> <?php _e('Yes', $this -> plugin_name); ?></label>
				<label><input <?php echo ($this -> get_option('shownav') == "N") ? 'checked="checked"' : ''; ?> onclick="jQuery('#shownavdiv').hide();" type="radio" name="shownav" value="N" id="shownav_N" /> <?php _e('No', $this -> plugin_name); ?></label>
				<span class="howto"><?php _e('Show next/previous buttons on the image for navigation purposes?', $this -> plugin_name); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<div id="shownavdiv" style="display:<?php echo ($this -> get_option('shownav') == "Y") ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="navopacity"><?php _e('Navigation Default Opacity', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('The default state opacity of the left/right navigation arrows. This is a percentage value and you can specify anything between 0% and 100% as needed.', $this -> plugin_name)); ?></th>
				<td>
					<input type="hidden" name="navopacity" value="<?php echo $navopacity; ?>" id="navopacity" style="width:45px;" />
					<div id="navopacity_slider"></div>
					<span class="slider-value" id="navopacity_slider_value"><?php echo (empty($navopacity)) ? 0 : $navopacity; ?></span>
					<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#navopacity_slider').slider({
							min: 0, 
							max: 100,
							value: <?php echo (empty($navopacity)) ? 0 : $navopacity; ?>,
							slide: function(event, ui) {
								jQuery('#navopacity').val(ui.value);
								jQuery('#navopacity_slider_value').text(ui.value);
							}
						});
					});
					</script>
					
					<span class="howto"><?php _e('Opacity of the next/previous buttons by default.', $this -> plugin_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="navhover"><?php _e('Navigation Hover Opacity', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('The hover state opacity of the left/right navigation arrows. This is the opacity when the user hovers with the mouse cursor over the arrow image. Percentage value between 0% and 100%', $this -> plugin_name)); ?></th>
				<td>
					<input type="hidden" name="navhover" value="<?php echo $navhover; ?>" id="navhover" style="width:45px;" />
					<div id="navhover_slider"></div>
					<span class="slider-value" id="navhover_slider_value"><?php echo (empty($navhover)) ? 0 : $navhover; ?></span>
					<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#navhover_slider').slider({
							min: 0, 
							max: 100,
							value: <?php echo (empty($navhover)) ? 0 : $navhover; ?>,
							slide: function(event, ui) {
								jQuery('#navhover').val(ui.value);
								jQuery('#navhover_slider_value').text(ui.value);
							}
						});
					});
					</script>
					<span class="howto"><?php _e('Opacity of the next/previous buttons when they are hovered.', $this -> plugin_name); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="informationY"><?php _e('Show Information', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('Should the information bar be shown on slides? Turn this on to show a bar on each slide with the title and description of the slide.', $this -> plugin_name)); ?></th>
			<td>
				<label><input onclick="jQuery('#information_div').show();" <?php echo ($this -> get_option('information') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="information" value="Y" id="informationY" /> <?php _e('Yes', $this -> plugin_name); ?></label>
				<label><input onclick="jQuery('#information_div').hide();" <?php echo ($this -> get_option('information') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="information" value="N" id="informationN" /> <?php _e('No', $this -> plugin_name); ?></label>
				<span class="howto"><?php _e('Should the information bar be shown on slides?', $this -> plugin_name); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<div id="information_div" style="display:<?php echo ($this -> get_option('information') == "Y") ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="infospeed"><?php _e('Information Speed', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('Specify the speed at which the information bar will slide up and down as the slide is shown and hidden.', $this -> plugin_name)); ?></th>
				<td>
					<input type="hidden" style="width:45px;" name="infospeed" value="<?php echo $infospeed; ?>" id="infospeed" />
					<div id="infospeed_slider"></div>
					<span class="slider-value" id="infospeed_slider_value"><?php echo (empty($infospeed)) ? 0 : $infospeed; ?></span>
					<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#infospeed_slider').slider({
							min: 1, 
							max: 20,
							value: <?php echo (empty($infospeed)) ? 0 : $infospeed; ?>,
							slide: function(event, ui) {
								jQuery('#infospeed').val(ui.value);
								jQuery('#infospeed_slider_value').text(ui.value);
							}
						});
					});
					</script>
					<span class="howto"><?php _e('Speed at which the information bar will slide in and out.', $this -> plugin_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="infohideonmobile"><?php _e('Hide On Mobiles', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('With a responsive layout turned on, the slideshow will respond in width on mobile devices and the information bar tends to overlap the entire slide since it increases in height as it reduces in width. You can tick/check this setting to hide the information bar on mobile devices so that the slides remain fully visible.', $this -> plugin_name)); ?></th>
				<td>
					<label><input <?php echo (!empty($infohideonmobile)) ? 'checked="checked"' : ''; ?> type="checkbox" name="infohideonmobile" value="1" id="infohideonmobile" /> <?php _e('Yes, hide the information bar on mobiles', $this -> plugin_name); ?></label>
					<span class="howto"><?php _e('Tick/check this to hide the information bar on mobiles', $this -> plugin_name); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="thumbnailsN"><?php _e('Show Thumbnails', $this -> plugin_name); ?></label>
			<?php echo $this -> Html -> help(__('Would you like to show a thumbnail bar/slider above/below the slideshow with the thumbnails of all the slides in the slideshow for easier navigation?', $this -> plugin_name)); ?></th>
			<td>
				<label><input onclick="jQuery('#thumbnails_div').show();" <?php echo ($this -> get_option('thumbnails') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="thumbnails" value="Y" id="thumbnailsY" /> <?php _e('Yes', $this -> plugin_name); ?></label>
				<label><input onclick="jQuery('#thumbnails_div').hide();" <?php echo ($this -> get_option('thumbnails') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="thumbnails" value="N" id="thumbnailsN" /> <?php _e('No', $this -> plugin_name); ?></label>
				<span class="howto"><?php _e('Should the thumbnails bar be shown for slides?', $this -> plugin_name); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<div id="thumbnails_div" style="display:<?php echo ($this -> get_option('thumbnails') == "Y") ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="thubmpositionbottom"><?php _e('Thumbnails Position', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('With the thumbnails turned on with the setting above, you can now specify the position of the thumbnail bar/slider. Either above or below the slideshow is available.', $this -> plugin_name)); ?></th>
				<td>
					<label><input <?php echo ($this -> get_option('thumbposition') == "top") ? 'checked="checked"' : ''; ?> type="radio" name="thumbposition" value="top" id="thumbpositiontop" /> <?php _e('Top', $this -> plugin_name); ?></label>
					<label><input <?php echo ($this -> get_option('thumbposition') == "bottom") ? 'checked="checked"' : ''; ?> type="radio" name="thumbposition" value="bottom" id="thumbpositionbottom" /> <?php _e('Bottom', $this -> plugin_name); ?></label>
					<span class="howto"><?php _e('Choose your preferred position of the thumbnails bar relative to the slideshow images.', $this -> plugin_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="thumbheight"><?php _e('Thumbnail Dimensions', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('Specify the width and height (dimensions) of the thumbnails in the thumbnail bar/slider which will show above/below the slideshow.', $this -> plugin_name)); ?></th>
				<td>
					<input class="widefat" style="width:45px;" type="text" name="thumbwidth" value="<?php echo esc_attr(stripslashes($this -> get_option('thumbwidth'))); ?>" id="thumbwidth" /> 
					<?php _e('x <!-- by -->', $this -> plugin_name); ?>
					<input class="widefat" style="width:45px;" type="text" name="thumbheight" value="<?php echo esc_attr(stripslashes($this -> get_option('thumbheight'))); ?>" id="thumbheight" />
					<?php _e('px <!-- pixels -->', $this -> plugin_name); ?>
					<span class="howto"><?php _e('Width and height of the thumbnails for the slides.', $this -> plugin_name); ?><br/>
					<?php _e('You may leave the width empty (not the height) to crop proportionally.', $this -> plugin_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="thumbopacity"><?php _e('Thumbnail Opacity', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('The opacity of the default state of thumbnails in the thumbnails bar/slider. The active thumbnail of the currently showing slide will be 100% opacity, always.', $this -> plugin_name)); ?></th>
				<td>
					<input style="width:45px;" type="hidden" name="thumbopacity" value="<?php echo $thumbopacity; ?>" id="thumbopacity" />
					<div id="thumbopacity_slider"></div>
					<span class="slider-value" id="thumbopacity_slider_value"><?php echo (empty($thumbopacity)) ? 0 : $thumbopacity; ?></span>
					<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#thumbopacity_slider').slider({
							min: 0, 
							max: 100,
							value: <?php echo (empty($thumbopacity)) ? 0 : $thumbopacity; ?>,
							slide: function(event, ui) {
								jQuery('#thumbopacity').val(ui.value);
								jQuery('#thumbopacity_slider_value').text(ui.value);
							}
						});
					});
					</script>
					<span class="howto"><?php _e('Default opacity of thumbnails when they are not hovered.', $this -> plugin_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="thumbscrollspeed"><?php _e('Thumbnails Scroll Speed', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('At which speed should the thumbnails bar/slider scroll when the left/right arrows are hovered by the user?', $this -> plugin_name)); ?></th>
				<td>
					<input type="hidden" class="widefat" style="width:45px;" name="thumbscrollspeed" value="<?php echo $thumbscrollspeed; ?>" id="thumbscrollspeed" />
					<div id="thumbscrollspeed_slider"></div>
					<span class="slider-value" id="thumbscrollspeed_slider_value"><?php echo (empty($thumbscrollspeed)) ? 0 : $thumbscrollspeed; ?></span>
					<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#thumbscrollspeed_slider').slider({
							min: 1, 
							max: 20,
							value: <?php echo (empty($thumbscrollspeed)) ? 0 : $thumbscrollspeed; ?>,
							slide: function(event, ui) {
								jQuery('#thumbscrollspeed').val(ui.value);
								jQuery('#thumbscrollspeed_slider_value').text(ui.value);
							}
						});
					});
					</script>
					<span class="howto"><?php _e('Speed at which the thumbnails will scroll.', $this -> plugin_name); ?> <small><?php _e('(Default:5, Recommended: 1-20)', $this -> plugin_name); ?></small></span>
				</td>
			</tr>
			<tr>
				<th><label for="thumbspacing"><?php _e('Thumbnail Spacing', $this -> plugin_name); ?></label>
				<?php echo $this -> Html -> help(__('This is a simple margin setting to specify the space between the thumbnails in the thumbnails bar/slider above/below the slideshow.', $this -> plugin_name)); ?></th>
				<td>
					<input type="text" style="width:45px;" name="thumbspacing" value="<?php echo $this -> get_option('thumbspacing'); ?>" id="thumbspacing" /> <?php _e('px', $this -> plugin_name); ?>
					<span class="howto"><?php _e('Horizontal margin/spacing in pixels between thumbnail images.', $this -> plugin_name); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>