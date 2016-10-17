<?php

/**
 * Remove the comments URL field
 */

function remove_comment_url_fields($fields) {
    if(isset($fields['url']))
    {
         unset($fields['url']);
    }
    return $fields;
}
add_filter('comment_form_default_fields','remove_comment_url_fields');
