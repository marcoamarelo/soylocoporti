<?php

/**
 * Verify nonce of an AJAX request
 *
 * @since  3.8.9
 * @access private
 * @param string $ajax_action Name of AJAX action
 * @return WP_Error|boolean True if nonce is valid. WP_Error if otherwise.
 */
function _wpsc_ajax_verify_nonce( $ajax_action ) {
	// nonce can be passed with name wpsc_nonce or _wpnonce
	$nonce = '';
	if ( isset( $_REQUEST['nonce'] ) )
		$nonce = $_REQUEST['nonce'];
	elseif ( isset( $_REQUEST['_wpnonce'] ) )
		$nonce = $_REQUEST['_wpnonce'];
	else
		return new WP_Error( 'wpsc_ajax_invalid_nonce', __( 'Your session has expired. Please refresh the page and try again.', 'wpsc' ) );

	// validate nonce
	if ( ! wp_verify_nonce( $nonce, 'wpsc_ajax_' . $ajax_action ) )
		return new WP_Error( 'wpsc_ajax_invalid_nonce', __( 'Your session has expired. Please refresh the page and try again.', 'wpsc' ) );

	return true;
}

/**
 * Verify AJAX callback and call it if it exists.
 *
 * @since  3.8.9
 * @access private
 * @param  string $ajax_action Name of AJAX action
 * @return WP_Error|array Array of response args if callback is valid. WP_Error if otherwise.
 */
function _wpsc_ajax_fire_callback( $ajax_action ) {
	// if callback exists, call it and output JSON response
	$callback = "_wpsc_ajax_{$ajax_action}";

	if ( is_callable( $callback ) )
		$result = call_user_func( $callback );
	else
		$result = new WP_Error( 'wpsc_invalid_ajax_callback', __( 'Invalid AJAX callback.', 'wpsc' ) );

	return $result;
}

/**
 * AJAX handler for all WPEC ajax requests.
 *
 * This function automates nonce checking and outputs JSON response.
 *
 * @since 3.8.9
 * @access private
 */
function _wpsc_ajax_handler() {
	$ajax_action = str_replace( '-', '_', $_REQUEST['wpsc_action'] );
	$result = _wpsc_ajax_verify_nonce( $ajax_action );

	if ( ! is_wp_error( $result ) )
		$result = _wpsc_ajax_fire_callback( $ajax_action );

	$output = array(
		'is_successful' => false,
	);

	if ( is_wp_error( $result ) ) {
		$output['error'] = array(
			'code'     => $result->get_error_code(),
			'messages' => $result->get_error_messages(),
			'data'     => $result->get_error_data(),
		);
	} else {
		$output['is_successful'] = true;
		$output['obj'] = $result;
	}

	echo json_encode( $output );
	exit;
}
add_action( 'wp_ajax_wpsc_ajax', '_wpsc_ajax_handler' );

function wpsc_is_doing_ajax( $action = '' ) {
	$ajax = defined( 'DOING_AJAX' ) && DOING_AJAX && ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] == 'wpsc_ajax';

	if ( $action )
		$ajax = $ajax && ! empty( $_REQUEST['wpsc_action'] ) && $action == str_replace( '-', '_', $_REQUEST['wpsc_action'] );

	return $ajax;
}

/**
 * Helper function that generates nonce for an AJAX action. Basically just a wrapper of
 * wp_create_nonce() but automatically add prefix.
 *
 * @since  3.8.9
 * @access private
 * @param  string $action AJAX action without prefix
 * @return string         The generated nonce.
 */
function _wpsc_create_ajax_nonce( $ajax_action ) {
	return wp_create_nonce( "wpsc_ajax_{$ajax_action}" );
}

/**
 * Add new variation set via AJAX.
 *
 * If the variation set name is the same as an existing variation set,
 * the children variant terms will be added inside that existing set.
 *
 * @since 3.8.8
 * @access private
 * @return array Response args
 */
