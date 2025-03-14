<?php 

$btnCta       = get_field('cta_listing','options');
$titleListing = get_field('title_listing','options');

$type = '';

if(is_page(28951) || is_page(843)):
    $type = "A vendre";
else if(is_page(28963)):
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
            <?php while ($biens->have_posts()) : $biens->the_post(); ?>
                <div class="card">
                    <a href="<?php the_permalink(); ?>">
                        <div class="block-img miniature-bien" style="background-image:url('<?php echo get_field('miniature'); ?>');">
                            <?php if (get_field('new')) : ?><span class="statut">New</span><?php endif; ?>
                            <?php if (get_field('statut_bien') === "Vendu") : ?><span class="statutBien">Vendu !</span><?php endif; ?>
                        </div>
                        <h3><strong><?php the_field('categorie_bien'); ?></strong> - <strong><?php the_field('situation_lieu'); ?></strong></h3>
                        <div class="columns details">
                            <?php if(get_field('chambres')): ?>
                                <div class="room"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bed.png" alt="icone_bed" class="icon"/><p><?php the_field('chambres'); ?></p></div>
                            <?php endif; ?>
                            <?php if(get_field('surf_habitable')): ?>
                                <div class="surfHab"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/house.png" alt="icone_house" class="icon"/><p><?php the_field('surf_habitable'); ?> m²</p></div>
                            <?php endif; ?>
                        </div>
                        <div class="cta price">
                            <?php if(get_field('faireOffre')): echo 'FO àpd '; endif; ?>
                            <?php the_field('prix'); ?> €
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; 
    wp_reset_postdata(); ?>

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
