<?php

function mailchimp_get_lists( $api_key ) {

	$lists_formatted = array( '' => 'Not set' );

	// Make call and add lists if any
	if ( preg_match( '/[a-z0-9]+-[a-z0-9]+/', $api_key ) ) {

		$args = array(
			'timeout'     => 15,
			'redirection' => 15,
			'headers'     => "Authorization: apikey $api_key",
		);
		
		//get stuff after the dash as the delivery center, for URL
		$delivery_center =  explode("-", $api_key);
		$delivery_center = $delivery_center[1];		
		
		$url = 'https://' . $delivery_center . '.api.mailchimp.com/3.0/lists?offset=0&count=999';
		$response = wp_remote_get( $url, $args );
		if ( is_wp_error( $response ) ) {
			return $lists_formatted;
		}
		if ( !empty ( $response['body'] ) ) {
			$body = json_decode( $response['body'], true);
			
			if ( !empty ( $body['lists'] )) {
				
				foreach ( $body['lists'] as $list ) {
					$lists_formatted[ $list[ 'id' ] ] = $list[ 'name' ];
				}
			}
		}
	}

	return $lists_formatted;
}

function mailchimp_get_groups( $api_key, $list_id ) {

	$groups_formatted = array();

	// Make call and add lists if any
	if ( preg_match( '/[a-z0-9]+-[a-z0-9]+/', $api_key ) ) {

		$args = array(
			'timeout'     => 15,
			'redirection' => 15,
			'headers'     => "Authorization: apikey $api_key",
		);
		
		//get stuff after the dash as the delivery center, for URL
		$delivery_center =  explode("-", $api_key);
		$delivery_center = $delivery_center[1];		
		
		$url = 'https://' . $delivery_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/interest-categories?offset=0&count=999';
		$response = wp_remote_get( $url, $args );
		if ( is_wp_error( $response ) ) {
			return $groups_formatted;
		}
		if ( !empty ( $response['body'] ) ) {
			$body = json_decode( $response['body'], true);
			if ( !empty ( $body['categories'] )) {
				
				foreach ( $body['categories'] as $category ) {
					$url = 'https://' . $delivery_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/interest-categories/' . $category['id'] . '/interests?offset=0&count=999';
					$response = wp_remote_get( $url, $args );
					if ( ! is_wp_error( $response ) ) {
						$body = json_decode( $response['body'], true);
						
						foreach ( $body['interests'] as $interest ) {
							$groups_formatted[ $interest['id'] ] = $interest[ 'name' ];
						}
						
					}
				}
			}
		}
	}

	return $groups_formatted;
}

function mailchimp_get_groups_ajax() {
	
	$api_key = empty( $_REQUEST['api_key'] ) ? '' : $_REQUEST['api_key'];
	$list_id = empty( $_REQUEST['list_id'] ) ? '' : $_REQUEST['list_id'];
 
	$groups_formatted = array();

	// Make call and add lists if any
	if ( preg_match( '/[a-z0-9]+-[a-z0-9]+/', $api_key ) ) {

		$args = array(
			'timeout'     => 15,
			'redirection' => 15,
			'headers'     => "Authorization: apikey $api_key",
		);
		
		//get stuff after the dash as the delivery center, for URL
		$delivery_center =  explode("-", $api_key);
		$delivery_center = $delivery_center[1];		
		
		$url = 'https://' . $delivery_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/interest-categories?offset=0&count=999';
		$response = wp_remote_get( $url, $args );
		if ( is_wp_error( $response ) ) {
			echo json_encode( $groups_formatted );
			wp_die();
		}
		if ( !empty ( $response['body'] ) ) {
			$body = json_decode( $response['body'], true);
			if ( !empty ( $body['categories'] )) {
				
				foreach ( $body['categories'] as $category ) {
					$url = 'https://' . $delivery_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/interest-categories/' . $category['id'] . '/interests?offset=0&count=999';
					$response = wp_remote_get( $url, $args );
					if ( ! is_wp_error( $response ) ) {
						$body = json_decode( $response['body'], true);
						
						foreach ( $body['interests'] as $interest ) {
							$groups_formatted[ $interest['id'] ] = $interest[ 'name' ];
						}
						
					}
				}
			}
		}
	}


	// Output response and exit
	echo json_encode( $groups_formatted );
	wp_die();
}
add_action( 'wp_ajax_mailchimp_get_groups', 'mailchimp_get_groups_ajax' );