function _wpsc_ajax_add_variation_set() {
	$new_variation_set = $_POST['variation_set'];
	$variants = preg_split( '/\s*,\s*/', $_POST['variants'] );

	$return = array();

	$parent_term_exists = term_exists( $new_variation_set, 'wpsc-variation' );

	// only use an existing parent ID if the term is not a child term
	if ( $parent_term_exists ) {
		$parent_term = get_term( $parent_term_exists['term_id'], 'wpsc-variation' );
		if ( $parent_term->parent == '0' )
			$variation_set_id = $parent_term_exists['term_id'];
	}

	if ( empty( $variation_set_id ) ) {
		$results = wp_insert_term( $new_variation_set, 'wpsc-variation' );
		if ( is_wp_error( $results ) )
			return $results;
		$variation_set_id = $results['term_id'];
	}

	if ( empty( $variation_set_id ) )
		return new WP_Error( 'wpsc_invalid_variation_id', __( 'Cannot retrieve the variation set in order to proceed.', 'wpsc' ) );

	foreach ( $variants as $variant ) {
		$results = wp_insert_term( $variant, 'wpsc-variation', array( 'parent' => $variation_set_id ) );

		if ( is_wp_error( $results ) )
			return $results;

		$inserted_variants[] = $results['term_id'];
	}

	require_once( 'includes/walker-variation-checklist.php' );

	/* --- DIRTY HACK START --- */
	/*
	There's a bug with term cache in WordPress core. See http://core.trac.wordpress.org/ticket/14485.
	The next 3 lines will delete children term cache for wpsc-variation.
	Without this hack, the new child variations won't be displayed on "Variations" page and
	also won't be displayed in wp_terms_checklist() call below.
	*/
	clean_term_cache( $variation_set_id, 'wpsc-variation' );
	delete_option('wpsc-variation_children');
	wp_cache_set( 'last_changed', 1, 'terms' );
	_get_term_hierarchy('wpsc-variation');
	/* --- DIRTY HACK END --- */

	ob_start();
	wp_terms_checklist( (int) $_POST['post_id'], array(
		'taxonomy'      => 'wpsc-variation',
		'descendants_and_self' => $variation_set_id,
		'walker'        => new WPSC_Walker_Variation_Checklist( $inserted_variants ),
		'checked_ontop' => false,
	) );
	$content = ob_get_clean();

	$return = array(
		'variation_set_id'  => $variation_set_id,
		'inserted_variants' => $inserted_variants,
		'content'           => $content,
	);

	return $return;
}

/**
 * Display gateway settings form via AJAX
 *
 * @since  3.8.9
 * @access private
 * @return array Response args
 */
function _wpsc_ajax_payment_gateway_settings_form() {
	require_once( 'settings-page.php' );
	require_once( 'includes/settings-tabs/gateway.php' );

	$return = array();
	ob_start();
	$tab = new WPSC_Settings_Tab_Gateway();
	$tab->display_payment_gateway_settings_form();
	$return['content'] = ob_get_clean();

	return $return;
}

/**
 * Display shipping module settings form via AJAX
 *
 * @since  3.8.9
 * @access private
 * @return array Response args
 */
function _wpsc_ajax_shipping_module_settings_form() {
	require_once( 'settings-page.php' );
	require_once( 'includes/settings-tabs/shipping.php' );

	$return = array();
	ob_start();
	$tab = new WPSC_Settings_Tab_Shipping();
	$tab->display_shipping_module_settings_form();
	$return['content'] = ob_get_clean();

	return $return;
}

/**
 * Display settings tab via AJAX
 *
 * @since 3.8.9
 * @access private
 * @return array Response args
 */
function _wpsc_ajax_navigate_settings_tab() {
	require_once( 'settings-page.php' );

	$return = array();
	ob_start();
	$settings_page = new WPSC_Settings_Page( $_POST['tab'] );
	$settings_page->display_current_tab();
	$return['content'] = ob_get_clean();

	return $return;
}
/**
 * Display base region list in Store Settings -> General
 *
 * @since 3.8.9
 * @access private
 * @return array Response args
 */
