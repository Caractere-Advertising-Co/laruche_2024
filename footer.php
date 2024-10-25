<?php 

$logo       = get_field('logo_footer','options');
$adresse    = get_field('adresse','options');

$cttCol1    = get_field('contenu_colonne_1','options');
$infosIpi   = get_field('contenu_colonne_2','options');
$titreCol2  = get_field('titre-colonne-2-2','options');
$titreCol3  = get_field('contenu_colonne_3','options');
$background = get_field('background-footer','options');

$keywords = get_field('keywords','options');

?>

<footer <?php if($background): echo 'style="background:url(\''.$background['url'].'\');background-size:cover;"';endif?>>
    <div class="container">
        <div class="footer-top">
            <div class="col general-infos">
                <?php if($logo):?>
                    <div class="block-img">
                        <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>" />
                    </div>        
                <?php endif;?>
                
                <?php if($cttCol1): echo $cttCol1; endif;?>
            </div>

            <div class="col col-2">
                <?php if($titreCol2): echo '<h4>'.$titreCol2.'</h4>';endif;?>
                
                <?php
                wp_nav_menu( array(
                    'menu' => 'Menu Footer',
                    'theme_location' => 'footer',
                    'menu_class' => 'semi-bold nav'
                ) );?>
            </div>

            <div class="col rs_footer">
                <?php if($titreCol3): echo $titreCol3; endif;?>
            </div>
        </div>

        <div class="footer_middle">
            <?php 
            if($keywords):
                echo '<span class="keywords">'.$keywords.'</span>';
            endif;
            
            if($infosIpi): echo '<div class="infosIpi">'.$infosIpi.'</div>'; endif;
            ?>


        </div>
    </div>
    <div class="footer_bottom">
        <?php
            $cookLink = get_field('lien_cookies','options');
            $confLink = get_field('lien_confi','options');
        ?>

        <div class="container desktop">
            <?php if($cookLink): echo "<a href=".$cookLink['url'].">".$cookLink['title']."</a>"; endif;?>
            <div>
                <?php 
                    $copyright = get_field('copyright','options');
                    if($copyright): echo $copyright; endif;
                ?>
            </div>
            <?php if($confLink): echo "<a href=".$confLink['url'].">".$confLink['title']."</a>"; endif;?>
        </div>

        <div class="container mobile">
            <div class="links">
                <?php if($cookLink): echo "<a href=".$cookLink['url'].">".$cookLink['title']."</a>"; endif;?>
                <?php if($confLink): echo "<a href=".$confLink['url'].">".$confLink['title']."</a>"; endif;?>
            </div>

            <div class="copyright">
            <?php 
                    $copyright = get_field('copyright','options');
                    if($copyright): echo $copyright; endif;
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>