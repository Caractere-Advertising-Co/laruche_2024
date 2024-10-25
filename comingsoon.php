<?php 
 /* Template Name: Coming soon */

 /* gites \ gite_description \ galerie_gites \ banner_arriere_plan */ 

 $title = get_field('option','titre');
 $logo = get_field('option','logo');
 $banner = get_field('banner_arriere_plan');

 $galerie = get_field('galerie_gites');
?>

<div>
    <div class="top_window">
        <img src="<?php echo $banner['sizes']['large'];?>" alt="<?php echo $banner['name'];?>"/>
        <p>test</p>
    </div>
    <div class="bottom_row">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php if(have_rows('galerie_gites')) : ?>
                    <?php while(have_rows('galerie_gites')) : the_row();?>
                        <?php $slide = get_sub_field('gite');?>
                        <div class="swiper-slide">
                            <img src="<?php echo $slide['url'];?>"/>
                        </div>
                    <?php endwhile;?>
                <?php endif;?>
                
            </div>
        </div>
        <div class="content">
            <img src="
        </div>
    </div>
</div>