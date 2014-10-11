<!-- Permissions -->

<?php

global $wp_roles;
$permissions = $this -> get_option('permissions');

?>

<?php if (current_user_can('edit_users') || is_super_admin()) : ?>
	<table class="form-table">
		<thead>
			<tr>
				<th>&nbsp;</th>
    			<?php foreach ($wp_roles -> role_names as $role_key => $role_name) : ?>
    				<th style="white-space:nowrap; font-weight:bold; text-align:center;">
    					<label>
    						<?php if ($role_key != "administrator") : ?><input type="checkbox" name="sectionsrolescheckall<?php echo $role_key; ?>" value="1" id="sectionsrolescheckall<?php echo $role_key; ?>" onclick="jqCheckAll(this, false, 'permissions[<?php echo $role_key; ?>]');" /><?php endif; ?>
							<?php echo $role_name; ?>
    					</label>
    				</th>	
    			<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($this -> sections)) : ?>
				<?php foreach ($this -> sections as $section_key => $section_name) : ?>
					<tr class="<?php echo $class = (empty($class)) ? 'arow' : ''; ?>">
						<th style="white-space:nowrap; text-align:right;"><?php echo $this -> Html -> section_name($section_key); ?></th>
						<?php foreach ($wp_roles -> role_names as $role_key => $role_name) : ?>
							<td style="text-align:center;">
								<input <?php echo ($role_key == "administrator") ? 'checked="checked" disabled="disabled"' : ''; ?> <?php echo (!empty($permissions[$role_key]) && in_array($section_key, $permissions[$role_key])) ? 'checked="checked"' : ''; ?> type="checkbox" name="permissions[<?php echo $role_key; ?>][]" value="<?php echo $section_key; ?>" id="" />
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
<?php endif; ?>