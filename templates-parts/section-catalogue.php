<div id="section-catalogue">
    <div class="container columns">

    <?php 
        $img = get_field('image_catalogue','options');
        $txt = get_field('texte_catalogue','options');
        $cta = get_field('cta_catalogue','options');
    ?>

        <?php if($img):?>
            <div class="bloc_img from-left">
                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['title'];?>" />
            </div>   
        <?php endif;?>
        <div class="content_section-cta from-bottom">
            <?php if($txt): echo $txt;endif;?>
            <?php if($cta):?>
            <a href="<?php echo $cta['url'];?>" class="cta bgBlue from-bottom">
                <?php echo $cta['title'];?>
            </a>
            <?php endif;?>
        </div> 
    </div>
</div>