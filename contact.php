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
    <div class="container columns <?php if(is_page(45385)|| is_page(627)): echo '-row'; endif;?>">
        <div class="colg">
            <div class="title titlelvl2">
                <?php if($surtitre): echo '<h1>'.$surtitre.'</h1>'; endif;?>
                <?php if($titre): echo $titre; endif;?>
            </div> 
            <div class="content entry-content"><?php if($intro): echo $intro; endif;?></div>

            <div class="contactInfos"><?php if($infoContact): echo $infoContact; endif; ?></div>
        </div>
        <div class="cold">
            <?php if(is_page(45385) || is_page(627)):?>
                <div class="fleche-form">
                    <div class="block-img"><img src="http://laruche-copie.caractere-advertising.be/wp-content/uploads/2025/03/fleche_gauche.png" alt="laruche_fleche_gauche"/></div>
                    <h2>Quel est <strong>votre projet ?</strong></h2>
                    <div class="block-img"><img src="http://laruche-copie.caractere-advertising.be/wp-content/uploads/2025/03/fleche_droite.png" alt="laruche_fleche_droite"/></div>
                </div>
            <?php endif;?>
            <div class="cta-form columns">
                <?php if($cta1):?><a href="#!" id="ctaVente" class="cta inactif"><?php echo $cta1['title'];?></a><?php endif;?>
                <?php if($cta2):?><a href="#!" id="ctaSearch" class="cta cta-dark inactif"><?php echo $cta2['title'];?></a><?php endif;?>
            </div>
            <section id="formulaire">
                <?php 
                
                $valid;
                if(is_page(47261) || is_page(45386)):
                    $valid = 'active';
                endif;
                
                if($form): echo '<div id="formulaire-vendre" class="'. $valid .'">'.do_shortcode( $form ).'</div>'; endif;?>
                <?php if($form2): echo '<div id="formulaire-recherche">'.do_shortcode( $form2 ).'</div>'; endif;?>
            </section>
        </div>
    </div>
</section>

<?php get_footer();
