<?php
/* Template Name: listing biens*/

$titleListing = get_field('title_listing','options');

get_header();?>


<section id="title-section">

    <div class="container">
        <?php
            if(is_page(28951)):
                echo '<h1>Nos biens à vendre</strong></h1>';
            else :
                echo '<h1>Nos biens à louer</strong></h1>';
            endif;
        ?>
    </div>
</section>

<?php

get_template_part( 'templates-parts/section-listing-bien' );
get_footer();

?>