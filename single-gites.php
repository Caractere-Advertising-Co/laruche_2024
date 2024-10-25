<?php
/*
Template Name: Gites
Template Post Type: gites, gite, gîte, gîtes
*/

get_header();

$surtitre = get_field('surtitre');
$titre = get_field('titre');
$price = get_field('price');

$subtitle = get_field('surtitre-intro');
$titrintro = get_field('titre-intro');
$intro = get_field('introduction');

$cta = get_field('cta');

/* Nos Chambres */

$surtitre_chamres = get_field('surtitre-chambres');
$titre_chambres = get_field('titre-chambres');
$ctaChambres = get_field('cta-gites');

/* Séparator */
$imgSep = get_field('image-separator');

$bg_header = get_field('bg_header');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;?>

<div id="modal-chambre">
    <div class="container_popup">
    </div>
</div>

<header id="header" >
    <img src="<?php echo $bg_url;?>" alt="<?php echo $bg_header['title'];?>"/>
    <div class="container">
        <?php if($surtitre): echo '<span class="subtitle">'.$surtitre.'</span>'; endif;?>
        <?php if($titre): echo $titre; endif;?>
        <?php if($price): echo '<span class="cta">ÀPD DE '.$price.'€ LA NUIT';endif;?>
    </div>

    <div class="booking">
        <form class="research-bar" action="<?php echo get_bloginfo('url').'/booking';?>" method="POST">
            <div class="research-bar__item">
                <select class="research-bar__item--input gites" name="gites">
                    <option value="la-chapelle">La Chapelle</option>
                    <option value="la-passerelle">La Passerelle</option>
                </select>
            </div>
            <div class="research-bar__item">
                <input class="research-bar__item--input date" type="text" name="check-in" id="check-in" placeholder="Date d'arrivée" />
            </div>
            <div class="research-bar__item">
                <input class="research-bar__item--input date" type="text" name="check-out" id="check-out" placeholder="Date de départ" />
            </div>
            <div class="research-bar__item">
                <input class="research-bar__item--input people" type="text" name="people" id="people" placeholder="Personnes" />
            </div>  
            <div class="research-bar__item button">
                <input type="submit" id="rechercher" value="Rechercher" />
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
    jQuery(document).ready(function($){
        $("#check-in, #check-out").datepicker({ dateFormat: 'dd/mm/yy' });
    });
    </script>
</header>

<section id="simple-page">
    <div class="container">
        <div class="section-intro">
            <?php if($subtitle) : echo '<span class="subtitle">'.$subtitle.'</span>';endif;?>
            <?php if($titrintro) : echo $titrintro;endif;?>
            
            <div class="intro from-bottom"><?php if($intro) : echo $intro;endif;?></div>
        </div>

        <div class="content-toggle">
            <?php if(have_rows('informations_gites')):
                    while(have_rows('informations_gites')): the_row();
                        $title = get_sub_field('titre');
                        $content = get_sub_field('explication');
                    
                        ?>
                        <div class="title-toggle accordion">
                           <h2><?php echo $title;?></h2>
                        </div>

                        <div class="content-toggle panel <?php echo $title == 'Aménagement' ? 'amenagements' : '';?>">
                            <?php echo $content;?>
                        </div>
                    <?php endwhile;
                endif;
            ?>
        </div>

        <?php echo '<a href="'.$ctaChambres['url'].'" class="cta">'.$ctaChambres['title'].'</a>';?>
    </div>
</section>

<section id="nos-chambres">
    <div class="container">
        <?php 
            $surtitre = get_field('surtitre-chambres');
            $titre = get_field('titre-chambres');
        
            $galerie = get_field('galerie-chambres');

            if($surtitre): echo '<h3 class="subtitle">'.$surtitre.'</h3>';endif;
            if($titre): echo $titre;endif;

            if($galerie):?>
                <div class="swiper swiper-chambres">
                    <div class="swiper-wrapper">
                        <?php
                        foreach($galerie as $g):?>
                            <div class="swiper-slide views-rooms" data-index="<?php echo $g->ID;?>">
                                <?php echo get_the_post_thumbnail( $g->ID);?>
                                <h3 class="content-slider"><?php echo $g->post_title;?></h3>
                                <p class="hover-effect">+</p>
                            </div>
                        <?php endforeach;?>
                    </div>
                    
                </div>


                <div class="swiper-chambre-button-prev"></div>
                <div class="swiper-chambre-button-next"></div>

            <?php endif;
        ?>
    </div>
</section>

<?php if($imgSep):?>
    <section id="photo-separator">
        <img src="<?php echo $imgSep['url'];?>" alt="<?php echo $imgSep['title'];?>"/>
    </section>
<?php endif;?>

<?php get_template_part( 'templates-parts/section-extra' );?>
<?php get_template_part( 'templates-parts/section-citation' );?>
<?php get_template_part( 'templates-parts/section-acco-infos' );?>
<?php get_template_part( 'templates-parts/disclaimer-banner' );?>

<?php get_template_part( 'templates-parts/section-cta-contact' );?>

<?php get_footer();