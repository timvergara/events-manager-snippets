<?php

/*
  * my_em_custom_event_output_condition_has_content
  * Conditional Placeholder to check if there is a content available
  * has_content
  * @param $show
  * @param $condition
  * @param $full_match
  * @param $EM_Event
  * @return boolean
*/

add_action('em_event_output_condition', 'my_em_custom_event_output_condition_has_content', 1, 4);
function my_em_custom_event_output_condition_has_content($replacement, $condition, $match, $EM_Event){
	if( is_object( $EM_Event ) && preg_match( '/^has_content/', $condition, $matches ) ){
		if( ! empty( trim( $EM_Event->post_content ) ) ){
			$replacement = preg_replace("/\{\/?$condition\}/", '', $match);
		} else {
			$replacement = 'There is no content on this event!';
		}
	}
	return $replacement;
}
?>