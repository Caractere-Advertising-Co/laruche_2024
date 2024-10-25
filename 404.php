<?php
/* Template Name: 404*/

$content = get_field('content_404','options');
$cta = get_field('cta_404','options');

get_header();?>

<section id="section-404">
    <div class="container">
        <?php if($content):
            echo $content;
        
            if($cta):
                echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'</a>';
            endif;
        endif;?>
    </div>
</section>

<?php get_footer();