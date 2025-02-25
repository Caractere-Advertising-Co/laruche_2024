<?php
/*
Template Name: Single Biens
Template Post Type: biens, post
*/

// Include autoloader
require_once 'vendor/autoload.php';

error_reporting(E_ALL & ~E_NOTICE);

// Reference the Dompdf namespace //MUST COME AT TOP OF FILE IN PUBLIC SCOPE
use Dompdf\Dompdf;

$html = ""; // the variable to hold our html

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cf-submit'])) {
    $html_to_process = get_html();
    stream_pdf_file($html_to_process); // function to write the html to pdf and stream pdf
}

get_header();

$surtitre      = get_field('surtitre');
$titre         = get_field('titre');

$bg_header     = get_field('bg_header');

if(!$bg_header):
    $bg_url    = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url    = $bg_header['url'];
endif;

$imgTr         = get_field('image-transition');
$contentTr     = get_field('content-transition');
$ctaTr         = get_field('cta-transition');

$ctaNotaire    = get_field('cta-notaire','options');

$introduction  = get_field('description');
$adresse       = get_field('adresse_bien');
$galerie       = get_field('galerie');

// CARACT. BIEN

$title         = get_the_title();
$thb           = get_field('miniature');
$tyPEB         = get_field('type_peb');
$peb           = get_field('PEB');
$lieu          = get_field('situation_lieu');
$categorie     = get_field('categorie_bien');
$pebDble       = get_field('PEB_double');
$typeBien      = get_field('type_de_bien');
$prix          = get_field('prix');
$priceAim      = get_field('prix_achat_im');
$compBien      = get_field('composition_du_bien');
$surfHab       = get_field('surf_habitable');
$surfTot       = get_field('surf_totale');
$fairOff       = get_field('faireOffre');
$new           = get_field('new');

$situation     = get_field('situation');
$environnement = $situation['type_denvironnement'];
$inondation    = $situation['inondation'];
$refCada       = $situation['ref_cada'];

$rc            = get_field('rc');

$icones = get_field('icones_biens','options');

?>

<section id="introduction-single-bien">
    <div class="container">
        <h1><?php echo '<strong>' . $lieu . '</strong> - <span class="price">'. $prix . ' €</span>';?></h1>
        <p><?php if($adresse): echo $adresse; endif;?></p>
    </div>

    <div class="container columns">
        <a href="<?php echo get_permalink(45385);?>?&sujet=<?php echo $lieu . ' - ' . $adresse. ' €';?>" class="cta">Planifier une visite</a>
        <form method="post" class="topdf" id="tt_form" target="_blank">
            <button type="submit" class="cta" id="btn" name="cf-submit"
                value=""><?php _e('Fiche du bien', 'ajd') ?></button>
        </form>
    </div>

    <div class="container">
        <?php if($ctaNotaire):?>
            <a href="<?php echo $ctaNotaire['url'];?>" class="ctanotaire" target="_blank"><?php echo $ctaNotaire['title'];?></a>
        <?php endif;?>
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
        <?php if(!empty($surfTot)): echo '<div class="col"><div class="block-img"><img src="'.$icones['superficie_terrain']['url'].'" alt="'.$icones['superficie_terrain']['name'].'"/></div><p>Superficie terrain<br><strong>'.$surfTot.'</strong></p></div>'; endif;?>
        <?php if(!empty($surfHab)): echo '<div class="col"><div class="block-img"><img src="'.$icones['surface_habitable']['url'].'" alt="'.$icones['surface_habitable']['name'].'"/></div><p>Surface habitable<br><strong>'.$surfHab.' m2</strong></p></div>'; endif;?>
        <?php if(!empty($compBien['salle_de_bain'])): echo '<div class="col"><div class="block-img"><img src="'.$icones['salle_de_bain']['url'].'" alt="'.$icones['salle_de_bain']['name'].'"/></div><p>Salle(s) de bain<br><strong>'.$compBien['salle_de_bain'].'</strong></p></div>'; endif;?>
        <?php if(!empty($compBien['chambre'])): echo '<div class="col"><div class="block-img"><img src="'.$icones['nombre_de_chambre']['url'].'" alt="'.$icones['nombre_de_chambre']['name'].'"/></div><p>Nbre de chambre(s)<br><strong>'.$compBien['chambre'].'</strong></p></div>'; endif;?>
        <?php if(!empty($compBien['garage'])): echo '<div class="col"><div class="block-img"><img src="'.$icones['garage_carport']['url'].'" alt="'.$icones['garage_carport']['name'].'"/></div><p>Garage / Carport<br><strong>'.$compBien['garage'].'</strong></p></div>'; endif;?>
    </div>
