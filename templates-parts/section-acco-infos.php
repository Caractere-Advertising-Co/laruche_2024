<?php
    $title = get_field('titre-infos-acco');
    $galerie = get_field('galerie-infos-acco');
    $cta = get_field('cta-infos-acco');
    $circle = get_field('cercle');
?>

<section id="acco-infos">
    <div class="container columns">
        <div class="col-g">
            <?php if($title): echo $title;endif;?>
            <?php 
            if(have_rows('avantages-acco')):
                while(have_rows('avantages-acco')): the_row();
                    $title = get_sub_field('titre-adv-acco');
                    $exp = get_sub_field('explication-adv-acco');?>

                    <h3 class="title-toggle accordion"><?php if($title): echo $title;endif?></h3>
                    <div class="content-toggle panel"><?php if($exp): echo $exp; endif;?></div>
               
                <?php endwhile;
            endif;?>

            <?php if($cta): echo '<a href="'.$cta["url"].'" class="cta">'.$cta['title'].'</a>';endif?>
        </div>

        <div class="col-d">
            <div class="curved-text rotate-anim"><?php if($circle): echo $circle;endif;?></div>

            <div class="swiper swiper-acco">
                <div class="swiper-wrapper">
                    <?php if($galerie):
                        foreach($galerie as $g):?>
                            <div class="swiper-slide">
                                <img src="<?php echo $g['url'];?>" alt="<?php echo $g['name'];?>"/>
                            </div>
                        <?php endforeach;
                    endif;?>
                </div>
            </div>

            <div class="swiper-acco-button-prev"></div>
            <div class="swiper-acco-button-next"></div>
        </div>
    </div>
</section>