<?php

/**
 * Adding a nonce to links
 */

$base_url = "http://website.com/admin/delete.php?post_id=7";
$nonce_url = wp_nonce_url( $base_url, 'delete_post_noncename' );
?>
<a href="<?php echo $nonce_url; ?>">Delete post</a>