function mailchimp_ajax_get_lists() {

	// Validate the API key
	$api_key = K::get_var( 'mailchimp_api_key', $_POST );
	$lists_formatted = array( '' => 'Not set' );

	// Make call and add lists if any
	if ( preg_match( '/[a-z0-9]+-[a-z0-9]+/', $api_key ) ) {

		$args = array(
			'timeout'     => 15,
			'redirection' => 15,
			'headers'     => "Authorization: apikey $api_key",
		);
		
		//get stuff after the dash as the delivery center, for URL
		$delivery_center =  explode("-", $api_key);
		$delivery_center = $delivery_center[1];		
		
		$url = 'https://' . $delivery_center . '.api.mailchimp.com/3.0/lists?offset=0&count=999';
		$response = wp_remote_get( $url, $args );
		
		if ( !empty ( $response['body'] ) ) {
			$body = json_decode( $response['body'], true);
			
				
			foreach ( $body['lists'] as $list ) {
				$lists_formatted[ $list[ 'id' ] ] = $list[ 'name' ];
			}
		}
	}

	// Output response and exit
	echo json_encode( $lists_formatted );
	exit;
}

function mailchimp_add_user( $settings, $user_data, $list_id ) {

	$form_meta = get_post_meta ( $user_data['form_id'], 'fca_eoi', true );
	$api_key = $form_meta['mailchimp_api_key'];
	
	// Make call and add lists if any
	if ( preg_match( '/[a-z0-9]+-[a-z0-9]+/', $api_key ) ) {
		
		$double_opt_in = K::get_var( 'mailchimp_double_opt_in', $form_meta, 'true' );
		$double_opt_in == 'true' ? $double_opt_in = 'pending' : $double_opt_in = 'subscribed'; 

		$body = array (
			'email_address' => K::get_var( 'email', $user_data ),
			'status' => $double_opt_in,
		);
		$name = K::get_var( 'name', $user_data, '' );
		if ( !empty ( $name ) ) {
			$body['merge_fields'] = array('FNAME' => $name );
		}
		
		$options = get_option( 'fca_eoi_settings' );
		$useGroups = empty ( $options['mailchimp_groups'] ) ? false : true;
		
		if ( !empty ( $form_meta['mailchimp_groups'] ) && $useGroups ) {
			$body['interests'] = array();
			forEach ( $form_meta['mailchimp_groups'] as $group_id ) {
				$body['interests'][$group_id] = true;
			}
		}
		
		$args = array(
			'method' => 'PUT',
			'timeout'     => 15,
			'redirection' => 15,
			'headers'     => "Authorization: apikey $api_key",
			'body' => json_encode ( $body ),
		);
		
		//get stuff after the dash as the delivery center, for URL
		$delivery_center =  explode("-", $api_key);
		$delivery_center = $delivery_center[1];		
		
		$member_id = md5(strtolower(K::get_var( 'email', $user_data )));
		
		$url = 'https://' . $delivery_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . $member_id;
		$response = wp_remote_request( $url, $args);
		//possible debug:  make sure wp php log plugin is running
		//wp_php_log ( $response, 'mailchimp-response' );
		// Return true if added, otherwise false
		if( is_wp_error( $response ) ) {
			return false;
		} else {
			
			if ( $response['response']['code'] == 200 ) {
				return true;
			} else {
				return false;
			}
		}
	}
	return false;
}

function mailchimp_string( $def_str ) {

	$strings = array(
		'Form integration' => __( 'MailChimp Integration' ),
	);

	return K::get_var( $def_str, $strings, $def_str );
}

function mailchimp_admin_notices( $errors ) {
	/* Provider errors can be added here */
	return $errors;
}


