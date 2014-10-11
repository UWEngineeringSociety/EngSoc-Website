<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package GovPress
 */
?>

		</div><!-- #content -->
	</div><!-- .col-width -->

	<?php
		/*
		 * A sidebar in the footer? Yep. You can can customize
		 * your footer with three columns of widgets.
		 */
		if ( ! is_404() )
			get_sidebar( 'footer' );
	?>

	<?php
	$fclass = 'site-footer no-widgets';
	if ( is_active_sidebar( 'footer-text' ) ) {
		$fclass = 'site-footer widgets';
	} ?>

	<footer class="<?php echo $fclass; ?>" role="contentinfo">
		<div class="col-width">
			<?php if ( is_active_sidebar( 'footer-text' ) ) { ?>
				<div class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-text' ); ?>
				</div>
			<?php } else { ?>
				<div class="footer-text-right">
				<br>
					<div style="opacity:0.8; float:right;"><a href="http://www.facebook.com/uwengsoc"><img src="http://engsocwp.uwaterloo.ca/wp-content/uploads/2014/08/facebookp.png" width="30" height="30"/></a>
					<a href="http://www.twitter.com/uwengsoc"><img src="http://engsocwp.uwaterloo.ca/wp-content/uploads/2014/08/twitterp.png" width="30" height="30"/></a>
<!-- 					<a href="http://www.youtube.com/uwengsoc"><img src="http://engsocwp.uwaterloo.ca/wp-content/uploads/2014/08/youtube.png" width="30" height="30"/></a>
 -->					<a href="http://www.youtube.com/uwengsoc"><img src="http://engsocwp.uwaterloo.ca/wp-content/uploads/2014/08/rssp.png" width="30" height="30"/></a>
					<a href="https://www.flickr.com/photos/engsoctsn/sets/"><img src="http://engsocwp.uwaterloo.ca/wp-content/uploads/2014/08/flickrp.png" width="30" height="30"/></a></div>
					<?php printf('<br><br><br>Last Updated: June 20, 2014<br>'); ?>
					<?php printf('©2008-2014 UW Engineering Society<br>'); ?>
					<?php printf('All Rights Reserved'); ?>
				</div>
				<div class="footer-text-left">
					<div id="contact-us"><?php printf('Contact Us'); ?></div>
					<?php printf('info@engsoc.uwaterloo.ca<br>'); ?>
					<?php printf('<br><b>University of Waterloo Engineering Society</b><br>'); ?>
					<?php printf('CPH 1327, 200 University Avenue West<br>'); ?>
					<?php printf('Waterloo, Ontario, Canada N2L 3G1<br>'); ?>
					<?php printf('519-888-4567 x32323'); ?>
				</div>
			<?php } ?>
		</div><!-- .col-width -->
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
