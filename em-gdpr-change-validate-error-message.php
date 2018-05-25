<?php 
/**
 * Change the message "You must allow us to collect and store your data in order for us to process your booking."
 * Validates a bookng to ensure consent is/was given.
 * @param bool $result
 * @param EM_Booking $EM_Booking
 * @return bool
 */
function theme_custom_em_data_privacy_consent_booking_validate( $result, $EM_Booking ){
	
	if( is_user_logged_in() ){
		//check if consent was previously given and ignore if settings dictate so
		$consent_given_already = get_user_meta( get_current_user_id(), 'em_data_privacy_consent', true );
		if( !empty( $consent_given_already ) && get_option( 'dbem_data_privacy_consent_remember') == 1 ) return $result; //ignore if consent given as per settings
	}
    if( empty( $EM_Booking->booking_meta['consent'] ) ){
	    $EM_Booking->add_error( sprintf( __( 'PUT_YOUR_CUSTOM_MESSAGE_HERE', 'events-manager' ) ) );
	    $result = false;
    }
    return $result;
}

function theme_custom_em_data_privacy_consent_hooks(){
	//BOOKINGS
	if( get_option( 'dbem_data_privacy_consent_bookings' ) == 1 || ( get_option( 'dbem_data_privacy_consent_bookings' ) == 2 && !is_user_logged_in() ) ){
		remove_filter( 'em_booking_validate', 'em_data_privacy_consent_booking_validate', 10, 2 );
		add_filter( 'em_booking_validate', 'theme_custom_em_data_privacy_consent_booking_validate', 10, 2 );
	}
}

add_action( 'init', 'theme_custom_em_data_privacy_consent_hooks' );

?>