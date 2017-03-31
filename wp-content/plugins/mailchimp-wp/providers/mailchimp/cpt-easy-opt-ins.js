jQuery( document ).ready( function( $ ) {

	var $api_key = $( '[name="fca_eoi[mailchimp_api_key]"]' );
	var $lists = $( '[name="fca_eoi[mailchimp_list_id]"]' );
	var $group_input = $( '[name="fca_eoi[mailchimp_groups][]"]' );
	var $lists_wrapper = $( '#mailchimp_list_id_wrapper' );
	var $group_wrapper = $( '#mailchimp_group_wrapper' );
	
	var mailChimp_groups_active = fcaEoiUseGroups == 'on' ? true: false;
	var $double_opt_in_wrapper = $( '#mailchimp_double_opt_in_wrapper' );
            
	mailchimp_toggle_fields();

	fca_eoi_provider_status_setup( 'mailchimp', $api_key ); 
	fca_eoi_provider_status_setup( 'mailchimp-groups', $group_input );
	
	$lists.change(function() {
		mailChimp_groups_active ? get_mailchimp_groups() : '';
	});
	
	//IF EVERYTHING IS SET BUT THERE ARE NO GROUPS, TRY AGAIN
	if ( $api_key.val() !== '' && $lists.find(":selected").val() !== 'Not set' && $('[name="fca_eoi[mailchimp_list_id]"] option').size() == 0 ) {
		mailChimp_groups_active ? get_mailchimp_groups() : '';
	}
	
	function get_mailchimp_groups() {
		$lists = $( '[name="fca_eoi[mailchimp_list_id]"]' );
		fca_eoi_provider_status_set( 'mailchimp-groups', fca_eoi_provider_status_codes.loading );
		var data = {
			'action': 'mailchimp_get_groups', /* API action name, do not change */
			'api_key' : $api_key.val().trim(),
			'list_id' : $lists.find(":selected").val(),
		};
		
		$.post( ajaxurl, data, function( response ) {

			var groups = JSON.parse( response );
			
			fca_eoi_provider_status_set( 'mailchimp-groups', '' );
			
			var $group_select = $( '<select class="select2 mailchimp_group_select" style="width: 27em;" multiple="multiple" placeholder="Select Interest Groups Here" name="fca_eoi[mailchimp_groups][]" >' );

			for ( group_id in groups ) {
				$group_select.append( '<option value="' + group_id + '">' + groups[ group_id ] + '</option>' );
			}

			// Replace dropdown with new list of lists, apply Select2 then show
			$( '[name="fca_eoi[mailchimp_groups][]"]' ).select2( 'destroy' );
			$( '[name="fca_eoi[mailchimp_groups][]"]' ).replaceWith( $group_select );
			$( '[name="fca_eoi[mailchimp_groups][]"]' ).select2();

		} );
	}

	$api_key.bind( 'input', function() {
		if ( ! fca_eoi_provider_is_value_changed( $( this ) ) ) {
			return;
		}

		fca_eoi_provider_status_set( 'mailchimp', fca_eoi_provider_status_codes.loading );

		var data = {
			'action': 'fca_eoi_mailchimp_get_lists', /* API action name, do not change */
			'mailchimp_api_key' : $api_key.val().trim()
		};
		
		$.post( ajaxurl, data, function( response ) {

			var lists = JSON.parse( response );

			fca_eoi_provider_status_set( 'mailchimp', Object.keys(lists).length > 1
				? fca_eoi_provider_status_codes.ok
				: fca_eoi_provider_status_codes.error );

			var $lists = $( '<select class="select2" style="width: 27em;" name="fca_eoi[mailchimp_list_id]" >' );

			for ( list_id in lists ) {
				$lists.append( '<option value="' + list_id + '">' + lists[ list_id ] + '</option>' );
			}

			// Set first list as selected
			$( 'option:eq(1)', $lists ).prop( 'selected', true );

			// Replace dropdown with new list of lists, apply Select2 then show
			$( '[name="fca_eoi[mailchimp_list_id]"]' ).select2( 'destroy' );
			$( '[name="fca_eoi[mailchimp_list_id]"]' ).replaceWith( $lists );
			$( '[name="fca_eoi[mailchimp_list_id]"]' ).select2();
			mailchimp_toggle_fields();
			$lists.change(function() {
				mailChimp_groups_active ? get_mailchimp_groups() : '';
			});
			mailChimp_groups_active ? get_mailchimp_groups() : '';
		} );
	})

	/**
	 * Show/hide some fields if there are/aren't list options
	 *
	 * Don't forget that there is always the option "Not Set", 
	 * so take it into consideration when cheking the number of options
	 */
	function mailchimp_toggle_fields() {

		var options = $( 'option', '[name="fca_eoi[mailchimp_list_id]"]' );

		if( options.length > 1 ) {
			$()
				.add( $double_opt_in_wrapper )
				.add( $lists_wrapper )
				.add( $group_wrapper )
				.show( 'fast' )
			;
		} else {
			$()
				.add( $double_opt_in_wrapper )
				.add( $lists_wrapper )
				.add( $group_wrapper )
				.hide( )
			;
		}
	}
        
       // toggle send_opt_int_bait fearure once mailchimp double opt in is selected
       $( 'select[name="fca_eoi[mailchimp_double_opt_in]"]' ).select2().on("change", function(e) {
//          if( $( 'select[name="fca_eoi[mailchimp_double_opt_in]"]' ).val() == 'false' ) {
//              $( 'input[name="fca_eoi[is_send_opt_int_bait]"]' ).prop('checked', true); 
//          } else {
              $( 'input[name="fca_eoi[is_send_opt_int_bait]"]' ).prop('checked', false); 
//          }
        });
       // toggle mailchimp double opt in fearure once  send_opt_int_bait is selected 
      $( 'input[name="fca_eoi[is_send_opt_int_bait]"]' ).on('click', function(e) {
          if( $( 'input[name="fca_eoi[is_send_opt_int_bait]"]' ).is(":checked") ) {
              $( 'select[name="fca_eoi[mailchimp_double_opt_in]"]' ).select2('val', 'false'); 
			  } else {
              $(  'select[name="fca_eoi[mailchimp_double_opt_in]"]' ).select2('val', 'true');  
          }
        }); 
} );
