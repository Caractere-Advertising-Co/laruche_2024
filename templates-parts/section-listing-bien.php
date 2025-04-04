<?php 

$btnCta       = get_field('cta_listing','options');
$titleListing = get_field('title_listing','options');

// Définir le type de bien en fonction de la page
$type = ''; // Initialisation de la variable

if (is_page(28951) || is_page(843)) {
    $type = "A vendre";
} elseif (is_page(28963)) {
    $type = "A louer";
}

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$paged = max(1, $paged); // Garantit que $paged est toujours >= 1

// Requête pour la front-page (afficher les 2 types de biens)
if (is_front_page()) {
    $args = array(
        'post_type'      => 'biens',
        'post_status'    => 'publish',
        'posts_per_page' => -1, // Ou définis une valeur spécifique pour limiter les biens affichés
        'orderby'        => 'date', // Tu peux trier les biens comme tu veux
        'order'          => 'DESC'
    );
} else {
    // Requête pour les pages spécifiques (un type de bien à la fois)
    $args = array(
        'post_type'      => 'biens',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_query'     => array(
            array(
                'key'     => 'type_de_bien',
                'value'   => $type,
                'compare' => '='
            )
        )
    );
}

$biens_query = new WP_Query($args);


$recentAndActive = [];
$oldSold = [];

if ($biens_query->have_posts()) {
    while ($biens_query->have_posts()) {
        $biens_query->the_post();

        $statut      = get_field('statut_bien');
        $prix        = get_field('prix');
        $publishDate = get_the_date('Ymd');
        $daysDiff    = intval((strtotime(date('Ymd')) - strtotime($publishDate)) / (60 * 60 * 24));

        $group = 'recentAndActive';
        if ($statut === 'Vendu' && $daysDiff > 180) {
            $group = 'oldSold';
        }

        $postData = [
            'ID'    => get_the_ID(),
            'prix'  => $prix ? intval($prix) : 0,
            'post'  => $post,
        ];

        if ($group === 'recentAndActive') {
            $recentAndActive[] = $postData;
        } else {
            $oldSold[] = $postData;
        }
    }

    usort($recentAndActive, fn($a, $b) => $a['prix'] <=> $b['prix']);
    usort($oldSold, fn($a, $b) => $a['prix'] <=> $b['prix']);

    $allPosts = array_merge($recentAndActive, $oldSold);
} else {
    $allPosts = [];
}

$per_page = is_front_page() ? 6 : 15;
$total_posts = count($allPosts);
$total_pages = ceil($total_posts / $per_page);

$offset = ($paged - 1) * $per_page;
$displayPosts = array_slice($allPosts, $offset, $per_page);

wp_reset_postdata();
?>

<section id="listing-biens">
    <?php if(is_front_page()):?>
        <div class="container">
            <div class="title-section"><?php if($titleListing): echo $titleListing; endif;?></div>
        </div>
    <?php else : ?>
        <div class="container columns">
            <div id="title-section">
                <?php if(is_page(28951)):
                    echo '<h1>Nos <strong>biens à vendre</strong></h1>';
                else :
                    echo '<h1>Nos <strong>biens à louer</strong></h1>';
                endif; ?>
            </div>
        </div>
    <?php endif; ?>


    <?php if (is_front_page() && empty($allPosts)): ?>
        <div class="container"><p>Aucun bien disponible pour le moment.</p></div>
    <?php elseif(!empty($displayPosts)) : ?>
        
        <div class="container grid grid-biens">
            <?php 
            foreach ($displayPosts as $postData) :
                $post = $postData['post'];
                setup_postdata($post);

                $title      = get_the_title();
                $thb        = get_field('miniature');
                $tyPEB      = get_field('type_peb');
                $statut     = get_field('statut_bien');
                $peb        = get_field('PEB');
                $pebDble    = get_field('PEB_double');
                $typeBien   = get_field('type_de_bien');
                $categorie  = get_field('categorie_bien');
                $lieu       = get_field('situation_lieu');
                $prix       = get_field('prix');
                $chambre    = get_field('chambres');
                $surfHab    = get_field('surf_habitable');
                $surfTot    = get_field('surf_totale');
                $fairOff    = get_field('faireOffre');
                $validLink  = array('Vendu','Loué');

                $publishDate = get_the_date('Ymd');
                $currentDate = date('Ymd');
                $daysDiff    = intval((strtotime($currentDate) - strtotime($publishDate)) / (60 * 60 * 24));

                $isNew = $daysDiff <= 30;
                
            ?>
                <div class="card">
                    <?php echo in_array($statut,$validLink) ? '' :  '<a href="'.get_permalink().'">'; ?>
                        <div class="block-img miniature-bien" <?php if($thb):?>style="background-image:url('<?php echo $thb;?>');"<?php endif;?>>
                            <?php if($isNew):?><span class="statut">Nouveau</span><?php endif;?>
                            <?php if($statut):
                                switch($statut){
                                    case 'Vendu':   
                                        echo '<span class="statutBien">Vendu !</span>';
                                        break;
                                    case 'Sous option':
                                        echo '<span class="statutBien ssOption">Sous <br> option</span>';
                                        break;
                                    case 'Loué':
                                        echo '<span class="statutBien">Loué !</span>';
                                        break;
                                }
                            endif;?>

                            <div class="logo_peb">
                                <?php if($tyPEB && $pebDble): ?>
                                    <img src="<?php echo get_template_directory_uri().'/assets/images/20px_bi/'. $pebDble.'.png';?>" alt="<?php echo $pebDble;?>" />
                                <?php elseif($peb): ?>
                                    <img src="<?php echo get_template_directory_uri().'/assets/images/20px_un/'. $peb.'.png';?>" alt="<?php echo $peb;?>" />
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if($title): echo '<h3><strong>' . $categorie . '</strong> - <strong>'. $lieu . '</strong></h3>'; endif;?>
                        <div class="columns details">
                            <?php if($chambre): ?><div class="room"><div class="block-img"><img src="<?php echo get_template_directory_uri();?>/assets/images/bed.png" alt="icone_bed" class="icon"/></div><p><?php echo $chambre; ?></p></div><?php endif;?>
                            <?php if($surfHab): ?><div class="surfHab"><div class="block-img"><img src="<?php echo get_template_directory_uri();?>/assets/images/house.png" alt="icone_bed" class="icon"/></div><p><?php echo $surfHab; ?> m²</p></div><?php endif;?>
                            <?php if($surfTot): ?><div class="surfTot"><div class="block-img"><img src="<?php echo get_template_directory_uri();?>/assets/images/surf_totale.png" alt="icone_bed" class="icon"/></div><p><?php echo $surfTot; ?></p></div><?php endif;?>
                        </div>
                        <div class="cta price">
                            <?php 
                                echo $fairOff ? 'FO àpd ' : ''; 
                                if($prix): echo $prix ; endif;
                                echo ($typeBien == 'À louer') ? '€ / mois' : ' €';    
                            ?>
                        </div>
                    <?php echo in_array($statut,$validLink) ?  '' : '</a>' ; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="container"><p>Aucun bien trouvé.</p></div>
    <?php endif; ?>

    <?php if (!is_front_page() && $total_pages > 1): ?>
        <div class="container columns cta-biens number-listing">
            <?php echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%',
                'current' => $paged,
                'total' => $total_pages
            )); ?>
        </div>
    <?php endif; ?>
</section>
