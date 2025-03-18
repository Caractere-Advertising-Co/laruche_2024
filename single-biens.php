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

$statut        = get_field('statut_bien');

$title         = get_the_title();
$thb           = get_field('miniature');
$tyPEB         = get_field('type_peb');
$peb           = get_field('PEB');

$infoPeb       = get_field('informations_peb');
$codeUniPEB    = $infoPeb['code_unique_peb'];
$valEnerg      = $infoPeb['valeur_energetique'];
$energieTotal  = $infoPeb['energie_total'];

$infoPeb_2     = get_field('informations_peb_copier');
$codeUniPEB_2  = $infoPeb_2['code_unique_peb'];
$valEnerg_2    = $infoPeb_2['valeur_energetique'];
$energieTotal_2= $infoPeb_2['energie_total'];

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
$elec          = get_field('electricite');

$situation     = get_field('situation');
$environnement = $situation['type_denvironnement'];
$inondation    = $situation['inondation'];
$refCada       = $situation['ref_cada'];

$charge        = get_field('charge');

$rc            = get_field('rc');

$icones = get_field('icones_biens','options');

if($fairOff):   
    $foapd =  'FO àpd ';
else : 
    $foapd = ''; 
endif;

?>

<section id="introduction-single-bien">
    <div class="container">
        <h1><?php echo '<strong>' . $lieu . '</strong> - <span class="price">' . $foapd . ' '. $prix . ' €</span>';?></h1>
        <p><?php if($adresse): echo $adresse; endif;?></p>
    </div>

    <div class="container columns">
        <a href="<?php echo get_permalink(47261);?>?&sujet=<?php echo $lieu . ' - ' . $adresse;?>" class="cta">Planifier une visite</a>
        <form method="post" class="topdf" id="tt_form" target="_blank">
            <button type="submit" class="cta" id="btn" name="cf-submit"
                value=""><?php _e('Fiche du bien', 'ajd') ?></button>
        </form>
        <?php if($ctaNotaire && ($typeBien != "À louer")):?>
            <a href="<?php echo $ctaNotaire['url'];?>" class="ctanotaire cta" target="_blank"><?php echo $ctaNotaire['title'];?></a>
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
        <div class="columns">
            <div class="colg">
                <?php if($adresse):?>
                    <div><p class="toggle-button accordion"><strong>Adresse : </strong><?php echo $adresse ;?></p></div>
                <?php endif;?>

                <?php if($surfHab):?>
                    <div><p class="toggle-button accordion"><strong>Surface habitable :</strong><?php echo $surfHab . ' m²';?></p></div>
                <?php endif;?>

                <?php if($surfTot):?>
                    <div><p class="toggle-button accordion"><strong>Propriété :</strong><?php echo $surfTot;?></p></div>
                <?php endif;?>

                <?php if($rc):?>
                    <div><p class="toggle-button accordion"><strong>Revenu cadastral :</strong><?php echo $rc . ' €';?></p></div>
                <?php endif;?>
                
                <?php if($prix):?>
                    <div><p class="toggle-button accordion"><strong>Faire offre à partir de : </strong><?php echo $prix .' €';?></p></div>
                <?php endif;?>

                <?php if($charge):?>
                    <div><p class="toggle-button accordion"><strong>Charge(s) locative : </strong><?php echo $charge .' €';?></p></div>
                <?php endif;?>

                <?php if($priceAim):?>
                    <div><p class="toggle-button accordion"><strong>Prix d'achat immédiat :</strong><?php echo $priceAim . ' €';?></p></div>
                <?php endif;?>
            </div>
                
            <div class="cold">

                <?php if($peb):?>
                    <div>
                        <p class="toggle-button accordion"><strong>Label énergétique:</strong>
                            <span class="logo_peb">
                                <?php echo $tyPEB == 1 ? '<img src="'.get_template_directory_uri().'/assets/images/20px_bi/'. $pebDble.'.png" alt="'. $pebDble .'" />' : '<img src="'. get_template_directory_uri().'/assets/images/20px_un/'. $peb.'.png" alt="'. $peb.'" />';?>
                            </span>
                        </p>
                    </div>
                    
                    <?php if($tyPEB == 0):?>
                        <div><p class="toggle-button accordion"><strong>Code unique :</strong> <?php echo $codeUniPEB;?></p></div>
                        <div><p class="toggle-button accordion"><strong>Valeur énergétique :</strong> <?php echo $valEnerg;?></p></div>
                        <div><p class="toggle-button accordion"><strong>Energie totale :</strong> <?php echo $energieTotal;?></p></div>
                    <?php else: ?>
                        <div><p class="toggle-button accordion"><strong>Code unique :</strong> <?php echo $codeUniPEB;?></p></div>
                        <div><p class="toggle-button accordion"><strong>Valeur énergétique :</strong> <?php echo $valEnerg;?></p></div>
                        <div><p class="toggle-button accordion"><strong>Energie totale :</strong> <?php echo $energieTotal;?></p></div>
                        <div><p class="toggle-button accordion"><strong>Code unique :</strong> <?php echo $codeUniPEB_2;?></p></div>
                        <div><p class="toggle-button accordion"><strong>Valeur énergétique :</strong> <?php echo $valEnerg_2;?></p></div>
                        <div><p class="toggle-button accordion"><strong>Energie totale :</strong> <?php echo $energieTotal_2;?></p></div>
                    <?php endif;?>
                    
                <?php endif;?>

                <?php if($elec):?>
                    <div>
                        <p class="toggle-button accordion"><strong>Électricité : </strong><?php echo $elec;?></p>
                    </div>
                <?php endif;?>

                <?php if($refCada):?>
                    <div><p class="toggle-button accordion"><strong>Reférence cadastral :</strong><?php echo $refCada;?></p></div>
                <?php endif;?>

                <?php if($compBien['chambre']):?>
                    <div><p class="toggle-button accordion"><strong>Nombre de chambre : </strong><?php echo $compBien['chambre'];?></p></div>
                <?php endif;?>
                
                <?php if($compBien['garage']):?>
                    <div><p class="toggle-button accordion"><strong>Garage :</strong><?php echo $compBien['garage'];?></p></div>
                <?php endif;?>

                <?php if($compBien['salle_de_bain']):?>
                    <div><p class="toggle-button accordion"><strong>Salle de bains :</strong><?php echo $compBien['salle_de_bain'];?></p></div>
                <?php endif;?>

                
            </div>
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

