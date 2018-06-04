<?php 

/**
 * Similar to https://pastebin.com/CX3Lc6QJ
 * But this is for the Tags Version
 */

function em_snippet_hide_empty_tags( $args ){
  if( empty( $args['exclude'] ) && empty( $args['include'] ) ){
      //get list of categories with events in them (past or present)
      $terms = get_terms( EM_TAXONOMY_TAG, array( 'hide_empty' => true ) );
      $args['include'] = array();
     
  foreach( $terms as $term ){
          //check if this term has events in the future, if so add it to the include argument
          if( EM_Events::count( array( 'tag' => $term->term_id, 'scope' => 'future' ) ) ){
              $args['include'][] = $term->term_id;
          }
      }

  }
  return $args;
}
add_filter( 'em_tags_get_default_search', 'em_snippet_hide_empty_tags' );


?>