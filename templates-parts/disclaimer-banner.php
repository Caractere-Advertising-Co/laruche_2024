<section id="disclaimer_banner">
    <?php 
    $txtBanner = get_field('texte_banner','options');
    $ctaBanner = get_field('cta_banner','options');
    ?>

    <div class="container from-left">
        <?php if($txtBanner): echo $txtBanner; endif;?>
        <?php if($ctaBanner):?> <a href="<?php echo $ctaBanner['url'];?>" class="cta-border"><?php echo $ctaBanner['title'];?></a><?php endif;?>
    </div>
</section>