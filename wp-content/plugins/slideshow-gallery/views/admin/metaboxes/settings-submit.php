<!-- Settings Submit -->

<?php

$debugging = get_option('tridebugging');

?>

<div class="submitbox" id="submitpost">
	<div id="minor-publishing">
		<div id="misc-publishing-actions">
			<div class="misc-pub-section">
				<a href="<?php echo $this -> url; ?>&amp;method=reset" title="<?php _e('Reset all configuration settings to their default values', $this -> plugin_name); ?>" onclick="if (!confirm('<?php _e('Are you sure you wish to reset all configuration settings?', $this -> plugin_name); ?>')) { return false; }"><?php _e('Reset to Defaults', $this -> plugin_name); ?></a>
			</div>
			<div class="misc-pub-section misc-pub-section-last">
				<label><input <?php echo (!empty($debugging) && $debugging == 1) ? 'checked="checked"' : ''; ?> type="checkbox" name="debugging" value="1" id="debugging" /> <?php _e('Turn on debugging', $this -> plugin_name); ?></label>
			</div>
		</div>
	</div>
	<div id="major-publishing-actions">
		<div id="publishing-action">
			<input class="button-primary button button-large" type="submit" name="save" value="<?php _e('Save Configuration', $this -> plugin_name); ?>" />
		</div>
		<br class="clear" />
	</div>
</div>