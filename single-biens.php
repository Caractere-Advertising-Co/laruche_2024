<?php
/*
Template Name: Single Biens
Template Post Type: biens, post
*/

get_header();

$surtitre   = get_field('surtitre');
$titre      = get_field('titre');

$bg_header  = get_field('bg_header');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;

$imgTr      = get_field('image-transition');
$contentTr  = get_field('content-transition');
$ctaTr      = get_field('cta-transition');

$introduction = get_field('description');
$adresse = get_field('adresse_bien');
$galerie    = get_field('galerie');

// CARACT. BIEN
$title_cara = get_field('title_cara');

$title      = get_the_title();
$thb        = get_field('miniature');
$tyPEB      = get_field('type_peb');
$peb        = get_field('PEB');
$lieu       = get_field('lieu');
$categorie  = get_field('categorie_bien');
$pebDble    = get_field('PEB_double');
$typeBien   = get_field('type_de_bien');
$prix       = get_field('prix');
$compBien   = get_field('composition_du_bien');
$surfHab    = get_field('surf_habitable');
$surfTot    = get_field('surf_totale');
$fairOff    = get_field('faireOffre');
$new        = get_field('new');

$situation  = get_field('situation');
$environnement = $situation['type_denvironnement'];
$inondation    = $situation['inondation'];

?>

<section id="introduction-single-bien">
    <div class="container">
        <h1>
            <?php echo '<strong>' . $categorie . '</strong> - ' . $typeBien .' - <strong>'. $lieu . '</strong><br>';?>
            <?php echo '<span class="price">'. $prix . ' €</span>';?>
        </h1>
    </div>
</section>

<section id="description-biens">
    <div class="container">
        <div class="swiper swiper-single-bien">
            <div class="swiper-wrapper">
                <?php if($galerie):
                    foreach($galerie as $slide):?>
                        <div class="swiper-slide">
                            <a data-fslightbox href="<?php echo $slide['url'];?>">
                                <img src="<?php echo $slide['url'];?>" alt="<?php echo $slide['name'];?>" />
                                <?php if($tyPEB):?>
                                    <div class="logo_peb">
                                        <img src="<?php echo get_template_directory_uri().'/assets/images/20px_bi/'. $pebDble.'.png';?>" alt="<?php echo $pebDble;?>" />
                                    </div>
                                <?php else :?>
                                    <div class="logo_peb">
                                        <img src="<?php echo get_template_directory_uri().'/assets/images/20px_un/'. $peb.'.png';?>" alt="<?php echo $peb;?>" />
                                    </div>
                                <?php endif;?>
                            </a>
                        </div>
                    <?php endforeach;
                endif;?>
            </div>
        </div>

        <div class="swiper-button-prev swiper-single-estate-prev"></div>
        <div class="swiper-button-next swiper-single-estate-next"></div>
    </div>
    <div class="container columns details-biens">
        <?php if($surfTot): echo '<p>Superficie terrain<br><strong>'.$surfTot.'</strong></p>'; endif;?>
        <?php if($surfHab): echo '<p>Surface habitable<br><strong>'.$surfHab.' m2</strong></p>'; endif;?>
        <?php if($compBien): echo '<p>Salle(s) de bain<br><strong>'.$compBien['salle_de_bain'].'</strong></p>'; endif;?>
        <?php if($compBien): echo '<p>Nbre de chambre(s)<br><strong>'.$compBien['chambre'].'</strong></p>'; endif;?>
        <?php if($compBien): echo '<p>Garage / Carport<br><strong>'.$compBien['garage'].'</strong></p>'; endif;?>
    </div>
</section>

<section id="introduction-biens">
    <div class="container"><?php if($introduction): echo $introduction; endif;?></div>
</section>

<section id="caracteristiques-biens">
    <div class="container section-title">
        <?php if($title_cara): echo $title_cara;endif;?>

        <div class="columns">
            <?php if(have_rows('informations_accordeon')):?>
                    <?php while(have_rows('informations_accordeon')): the_row();
                        $title = get_sub_field('titre_section');
                        $content = get_sub_field('contenu_section');
                    ?>
                        <div class="toggle-section">
                            <h3 class="toggle-button accordion"><?php echo $title;?></h3>
                            <div class="toggle-content">
                                <?php if($content): echo $content; endif;?>
                            </div>
                        </div>
                <?php endwhile;?>
            <?php endif;?>
        </div>
    </div>
</section>

<section id="galerie-bien">
    <div class="container">
        <?php if($galerie):
            foreach($galerie as $g):?>
                <a data-fslightbox href="<?php echo $g['url'];?>">
                    <div class="block-img" style="background-image:url('<?php echo $g['url'];?>');">
                    </div>
                </a>
            <?php endforeach;
        endif;?>
    </div>
</section>

<?php

get_template_part( 'templates-parts/section-citation');
get_template_part( 'templates-parts/contact');

get_footer();