<?php
/**
 * Multiple loops with get_posts
 */
?>

<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
	<div <?php post_class(); ?>>
		<h2><?php the_title(); ?></h2>
		<p><?php the_content(); ?></p>
	</div>
<?php endwhile; ?>

<p>Sorry that post could not be found</p>

<?php endif; ?>

<div class="related-posts">
	<h2>Related Posts</h2>
	<?php
	// globalise the post
	global $post;
	// get the categories the post is in
	$cats = get_the_category( $post->ID );
	$cat_ids = array(); // empty array to put the IDs into

	// Loop through the categories and store the IDs in an array
	foreach( $cats as $cat ):
		$cat_ids[] = $cat->term_id;
	endforeach;
	
	// Set up the arguments for the query
	$args = array(
		'post_type' => 'post',
		'category__in' => $cat_ids,
	);
	
	// Run the query
	$related_posts = get_posts($args); ?>
	<ul id="related-posts">
		<?php foreach( $related_posts as $related ): ?>
			<li><a href="<?php echo get_permalink( $related->ID ); ?>"><?php echo $related->post_title; ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>