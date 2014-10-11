<!-- Images Tester -->

<?php

$newpath = 2;
if (!empty($_GET['changepath'])) {
	switch ($_GET['changepath']) {
		case 1			:
			$newpath = 2;
			break;
		case 2			:
			$newpath = 3;
			break;
		case 3			:
			$newpath = 1;
			break;
	}
}

?>

<div class="wrap slideshow">
	<h2>Slideshow Images Tester</h2>
	
	<div style="float:none;" class="subsubsub">
		<a href="?page=<?php echo $this -> sections -> settings; ?>"><?php _e('&larr; Back to Configuration', $this -> plugin_name); ?></a>
	</div>
	
	<?php if (!empty($slide)) : ?>
		<p><?php _e('Kindly follow these steps to fix broken images:', $this -> plugin_name); ?></p>
	
		<ol>
			<li>
				<h3><?php _e('Check Original Image', $this -> plugin_name); ?></h3>
				<p><?php echo __('Ensure that the original image exists by clicking the button below to open the image.', $this -> plugin_name); ?><br/>
				<?php echo sprintf(__('If the image does not open, go to Slideshow > Manage Slides and reupload the image to the slide for slide ID %s'), $slide -> id); ?><br/>
				<?php echo __('If it does open, you can continue to step 2 below.', $this -> plugin_name); ?></p>
				<p><a class="button" href="<?php echo GalleryHtmlHelper::image_url($slide -> image); ?>" target="_blank"><?php echo sprintf(__('Open Original Image: %s', $this -> plugin_name), __($slide -> title)); ?></a></p>
			</li>
			<li>
				<h3><?php _e('Test Resized/Cropped Image', $this -> plugin_name); ?></h3>
				<p><?php _e('Below is a button to open the resized image in a new tab and then an actual 100 by 100 pixels sample of the image.', $this -> plugin_name); ?><br/>
				<?php _e('If both the image from the button below and the sample below works fine, there is nothing wrong with the image cropping procedure.', $this -> plugin_name); ?><br/>
				<?php _e('If neither of them work, there is something wrong, continue to step 3 below.', $this -> plugin_name); ?></p>
				<p><a class="button" target="_blank" href="<?php echo $this -> Html -> bfithumb_image_src($slide -> image_path, 100, 100, 100); ?>"><?php echo sprintf(__('Open Resized Image: %s', $this -> plugin_name), __($slide -> title)); ?></a></p>
				<p><?php echo $this -> Html -> bfithumb_image($slide -> image_path, 100, 100, 100, "slideshow_dropshadow"); ?></p>
			</li>
			<li>
				<h3><?php _e('Analyze Error Message', $this -> plugin_name); ?></h3>
				<p><?php _e('When you clicked the "Open Resized Image" button above, it opened the BFI Thumb URL of the image.', $this -> plugin_name); ?><br/>
				<?php _e('BFI Thumb will give you a descriptive error telling you what is wrong.', $this -> plugin_name); ?></p>
				
				<p><?php _e('If the error is simply "Could not find the internal image you specified." then you now your "Images Path" setting is incorrect.', $this -> plugin_name); ?><br/>
				<?php _e('With that being the case, let us try a different "Images Path" to see if that resolves it. Click "Try Different Path" below.', $this -> plugin_name); ?><br/>
				<?php _e('Alternatively, if you know what the path should be, go and change it under Slideshow > Configuration > General Settings.', $this -> plugin_name); ?></p>				
			</li>
		</ol>
	<?php else : ?>
		<p class="slideshow_error"><?php _e('No slide available. In order to use the tester, add at least one slide under Slideshow > Manage Slides.', $this -> plugin_name); ?></p>
	<?php endif; ?>
</div>