function _wpsc_ajax_display_region_list() {
	require_once( 'settings-page.php' );
	require_once( 'includes/settings-tabs/general.php' );

	$return = array();
	ob_start();
	$tab = new WPSC_Settings_Tab_General();
	$tab->display_region_drop_down();
	$return['content'] = ob_get_clean();

	return $return;
}

/**
 * Save tracking ID of a sales log.
 *
 * @since 3.8.9
 * @access private
 * @return array|WP_Error Response args if successful, WP_Error if otherwise.
 */
function _wpsc_ajax_purchase_log_save_tracking_id() {
	global $wpdb;

	$result = $wpdb->update(
		WPSC_TABLE_PURCHASE_LOGS,
		array(
			'track_id' => $_POST['value']
		),
		array(
			'id' => $_POST['log_id']
		),
		'%s',
		'%d'
	);

	if ( ! $result )
		return new WP_Error( 'wpsc_cannot_save_tracking_id', __( "Couldn't save tracking ID of the transaction. Please try again.", 'wpsc' ) );

	$return = array(
		'rows_affected' => $result,
		'id'            => $_POST['log_id'],
		'track_id'      => $_POST['value'],
	);

	return $return;
}

/**
 * Send sales log tracking email via AJAX
 *
 * @since 3.8.9
 * @access private
 * @return array|WP_Error Response args if successful, WP_Error if otherwise
 */
function _wpsc_ajax_purchase_log_send_tracking_email() {
	global $wpdb;

	$id = absint( $_POST['log_id'] );
	$sql = $wpdb->prepare( "SELECT `track_id` FROM " . WPSC_TABLE_PURCHASE_LOGS . " WHERE `id`=%d LIMIT 1", $id );
	$trackingid = $wpdb->get_var( $sql );

	$message = get_option( 'wpsc_trackingid_message' );
	$message = str_replace( '%trackid%', $trackingid, $message );
	$message = str_replace( '%shop_name%', get_option( 'blogname' ), $message );

	$email_form_field = $wpdb->get_var( "SELECT `id` FROM `" . WPSC_TABLE_CHECKOUT_FORMS . "` WHERE `type` IN ('email') AND `active` = '1' ORDER BY `checkout_order` ASC LIMIT 1" );
	$email = $wpdb->get_var( $wpdb->prepare( "SELECT `value` FROM `" . WPSC_TABLE_SUBMITED_FORM_DATA . "` WHERE `log_id`=%d AND `form_id` = '$email_form_field' LIMIT 1", $id ) );

	$subject = get_option( 'wpsc_trackingid_subject' );
	$subject = str_replace( '%shop_name%', get_option( 'blogname' ), $subject );

	add_filter( 'wp_mail_from', 'wpsc_replace_reply_address', 0 );
	add_filter( 'wp_mail_from_name', 'wpsc_replace_reply_name', 0 );

	$result = wp_mail( $email, $subject, $message);

	if ( ! $result )
		return new WP_Error( 'wpsc_cannot_send_tracking_email', __( "Couldn't send tracking email. Please try again.", 'wpsc' ) );

	$return = array(
		'id'          => $id,
		'tracking_id' => $trackingid,
		'subject'     => $subject,
		'message'     => $message,
		'email'       => $email
	);

	return $return;
}

/**
 * Delete an attached downloadable file via AJAX.
 *
 * @since 3.8.9
 * @access private
 * @return array|WP_Error Response args if successful, WP_Error if otherwise
 */
