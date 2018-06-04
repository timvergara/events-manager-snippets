<?php 
/**
 * Placeholder that will show the timezone selected on Events
 * Use #_EVENTTIMEZONE
 * @param $replace
 * @param $EM_Event
 * @param $result
 * @return bool
 */

function em_snippet_display_timezone_custom_placeholder( $replace, $EM_Event, $result ){
    if( $result == '#_EVENTTIMEZONE' ){
		if( isset( $EM_Event->event_timezone ) ) {
			$replace = $EM_Event->event_timezone;
		}
    }
    return $replace;
}

add_filter( 'em_event_output_placeholder', 'em_snippet_display_timezone_custom_placeholder', 1, 3 );

?>