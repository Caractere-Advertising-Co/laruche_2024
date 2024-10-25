<?php 
$titreExpert = get_field('Titre-expert','options');
$txtExpert = get_field('texte-expert','options');
$ctaExpert = get_field('cta-expert','options');

?>

<section id="expert">
    <div class="container">
        <?php if($titreExpert): echo $titreExpert; endif;?>

        <div class="descr">
            <?php if($txtExpert): echo $txtExpert; endif;?>
            <?php if($ctaExpert):?>
                <a href="<?php echo $ctaExpert['url'];?>" class="cta round"><?php echo $ctaExpert['title'];?></a>
            <?php endif;?>
        </div>
    </div>
</section>