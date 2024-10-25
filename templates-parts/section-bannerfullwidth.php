<?php
$surtitre = get_field('surtitre-fullwidth','options');
$title = get_field('title-fullwidth','options') ;
$cta = get_field('cta-fullwidth','options');
?>

<section id="banner-fullwidth">
    <div class="container">
            <?php if($surtitre): echo '<h4 class="subtitle">'.$surtitre.'</h4>';endif;?>
            <?php if($title) : echo $title;endif;?>
            <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta">'.$cta['title'].'</a>'; endif;?>
    </div>
</section>