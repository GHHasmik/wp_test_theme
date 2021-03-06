<?php
/**
 * mytesttheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mytesttheme
 */

if ( ! function_exists( 'mytesttheme_setup' ) ) :

	 
	function mytesttheme_setup() {
		
		load_theme_textdomain( 'mytesttheme', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		
		add_theme_support( 'title-tag' );

		
		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'menu-1' => esc_html__( 'Header', 'mytesttheme' ),
			'menu-2' => esc_html__( 'Footer1', 'mytesttheme' ),
			'menu-3' => esc_html__( 'Footer2', 'mytesttheme' ),
		) );

		
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		
		add_theme_support( 'custom-background', apply_filters( 'mytesttheme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 *		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'mytesttheme_setup' );

/**
 *
 * @global int $content_width
 */
function mytesttheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mytesttheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'mytesttheme_content_width', 0 );

/**
 * 
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mytesttheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mytesttheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mytesttheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
	add_action( 'widgets_init', 'mytesttheme_widgets_init' );


	function mytesttheme_scripts() {
	wp_enqueue_style( 'mytesttheme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mytesttheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mytesttheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
	add_action( 'wp_enqueue_scripts', 'mytesttheme_scripts' );


	require get_template_directory() . '/inc/custom-header.php';

	require get_template_directory() . '/inc/template-tags.php';


	require get_template_directory() . '/inc/template-functions.php';


	require get_template_directory() . '/inc/customizer.php';

	if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
	}


 	add_theme_support( 'admin_footer_text', 'admin_footer_copyright' );

	function admin_footer_copyright() {
    return '<p class=""footer-copyright text-center py-3"">Ankro LLC. All rights reserved.</p>';
	} 

	add_action( 'init', function(){
		register_post_type('editsec', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Edit sections', 
			'singular_name'      => 'Section Title', 
			'add_new'            => 'add sections', 
			'add_new_item'       => 'text1', 
			'edit_item'          => 'edit title', 
			'new_item'           => 'new', 
			'view_item'          => 'see', 
			'search_items'       => 'find', 
			'not_found'          => 'no', 
			'not_found_in_trash' => 'no', 
			'parent_item_colon'  => '', 
			'menu_name'          => 'edit section',
		),
		'public'              => true,
		'show_in_menu'        => null,  
		'menu_position'       => null,
		'menu_icon'           => 
		'dashicons-welcome-write-blog', 
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ],
	) );
});


function getsec(){
	$args = array(
		'numberposts' => 1,
		'post_type' => 'editsec',
	);

	return get_posts($args);


}

