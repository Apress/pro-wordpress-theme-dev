<?php

/**
 * Testing capabilities for specific types of users
 */

if( is_user_logged_in() ):

	if( current_user_can('manage_gold_membership') ):
		the_content();
	else: ?>
		<p>Sorry that content is only available to Gold members, <a href="/membership">find out more</a>.</p>
	<?php endif;
else:
	// Previous example continues…
