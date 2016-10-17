<?php
/**
 * Author template tags examples
 */
?>

<header>
	<h1><?php the_title(); ?></h1>
	<p class="byline">by <?php the_author(); ?> | <?php echo get_the_date(); ?></p>
</header>

<p class="more-posts">More posts by <?php the_author_posts_link(); ?></p>