$statut        = get_field('statut_bien');

$title         = get_the_title();
$thb           = get_field('miniature');
$tyPEB         = get_field('type_peb');
$peb           = get_field('PEB');

$infoPeb       = get_field('informations_peb');
$codeUniPEB    = $infoPeb['code_unique_peb'];
$valEnerg      = $infoPeb['valeur_energetique'];
$energieTotal  = $infoPeb['energie_total'];

$infoPeb_2     = get_field('informations_peb_copier');
$codeUniPEB_2  = $infoPeb_2['code_unique_peb'];
$valEnerg_2    = $infoPeb_2['valeur_energetique'];
$energieTotal_2= $infoPeb_2['energie_total'];

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
$elec          = get_field('electricite');

$situation     = get_field('situation');
$environnement = $situation['type_denvironnement'];
$inondation    = $situation['inondation'];
$refCada       = $situation['ref_cada'];

$charge        = get_field('charge');

$rc            = get_field('rc');

$icones = get_field('icones_biens','options');

if($fairOff):   
    $foapd =  'FO àpd ';
else : 
    $foapd = ''; 
endif;

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
                    font-weight: 700;
                    bottom: 0;
                    left: 0;
                    width: 21cm;
                    height: 1.2cm;
                    padding-bottom: .5cm;
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
                <div class="logo"><img src="<?php echo $logo['url'];?>" class="logo"/></div>

                <div class="contact">
                <a href="info@larucheimmobiliere.be">info@larucheimmobiliere.be</a> • <a href="tel:0071303052">T. 071/30 30 52</a>
                </div>
            </header>

            <section>
                <div class="container">
                    <h1><?php echo $lieu;?></h1>
                    <h2><?php echo $adresse;?></h2>
                </div>
            </section>

                <div class="block-img photo_bien"><img src="<?php echo $thb;?>"/></div>
    
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
                    <p>S.R.L. La Ruche Immobilière<br>
                    Tél.: <a href="tel:071303052">071 30 30 52</a> - <a href="info@larucheimmobiliere.be">info@larucheimmobiliere.be</a><br>
                    Place du Centre n°2 - 6120 Nalinnes | Agréation IPI n°508390</p>
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