function _wpsc_ajax_delete_file() {
	$product_id = absint( $_REQUEST['product_id'] );
	$file_name = basename( $_REQUEST['file_name'] );

	$result = _wpsc_delete_file( $product_id, $file_name );

	if ( ! $result )
		return new WP_Error( 'wpsc_cannot_delete_file', __( "Couldn't delete the file. Please try again.", 'wpsc' ) );

	$return = array(
		'product_id' => $product_id,
		'file_name'  => $file_name,
	);

	return $return;
}

/**
 * Delete a product meta via AJAX
 *
 * @since 3.8.9
 * @access private
 * @return  array|WP_Error Response args if successful, WP_Error if otherwise
 */
function _wpsc_ajax_remove_product_meta() {
	$meta_id = (int) $_POST['meta_id'];
	if ( ! delete_meta( $meta_id ) )
		return new WP_Error( 'wpsc_cannot_delete_product_meta', __( "Couldn't delete product meta. Please try again.", 'wpsc' ) );

	return array( 'meta_id' => $meta_id );
}

/**
 * Modify a purchase log's status.
 *
 * @since 3.8.9
 * @access private
 * @return array|WP_Error Response args if successful, WP_Error if otherwise.
 */
function _wpsc_ajax_change_purchase_log_status() {
	$result = wpsc_purchlog_edit_status( $_POST['id'], $_POST['new_status'] );
	if ( ! $result )
		return new WP_Error( 'wpsc_cannot_edit_purchase_log_status', __( "Couldn't modify purchase log's status. Please try again.", 'wpsc' ) );

	set_current_screen( 'dashboard_page_wpsc-sales-logs' );

	require_once( WPSC_FILE_PATH . '/wpsc-admin/includes/purchase-log-list-table-class.php' );
	$purchaselog_table = new WPSC_Purchase_Log_List_Table();
	$purchaselog_table->prepare_items();

	ob_start();
	$purchaselog_table->views();
	$views = ob_get_clean();

	ob_start();
	$purchaselog_table->display_tablenav( 'top' );
	$tablenav_top = ob_get_clean();

	ob_start();
	$purchaselog_table->display_tablenav( 'bottom' );
	$tablenav_bottom = ob_get_clean();

	$return = array(
		'id'              => $_POST['id'],
		'new_status'      => $_POST['new_status'],
		'views'           => $views,
		'tablenav_top'    => $tablenav_top,
		'tablenav_bottom' => $tablenav_bottom,
	);

	return $return;
}

/**
 * Save product ordering after drag-and-drop sorting
 *
 * @since 3.8.9
 * @access private
 * @return array|WP_Error Response args if successful, WP_Error if otherwise
 */
function _wpsc_ajax_save_product_order() {
	global $wpdb;

	$products = array( );
	foreach ( $_POST['post'] as $product ) {
		$products[] = (int) str_replace( 'post-', '', $product );
	}

	$failed = array();
	foreach ( $products as $order => $product_id ) {
		$result = wp_update_post( array(
			'ID' => $product_id,
			'menu_order' => $order,
		) );

		if ( ! $result )
			$failed[] = $product_id;
	}

	if ( ! empty( $failed ) ) {
		$error_data = array(
			'failed_ids' => $failed,
		);

		return new WP_Error( 'wpsc_cannot_save_product_sort_order', __( "Couldn't save the products' sort order. Please try again.", 'wpsc' ), $error_data );
	}

	return array(
		'ids' => $products,
	);
}

/**
 * Update Checkout fields order
 *
 * @since 3.8.9
 * @access private
 * @return array|WP_Error Response args or WP_Error
 */
