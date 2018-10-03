<?php

/**
 * This function makes the Ticket options display even numbers and make you sell even number of tickets
 * @param $content
 * @param $zero_value
 * @param $default_value
 * @param $EMticket
 * @return $output (The select list of Ticket)
 */
function em_snippet_ticket_get_spaces_options( $content, $zero_value, $default_value, $EMticket) {
	$available_spaces = $EMticket->get_available_spaces();		
	if( $EMticket->is_available() ) {
		$min_spaces = $EMticket->get_spaces_minimum();
		if( $default_value > 0 ){
			$default_value = $min_spaces > $default_value ? $min_spaces:$default_value;
		}else{
			$default_value = $EMticket->is_required() ? $min_spaces:0;
		}
		ob_start();
		?>
		<select name="em_tickets[<?php echo $EMticket->ticket_id ?>][spaces]" class="em-ticket-select" id="em-ticket-spaces-<?php echo $EMticket->ticket_id ?>">
			<?php 
				$min = ($EMticket->ticket_min > 0) ? $EMticket->ticket_min:1;
				$max = ($EMticket->ticket_max > 0) ? $EMticket->ticket_max:get_option('dbem_bookings_form_max');
				if( $EMticket->get_event()->event_rsvp_spaces > 0 && $EMticket->get_event()->event_rsvp_spaces < $max ) $max = $EMticket->get_event()->event_rsvp_spaces;
			?>
			<?php if($zero_value && !$EMticket->is_required()) : ?><option>0</option><?php endif; ?>
				<?php for( $i=$min; $i<=$available_spaces && $i<=$max; $i++ ): ?>
					<?php if( $i % 2 == 0 ): ?>
					<option <?php if($i == $default_value){ echo 'selected="selected"'; $shown_default = true; } ?>><?php echo $i ?></option>
					<?php endif; ?>
				<?php endfor; ?>
			<?php if(empty($shown_default) && $default_value > 0 ): ?><option selected="selected"><?php echo $default_value; ?></option><?php endif; ?>
		</select>
		<?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}else{
		return false;
	}
}

add_filter( 'em_ticket_get_spaces_options', 'em_snippet_ticket_get_spaces_options', 20, 4 );
?>