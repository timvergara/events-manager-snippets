<?php

/*
  * my_em_event_within_90days_output_condition
  * Conditional Placeholder to Checks if the Event is within 90days from current date
  * has_content
  * @param $show
  * @param $condition
  * @param $full_match
  * @param $EM_Event
  * @return boolean
*/

add_action('em_event_output_condition', 'my_em_event_within_90days_output_condition', 1, 4);
function my_em_event_within_90days_output_condition($show, $condition, $match, $EM_Event){
	if( is_object($EM_Event) && preg_match('/^event_within_90days/',$condition, $matches) ){
		$event_date = new DateTime( );
		$event_date->setTimestamp( $EM_Event->start()->getTimestamp() );
		$now = new DateTime();
		if( $event_date->diff($now)->days <= 90 ) {
			$show = preg_replace("/\{\/?$condition\}/", '', $match);
		} else {
			$show = 'Booking is disabled.';
		}
	}
	return $show;
}
?>