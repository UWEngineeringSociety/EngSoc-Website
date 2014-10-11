<?php
/**
 * Upgrade Functions
 *
 * @package     Ninja Forms
 * @subpackage  Admin/Upgrades
 * @copyright   Copyright (c) 2014, WP Ninjas
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       2.7
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Display Upgrade Notices
 *
 * @since 2.7
 * @return void
*/
function nf_show_upgrade_notices() {

	// Convert notifications
	if ( isset ( $_GET['page'] ) && $_GET['page'] == 'nf-processing' )
		return; // Don't show notices on the processing page.

	$n_conversion_complete = get_option( 'nf_convert_notifications_complete', false );

	if ( ! $n_conversion_complete ) {
		printf(
			'<div class="update-nag"><p>' . __( 'Ninja Forms needs to upgrade your form notifications, click <a href="%s">here</a> to start the upgrade.', 'ninja-forms' ) . '</p></div>',
			admin_url( 'index.php?page=nf-processing&action=convert_notifications' )
		);
	}

	if ( isset( $_GET['page'] ) && $_GET['page'] == 'nf-upgrades' )
		return; // Don't show notices on the upgrades page

	$step = get_option( 'nf_convert_subs_step' );

	if ( $step != 'complete' ) {
		if ( empty( $step ) ) {
			$step = 1;
		}
		printf(
			'<div class="update-nag"><p>' . __( 'Ninja Forms needs to upgrade the submissions table, click <a href="%s">here</a> to start the upgrade.', 'ninja-forms' ) . '</p></div>',
			admin_url( 'index.php?page=nf-upgrades&nf-upgrade=upgrade_subs_to_cpt&step=' . $step )
		);
	}

	$upgrade_notice = get_option( 'nf_upgrade_notice' );

	if ( $upgrade_notice != 'closed' ) {
		printf(
			'<div class="update-nag"><p>' . __( 'Thank you for updating to version 2.7 of Ninja Forms. Please update any Ninja Forms extensions from ', 'ninja-forms' ) . '<a href="http://ninjaforms.com/your-account/purchases/"</a>ninjaforms.com</a>. <a href="%s">Dismiss this notice</a></p></div>',
			add_query_arg( array( 'nf_action' => 'dismiss_upgrade_notice' ) )
		);
	}

	if ( defined( 'NINJA_FORMS_UPLOADS_VERSION' ) && version_compare( NINJA_FORMS_UPLOADS_VERSION, '1.3.5' ) == -1 ) {
		echo '<div class="error"><p>' . __( 'Your version of the Ninja Forms File Upload extension isn\'t compatible with version 2.7 of Ninja Forms. It needs to be at least version 1.3.5. Please update this extension at ', 'ninja-forms' ) . '<a href="http://ninjaforms.com/your-account/purchases/"</a>ninjaforms.com</a></p></div>';
	}

	if ( defined( 'NINJA_FORMS_SAVE_PROGRESS_VERSION' ) && version_compare( NINJA_FORMS_SAVE_PROGRESS_VERSION, '1.1.3' ) == -1 ) {
		echo '<div class="error"><p>' . __( 'Your version of the Ninja Forms Save Progress extension isn\'t compatible with version 2.7 of Ninja Forms. It needs to be at least version 1.1.3. Please update this extension at ', 'ninja-forms' ) . '<a href="http://ninjaforms.com/your-account/purchases/"</a>ninjaforms.com</a></p></div>';
	}
}
add_action( 'admin_notices', 'nf_show_upgrade_notices' );

/**
 * Triggers all upgrade functions
 *
 * This function is usually triggered via AJAX
 *
 * @since 2.7
 * @return void
*/
function nf_trigger_upgrades() {
	if ( DOING_AJAX )
		die( 'complete' ); // Let AJAX know that the upgrade is complete
}
add_action( 'wp_ajax_edd_trigger_upgrades', 'nf_trigger_upgrades' );

/**
 * Upgrades for Ninja Forms v2.7 and Submission Custom Post Type.
 *
 * @since 2.7
 * @return void
 */
function nf_v27_upgrade_subs_to_cpt() {
	//Bail if we aren't in the admin.
	if ( ! is_admin() )
		return false;

	// Bail if we don't have the appropriate permissions.
	if ( is_multisite() ) {
		if ( ! is_super_admin() )
			return false;
	} else {
		if ( ! current_user_can( 'install_plugins' ) )
			return false;
	}

	ignore_user_abort( true );

	if ( ! nf_is_func_disabled( 'set_time_limit' ) && ! ini_get( 'safe_mode' ) ) {
		//set_time_limit( 0 );
	}

	$step   = isset( $_GET['step'] )  ? absint( $_GET['step'] )  : 1;
	$total  = isset( $_GET['total'] ) ? absint( $_GET['total'] ) : false;
	$number  = isset( $_GET['custom'] ) ? absint( $_GET['custom'] ) : 1;

	if ( get_option( 'nf_convert_subs_num' ) ) {
		$number = get_option( 'nf_convert_subs_num' );
	}

	$form_id  = isset( $_GET['form_id'] ) ? absint( $_GET['form_id'] ) : 0;

	update_option( 'nf_convert_subs_step', $step );

	$convert_subs = new NF_Convert_Subs();
	$old_sub_count = $convert_subs->count_old_subs();

	if( empty( $total ) || $total <= 1 ) {
		$total = round( ( $old_sub_count / 100 ), 0 ) + 2;
	}

	if ( $step <= $total ) {
		if ( $step == 1 ) {
			$begin = 0;
		} else {
			$begin = ( $step - 1 ) * 100;
		}

		$subs_results = $convert_subs->get_old_subs( $begin, 100 );

		if ( is_array( $subs_results ) && ! empty( $subs_results ) ) {

			foreach ( $subs_results as $sub ) {
				if ( $form_id != $sub['form_id'] ) {
					$form_id = $sub['form_id'];
					$number = 1;
				}
				$converted = get_option( 'nf_converted_subs' );
				if ( empty( $converted ) )
					$converted = array();

				if ( ! in_array( $sub['id'], $converted ) ) {
					$convert_subs->convert( $sub, $number );

					$converted[] = $sub['id'];
					update_option( 'nf_converted_subs', $converted );
					$number++;
					update_option( 'nf_convert_subs_num', $number );
				}
			}
		}

		$step++;

		$redirect = add_query_arg( array(
			'page'        	=> 'nf-upgrades',
			'nf-upgrade' 	=> 'upgrade_subs_to_cpt',
			'step'        	=> $step,
			'custom'      	=> $number,
			'total'       	=> $total,
			'form_id'		=> $form_id
		), admin_url( 'index.php' ) );
		wp_redirect( $redirect ); exit;

	} else {
		update_option( 'nf_convert_subs_step', 'complete' );
		delete_option( 'nf_convert_subs_num' );
		wp_redirect( admin_url( 'index.php?page=nf-about' ) ); exit;
	}
}
add_action( 'nf_upgrade_subs_to_cpt', 'nf_v27_upgrade_subs_to_cpt' );

/**
 * Keep our upgrade notice closed.
 *
 * @since 2.7
 * @return void
 */
function nf_dismiss_upgrade_notice() {
	update_option( 'nf_upgrade_notice', 'closed' );
	wp_redirect( remove_query_arg( 'nf_action' ) );
	exit;
}

add_action( 'nf_dismiss_upgrade_notice', 'nf_dismiss_upgrade_notice' );
