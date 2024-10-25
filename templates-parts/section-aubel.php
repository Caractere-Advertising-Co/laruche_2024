<?php
$surtitre = get_field('surtitre_aubel','options'); 
$txtNaissance = get_field('txt_aubel','options');
$image_1 = get_field('image_1_aubel','options');
$image_2 = get_field('image_2_aubel','options');
$ctaNaiss = get_field('cta_naissance','options');
$galerie = get_field('galerie_auble','options');?>

<section id="begin_entreprise">
    <div class="container columns">
        <div class="colg">

            <?php if($galerie): ?>
                <div class="swiper swiper-about">
                    <div class="swiper-wrapper">
                        <?php if($galerie): 
                            foreach($galerie as $gal):?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $gal['url'];?>" alt="<?php $gal['title'];?>"/>
                                </div>
                            <?php endforeach;
                        endif;?>
                    </div>


                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            <?php else : ?>
                <div class="image-left from-left">
                    <img src="<?php echo $image_1['url'];?>" alt="<?php echo $image_1['title'];?>" />
                </div>
                <div class="tiny-image-left from-right">
                    <img src="<?php echo $image_2['url'];?>" alt="<?php echo $image_2['title'];?>" />
                </div>
            <?php endif;?>
        </div>
        <div class="cold">
            <?php if($surtitre): echo '<h3>'.$surtitre.'</h3>'; endif;?>
            <?php if($txtNaissance): echo $txtNaissance; endif;?>
            <?php if($ctaNaiss):?>
                <a href="<?php echo $ctaNaiss['url'];?>" class="cta-border"><?php echo $ctaNaiss['title'];?></a>
            <?php endif;?>
        </div>
    </div>
</section>