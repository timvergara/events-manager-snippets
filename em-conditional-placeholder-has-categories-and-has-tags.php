<?php

/*
  * my_em_event_output_condition_has_categories
  * Conditional Placeholder to check if an Event has any selected Categories
  * has_categories
  * @param $show
  * @param $condition
  * @param $full_match
  * @param $EM_Event
  * @rreturn boolean
*/

function my_em_event_output_condition_has_categories( $show, $condition, $full_match, $EM_Event ){
    if ( $condition == 'has_categories' ){
		//event is in this category
		$show_condition = has_term( '', EM_TAXONOMY_CATEGORY, $EM_Event->post_id );
	}
    return $show;
}

add_action( 'em_event_output_condition', 'my_em_event_output_condition_has_categories', 1, 4 );

/*
  * my_em_event_output_condition_has_tags
  * Conditional Placeholder to check if an Event has any selected Categories
  * has_tags
  * @param $show
  * @param $condition
  * @param $full_match
  * @param $EM_Event
  * @rreturn boolean
*/

function my_em_event_output_condition_has_tags( $show, $condition, $full_match, $EM_Event ){
    if ( $condition == 'has_tags' ){
		//event is in this category
		$show_condition = has_term( '', EM_TAXONOMY_TAG, $EM_Event->post_id );
	}
    return $show;
}

add_action( 'em_event_output_condition', 'my_em_event_output_condition_has_tags', 1, 4 );
?>