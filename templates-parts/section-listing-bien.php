<?php 

$btnCta       = get_field('cta_listing','options');
$titleListing = get_field('title_listing','options');

if(is_front_page(  )):
    $offset = 6;
else : 
    $offset = 9;
endif;

?>

<section id="listing-biens">
    <?php if(is_front_page(  )):?>
        <div class="container">
            <?php if($btnCta): echo '<div class="btn cta"><a href="'.$btnCta['url'].'">'.$btnCta['title'].'</a><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></div>'; endif;?>
            <div class="title-section"><?php if($titleListing): echo $titleListing; endif;?></div>
        </div>
    <?php endif;?>

    <div class="container grid grid-biens">
        <?php 

        $args = array(
            'post_type' => 'biens',
            'post_status' => 'publish',
            'posts_per_page' => $offset
        );

        $biens = new WP_Query($args);

        if($biens->have_posts()):
            while($biens->have_posts()): $biens->the_post();
                $title    = get_the_title();
                $thb      = get_field('miniature');
                $tyPEB    = get_field('type_peb');
                $peb      = get_field('PEB');
                $pebDble  = get_field('PEB_double');
                $typeBien = get_field('type_de_bien');
                $lieu     = get_field('lieu');
                $prix     = get_field('prix');
                $chambre  = get_field('chambres');
                $surfHab  = get_field('surf_habitable');
                $surfTot  = get_field('surf_totale');
                $fairOff  = get_field('faireOffre');
                $new      = get_field('new');
            ?>
                <div class="card">
                    <a href="<?php echo get_permalink();?>">
                        <div class="block-img miniature-bien" <?php if($thb):?>style="background-image:url('<?php echo $thb['url'];?>');"<?php endif;?>>
                            <?php if($new):?><span class="statut">New</span><?php endif;?>

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
                        <?php if($title): echo '<h3>'.$title.'</h3>'; endif;?>
                        <div class="columns details">
                            <?php if($chambre): echo '<div class="room"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/bed.png" alt="icone_bed" class="icon"/></div><p>'.$chambre.' Chs</p></div>'; endif;?>
                            <?php if($surfHab): echo '<div class="surfHab"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/house.png" alt="icone_bed" class="icon"/></div><p>'.$surfHab.' m2</p></div>'; endif;?>
                            <?php if($surfTot): echo '<div class="surfTot"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/surf_totale.png" alt="icone_bed" class="icon"/></div><p>'.$surfTot.' m2</p></div>'; endif;?>
                        </div>
                        <div class="cta price">
                            <?php 
                                echo $fairOff ? 'Foàpd' : '';
                                if($prix): echo $prix . '€'; endif;
                                echo $typeBien = 'A louer' ? '/mois' : '';
                            ?>
                        </div>
                    </a>
                </div>
            <?php endwhile;
        endif;

        wp_reset_postdata();
        ?>
    </div>

        <div class="container columns cta-biens">
            <?php if(is_front_page(  )):
                $urlSale = get_field('lien_page_vendre');
                $urlLocation = get_field('lien_page_louer');
            ?>

            <a href="<?php if($urlSale): echo $urlSale['url'];endif;?>" class="cta"><?php echo $urlSale['title'];?></a>
            <a href="<?php if($urlLocation): echo $urlLocation['url'];endif;?>" class="cta"><?php echo $urlLocation['title'];?></a>
            <?php else :?>
                <a href="#!" class="cta" id="load-more-biens">Chargez plus</a>
            <?php endif;?>
        </div>
   
</section>