<?php 

$btnCta       = get_field('cta_listing','options');
$titleListing = get_field('title_listing','options');

$type = '';

if(is_page(28951) || is_page(843)):
    $type = "A vendre";
elseif(is_page(28963)):
    $type = "A louer";
endif;

if(is_front_page(  )):
    $args = array(
        'post_type' => 'biens',
        'post_status' => 'publish',
        'posts_per_page' => 6

    );
else : 
    
    $args = array(
        'post_type'      => 'biens',
        'post_status'    => 'publish',
        'paged'          => $paged,
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
endif;

?>

<section id="listing-biens">
    <?php if(is_front_page(  )):?>
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
        $active_biens = [];
        $old_sold_biens = [];
        $six_months_ago = strtotime('-6 months');

        if ($biens->have_posts()) :
            while ($biens->have_posts()) : $biens->the_post();
                $statut = get_field('statut_bien');
                $date_vendu = get_post_meta(get_the_ID(), 'date_vendu_loue', true);
                $date_vendu_timestamp = $date_vendu ? strtotime($date_vendu) : null;

                if (in_array($statut, ['Vendu', 'Loué']) && $date_vendu_timestamp && $date_vendu_timestamp < $six_months_ago) {
                    $old_sold_biens[] = get_the_ID(); // Biens vendus/loués depuis +6 mois
                } else {
                    $active_biens[] = get_the_ID(); // Biens actifs ou vendus/loués récents
                }
            endwhile;
        endif;

    
    wp_reset_postdata();

    function display_biens($biens_list) {
        foreach ($biens_list as $bien_id):
            setup_postdata(get_post($bien_id));
            
            $title = get_the_title();
            $thb = get_field('miniature', $bien_id);
            $statut = get_field('statut_bien', $bien_id);
            $tyPEB         = get_field('type_peb', $bien_id);
            $pebDble       = get_field('PEB_double', $bien_id);
            $peb           = get_field('PEB', $bien_id);
            $categorie = get_field('categorie_bien', $bien_id);
            $lieu = get_field('situation_lieu', $bien_id);
            $prix = get_field('prix', $bien_id);
            $typeBien = get_field('type_de_bien', $bien_id);
            $new = get_field('new', $bien_id);
            $compBien = get_field('composition_du_bien', $bien_id);
            $chambre   = get_field('chambres', $bien_id);
            $surfHab   = get_field('surf_habitable', $bien_id);
            $surfTot   = get_field('surf_totale', $bien_id);
            $fairOff   = get_field('faireOffre', $bien_id);
            $validLink = array('Vendu','Loué');
    
            ?>
            <div class="card">
                <?php echo in_array($statut,$validLink) ? '' :  '<a href="'.get_permalink($bien_id).'">'; ?>
                    <div class="block-img miniature-bien" <?php if ($thb) : ?>style="background-image:url('<?php echo $thb; ?>');"<?php endif; ?>>
                        <?php if ($new) : ?><span class="statut">New</span><?php endif; ?>
                        <?php if ($statut === "Vendu") : ?><span class="statutBien">Vendu !</span><?php endif; ?>
                    <?php if($tyPEB):?>
                                <div class="logo_peb">
                                    <img src="<?php echo get_template_directory_uri().'/assets/images/20px_bi/'. $pebDble.'.png';?>" alt="<?php echo $pebDble;?>" />
                                </div>
                            <?php else :?>
                                <div class="logo_peb">
                                    <img src="<?php echo get_template_directory_uri().'/assets/images/20px_un/'. $peb.'.png';?>" alt="<?php echo $peb;?>" />
                                </div>
                            <?php endif;?>
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
        endforeach;

        wp_reset_postdata();
    endif; ?>
    
    <div class="container grid grid-biens">
        <?php display_biens($active_biens); ?>
        <?php display_biens($old_sold_biens); ?>
    </div>

    <div class="container columns cta-biens number-listing">
        <?php if(is_front_page(  )):
            $urlSale = get_field('lien_page_vendre');
            $urlLocation = get_field('lien_page_louer');
        ?>

        <a href="<?php if($urlSale): echo $urlSale['url'];endif;?>" class="cta"><?php echo $urlSale['title'];?></a>
        <a href="<?php if($urlLocation): echo $urlLocation['url'];endif;?>" class="cta ctaLoco"><?php echo $urlLocation['title'];?></a>

        <?php else : 
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
            endif;
        endif;?>
    </div>
</section>  

