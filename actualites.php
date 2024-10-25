<?php
/*
Template Name: Actualités
*/

get_header();

$surtitre = get_field('surtitre');
$titre = get_field('titre');

$bg_header = get_field('bg_header');

if(!$bg_header):
    $bg_url = get_template_directory_uri(  ).'/assets/img/bg-default.jpg';
else :
    $bg_header = get_field('bg_header');
    $bg_url = $bg_header['url'];
endif;

$titreDec = get_field('decouverte');
$cta = get_field('cta');

?>

<header id="header-simple-page" >
    <img src="<?php echo $bg_url;?>" alt="<?php echo $bg_header['title'];?>"/>

    <div class="container">
        <div class="content">
            <span class="subtitle"><?php if($surtitre): echo $surtitre;endif;?></span>
            <?php if($titre): echo $titre; endif;?>
        </div>
    </div>
</header>

<section id="simple-page">
    <div class="container">
    <?php 
        $args = array(
            "post_type" => "post",
            "post_per_page" => -1
        );

        $news = new WP_Query($args);
        $i = 1;

        if($news->have_posts()):
            while($news->have_posts()): $news->the_post();
                get_template_part('templates-parts/blog/card-blog', null, array( 'id' => $i));
                $i++;
            endwhile;
        endif;

        wp_reset_postdata();?>

        <div id="nos-campagnes">
            <?php if($titreDec): echo $titreDec; endif;?>
            <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta-border">'.$cta['title'].'</a>';endif;?>
        </div>
    </div>
</section>

<?php get_footer();