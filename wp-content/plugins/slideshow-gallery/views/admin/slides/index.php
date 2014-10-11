<div class="wrap <?php echo $this -> pre; ?> slideshow">
	<h2><?php _e('Manage Slides', $this -> plugin_name); ?> <?php echo $this -> Html -> link(__('Add New'), $this -> url . '&amp;method=save', array('class' => "add-new-h2")); ?></h2>

	<?php if (!empty($slides)) : ?>	
		<form id="posts-filter" action="<?php echo $this -> url; ?>" method="post">
			<ul class="subsubsub">
				<li><?php echo $paginate -> allcount; ?> <?php _e('slides', $this -> plugin_name); ?></li>
			</ul>
		</form>
	<?php endif; ?>
	
	<?php $this -> render('slides' . DS . 'loop', array('slides' => $slides, 'paginate' => $paginate), true, 'admin'); ?>
</div>