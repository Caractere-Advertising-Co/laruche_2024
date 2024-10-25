<?php $title_ptsfort = get_field('titre_point_fort');?>

<div class="content_service">
    <?php
    if($title_ptsfort): echo $title_ptsfort; endif;

    if(have_rows('liste_points_forts')):
        while(have_rows('liste_points_forts')) : the_row();
            $titrePf = get_sub_field('titres_pf');
            $descrPf = get_sub_field('description_pf');
            ?>
        
            <div class="card_pf from-bottom">
                <?php if($titrePf): echo '<h4>'.$titrePf.'</h4>'; endif;?>
                <?php if($descrPf): echo $descrPf; endif?>
            </div>
        <?php 
        endwhile;
    endif;

    if(have_rows('liste_documents')):
        while(have_rows('liste_documents')) : the_row();
            $document = get_sub_field('document');
            $libelle = get_sub_field('libelle');?>

            <a href="<?php echo $document['url'];?>" target="_blank" class="from-left">
                <div class="document_ddl">
                    <img src="<?php echo get_template_directory_uri(  );?>/assets/img/icone_pdf.svg" alt="icone_ddl" />
                    <p><?php echo $libelle;?></p>
                </div>
            </a><?php 
        endwhile;
    endif;?>
</div>