<?php 
$btnCta       = get_field('cta_listing','options');
$titleListing = get_field('title_listing','options');

$type = '';
if (is_page(28951) || is_page(843)) {
    $type = "A vendre";
} elseif (is_page(28963)) {
    $type = "A louer";
}

// Pagination
$paged = max(1, get_query_var('paged'));
$posts_per_page = 16;
$six_months_ago = strtotime('-6 months');

// Récupération des biens
$args = array(
    'post_type'      => 'biens',
    'post_status'    => 'publish',
    'posts_per_page' => -1, // On récupère tout pour trier ensuite
    'meta_query'     => array(
        array(
            'key'     => 'type_de_bien',
            'value'   => $type,
            'compare' => '='
        )
    ),
    'meta_key'       => 'prix',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC'
);

$biens_query = new WP_Query($args);
$all_biens = [];

if ($biens_query->have_posts()) {
    while ($biens_query->have_posts()) {
        $biens_query->the_post();
        
        $statut = get_field('statut_bien');
        $date_vendu = get_post_meta(get_the_ID(), 'date_vendu_loue', true);
        $date_vendu_timestamp = $date_vendu ? strtotime($date_vendu) : null;

        $bien = [
            'id' => get_the_ID(),
            'statut' => $statut,
            'date_vendu' => $date_vendu_timestamp
        ];

        // Biens récents en premier, biens vendus/loués de plus de 6 mois en dernier
        if (in_array($statut, ['Vendu', 'Loué']) && $date_vendu_timestamp && $date_vendu_timestamp < $six_months_ago) {
            $all_biens[] = $bien; 
        } else {
            array_unshift($all_biens, $bien); // Insère en début de tableau
        }
    }
}

wp_reset_postdata();

// Appliquer la pagination après tri
$total_biens = count($all_biens);
$total_pages = ceil($total_biens / $posts_per_page);
$offset = ($paged - 1) * $posts_per_page;
$biens_pagination = array_slice($all_biens, $offset, $posts_per_page);

function display_biens($biens_list) {
    foreach ($biens_list as $bien) {
        setup_postdata(get_post($bien['id']));
        
        $title = get_the_title($bien['id']);
        $thb = get_field('miniature', $bien['id']);
        $statut = get_field('statut_bien', $bien['id']);
        $peb = get_field('PEB', $bien['id']);
        $pebDble = get_field('PEB_double', $bien['id']);
        $categorie = get_field('categorie_bien', $bien['id']);
        $lieu = get_field('situation_lieu', $bien['id']);
        $prix = get_field('prix', $bien['id']);
        $typeBien = get_field('type_de_bien', $bien['id']);
        $new = get_field('new', $bien['id']);
        $compBien = get_field('composition_du_bien', $bien['id']);
        $chambre = get_field('chambres', $bien['id']);
        $surfHab = get_field('surf_habitable', $bien['id']);
        $surfTot = get_field('surf_totale', $bien['id']);
        $fairOff = get_field('faireOffre', $bien['id']);
        $validLink = array('Vendu','Loué');

        ?>
        <div class="card">
            <?php echo in_array($statut, $validLink) ? '' : '<a href="'.get_permalink($bien['id']).'">'; ?>
                <div class="block-img miniature-bien" <?php if ($thb) : ?>style="background-image:url('<?php echo $thb; ?>');"<?php endif; ?>>
                    <?php if ($new) : ?><span class="statut">New</span><?php endif; ?>
                    <?php if ($statut === "Vendu") : ?><span class="statutBien">Vendu !</span><?php endif; ?>
                    <div class="logo_peb">
                        <img src="<?php echo get_template_directory_uri().'/assets/images/20px_bi/'. ($pebDble ?: $peb) .'.png';?>" alt="<?php echo $pebDble ?: $peb;?>" />
                    </div>
                </div>
                <h3><strong><?php echo $categorie; ?></strong> - <strong><?php echo $lieu; ?></strong></h3>
                <div class="columns details">
                    <?php if($compBien['chambre']): echo '<div class="room"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/bed.png" alt="icone_bed" class="icon"/></div><p>'.$compBien['chambre'].'</p></div>'; endif;?>
                    <?php if($surfHab): echo '<div class="surfHab"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/house.png" alt="icone_bed" class="icon"/></div><p>'.$surfHab.' m²</p></div>'; endif;?>
                    <?php if($surfTot): echo '<div class="surfTot"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/surf_totale.png" alt="icone_bed" class="icon"/></div><p>'.$surfTot.'</p></div>'; endif;?>
                </div>
                <div class="cta price">
                    <?php 
                        echo $fairOff ? 'FO àpd ' : ''; 
                        if($prix): echo $prix ; endif;
                        echo ($typeBien == 'À louer') ? '€ / mois' : ' €';    
                    ?>
                </div>
            <?php echo in_array($statut, ['Vendu', 'Loué']) ? '' : '</a>'; ?>
        </div>
        <?php
    }

    wp_reset_postdata();
}
?>

<section id="listing-biens">
    <div class="container grid grid-biens">
        <?php display_biens($biens_pagination); ?>
    </div>

    <div class="container columns cta-biens number-listing">
        <?php if ($total_pages > 1) {
            echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%',
                'current' => $paged,
                'total' => $total_pages
            ));
        } ?>
    </div>
</section>
