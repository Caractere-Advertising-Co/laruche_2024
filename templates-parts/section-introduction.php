<?php 
    $color_bg = get_field('arriere_plan-color');
    $img = get_field('image_about','options');
    
    $intro = get_field('introduction-blog');
    if(!$intro):$intro = get_field('introduction','options');endif;

    $titreJps = get_field('titre-about-jps');
    if(!$titreJps):$titreJps = get_field('titre-about-jps','options');endif;

    $btnJps = get_field('lien_about');
    if(!$btnJps):$btnJps = get_field('lien_about','options');endif;
?>

<section id="section-introduction">
    <div class="container columns">
        <div class="col-g">
            <?php if($titreJps): echo '<span class="from-bottom">' . $titreJps . '</span>'; endif;?>
            <?php if($img):?>
                <div class="img-content from-bottom">
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['name'];?>" />
                </div>
            <?php endif;?>
        </div>
        <div class="col-d">
            <?php if($intro): echo '<span class="from-bottom">' . $intro . '</span>'; endif;?>
            <?php if($btnJps):?><a href="<?php echo $btnJps['url'];?>" class="cta from-bottom"><?php echo $btnJps['title'];?></a><?php endif;?>
        </div>
    </div>
</section>
    