<section id="card-listing">
    <div class="container columns">
        <?php if(have_rows('card-listing')):
            while(have_rows('card-listing')): the_row();
                $bg    = get_sub_field('background');
                $title = get_sub_field('texte');
                $cta   = get_sub_field('cta');?>

                <div class="col" style="background-image:url('<?php if($bg): echo $bg['url'];endif;?>');">
                    <?php if($title): echo $title; endif;?>
                    <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></a>'; endif;?>
                </div>
            
            <?php endwhile;
        endif;?>
    </div>
</section>