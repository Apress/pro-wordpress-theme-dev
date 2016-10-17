<?php

/**
 * Simple comments page template
 */
?>


<?php if ( have_comments() ) : ?>
	<section class="comments">
		<h2>Comments</h2>

		<ul>
			<?php wp_list_comments(); ?>
		</ul>	
	</section>
<? endif; ?>
		
<section id="comment-form">
	<h2>Leave a comment</h2>
	<?php comment_form($args); ?>
</section>
