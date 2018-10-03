<?php 

/*
  * my_em_booking_wp_name_placeholders
  * Adds custom placeholder to display the WordPress display name.
  * #_BOOKINGWPNAME
  * It would display the #_BOOKINGNAME if there is no display name or user is not logged-in
  * @param $replace
  * @param $EM_Event
  * @param $result
  * @return #_BOOKINGWPNAME data
*/

add_filter( 'em_event_output_placeholder', 'my_em_booking_wp_name_placeholders', 1, 3 );

function my_em_booking_wp_name_placeholders( $replace, $EM_Event, $result ){
	global $EM_Booking;
	
    if( $result == '#_BOOKINGWPNAME' ){
        $replace = '';
		
		if( isset( $EM_Booking->person->data->display_name ) ) {
			$display_name = wp_kses_data( trim( $EM_Booking->person->data->display_name ) );
			$replace = $display_name;
		} else {
			$replace = $EM_Booking->get_person()->get_name();
		}
    }
    return $replace;
}

?>
