<?php header("Content-Type: text/css"); ?>

<?php $styles = array(); ?>
<?php foreach ($_GET as $skey => $sval) : ?>
	<?php $styles[$skey] = urldecode($sval); ?>
<?php endforeach; ?>
<?php 

$resheight = $styles['resheight'] . $styles['resheighttype']; 
$sliderheight = $styles['thumbheight'] + 14;
$unique = $styles['unique'];

?>
<?php if (!empty($styles['wrapperid'])) : ?>
	ul.slideshow<?php echo $unique; ?> { list-style:none !important; color:#fff; }
	ul.slideshow<?php echo $unique; ?> span { display:none; }
	#<?php echo $styles['wrapperid']; ?> { position:relative; width:100%; background:<?php echo $styles['background']; ?>; padding:0 0 0 0; border:<?php echo $styles['border']; ?>; margin:0; display:none; }
	#<?php echo $styles['wrapperid']; ?> * { margin:0; padding:0; }
	#<?php echo $styles['wrapperid']; ?> #fullsize<?php echo $unique; ?> { position:relative; z-index:1; overflow:hidden; width:100%; height:<?php echo $resheight; ?><?php if (!empty($styles['autoheight']) && $styles['autoheight'] == "true") : ?> !important<?php endif; ?>; clear:both; border: none; }
	#<?php echo $styles['wrapperid']; ?> #information<?php echo $unique; ?> { text-align:left; font-family:Verdana, Arial, Helvetica, sans-serif !important; position:absolute; bottom:0; width:100%; height:0; background:<?php echo $styles['infobackground']; ?>; color:<?php echo $styles['infocolor']; ?>; overflow:hidden; z-index:300; opacity:.7; filter:alpha(opacity=70); }
	#<?php echo $styles['wrapperid']; ?> #information<?php echo $unique; ?> h3 { color:<?php echo $styles['infocolor']; ?>; padding:4px 8px 3px; margin:0 !important; font-size:16px; font-weight:bold; }
	#<?php echo $styles['wrapperid']; ?> #information<?php echo $unique; ?> p { color:<?php echo $styles['infocolor']; ?>; padding:0 8px 8px; margin:0 !important; font-size: 14px; font-weight:normal; }
	#<?php echo $styles['wrapperid']; ?> #image<?php echo $unique; ?> { width:100%; }
	#<?php echo $styles['wrapperid']; ?> #image<?php echo $unique; ?> img { border:none; height:auto; width:100%; margin:0 auto; display:block; }
	#<?php echo $styles['wrapperid']; ?> .imgnav { position:absolute; width:25%; height:100%; cursor:pointer; z-index:250; }
	#<?php echo $styles['wrapperid']; ?> #imgprev<?php echo $unique; ?> { left:0; background:url('images/left.gif') left center no-repeat; }
	#<?php echo $styles['wrapperid']; ?> #imgnext<?php echo $unique; ?> { right:0; background:url('images/right.gif') right center no-repeat; }
	#<?php echo $styles['wrapperid']; ?> #imglink<?php echo $unique; ?> { position:absolute; zoom:1; background-color:#ffffff; height:100%; <?php if (!empty($styles['shownav']) && $styles['shownav'] == "true") : ?>width:50%; left:25%; right:20%;<?php else : ?>width:100%; left:0;<?php endif; ?> z-index:149; opacity:0; filter:alpha(opacity=0); }
	#<?php echo $styles['wrapperid']; ?> .linkhover { background:transparent url('images/link.gif') center center no-repeat !important; text-indent:-9999px; opacity:.4 !important; filter:alpha(opacity=40) !important; }
	#<?php echo $styles['wrapperid']; ?> #thumbnails<?php echo $unique; ?> { background:<?php echo $styles['background']; ?>; height:<?php echo $sliderheight; ?>px; }
	#<?php echo $styles['wrapperid']; ?> .thumbstop { margin-bottom:8px !important; }
	#<?php echo $styles['wrapperid']; ?> .thumbsbot { margin-top:8px !important; }
	#<?php echo $styles['wrapperid']; ?> #slideleft<?php echo $unique; ?> { float:left; position:absolute; left:0; z-index:150; width:20px; height:<?php echo $sliderheight; ?>px; background:url('images/scroll-left.gif') center center no-repeat; background-color:#222; }
	#<?php echo $styles['wrapperid']; ?> #slideleft<?php echo $unique; ?>:hover { background-color:#333; }
	#<?php echo $styles['wrapperid']; ?> #slideright<?php echo $unique; ?> { float:right; position:absolute; right:0; z-index:150; width:20px; height:<?php echo $sliderheight; ?>px; background:#222 url('images/scroll-right.gif') center center no-repeat; }
	#<?php echo $styles['wrapperid']; ?> #slideright<?php echo $unique; ?>:hover { background-color:#333; }
	#<?php echo $styles['wrapperid']; ?> #slidearea<?php echo $unique; ?> { float:left; position:absolute; z-index:149; background:<?php echo $styles['background']; ?>; width:calc(100% - 40px); margin:0 20px; height:<?php echo $sliderheight; ?>px; overflow:hidden; }
	#<?php echo $styles['wrapperid']; ?> #slider<?php echo $unique; ?> { position:absolute; width:<?php echo $styles['sliderwidth']; ?>px !important; left:0; height:<?php echo $sliderheight; ?>px; padding:3px 0 0 5px; }
	#<?php echo $styles['wrapperid']; ?> #slider<?php echo $unique; ?> img { cursor:pointer; border:1px solid #666; padding:2px; float:left !important; }
	#<?php echo $styles['wrapperid']; ?> #spinner<?php echo $unique; ?> { position:relative; top:50%; left:45%; text-align:left; }	
	#<?php echo $styles['wrapperid']; ?> #spinner<?php echo $unique; ?> img { border:none; }
	
	<?php if (!empty($styles['infohideonmobile'])) : ?>
		@media (max-width:480px) {
			.slideshow-information {
				display: none !important;
			}
		}
	<?php endif; ?>
<?php endif; ?>