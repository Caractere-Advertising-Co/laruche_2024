<?php

$thmb = get_the_post_thumbnail_url();
$titre = get_field('titre');
$intro = get_field('texte_introduction');

if(is_page_template( 'services.php' )):
    $thmb = get_sub_field('image-service');
    $titre = get_sub_field('titre');
    $intro = get_sub_field('texte_introduction');
endif;

$i = null;

if($args['id']):
    $i = $args['id'];
endif;?>

<?php if($i % 2):?>
    <div class="card-news -left container columns">
        <div class="col-g">
            <?php if($titre): echo $titre;endif;?>
            <?php if($intro): echo $intro;endif;?>

            <?php if(!is_page_template( 'services.php' )):?>
                <a href="<?php echo the_permalink( );?>" class="cta-border"><?php the_title();?></a>
            <?php endif;?>
        </div>

        <div class="col-d">
            <?php if(!is_page_template( 'services.php' )):?>
                <img src="<?php echo $thmb;?>"/>
            <?php else :?>
                <img src="<?php echo $thmb['url'];?>" alt="<?php echo $thmb['title'];?>"/>
            <?php endif;?>
        </div>
    </div>
<?php else : ?>
    <div class="card-news -right container columns">
        <div class="col-g">
            <?php if(!is_page_template( 'services.php' )):?>
                <img src="<?php echo $thmb;?>"/>
            <?php else :?>
                <img src="<?php echo $thmb['url'];?>" alt="<?php echo $thmb['title'];?>"/>
            <?php endif;?>
        </div>
        <div class="col-d">
            <?php if($titre): echo $titre;endif;?>
            <?php if($intro): echo $intro;endif;?>
            
            <?php if(!is_page_template( 'services.php' )):?>
                <a href="<?php echo the_permalink( );?>" class="cta-border"><?php the_title();?></a>
            <?php endif;?>
        </div>
    </div>  
<?php endif;?>