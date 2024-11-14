<?php
    $title    = get_the_title();
    $thb      = get_field('miniature');
    $tyPEB    = get_field('type_peb');
    $peb      = get_field('PEB');
    $pebDble  = get_field('PEB_double');
    $typeBien = get_field('type_de_bien');
    $lieu     = get_field('lieu');
    $prix     = get_field('prix');
    $chambre  = get_field('chambres');
    $surfHab  = get_field('surf_habitable');
    $surfTot  = get_field('surf_totale');
    $fairOff  = get_field('faireOffre');
    $new      = get_field('new');

?>

<div class="card">
    <a href="<?php echo get_permalink();?>">
        <div class="block-img miniature-bien" <?php if($thb):?>style="background-image:url('<?php echo $thb['url'];?>');"<?php endif;?>>
            <?php if($new):?><span class="statut">New</span><?php endif;?>

            <?php if($tyPEB):?>
                <div class="logo_peb">
                    <img src="<?php echo get_template_directory_uri().'/assets/images/20px_bi/'. $pebDble.'.png';?>" alt="<?php echo $pebDble;?>" />
                </div>
            <?php else :?>
                <div class="logo_peb">
                    <img src="<?php echo get_template_directory_uri().'/assets/images/20px_un/'. $peb.'.png';?>" alt="<?php echo $peb;?>" />
                </div>
            <?php endif;?>
        </div>
        <?php if($title): echo '<h3>'.$title.'</h3>'; endif;?>
        
        <div class="columns details">
            <?php if($chambre): echo '<div class="room"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/bed.png" alt="icone_bed" class="icon"/></div><p>'.$chambre.' Chs</p></div>'; endif;?>
            <?php if($surfHab): echo '<div class="surfHab"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/house.png" alt="icone_bed" class="icon"/></div><p>'.$surfHab.' m2</p></div>'; endif;?>
            <?php if($surfTot): echo '<div class="surfTot"><div class="block-img"><img src="'.get_template_directory_uri().'/assets/images/surf_totale.png" alt="icone_bed" class="icon"/></div><p>'.$surfTot.' m2</p></div>'; endif;?>
        </div>
        <div class="cta price">
            <?php 
                echo $fairOff ? 'Foàpd' : '';
                if($prix): echo $prix . '€'; endif;
                echo $typeBien = 'A louer' ? '/mois' : '';?>
        </div>
    </a>
</div>