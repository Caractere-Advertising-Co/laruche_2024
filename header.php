<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="La Ruche immobilière"/>
    <title>La Ruche immobilière</title>

    <link rel="stylesheet" href="https://use.typekit.net/ovg4lmv.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/53b095485a.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="<?php echo get_template_directory_uri();?>/dist/main.bundle.js" defer></script>
    <script src="<?php echo get_template_directory_uri();?>/dist/style.bundle.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcCZ4mj6l487UULbiFxsPHEUzkQUIuy-A&callback=console.debug&libraries=maps,marker&v=beta">
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="scrollToTop">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path fill="#ffffff"
                d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
        </svg>
    </div>

    <header>
        <?php get_template_part( 'templates-parts/header-nav' );?>

        <?php if(is_front_page(  )):
            $slide = get_field('texte_slide_intro');

            if($slide): echo 
                '<div class="container title-frontPage">'.$slide.'</div>'; endif;
        endif;?>
    </header>

    <?php wp_body_open(); ?>