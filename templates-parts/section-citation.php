<section id="citation">
    <div class="container top_content">
        <?php 
            $titre_cons = get_field('titre_section_con','options');
            $img = get_field('image_citation','options');
            $soutitre_cons = get_field('soutitre_section_cons','options');

            if($img): echo '<img src="'.$img["url"].'" alt="'.$img["title"].'" class="quote"/>';endif;
            if($titre_cons): echo $titre_cons; endif;
            if($soutitre_cons): echo '<h3>'.$soutitre_cons.'</h3>'; endif;
        ?>
    </div>
</section>