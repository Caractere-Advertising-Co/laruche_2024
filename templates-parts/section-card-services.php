<section id="aboutus">
    <div class="container">
        <div class="swiper-content">
            <div class="swiper-resp">
                <div class="swiper-wrapper">
                    <?php if(have_rows('services','options')): 
                            while(have_rows('services','options')): the_row();

                                $img = get_sub_field('background_service');
                                $link = get_sub_field('lien_service');?>

                    <div class="swiper-slide card"
                        style=" background:url(<?php if($img): echo $img['url']; endif;?>) center;background-size:cover;">
                        <a href="<?php if($link):echo $link['url'];endif;?>">
                            <h4><?php echo get_sub_field('nom_service');?></h4>
                        </a>
                    </div>
                    <?php endwhile;
                        endif;?>
                </div>
            </div>
            <div class="section_nav">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <?php if(is_front_page()):
            get_template_part( 'templates-parts/section-introduction' );
        endif;?>

    </div>
</section>