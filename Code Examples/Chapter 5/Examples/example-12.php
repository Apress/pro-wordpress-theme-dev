<?php

/**
 * Advanced search with taxonomies and custom meta
 */

// Create a select drop down from the given taxonomy
function prowordpress_build_tax_select( $tax, $label ) {
	// Get all terms - no arguments for the get_terms function means the 
	// function will return only the terms which have been assigned to posts
	$terms = get_terms($tax);

	// Start the select field
	$select = '<select name="'. $tax .'">';
	// Our first option is the instruction field with a blank value
	$select .= '<option value="">Select '. $label .'</option>';
	// Loop through all the terms to create the dropdown list
	foreach ($terms as $term) {
	   $select .= '<option value="' . $term->slug . '">' . $term->name . '</option>';	
	}
	// close the select field
	$select .= '</select>';

	// Return the select field
	return $select;
}


// Build the search form ?>
<h2>Search movies</h2>
<form action="/movie-search" method="post">
	
	<p>
		<label for="search_text">Search:</label>
		<input type="text" name="ptd_movie_search_text" id="search_text">
	</p>

	<?php foreach( $movie_taxonomies as $tax ): ?>
		<p>
		    <label>Movie <?php echo $tax->name; ?>:</label>
		    <?php echo prowordpress_build_tax_select($tax->name, $tax->label); ?>
		</p>
	<?php endforeach; ?>

	<p>
		<label for="movie_rating">Movie certificate:</label>
		<select name="ptd_movie_rating" id="movie_rating">
			<option>Select rating</option>
			<option value="G">G</option>
			<option value="PG">PG</option>
			<option value="PG-13">PG-13</option>
			<option value="R">R</option>
			<option value="NC-17">NC-17</option>
		</select>
	</p>

	<p>
		<label for="running_time">Running time (less than):</label>
		<input type="text" name="ptd_movie_running_time" id="running_time">
	</p>

	<p><input type="submit" value="Search"></p>
	
</form>


<?php

// Build the query arguments

foreach ( $_POST as $key => $value ) { 
	if( '' !== $value ) {

		if( 'ptd_movie_search_text' === $key ) {
			$args['s'] = htmlentities($value);
		}
		elseif( 'ptd_genre' === $key ) {
			$genre['taxonomy'] = htmlspecialchars($key);
			$genre['terms'] = htmlspecialchars($value);
			$genre['field'] = 'slug';
			$args['tax_query'] = $genre;
		}
		elseif( 'ptd_movie_rating' === $key || 'ptd_movie_running_time' === $key ) {
			$meta['key'] = htmlspecialchars($key);
			$meta['value'] = htmlspecialchars($value);

			if( 'ptd_movie_running_time' === $key ) {
				$meta['compare'] = '<';
				$meta['type'] = 'NUMERIC';
			} else {
				$meta['compare'] = '=';
			}

			$meta_query[] = $meta;
		}
	}

	if( isset( $meta_query ) ) {
		$args['meta_query'] = array_merge( array('relation' => 'AND'), $meta_query );
	}

	$args['post_type'] = 'ptd_movie';
}

