<?php 
    $titlecta = get_field('titre_cta_extra','options');
    $cta = get_field('cta-extra','options');
?>

<?php if($cta):?>
    <a href="<?php echo $cta['url'];?>" class="cta-reser">
        <img src="<?php echo get_template_directory_uri(  ) . '/assets/images/phone-8.png';?>" alt="icon-phone"/>
            <span class="txt-cta">
                <?php echo '<span class="subtitle">'.$titlecta.'</span><br>';?>
                <?php echo '<span class="number">'.$cta['title'].'</span>';?>
            </span>
    </a>
<?php endif;?>