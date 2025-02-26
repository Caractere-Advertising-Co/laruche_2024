<?php
/* Template Name: listing biens*/

$titleListing = get_field('title_listing','options');

get_header();
    get_template_part( 'templates-parts/section-listing-bien' );
get_footer();

?>