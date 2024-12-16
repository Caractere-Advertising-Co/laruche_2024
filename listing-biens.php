<?php
/* Template Name: listing biens*/

$btnCta       = get_field('cta_listing','options');
$titleListing = get_field('title_listing','options');

get_header();?>


<section id="btn-listing-biens">


<div class="container">
        <?php if($btnCta): echo '<div class="btn cta"><a href="'.$btnCta['url'].'">'.$btnCta['title'].'</a><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></div>'; endif;?>
    </div>
        </section>
<section id="title-section">

    <div class="container">
        <?php
            if(is_page(843)):
                echo '<h1>Découvrez tous <br><strong>nos biens à vendre</strong></h1>';
            else :
                echo '<h1>Découvrez tous <br><strong>nos biens à louer</strong></h1>';
            endif;
        ?>
    </div>
</section>

<?php

get_template_part( 'templates-parts/section-listing-bien' );

get_footer();

?>