function _wpsc_ajax_update_checkout_fields_order() {
	global $wpdb;

	$checkout_fields = $_REQUEST['sort_order'];
	$order = 1;
	$failed = array();
	$modified = array();
	foreach ( $checkout_fields as &$checkout_field ) {
		// ignore new fields
		if ( strpos( $checkout_field, 'new-field' ) === 0 )
			continue;
		$checkout_field = absint( preg_replace('/[^0-9]+/', '', $checkout_field ) );
		$result = $wpdb->update(
			WPSC_TABLE_CHECKOUT_FORMS,
			array(
				'checkout_order' => $order
			),
			array(
				'id' => $checkout_field
			),
			'%d',
			'%d'
		);
		$order ++;
		if ( $result === false )
			$failed[] = $checkout_field;
		elseif ( $result > 0 )
			$modified[] = $checkout_field;
	}

	if ( ! empty( $failed ) )
		return new WP_Error( 'wpsc_cannot_save_checkout_field_sort_order', __( "Couldn't save checkout field sort order. Please try again.", 'wpsc' ), array( 'failed_ids' => $failed ) );

	return array(
		'modified' => $modified,
	);
}

/**
 * Save a downloadable file to a product
 *
 * @since 3.8.9
 * @access private
 * @return array|WP_Error Response args if successful, WP_Error if otherwise.
 */
function _wpsc_ajax_upload_product_file() {
	global $wpdb;
	$product_id = absint( $_POST["product_id"] );
	$output = '';
	$delete_nonce = _wpsc_create_ajax_nonce( 'delete_file' );

	foreach ( $_POST["select_product_file"] as $selected_file ) {
		// if we already use this file, there is no point doing anything more.
		$sql = $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_type = 'wpsc-product-file' AND post_title = %s", $selected_file ); // TODO it's safer to select by post ID, in that case we will use get_posts()
		$file_post_data = $wpdb->get_row( $sql, ARRAY_A );
		$selected_file_path = WPSC_FILE_DIR . basename( $selected_file );
		$file_url = WPSC_FILE_URL . basename( $selected_file );
		$file_size = filesize( $selected_file_path );
		if ( empty( $file_post_data ) ) {
			$type = wpsc_get_mimetype( $selected_file_path );
			$attachment = array(
				'post_mime_type' => $type,
				'post_parent' => $product_id,
				'post_title' => $selected_file,
				'post_content' => '',
				'post_type' => "wpsc-product-file",
				'post_status' => 'inherit'
			);
			$id = wp_insert_post( $attachment );
		} else {
			// already attached
			if ( $file_post_data['post_parent'] == $product_id )
				continue;
			$type = $file_post_data["post_mime_type"];
			$url = $file_post_data["guid"];
			$title = $file_post_data["post_title"];
			$content = $file_post_data["post_content"];
			// Construct the attachment
			$attachment = array(
				'post_mime_type' => $type,
				'guid' => $url,
				'post_parent' => absint( $product_id ),
				'post_title' => $title,
				'post_content' => $content,
				'post_type' => "wpsc-product-file",
				'post_status' => 'inherit'
			);
			// Save the data
			$id = wp_insert_post( $attachment );
		}

		$deletion_url = wp_nonce_url( "admin.php?wpsc_admin_action=delete_file&amp;file_name={$attachment['post_title']}&amp;product_id={$product_id}", 'delete_file_' . $attachment['post_title'] );

		$output .= '<tr class="wpsc_product_download_row">';
		$output .= '<td style="padding-right: 30px;">' . $attachment['post_title'] . '</td>';
		$output .= '<td>' . wpsc_convert_byte( $file_size ) . '</td>';
		$output .= '<td>.' . wpsc_get_extension( $attachment['post_title'] ) . '</td>';
		$output .= "<td><a data-file-name='" . esc_attr( $attachment['post_title'] ) . "' data-product-id='" . esc_attr( $product_id ) . "' data-nonce='" . esc_attr( $delete_nonce ) . "' class='file_delete_button' href='{$deletion_url}' >" . _x( 'Delete', 'Digital Download UI row', 'wpsc' ) . "</a></td>";
		$output .= '<td><a href=' .$file_url .'>' . _x( 'Download', 'Digital Download UI row', 'wpsc' ) . '</a></td>';
		$output .= '</tr>';
	}

	return array(
		'content' => $output,
	);
}

