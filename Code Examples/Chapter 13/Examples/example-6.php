<?php

// The method of our class
public function get_rating() {

	// do stuff

	return $rating;
}

// The function for our template tag in our main plugin file
function rar_the_rating($echo = true) {

	$ratings = RatingsAndReviews::get_instance();

	if( $echo ) {
		echo $ratings->get_rating();
	} else {
		return $ratings->get_rating();
	}

}