</section>

<section id="introduction-biens">
    <div class="container"><?php if($introduction): echo $introduction; endif;?></div>
</section>

<section id="caracteristiques-biens">
    <div class="container section-title">
        <h2>Caractéristiques</h2>

        <div class="columns">
            <?php if($lieu):?>
                <div class="toggle-section">
                    <h3 class="toggle-button accordion">Localisation</h3>
                
                    <div class="toggle-content">
                        <?php if($lieu): echo '<p>'.$lieu.'</p>'; endif;?>
                    </div>
                </div>
            <?php endif;?>
            <?php if($rc):?>
                <div class="toggle-section">
                    <h3 class="toggle-button accordion">Revenu cadastral</h3>
            
                    <div class="toggle-content">
                        <?php if($rc): echo '<p>'.$rc.'</p>'; endif;?>
                    </div>
                </div>
            <?php endif;?>
            <?php if($refCada):?>
                <div class="toggle-section">
                    <h3 class="toggle-button accordion">Reférence cadastral</h3>
                
                    <div class="toggle-content">
                        <?php if($refCada): echo '<p>'.$refCada.'</p>'; endif;?>
                    </div>
                </div>
            <?php endif;?>
            <?php if($prix):?>
                <div class="toggle-section">
                    <h3 class="toggle-button accordion">Faire offre à partir de</h3>
                
                    <div class="toggle-content">
                        <?php if($prix): echo '<p>'.$prix.'</p>'; endif;?>
                    </div>
                </div>
            <?php endif;?>
            <?php if($priceAim):?>
                <div class="toggle-section">
                    <h3 class="toggle-button accordion">Prix d'achat immédiat</h3>
                
                    <div class="toggle-content">
                        <?php if($priceAim): echo '<p>'.$priceAim.'</p>'; endif;?>
                    </div>
                </div>
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

get_footer();

function stream_pdf_file($contents){
    // Instantiate and use the dompdf class

    $dompdf = new Dompdf();

    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->set_option('isPhpEnabled', true);
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->loadHtml($contents);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'Portrait');

    // Render the HTML as PDF
    $dompdf->render();
    $outputfile = 'PDFpage.pdf';

    //to browser
    ob_end_clean();
    $dompdf->stream($outputfile, array('Attachment' => 0));

    exit(0);
}

