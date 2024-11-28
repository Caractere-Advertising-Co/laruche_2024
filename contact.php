<?php
/*
Template Name: Contact
*/

get_header();

$surtitre = get_field('surtitre-header');
$titre = get_field('titre-header');
$intro = get_field('introduction');

$form  = get_field('formulaire');
?>
<section id="contact-introduction">
    <div class="title titlelvl2">
        <?php if($surtitre): echo '<h1 class="subtitle">'.$surtitre.'</h1>'; endif;?>
        <?php if($titre): echo $titre; endif;?>
    </div>
    <div class="content entry-content"><?php if($intro): echo $intro; endif;?></div>
</section>

<section id="formulaire">
    <?php if($form): echo do_shortcode( $form ); endif;?>
</section>

<?php get_footer();
