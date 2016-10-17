<?php 

/**
 * Get term information
 */

$term_id = get_queried_object()->term_id; 
$current_term = get_term( $term_id, 'ptd_genre' );
?>
<header class="taxonomy-heading">
	<h2><?php echo $current_term->name; ?></h2>
	<p><?php echo $current_term->description; ?></p>
</header>
