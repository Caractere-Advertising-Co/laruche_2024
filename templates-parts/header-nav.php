<?php

$bg_header  = get_field('bg_header','options');
$logo       = get_field('logo-entreprise','options');

$tel        = get_field('telephone','options');
$mail       = get_field('email','options');
$icon_email = get_field('icon_email','options');
$icon_phone = get_field('icone_phone','options');

$btnCta       = get_field('cta_listing','options');

if($bg_header):?>
    <div class="bg_top_header">
        <img src="<?php echo $bg_header['url'];?>" alt="<?php echo $bg_header['title'];?>" />
    </div>
<?php endif;?>

<div class="top-menu-mobile">
    <div class="infos-item">
        <?php if($icon_phone): echo '<a href="tel:'.$tel.'"><div class="block-icon"><img src="'.$icon_phone['url'].'" alt="'.$icon_phone['name'].'" /></div></a>'; endif;?>
    </div>
    
    <div class="infos-item">
        <?php if($icon_email): echo '<a href="mailto:'.$mail.'"><div class="block-icon"><img src="'.$icon_email['url'].'" alt="'.$icon_email['name'].'" /></div></a>'; endif;?>
    </div>
</div>

<?php if(!is_front_page(  )):?>
    <?php if($btnCta): echo '<div class="btn cta nodesktop"><a href="'.$btnCta['url'].'">'.substr($btnCta['title'],0,110).'</a><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></div>'; endif;?>
<?php endif;?>

<div class="header navigation">
    <div class="col-g">
        <a href="<?php echo home_url();?>">
            <?php if($logo):?>
                <div class="logo">
                    <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>" />
                </div>
            <?php endif;?>
        </a>
    </div>

    <div class="col-d">

        <div class="top-menu">
            <div class="infos-item">
                <?php if($icon_phone): echo '<div class="block-icon"><img src="'.$icon_phone['url'].'" alt="'.$icon_phone['name'].'" /></div>'; endif;?>
                <?php if($tel): echo '<a href="tel:'.$tel.'"/>T. 071/30 30 52</a>'; endif;?>
            </div>
            <div class="infos-item">
                <?php if($icon_email): echo '<div class="block-icon"><img src="'.$icon_email['url'].'" alt="'.$icon_email['name'].'" /></div>'; endif;?>
                <?php if($mail): echo '<a href="mailto:'.$mail.'">'.$mail.'</a>'; endif;?>
            </div>

            <?php 
            if(have_rows('allrs','options')):
                while(have_rows('allrs','options')): the_row();
                    $link = get_sub_field('rs_link');
                    $img = get_sub_field('img_link');
                    ?>
                    
                    <a class="rs" href="<?php echo $link['url'];?>">
                        <img src="<?php echo $img['url'];?>" alt="<?php echo $img['title'] ?>"/>
                    </a>
                <?php endwhile;
            endif;?>    
        </div>
    
        <div class="primary-navigation">
            
            <?php 
            if(!is_front_page(  )): echo '<div class="nomobile">'; endif;
                wp_nav_menu(array(
                    'theme_location' => 'main',
                    'menu_class' => 'semi-bold nav'
                ));
            if(!is_front_page(  )): echo '</div>';endif;?>
        </div>
        <div class="btn-contact">
            <?php if(!is_front_page(  )):?>
                <?php if($btnCta): echo '<div class="btn cta nomobile"><a href="'.$btnCta['url'].'">'.substr($btnCta['title'],0,110).'</a><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></div>'; endif;?>
            <?php endif;?>
        </div>

        <div class="hamburger-menu">
            <svg id="open_the_Mmenu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" stroke-width=".6" fill="rgba(0,0,0,0)" stroke-linecap="round" style="cursor: pointer">
                <path d="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7">
                    <animate dur="0.2s" attributeName="d" values="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7;M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7" fill="freeze" begin="start.begin"></animate>
                    <animate dur="0.2s" attributeName="d" values="M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7;M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7" fill="freeze" begin="reverse.begin"></animate>
                </path>
                <rect width="10" height="10" stroke="none">
                    <animate dur="2s" id="reverse" attributeName="width" begin="click"></animate>
                </rect>
                <rect width="10" height="10" stroke="none">
                    <animate dur="0.001s" id="start" attributeName="width" values="10;0" fill="freeze" begin="click"></animate>
                    <animate dur="0.001s" attributeName="width" values="0;10" fill="freeze" begin="reverse.begin"></animate>
                </rect>
            </svg>
        </div>
    </div>
</div>