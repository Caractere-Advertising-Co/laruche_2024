<?php 
    $surtitre = get_field('surtitre-section-tit');
    $content = get_field('content-tit');
    $img = get_field('img-tit');
    $secText = get_field('sectexte-tit');
    $cta = get_field('cta-tit');
?>

<section id="section-2-tit">
    <div class="container columns">
        <div class="col-g ">
            <?php if($surtitre): echo '<h3 class="subtitle from-bottom">'.$surtitre.'</h3>';endif;?>
            <?php if($content): echo '<span class="from-bottom">'.$content.'</span>';endif;?>
            <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta from-bottom nomobile">'.$cta['title'].'</a>';endif;?>
        </div>
        <div class="col-d ">
            <?php if($img): echo '<div class="img-right"><img src="'.$img['url'].'" alt="'.$img['title'].'" class="from-bottom"></div>';endif;?>
            <?php if($secText): echo '<span class="from-bottom">'.$secText.'</span>';endif;?>
        </div>
    </div>

    <div class="nodesktop">
        <div class="container">
            <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta from-bottom nodesktop">'.$cta['title'].'</a>';endif;?>
        </div>
    </div>
</section>