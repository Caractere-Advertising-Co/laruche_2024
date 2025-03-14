<?php 

$btnCta       = get_field('cta_listing','options');
$titleListing = get_field('title_listing','options');

$type = '';

if(is_page(28951) || is_page(843)):
    $type = "A vendre";
elseif(is_page(28963)):
    $type = "A louer";
endif;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if(is_front_page()):
    $args = array(
        'post_type' => 'biens',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'paged' => $paged
    );
else : 
    $args = array(
        'post_type'      => 'biens',
        'post_status'    => 'publish',
        'paged'          => $paged,
        'posts_per_page' => 16, // Affichage en grille de 16
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
endif;

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

            <div class="columns cta-biens">
                <?php
                $biens = new WP_Query($args);
                if($biens->have_posts()):
                    $total_pages = $biens->max_num_pages;

                    if ($total_pages > 1){
                        $current_page = max(1, get_query_var('paged'));

                        echo paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => '/page/%#%',
                            'current' => $current_page,
                            'total' => $total_pages
                        ));
                    }
                endif;?>
            </div>
        </div>
    <?php endif;

    $biens = new WP_Query($args);

    if ($biens->have_posts()) : ?>
        <div class="container grid grid-biens">
            <?php while ($biens->have_posts()) : $biens->the_post();
               $title     = get_the_title();
                $thb       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
                $tyPEB     = get_field('type_peb');
                $statut    = get_field('statut_bien');
                $peb       = get_field('PEB');
                $pebDble   = get_field('PEB_double');
                $typeBien  = get_field('type_de_bien');
                $categorie = get_field('categorie_bien');
                $lieu      = get_field('situation_lieu');
                $prix      = get_field('prix');
                $compBien  = get_field('composition_du_bien');
                $chambre   = get_field('chambres');
                $surfHab   = get_field('surf_habitable');
                $surfTot   = get_field('surf_totale');
                $fairOff   = get_field('faireOffre');
                $new       = get_field('new');
                $validLink = array('Vendu','Loué');
            ?>
                <div class="card">
                    <?php echo in_array($statut,$validLink) ? '' :  '<a href="'.get_permalink().'">'; ?>
                        <div class="block-img miniature-bien" <?php if($thb):?>style="background-image:url('<?php echo $thb[0];?>');"<?php endif;?>>
                            <?php if($new):?><span class="statut">New</span><?php endif;?>
                            <?php if($statut === "Vendu"):?><span class="statutBien">Vendu !</span><?php endif;?>

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
            <?php endwhile;
        endif;

    wp_reset_postdata();?>

    <div class="container columns cta-biens number-listing">
        <?php if(!$biens->have_posts()) { echo '<p>Aucun bien trouvé.</p>'; } ?>
        <?php 
            $total_pages = $biens->max_num_pages;
            if ($total_pages > 1){
                $current_page = max(1, get_query_var('paged'));
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => '/page/%#%',
                    'current' => $current_page,
                    'total' => $total_pages
                ));
            }
        ?>
    </div>
</section>