function get_html(){
    // start buffering html, dont send to browser,
    // note no white space at start of html after php end tag.

    ob_start();

    

$surtitre      = get_field('surtitre');
$titre         = get_field('titre');

$logo          = get_field('logo-entreprise','options');

$introduction  = get_field('description');
$adresse       = get_field('adresse_bien');

// CARACT. BIEN

$title         = get_the_title();
$thb           = get_field('miniature');
$tyPEB         = get_field('type_peb');
$peb           = get_field('PEB');
$lieu          = get_field('lieu');
$categorie     = get_field('categorie_bien');
$pebDble       = get_field('PEB_double');
$typeBien      = get_field('type_de_bien');
$prix          = get_field('prix');
$compBien      = get_field('composition_du_bien');
$surfHab       = get_field('surf_habitable');
$surfTot       = get_field('surf_totale');
$fairOff       = get_field('faireOffre');
$achatImm      = get_field('achat-immediat');

$situation     = get_field('situation');
$environnement = $situation['type_denvironnement'];
$inondation    = $situation['inondation'];


    // =========   HTML CODE BEGINS HERE AFTER PHP END TAG ====================
?>
<!DOCTYPE html>
    <html>
      <head>
            <meta charset="UTF-8">
            <title>La Ruche Immobilière - Fiche bien</title>

            <style>
                *{
                    margin:0;
                    padding:0;
                    font-family: 'Montserrat',sans-serif;
                }
                
                header{
                    padding: 20px 50px;
                    background: #fcc307;
                    color: #fff;
                    height: .8cm;
                }

                header .logo{
                    height: 2.5cm;
                    position: absolute;
                }

                header .contact{
                    position: absolute;
                    right: 1cm;
                    top: .7cm;
                }

                header .contact a{
                    text-decoration: none;
                    font-size: .8rem;
                    color : #fff;
                    letter-spacing: 1px;
                    font-weight: 400;
                }

                .container{
                    width:18cm;
                    margin: .7cm auto;
                    text-align: center;
                }

                .container h1{
                    font-size: 1.5rem;
                    margin-top: .5cm;
                    text-transform: uppercase;
                }

                .container h2{
                    font-size: 1rem;
                    color: #fcc307;
                }

                .block-img{
                    width: 16cm;
                    height: 8cm;
                    margin:auto;
                    overflow: hidden;
                }

                .block-img img{
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                #blockGray{
                    background: #eee;
                    padding: 25px;
                    margin: 30px auto;
                }

                section .description,
                section .caracteristiques{
                    width: 16cm;
                    font-size: .65rem;
                    margin: auto;
                    text-align: justify;
                    line-height: .9rem;
                }
                

                section .description h3{
                    font-size: .9rem;
                    margin: 15px 0 5px 0;
                    color: #fcc307;
                    font-weight: 400;
                }

                .separator{
                    width: 16cm;
                    height:1px;
                    background: #fcc307;
                    display:block;
                    margin: .5cm auto;
                }
                
                .price{
                    font-weight: 700;
                }

                footer{
                    background : #fcc307;
                    color: #fff;
                    font-size: .7rem;
                    position: absolute;
                    font-weight: 7  00;
                    bottom: 0;
                    left: 0;
                    width: 21cm;
                    height: 2cm;
                    padding-bottom: .8cm;
                }

                footer p span{
                    margin: 10px auto 0;
                    display: block;
                    font-size: .5rem;
                }

                footer a{
                    color: #fff;
                    text-decoration: none;
                }
            </style>
      </head>
      <body>
            <header>
                <div class="logo">
                    <img src="<?php echo $logo['url'];?>" class="logo"/>
                </div>

                <div class="contact">
                <a href="info@larucheimmobiliere.be">info@larucheimmobiliere.be</a> • <a href="tel:0032495563099">0495 56 30 99</a>
                </div>
            </header>

            <section>
                <div class="container">
                    <h1><?php echo $lieu;?></h1>
                    <h2><?php echo $adresse;?></h2>
                </div>
            </section>

                <div class="block-img"><img src="<?php echo $thb['url'];?>" height="400"/></div>
    
            <section id="blockGray">
                <div class="description">
                    <?php echo $introduction;?>
                </div>
            </section>
            <section>
                <div class="caracteristiques">
                <h3> Les caractéristiques de ce bien : </h3>
                
                <p><strong>Localisation :</strong> <?php echo $lieu;?></p>
                <p><strong>Surface habitable :</strong> <?php echo $surfHab;?></p>
                <p><strong>Libre :</strong></p>
                <p><strong>Superficie :</strong> <?php echo $surfTot;?></p>
                <p><strong>Electricité conforme :</strong> <?php echo $peb;?></p>
                <p><strong>Zone inondable :</strong> <?php echo $inondation;?></p>

                <span class="separator"></span>
                </div>

                <div class="container price"> 
                    Faire offre à partir de : <?php echo $prix ;?> €
                    <?php if($achatImm): echo 'Prix d\'achat immédiat:' . $achatImm . '€'; endif;?>
                </div>
            </section>

            <footer>
                <div class="container">
                    <p>S.P.R.L. La Ruche Immobilière - TVA 0421 755 406<br>
Christopher Roekaerts : gérant et agent agréé IPI n°508390 - <a href="info@larucheimmobiliere.be">info@larucheimmobiliere.be</a><br>
Place du Centre n°2 Bte 1 - 6120 Nalinnes - Tél.: <a href="tel:0032495563099">0495 56 30 99</a><br>
<span>COMPTE BANCAIRE N° BE67 7320 3702 8587 - COMPTE DE TIERS N° BE98 7320 3702 9193</span></p>
                </div>
            </footer>
      </body>
    </html>
  
<?php
    // =========   HTML CODE BEGINS ENDS BEFORE THE BEGINING PHP TAG ====================

    global $html;
    $html = ob_get_contents(); // get all html in buffer to the $html global variable
    ob_end_clean(); // clean the buffer
    return $html; // return html
    exit;
}