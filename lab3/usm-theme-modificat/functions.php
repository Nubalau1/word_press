<?php
/**
 * USM Theme - Funcții principale
 *
 * @package USM_Theme
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Securitate: blochează accesul direct
}

// =============================================
// CONSTANTE TEMĂ
// =============================================

define( 'USM_THEME_VERSION', '1.0.0' );
define( 'USM_THEME_DIR', get_template_directory() );
define( 'USM_THEME_URI', get_template_directory_uri() );

// =============================================
// CONFIGURARE TEMĂ (after_setup_theme)
// =============================================

if ( ! function_exists( 'usm_theme_setup' ) ) :
    /**
     * Configurări și suport pentru funcționalitățile WordPress.
     */
    function usm_theme_setup() {

        // Suport pentru traduceri
        load_theme_textdomain( 'usm-theme', USM_THEME_DIR . '/languages' );

        // Feed-uri automate în <head>
        add_theme_support( 'automatic-feed-links' );

        // Titlu dinamic gestionat de WordPress
        add_theme_support( 'title-tag' );

        // Imagini reprezentative pentru postări
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1200, 628, true );
        add_image_size( 'usm-card',    600, 400, true );
        add_image_size( 'usm-hero',   1200, 500, true );
        add_image_size( 'usm-square',  400, 400, true );

        // Meniuri de navigare înregistrate
        register_nav_menus( array(
            'primary' => esc_html__( 'Meniu principal', 'usm-theme' ),
            'footer'  => esc_html__( 'Meniu subsol', 'usm-theme' ),
        ) );

        // HTML5 semantic pentru elementele WordPress
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );

        // Personalizare: culori pentru editor
        add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => esc_html__( 'Albastru USM', 'usm-theme' ),
                'slug'  => 'usm-blue',
                'color' => '#003087',
            ),
            array(
                'name'  => esc_html__( 'Galben USM', 'usm-theme' ),
                'slug'  => 'usm-yellow',
                'color' => '#e8a000',
            ),
            array(
                'name'  => esc_html__( 'Roșu accent', 'usm-theme' ),
                'slug'  => 'usm-red',
                'color' => '#cc0000',
            ),
        ) );

        // Suport pentru logo personalizat
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 200,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        // Suport pentru imaginea antetului
        add_theme_support( 'custom-header', array(
            'default-image'  => '',
            'width'          => 1920,
            'height'         => 400,
            'flex-width'     => true,
            'flex-height'    => true,
        ) );

        // Aliniere largă și completă pentru blocuri Gutenberg
        add_theme_support( 'align-wide' );

        // Suport pentru stiluri editor Gutenberg
        add_theme_support( 'editor-styles' );

        // Formatul conținutului (post formats)
        add_theme_support( 'post-formats', array(
            'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat',
        ) );
    }
endif;
add_action( 'after_setup_theme', 'usm_theme_setup' );

// =============================================
// LĂȚIMEA CONȚINUTULUI
// =============================================

function usm_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'usm_content_width', 860 );
}
add_action( 'after_setup_theme', 'usm_content_width', 0 );

// =============================================
// ÎNREGISTRARE WIDGET AREAS (SIDEBARS)
// =============================================

function usm_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Bara laterală principală', 'usm-theme' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Adaugă widget-uri în bara laterală.', 'usm-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer - Coloana 1', 'usm-theme' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Widget-uri pentru prima coloană din subsol.', 'usm-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer - Coloana 2', 'usm-theme' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Widget-uri pentru a doua coloană din subsol.', 'usm-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'usm_widgets_init' );

// =============================================
// ÎNCĂRCARE STILURI ȘI SCRIPTURI (wp_enqueue)
// =============================================

function usm_scripts() {

    // Stilul principal al temei (style.css cu metadate)
    wp_enqueue_style(
        'usm-theme-style',
        get_stylesheet_uri(),
        array(),
        USM_THEME_VERSION
    );

    // Font Google (Roboto pentru UI)
    wp_enqueue_style(
        'usm-google-fonts',
        'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Merriweather:ital,wght@0,400;0,700;1,400&display=swap',
        array(),
        null
    );

    // Script pentru navigare responsivă
    wp_enqueue_script(
        'usm-navigation',
        USM_THEME_URI . '/js/navigation.js',
        array(),
        USM_THEME_VERSION,
        true // în footer
    );

    // Thread-uri de comentarii WordPress
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'usm_scripts' );

// =============================================
// MENIU FALLBACK (când nu e setat niciun meniu)
// =============================================

function usm_fallback_menu() {
    echo '<ul class="nav-menu">';
    wp_list_pages( array(
        'title_li'    => '',
        'sort_column' => 'menu_order',
        'echo'        => true,
    ) );
    echo '</ul>';
}

// =============================================
// EXCERPT PERSONALIZAT
// =============================================

function usm_excerpt_length( $length ) {
    return 30; // cuvinte
}
add_filter( 'excerpt_length', 'usm_excerpt_length' );

function usm_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'usm_excerpt_more' );

// =============================================
// TITLU DOCUMENT (fallback pentru teme vechi)
// =============================================

function usm_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }
    global $paged, $page;
    if ( is_home() || is_front_page() ) {
        $title .= get_bloginfo( 'name', 'display' );
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title .= " $sep " . $site_description;
        }
        if ( $paged >= 2 || $page >= 2 ) {
            $title .= " $sep " . sprintf( esc_html__( 'Pagina %s', 'usm-theme' ), max( $paged, $page ) );
        }
        return $title;
    }
    $title .= get_bloginfo( 'name', 'display' );
    return $title;
}
add_filter( 'wp_title', 'usm_wp_title', 10, 2 );

// =============================================
// BODY CLASS — adaugă clase utile
// =============================================

function usm_body_classes( $classes ) {
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }
    return $classes;
}
add_filter( 'body_class', 'usm_body_classes' );

// =============================================
// STILURI EDITOR GUTENBERG (editor-styles)
// =============================================

function usm_add_editor_styles() {
    add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'usm_add_editor_styles' );

// =============================================
// SECURITATE: eliminare versiune WordPress din frontend
// =============================================

remove_action( 'wp_head', 'wp_generator' );
