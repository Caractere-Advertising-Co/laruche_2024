<?php 
/* Template Name: Generate PDF */

require 'vendor/autoload.php';
require_once 'dompdf/autoload.inc.php';

error_reporting(E_ALL & ~E_NOTICE);

$html= "";

use Dompdf\Dompdf;

$ob_get_contents = get_html();
gen_pdf($ob_get_contents);

function gen_pdf($content){

  $dompdf = new Dompdf();

  $dompdf->set_option('isRemoteEnabled', TRUE);
  $dompdf->set_option('isPhpEnabled', true);
  $dompdf->set_option('isHtml5ParserEnabled', TRUE);

  $dompdf->loadHtml($content);

  $dompdf->setPaper('A4', 'portrait');
  // Render the HTML as PDF
  $dompdf->render();
  $dompdf->stream();
  //to browser
  ob_end_clean();
}

function get_html(){
  ob_start();

  // =========   HTML CODE BEGINS HERE AFTER PHP END TAG ====================

  $url = get_template_directory_uri();
  global $wpdb;

  $idBien = $_GET['idBien'];
  ?>

  <!DOCTYPE html>
  <html>
    <head>
        <meta charset="UTF-8">
        <title>La Ruche Immobilière - Fiche bien</title>
    </head>
    <body>
        <header><h1>NOM DU BIEN</h1></header>

        <section>
            <div class="description"><h3 style="font-size:14px; color:#c1ac68;"></h3></div>
        </section>

        <footer>
            <p>
                <strong>Toutefois, si vous avez déjà communiqué ces informations, votre réservation est dès lors garantie.<br>
                    <span class="gold">Merci de présenter votre chèque cadeau à la réception dès votre arrivée.</span>
                </strong>
            </p>

            <img id="banner" src="<?php echo $url;?>/assets/images/bandeau-footer.png">

            <p><span class="gold">CONDITIONS D’ANNULATION :</span> En cas d’annulation à l’initiative du client, les frais suivants seront d’application : Du 7e jour au jour du début du séjour inclus ou no-show : 100% du prix de la location.
            En cas d’interruption du séjour et/ou des soins, les montants prévus sont intégralement dus.</p>
            
            <p><span class="gold">DONNÉES PERSONNELLES :</span> Le Château des Thermes respecte le règlement général de la protection des données.
            Il vous est bien entendu loisible de nous contacter si vous souhaitez que vos données soient supprimées au sein de notre établissement. Pour plus d’informations concernant nos conditions générales, veuillez-vous référer à notre site internet : https://www.chateaudesthermes.be/conditions-generales-de-vente/</p>
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