function mailchimp_integration( $settings ) {

	// Detect free version (has mailchimp only)
	$eoi_free = 'mailchimp' === K::get_var( 'provider', $settings );

	global $post;
	$fca_eoi = get_post_meta( $post->ID, 'fca_eoi', true );

	// Remember old Mailcihmp settings if we are in a new form
	$last_form_meta = get_option( 'fca_eoi_last_form_meta', '' );
	$suggested_api = empty($last_form_meta['mailchimp_api_key']) ? '' : $last_form_meta['mailchimp_api_key'];
	$suggested_list = empty($last_form_meta['mailchimp_list_id']) ? '' : $last_form_meta['mailchimp_list_id'];
	$suggested_double = empty($last_form_meta['mailchimp_double_opt_in']) ? '' : $last_form_meta['mailchimp_double_opt_in'];
	
	$api_key = K::get_var( 'mailchimp_api_key', $fca_eoi, $suggested_api );
	$list = K::get_var( 'mailchimp_list_id', $fca_eoi, $suggested_list );
	$double_opt_in = K::get_var( 'mailchimp_double_opt_in', $fca_eoi, $suggested_double );
	
	$lists_formatted = mailchimp_get_lists( $api_key );
	
	$options = get_option( 'fca_eoi_settings' );
	$use_mailchimp_groups = empty ( $options['mailchimp_groups'] ) ? false : true;
	
	if ( $use_mailchimp_groups ) {
		$groups_formatted = mailchimp_get_groups( $api_key, $list );
		K::fieldset( mailchimp_string( 'Form integration' ) ,
			array(
				array( 'input', 'fca_eoi[mailchimp_api_key]',
					array( 
						'class' => 'regular-text',
						'value' => $api_key,
					),
					array( 'format' => '<p><label>API Key<br />:input</label><br /><em><a tabindex="-1" href="http://admin.mailchimp.com/account/api" target="_blank">[Get my MailChimp API Key]</a></em></p>' ),
				),
				array( 'select', 'fca_eoi[mailchimp_double_opt_in]',
					array(
						'class' => 'select2',
						'style' => 'width: 27em;',
					),
					array( 
						'format' => $eoi_free
							? '<!---->'
							: '<p id="mailchimp_double_opt_in_wrapper"><label>Double opt-in<br />:select</label></p>'
						,
						'options' => $eoi_free
							? array(
								'true' => 'Yes',
							)
							: array(
								'false' => 'No',
								'true' => 'Yes',
							)
						,
						'selected' => $double_opt_in,
						'default' => 'true',
					),
				),
				array( 'select', 'fca_eoi[mailchimp_list_id]',
					array(
						'class' => 'select2',
						'style' => 'width: 27em;',
					),
					array(
						'format' => '<p id="mailchimp_list_id_wrapper"><label>List to subscribe to<br />:select</label></p>',
						'options' => $lists_formatted,
						'selected' => $list,
					),
				),
				array( 'select', 'fca_eoi[mailchimp_groups]',
					array(
						'class' => 'select2 mailchimp_group_select',
						'style' => 'width: 27em;',
						'multiple' => true,
						'placeholder' => __( 'Select Interest Groups Here' ),
					),
					array(
						'format' => '<p id="mailchimp_group_wrapper"><label>MailChimp Interest Groups<br />:select</label></p>',
						'options' => $groups_formatted,
						'selected' => K::get_var( 'mailchimp_groups', $fca_eoi, '' ),
						
					),
				),
				
			),
			array(
				'id' => 'fca_eoi_fieldset_form_mailchimp_integration',
			)
		);
	
	} else {
	
		K::fieldset( mailchimp_string( 'Form integration' ) ,
			array(
				array( 'input', 'fca_eoi[mailchimp_api_key]',
					array( 
						'class' => 'regular-text',
						'value' => $api_key,
					),
					array( 'format' => '<p><label>API Key<br />:input</label><br /><em><a tabindex="-1" href="http://admin.mailchimp.com/account/api" target="_blank">[Get my MailChimp API Key]</a></em></p>' ),
				),
				array( 'select', 'fca_eoi[mailchimp_double_opt_in]',
					array(
						'class' => 'select2',
						'style' => 'width: 27em;',
					),
					array( 
						'format' => $eoi_free
							? '<!---->'
							: '<p id="mailchimp_double_opt_in_wrapper"><label>Double opt-in<br />:select</label></p>'
						,
						'options' => $eoi_free
							? array(
								'true' => 'Yes',
							)
							: array(
								'false' => 'No',
								'true' => 'Yes',
							)
						,
						'selected' => $double_opt_in,
						'default' => 'true',
					),
				),
				array( 'select', 'fca_eoi[mailchimp_list_id]',
					array(
						'class' => 'select2',
						'style' => 'width: 27em;',
					),
					array(
						'format' => '<p id="mailchimp_list_id_wrapper"><label>List to subscribe to<br />:select</label></p>',
						'options' => $lists_formatted,
						'selected' => $list,
					),
				),				
			),
			array(
				'id' => 'fca_eoi_fieldset_form_mailchimp_integration',
			)
		);
	}
}