/**
 * Generate variations
 *
 * @since 3.8.9
 * @access private
 * @return array|WP_Error Response args if successful, WP_Error if otherwise
 */
function _wpsc_ajax_update_variations() {
	$product_id = absint( $_REQUEST["product_id"] );
	wpsc_update_variations();

	ob_start();
	wpsc_admin_product_listing( $product_id );
	$content = ob_get_clean();

	return array( 'content' => $content );
}

/**
 * Display the shortcode generator.
 *
 * @since  3.8.9
 * @access private
 */
function _wpsc_action_tinymce_window() {
	require_once( WPSC_CORE_JS_PATH . '/tinymce3/window.php' );
	exit;
}
add_action( 'wp_ajax_wpsc_tinymce_window', '_wpsc_action_tinymce_window' );

/**
 * Add tax rate
 * @since  3.8.9
 * @access private
 * @return array|WP_Error Response args if successful, WP_Error if otherwise
 */
function _wpsc_ajax_add_tax_rate() {
	//include taxes controller
	$wpec_taxes_controller = new wpec_taxes_controller;

	switch ( $_REQUEST['wpec_taxes_action'] ) {
		case 'wpec_taxes_get_regions':
			$regions = $wpec_taxes_controller->wpec_taxes->wpec_taxes_get_regions( $_REQUEST['country_code'] );
			$key = $_REQUEST['current_key'];
			$type = $_REQUEST['taxes_type'];
			$default_option = array( 'region_code' => 'all-markets', 'name' => 'All Markets' );
			$select_settings = array(
				'id' => "{$type}-region-{$key}",
				'name' => "wpsc_options[wpec_taxes_{$type}][{$key}][region_code]",
				'class' => 'wpsc-taxes-region-drop-down'
			);
			$returnable = $wpec_taxes_controller->wpec_taxes_build_select_options( $regions, 'region_code', 'name', $default_option, $select_settings );
			break;
		case 'wpec_taxes_build_rates_form':
			$key = $_REQUEST['current_key'];
			$returnable = $wpec_taxes_controller->wpec_taxes_build_form( $key );
			break;
		case 'wpec_taxes_build_bands_form':
			$key = $_REQUEST['current_key'];
			//get a new key if a band is already defined for this key
			while($wpec_taxes_controller->wpec_taxes->wpec_taxes_get_band_from_index($key))
			{
				$key++;
			}
			$returnable = $wpec_taxes_controller->wpec_taxes_build_form( $key, false, 'bands' );
			break;
	}// switch

	return array(
		'content' => $returnable,
	);
}

function wpsc_product_variations_table() {
	check_admin_referer( 'wpsc_product_variations_table' );
	require_once( WPSC_FILE_PATH . '/wpsc-admin/includes/product-variations-page.class.php' );
	$page = new WPSC_Product_Variations_Page();
	$page->display();

	exit;
}
add_action( 'wp_ajax_wpsc_product_variations_table', 'wpsc_product_variations_table' );

function _wpsc_ajax_set_variation_product_thumbnail() {
	$response = array(
		'success' => false
	);

	$post_ID = intval( $_POST['post_id'] );
	if ( current_user_can( 'edit_post', $post_ID ) ) {
		$thumbnail_id = intval( $_POST['thumbnail_id'] );

		if ( $thumbnail_id == '-1' )
			delete_post_thumbnail( $post_ID );

		set_post_thumbnail( $post_ID, $thumbnail_id );

		$thumbnail = wpsc_the_product_thumbnail( 50, 50, $post_ID, '' );
		if ( ! $thumbnail )
			$thumbnail = WPSC_CORE_IMAGES_URL . '/no-image-uploaded.gif';
		$response['src'] = $thumbnail;
		$response['success'] = true;
	}

	echo json_encode( $response );
	exit;
}
add_action( 'wp_ajax_wpsc_set_variation_product_thumbnail', '_wpsc_ajax_set_variation_product_thumbnail' );
