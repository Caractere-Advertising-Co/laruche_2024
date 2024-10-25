<section id="contact">
    <div class="container from-bottom">
        <?php 
            $subtitle = get_field('sub_contact','options');
            $title = get_field('titre-contact','options');
            $texte = get_field('texte-contact','options');
            $form = get_field('shortcode_form','options');

        ?>
        <?php if($subtitle):?><p class="subtitle"><?php echo $subtitle;?></p><?php endif;?>
        <?php if($title):?> <h2><?php echo $title;?></h2><?php endif;?>

        <?php get_template_part( 'templates-parts/separator/horizontal-line' );?>

        <?php if($texte): echo $texte;endif;?>

        <?php if($form): echo do_shortcode( $form ); endif;?>
    </div>
</section>