<?php
/*
Template Name: A propos
*/

get_header();

$surtitre = get_field('surtitre-header');
$titre = get_field('titre-header');
$intro = get_field('introduction');
$cta   = get_field('cta');

$cta_adv = get_field('cta_qualite');
$btnCta       = get_field('cta_listing','options');

?>


<section id="introduction">
    <div class="container">

        <div class="colg">
            <?php if($surtitre): echo '<h1 class="subtitle">'.$surtitre.'</h1>'; endif;?>
            <?php if($titre): echo $titre; endif;?>
        </div>
        <div class="cold">
            <?php if($intro): echo $intro; endif;?>
            <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'</a>'; endif;?>
        </div>
    </div>
</section>

<?php get_template_part( 'templates-parts/section-citation');?>

<section id="section-avantages">
    <div class="container columns">
        <?php if(have_rows('qualites')):
            while(have_rows('qualites')): the_row();
                $icon = get_sub_field('icone');
                $text = get_sub_field('texte');

                ?>
                <div class="col">
                    <?php if($icon): echo '<div class="block-img"><img src="'.$icon['url'].'" alt="'.$icon['title'].'"/></div>'; endif;?>
                    <?php if($text): echo $text; endif;?>
                </div>
            <?php endwhile;
        endif;?>
    </div>
    <div class="container">
        <?php if($cta_adv): echo '<a href="'.$cta_adv['url'].'" class="cta">'.$cta_adv['title'].'</a>'; endif;?>
    </div>
</section>

<?php get_template_part( 'templates-parts/contact');

get_footer();
