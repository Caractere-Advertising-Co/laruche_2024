<?php
/*
Template Name: Contact
*/

get_header();

$surtitre    = get_field('surtitre-header');
$titre       = get_field('titre-header');
$intro       = get_field('introduction');

$infoContact = get_field('informations_de_contact');
$cta1        = get_field('cta1');
$cta2        = get_field('cta2');

$form        = get_field('formulaire');
$form2       = get_field('formulaire-recherche');
?>

<section id="contact-introduction">
    <div class="container columns">
        <div class="colg">
            <div class="title titlelvl2">
                <?php if($surtitre): echo '<h1>'.$surtitre.'</h1>'; endif;?>
                <?php if($titre): echo $titre; endif;?>
            </div> 
            <div class="content entry-content"><?php if($intro): echo $intro; endif;?></div>

            <div class="contactInfos"><?php if($infoContact): echo $infoContact; endif; ?></div>
        </div>
        <div class="cold">
            <div class="cta-form columns">
                <?php if($cta1):?><a href="#!" id="ctaVente" class="cta"><?php echo $cta1['title'];?></a><?php endif;?>
                <?php if($cta2):?><a href="#!" id="ctaSearch" class="cta cta-dark inactif"><?php echo $cta2['title'];?></a><?php endif;?>
            </div>
            <section id="formulaire">
                <?php if($form): echo '<div id="formulaire-vendre" class="active">'.do_shortcode( $form ).'</div>'; endif;?>
                <?php if($form2): echo '<div id="formulaire-recherche">'.do_shortcode( $form2 ).'</div>'; endif;?>
            </section>
        </div>
    </div>
</section>



<?php get_footer();
