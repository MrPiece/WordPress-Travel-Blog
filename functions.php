<?php
/**
 * Travel Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Travel_Blog
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'travel_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function travel_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Travel Blog, use a find and replace
		 * to change 'travel-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'travel-blog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'travel-blog' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'travel_blog_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'travel_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travel_blog_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'travel_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'travel_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function travel_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'travel-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'travel-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'travel_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function travel_blog_scripts() {
	wp_enqueue_style( 'travel-blog-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/fontawesome-free-5.13.0-web/css/all.min.css');


	wp_style_add_data( 'travel-blog-style', 'rtl', 'replace' );

	wp_enqueue_script( 'travel-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script('autocomplete-off', get_template_directory_uri() . '/assets/js/autocomplete-off.js', [], false, true);
	wp_enqueue_script('comments', get_template_directory_uri() . '/assets/js/comments.js', [], false, true);
	wp_enqueue_script('home-posts', get_template_directory_uri() . '/assets/js/home-posts.js', [], false, true);
	wp_enqueue_script('mobile-dropmenu', get_template_directory_uri() . '/assets/js/mobile-dropmenu.js', [], false, true);
	wp_enqueue_script('mobile-search', get_template_directory_uri() . '/assets/js/mobile-search.js', [], false, true);
	wp_enqueue_script('search', get_template_directory_uri() . '/assets/js/search.js', [], false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
		wp_enqueue_script('comments', get_template_directory_uri() . '/assets/js/comments.js', [], false, true);
	}

	// if ( preg_match('/^\/blog\/(\?.*)?/', $_SERVER['REQUEST_URI']) )
	// 	wp_enqueue_script('archive-filter', get_template_directory_uri() . '/assets/js/archive-filter.js', [], false, true);
}
add_action( 'wp_enqueue_scripts', 'travel_blog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function enable_threaded_comments(){
if (!is_admin()) {
			if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
					wp_enqueue_script('comment-reply');
			}
}

add_action('get_header', 'enable_threaded_comments');

























add_action( 'after_setup_theme', 'travel_blog_register_menus' );
function travel_blog_register_menus() {
	register_nav_menus([
		'header'       => __('Header Menu'),
		'mobile-blog' => __('Mobile Blog Menu'),
		'mobile-about' => __('Mobile About Menu'),
		'footer-about' => __('Footer About Menu'),
		'footer-blog'  => __('Footer Blog Menu'),
	]);
}


add_filter( 'nav_menu_css_class', 'travel_blog_add_nav_menu_class', 10, 4 );
function travel_blog_add_nav_menu_class( $classes, $item, $args, $depth )
{
	if ($args->theme_location == 'header')
		$classes[] = 'link-item';

	return $classes;
}

add_filter('wp_nav_menu_items', 'travel_blog_add_menuclass', 10, 2);
function travel_blog_add_menuclass($template, $args) 
{
	$template = preg_replace('/<a/', '<a class="link"', $template);
	
	if ( $args->theme_location == 'footer-about' )
		$template = preg_replace('/<li/', "<li class='link-title'><span>Learn more</span></li>\n<li", $template, 1);
	else if ( $args->theme_location == 'footer-blog' )
		$template = preg_replace('/<li/', "<li class='link-title'><span>Blog</span></li>\n<li", $template, 1);

	return $template;
}


add_filter( 'comment_form_fields', 'travel_blog_change_comment_form_fields' );
function travel_blog_change_comment_form_fields($comment_fields)
{
	$comment_fields['cookies'] = preg_replace(
		'/<input .+ \/>/',
		'<div class="checkbox">
			<label for="wp-comment-cookies-consent" class="checkbox-input">
				<input type="checkbox" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" value="yes" />
				<span class="fas fa-check tick"></span>
			</label>
		</div>',
		$comment_fields['cookies'], 1
	);

	return $comment_fields;
}


add_filter('travel_blog_nested_comments', 'travel_blog_nested_comments_callback', 10, 3);
function travel_blog_nested_comments_callback(WP_Comment $comment, WP_Post $post, int $depth = 1): string
{
	$template = "<li class='comment-item'>\n";

	if ( '0' == $comment->comment_approved ) {
		$template .= 
			"<div class='alert alert-danger'>
				<p class='comment-awaiting-moderation'>". _e( 'Your comment is awaiting moderation.', 'triday' ) ."</p>
			</div>\n";
	}
	
	$template .= "<img class='comment-item__avatar' src='".get_avatar_url($comment)."' alt='Avatar'>\n";

	$link = get_comment_reply_link([
		'reply_text' => __('Reply'),
		'respond_id' => 'comment',
		'depth'      => 1,
		'max_depth'  => 5,
		'login_text' => __('Login to reply')
	], $comment, $post);
	$template .= 
		"<div class='comment-item__body'>
			<span class='comment-item__name'>{$comment->comment_author}</span>
			<span class='comment-item__date'>{$comment->comment_date_gmt}</span>
			<p class='comment-item__text'>{$comment->comment_content}</p>
			{$link}
		</div>\n";

	$template .= "</li>\n";

	$childrenComments = array_reverse(
		$comment->get_children([
			'hierarchical' => 'threaded',
			'format' 			 => 'tree',
			'status' 			 => 1,
		])
	);

	if (! empty($childrenComments) ) {
		$template .= "<ul class='comments__list' data-depth={$depth}>";

		foreach ($childrenComments as $childComment)
			$template .= travel_blog_nested_comments_callback($childComment, $post, $depth + 1);

		$template .= "</ul>";
	}

	return $template;
}


add_action('init', 'travel_blog_register_post_types');
function travel_blog_register_post_types(): void
{
	$countriesArgs = [
		'labels' => [
			'name'                     => 'Countries', // основное название для типа записи, обычно во множественном числе.
			'singular_name'            => 'Country', // название для одной записи этого типа.
			'add_new'                  => 'Add new', // текст для добавления новой записи, как "добавить новый" у постов в админ-панели.
												// Если нужно использовать перевод названия, вписывайте подобным образом: _x('Add New', 'product');
			'add_new_item'             => 'Add new country', // текст заголовка у вновь создаваемой записи в админ-панели. Как "Добавить новый пост" у постов.
			'edit_item'                => 'Edit country', // текст для редактирования типа записи. По умолчанию: редактировать пост/редактировать страницу.
			'new_item'                 => 'New country', // текст новой записи. По умолчанию: "Новый пост"
			'view_item'                => 'View country', // текст для просмотра записи этого типа. По умолчанию: "Посмотреть пост"/"Посмотреть страницу".
			'search_items'             => 'Search countries', // текст для поиска по этим типам записи. По умолчанию "Найти пост"/"найти страницу".
			'not_found'                => 'Countries were not found', // текст, если в результате поиска ничего не было найдено.
												// По умолчанию: "Постов не было найдено"/"Страниц не было найдено".
			'not_found_in_trash'       => 'Countries were not found in trash', // текст, если не было найдено в корзине. По умолчанию "Постов не было найдено в корзине"/"Страниц
												// не было найдено в корзине".
			'parent_item_colon'        => 'Parent country', // текст для родительских типов. Этот параметр не используется для не древовидных типов записей.
												// По умолчанию "Родительская страница".
			'all_items'                => 'All countries', // Все записи. По умолчанию равен menu_name
			'archives'                 => 'all_countries', // Архивы записей. По умолчанию равен all_items
			'item_updated'             => 'Country updated', // Текст заметки в редакторе записи при обновлении записи. С WP 5.0.
												// По умолчанию: «Post updated.» / «Page updated.»
			'item_published'           => 'Country published', // Текст заметки в редакторе записи при публикации записи. С WP 5.0.
												// По умолчанию: «Post published.» / «Page published.»
			'item_published_privately' => 'Country published privately', // Текст заметки в редакторе записи при публикации private записи. С WP 5.0.
												// По умолчанию: «Post published privately.» / «Page published
			'item_reverted_to_draft'   => 'Country reverted to draft', // Текст заметки в редакторе записи при возврате записи в draft. С WP 5.0.
												// По умолчанию: «Post reverted to draft.» / «Page reverted to
			'item_scheduled'           => 'Country scheduled', // Текст заметки в редакторе записи при запланированной публикации на будущую дату. С WP 5.0.
												// По умолчанию: «Post scheduled.» / «Page scheduled.»
		],
		'description'   => 'Countries where you have been and which you can tell about',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon'     => 'dashicons-admin-site-alt',
		'supports'      => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom_fields', 'comments']
	];

	register_post_type('countries', $countriesArgs);
}


add_action('init', 'travel_blog_register_taxonomies');
function travel_blog_register_taxonomies(): void
{
	$args = [
		'labels'                => [
			'name'              => 'Countries',
			'singular_name'     => 'Country',
			'search_items'      => 'Search countries',
			'all_items'         => 'All countries',
			'view_item '        => 'View country',
			'parent_item'       => 'Parent country',
			'parent_item_colon' => 'Parent country:',
			'edit_item'         => 'Edit country',
			'update_item'       => 'Update country',
			'add_new_item'      => 'Add new country',
			'new_item_name'     => 'New country name',
			'menu_name'         => 'Countries',
		],
		'description'           => 'Country that post is related to',
		'public'                => true,
		'hierarchical'          => true,

		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'rest_base'             => null,
	];

	register_taxonomy('country', ['post'], $args);

	$args = [
		'numberposts' => -1,
		'post_type'   => 'countries',
		'post_status' => 'publish'
	];
	
	$posts = get_posts($args);
	foreach ($posts as $post) {
		wp_insert_term($post->post_title, 'country', [
			'description' => '',
			'parent'      => 0,
			'slug'        => $post->post_name,
		]);
	}
}


add_action('widgets_init', 'travel_blog_register_sidebars');
function travel_blog_register_sidebars(): void
{
	$args = [
		'name'          => "Post Sidebar",
		'id'            => "post-sidebar",
		'description'   => 'Sidebar that displays on the post page',
		'class'         => 'dynamic-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	];

	register_sidebar($args);
}