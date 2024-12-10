<?php

add_filter('woocommerce_resize_images', static function() {
    return false;
});

// Menu 
register_nav_menus( array(
    'megamenu' => 'Mega Menu',
	  'main' => 'Menu Principal',
	  'footer' => 'Bas de page',
) );

add_theme_support( 'post-thumbnails' );

//SVG Files
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );
  
function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
  
function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
  add_filter( 'upload_mimes', 'cc_mime_types' );
  add_action( 'admin_head', 'fix_svg' );


  add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/src/js/loadmore.js', array('jquery'), '', true);

    // Localisation du script AJAX
    wp_localize_script('custom-scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
	wp_localize_script('scripts', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'total_biens' => wp_count_posts('biens')->publish, // Passer total_biens à JS
    ));
}

/*********************************
 Custom Post Type ---- Biens
**********************************/

function add_custom_post_biens() {

	$labels = array(
		'name'                  => _x( 'Bien.s', 'Post Type General Name', 'custom_post_type' ),
		'singular_name'         => _x( 'Bien', 'Post Type Singular Name', 'custom_post_type' ),
		'menu_name'             => __( 'Biens', 'custom_post_type' ),
		'name_admin_bar'        => __( 'Bien', 'custom_post_type' ),
		'archives'              => __( 'Archives', 'custom_post_type' ),
		'attributes'            => __( 'Item Attributes', 'custom_post_type' ),
		'all_items'             => __( 'Toute.s', 'custom_post_type' ),
		'add_new_item'          => __( 'Ajouter un nouveau bien', 'custom_post_type' ),
		'add_new'               => __( 'Ajouter bien', 'custom_post_type' ),
		'new_item'              => __( 'Nouveau', 'custom_post_type' ),
		'edit_item'             => __( 'Modifier', 'custom_post_type' ),
		'update_item'           => __( 'Mettre à jour', 'custom_post_type' ),
		'view_item'             => __( 'Voir', 'custom_post_type' ),
		'view_items'            => __( 'Voir', 'custom_post_type' ),
		'search_items'          => __( 'Recherche', 'custom_post_type' ),
		'not_found'             => __( 'Non trouvé', 'custom_post_type' ),
		'not_found_in_trash'    => __( 'Non trouvé', 'custom_post_type' ),
		'featured_image'        => __( 'Miniature', 'custom_post_type' ),
		'set_featured_image'    => __( 'Définir la miniature', 'custom_post_type' ),
		'remove_featured_image' => __( 'Retirer la miniature', 'custom_post_type' ),
		'use_featured_image'    => __( 'Utiliser comme miniature', 'custom_post_type' ),
		'insert_into_item'      => __( 'Insérer', 'custom_post_type' ),
		'uploaded_to_this_item' => __( 'Uploader', 'custom_post_type' ),
		'items_list'            => __( 'List', 'custom_post_type' ),
		'items_list_navigation' => __( 'Items list navigation', 'custom_post_type' ),
		'filter_items_list'     => __( 'Filtrer', 'custom_post_type' ),
	);
	$args = array(
		'label'                 => __( 'Biens', 'custom_post_type' ),
		'description'           => __( 'Biens de La Ruche', 'custom_post_type' ),
		'labels'                => $labels,
		'taxonomies'            => array( 'biens' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-feedback',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'supports'				=> array('title', 'revisions', 'author', 'thumbnail'),
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'		=> 'post',
	);
	register_post_type( 'biens', $args );

	// Déclaration de la Taxonomie
    $labels = array(
        'name'                       => _x( 'Provinces', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Province', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Province', 'text_domain' ),
		'all_items'                  => __( 'Toutes les provinces', 'text_domain' ),
		'parent_item'                => __( 'Parent', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent :', 'text_domain' ),
		'new_item_name'              => __( 'Ajouter', 'text_domain' ),
		'add_new_item'               => __( 'Ajouter', 'text_domain' ),
		'edit_item'                  => __( 'Editer', 'text_domain' ),
		'update_item'                => __( 'Modifier', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'search_items'               => __( 'Rechercher', 'text_domain' ),
		'add_or_remove_items'        => __( 'Ajouter/supprimer', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
		'not_found'                  => __( 'Non trouvé', 'text_domain' ),
    );
    
    $args = array( 
        'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
    );

    register_taxonomy( 'province', 'biens', $args );
}
add_action( 'init', 'add_custom_post_biens', 0 );


/*********************************
     AJAX - add more function 
**********************************/

add_action('wp_ajax_load_more_biens', 'load_more_biens');
add_action('wp_ajax_nopriv_load_more_biens', 'load_more_biens');

function load_more_biens() {
    $args = array(
        'post_type' => 'biens',
        'posts_per_page' => 9,
        'post_status' => 'publish',
        'offset' => $_POST['offset'],
		'meta_key' => 'type_de_bien',
        'meta_value' => $_POST['type']
    );

    $query = new WP_Query($args);

    // Compter le nombre total de biens publiés
    $total_biens = wp_count_posts('biens')->publish;

    // Si des articles sont trouvés, les charger
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('templates-parts/card-biens');
        }
    }

    // Renvoyer le nombre total de biens
    echo '<script>total_biens = ' . $total_biens . ';</script>';

    wp_die();
}