<?php
    $bg_actif = get_field('arriere-plan','options');
    if($bg_actif):
        $imgBg = get_field('image_darriere-plan','options');
    endif;
    $surtitre = get_field('surtitre-extras','options');
    $txt = get_field('texte_extras','options');?>

    <section id="section-extra" <?php if($bg_actif): echo 'class=" -filtreGreen" style="background:url('.$imgBg['url'].');"' ;endif;?>>
        <div class="container columns" >
            <div class="col-g">
                <?php if($surtitre): echo '<h3 class="subtitle">'.$surtitre.'</h3>';endif;?>
                <?php if($txt): echo $txt; endif;?>

                <?php get_template_part( 'templates-parts/cta-reservation' );?>
            </div>

            <div class="col-d">
                <div class="swiper swiper-extra">
                    <div class="swiper-wrapper">
                        <?php if(have_rows('extras','options')):
                            while(have_rows('extras','options')): the_row();
                                $mini = get_sub_field('miniature');
                                $txt = get_sub_field('texte');?>
                                
                                <div class="swiper-slide extras">
                                    <div class="content-img">
                                        <img src="<?php echo $mini['url'];?>" alt="<?php echo $mini['title'];?>"/>
                                    </div>
                                    <div class="content">
                                        <?php if($txt): echo $txt; endif;?>
                                    </div>
                                </div>
                            <?php endwhile;
                        endif;?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>


                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>


    