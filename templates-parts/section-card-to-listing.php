<section id="card-listing">
    <div class="container columns">
        <?php if(have_rows('card-listing')):
            while(have_rows('card-listing')): the_row();
                $bg    = get_sub_field('background');
                $title = get_sub_field('texte');
                $cta   = get_sub_field('cta');?>

                <div class="col" style="background-image:url('<?php if($bg): echo $bg['url'];endif;?>');">
                    <?php if($title): echo $title; endif;?>
                    <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'</a>'; endif;?>
                </div>
            
            <?php endwhile;
        endif;?>
    </div>
</section>