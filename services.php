<?php
/*
Template Name: Services
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

$surtitreIntro = get_field('surtitre-intro');
$titreIntro = get_field('titre-intro');
$txtIntro = get_field('introduction');

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
    <div class="container intro">
        <?php if($surtitreIntro): echo '<p class="subtitle">'.$surtitre.'</p>';endif?>
        <?php if($titreIntro): echo $titreIntro;endif?>
        <?php if($txtIntro): echo $txtIntro; endif?>
    </div>
</section>

<section id="liste-actualites">
    <div class="container" >
        <?php if(have_rows('services')):
            $i = 0;
            while(have_rows('services')): the_row();
                get_template_part('templates-parts/blog/card-blog', null, array( 'id' => $i));
                $i++;
            endwhile;
        endif; ?>
    </div>
</section>

<?php get_footer();