<?php
$post_type = get_post_type();
if ($post_type === 'biens') {
    include( get_template_directory() . '/single-biens.php' );
    exit;
}
?>
