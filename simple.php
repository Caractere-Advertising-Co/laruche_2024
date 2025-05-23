<?php
/*
Template Name: Simple-page
Template Post Type: page
*/

get_header();

$bg_header = get_field('bg_header');

$surtitre = get_field('surtitre');
$titre = get_field('titre_introduction');
$content = get_field('texte_introduction');

$imgSep = get_field('image-separator');

$imgTr = get_field('image-transition');
$contentTr = get_field('content-transition');
$ctaTr = get_field('cta-transition');

?>
<?php if($bg_header):?>
    <header id="header-simple-page" >
        <img src="<?php echo $bg_url;?>" alt="<?php echo $bg_header['title'];?>"/>

        <div class="container">
            <div class="content">
                <span class="subtitle"><?php if($surtitre): echo $surtitre;endif;?></span>
                <?php if($titre): echo $titre; endif;?>

                
            </div>
        </div>
    </header>
<?php endif;?>

<section id="simple-text-intro">
    <div class="container">
        <?php if($surtitre): echo '<h1>'.$surtitre.'</h1>'; endif;?>
        <?php if($titre): echo $titre; endif;?>
        <?php if($content): echo $content; endif;?>
        <?php if($imgSep):?>
                    <div class="block-img">
                        <img src="<?php echo $imgSep['url'];?>" />
                    </div>
                <?php endif;?>
    </div>
</section>

<?php if($imgTr):?>
    <section id="transition-blog">
        <div class="imgTr"><img src="<?php if($imgTr): echo $imgTr['url'];endif;?>" alt="<?php if($imgTr):echo $imgTr['title'];endif;?>"/></div>
        <div class="container columns">
            <div class="col-g"></div>
            <div class="col-d">
                <?php if($contentTr): echo $contentTr;endif;?>
                <?php if($ctaTr): echo '<a href="'.$ctaTr['url'].'" class="cta">'.$ctaTr['title'].'</a>';endif;?>
            </div>
        </div>
    </section>
<?php endif;

get_footer();