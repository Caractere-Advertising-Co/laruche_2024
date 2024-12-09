<?php
/* Template Name: listing biens*/

get_header();?>

<section id="title-section">
    <div class="container">
        <?php
            if(is_page(843)):
                echo '<h1>Tous nos biens à <strong>vendre</strong></h1>';
            else :
                echo '<h1>Tous nos biens à <strong>louer</strong></h1>';
            endif;
        ?>
    </div>
</section>

<?php

get_template_part( 'templates-parts/section-listing-bien' );

get_footer();

?>