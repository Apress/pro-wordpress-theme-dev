<?php

// Single switch 

switch_to_blog( 2 );
// Do stuff
restore_current_blog();


// Multiple switches

$current_blog = get_current_blog_id();

$updated = get_last_updated();
foreach ( $updated as $blog ) :
	
	switch_to_blog( $blog['blog_id'] );

	// Do stuff

endforeach; 

switch_to_blog( $current_blog );
