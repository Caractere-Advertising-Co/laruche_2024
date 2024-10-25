<?php

    $txtPresident = get_field('texte_du_president');
    $galerie = get_field('galerie_service');
    $img = null;
    $cta = get_field('cta_service');

    if(!$txtPresident):
        $txtPresident = get_field('texte_du_president','options');
    endif;

    if(!$galerie):
        $img = get_field('image_nossolutions','options');
    endif;
?>

<section id="mot_president">
    <div class="container">
        <div class="columns">
            <div class="col-g">
                <?php if($txtPresident): echo $txtPresident; endif;?>
                
            </div>
            <div class="col-d from-right">
                <?php if($img):?>
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" class="from-left" />

                <?php elseif($galerie):?>
                    <div class="swiper swiper-blog">
                        <div class="swiper-wrapper">
                            <?php foreach($galerie as $g):?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $g['url'];?>" alt="<?php echo $g['title'];?>"/>
                                </div>
                            <?php endforeach;?>
                        </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>

</section>