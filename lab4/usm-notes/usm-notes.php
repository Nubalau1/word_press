<?php
/*
Plugin Name: USM Notes
Description: Plugin educational care adauga sectiunea Notite cu prioritati si date de reamintire.
Version: 1.0.0
Author: Petrasco Bogdan
*/

if ( ! defined( 'ABSPATH' ) ) exit;

function usm_register_notes_cpt() {
    $labels = array(
        'name'               => 'Notite',
        'singular_name'      => 'Notita',
        'add_new'            => 'Adauga notita',
        'add_new_item'       => 'Adauga notita noua',
        'edit_item'          => 'Editeaza notita',
        'all_items'          => 'Toate notitele',
        'menu_name'          => 'Notite',
    );

    $args = array(
        'labels'      => $labels,
        'public'      => true,
        'has_archive' => true,
        'supports'    => array( 'title', 'editor', 'author', 'thumbnail' ),
        'menu_icon'   => 'dashicons-sticky',
    );

    register_post_type( 'usm_note', $args );
}
add_action( 'init', 'usm_register_notes_cpt' );

function usm_register_priority_taxonomy() {
    $labels = array(
        'name'              => 'Prioritati',
        'singular_name'     => 'Prioritate',
        'search_items'      => 'Cauta prioritati',
        'all_items'         => 'Toate prioritatile',
        'edit_item'         => 'Editeaza prioritatea',
        'add_new_item'      => 'Adauga prioritate noua',
        'menu_name'         => 'Prioritati',
    );

    $args = array(
        'labels'       => $labels,
        'hierarchical' => true,
        'public'       => true,
    );

    register_taxonomy( 'usm_priority', 'usm_note', $args );
}
add_action( 'init', 'usm_register_priority_taxonomy' );

// Adauga metabox
function usm_add_due_date_metabox() {
    add_meta_box(
        'usm_due_date',
        'Data de reamintire',
        'usm_due_date_callback',
        'usm_note',
        'side'
    );
}
add_action( 'add_meta_boxes', 'usm_add_due_date_metabox' );

// Continutul metabox
function usm_due_date_callback( $post ) {
    wp_nonce_field( 'usm_save_due_date', 'usm_due_date_nonce' );
    $value = get_post_meta( $post->ID, '_usm_due_date', true );
    echo '<label for="usm_due_date">Data:</label>';
    echo '<input type="date" id="usm_due_date" name="usm_due_date" value="' . esc_attr( $value ) . '" required style="width:100%">';
}

// Salvare metabox
function usm_save_due_date( $post_id ) {
    // Verificare nonce
    if ( ! isset( $_POST['usm_due_date_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['usm_due_date_nonce'], 'usm_save_due_date' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if ( isset( $_POST['usm_due_date'] ) ) {
        $date = sanitize_text_field( $_POST['usm_due_date'] );

        // Validare: data nu poate fi in trecut
        if ( $date < date('Y-m-d') ) {
            set_transient( 'usm_date_error_' . $post_id, 'Data nu poate fi in trecut!', 45 );
            return;
        }

        update_post_meta( $post_id, '_usm_due_date', $date );
    }
}
add_action( 'save_post', 'usm_save_due_date' );

// Afisare mesaj de eroare
function usm_show_date_error() {
    global $post;
    if ( ! $post ) return;
    $error = get_transient( 'usm_date_error_' . $post->ID );
    if ( $error ) {
        echo '<div class="notice notice-error"><p>' . esc_html( $error ) . '</p></div>';
        delete_transient( 'usm_date_error_' . $post->ID );
    }
}
add_action( 'admin_notices', 'usm_show_date_error' );

// Coloana "Due Date" in lista din admin
function usm_add_due_date_column( $columns ) {
    $columns['due_date'] = 'Data de reamintire';
    return $columns;
}
add_filter( 'manage_usm_note_posts_columns', 'usm_add_due_date_column' );

function usm_show_due_date_column( $column, $post_id ) {
    if ( $column === 'due_date' ) {
        $date = get_post_meta( $post_id, '_usm_due_date', true );
        echo $date ? esc_html( $date ) : '—';
    }
}
add_action( 'manage_usm_note_posts_custom_column', 'usm_show_due_date_column', 10, 2 );

function usm_notes_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'priority'    => '',
        'before_date' => '',
    ), $atts );

    $args = array(
        'post_type'      => 'usm_note',
        'posts_per_page' => -1,
    );

    // Filtru dupa prioritate
    if ( ! empty( $atts['priority'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'usm_priority',
                'field'    => 'slug',
                'terms'    => $atts['priority'],
            ),
        );
    }

    // Filtru dupa data
    if ( ! empty( $atts['before_date'] ) ) {
        $args['meta_query'] = array(
            array(
                'key'     => '_usm_due_date',
                'value'   => $atts['before_date'],
                'compare' => '<=',
                'type'    => 'DATE',
            ),
        );
    }

    $query = new WP_Query( $args );

    if ( ! $query->have_posts() ) {
        return '<p>Nu exista notite cu parametrii specificati.</p>';
    }

    $output = '<ul class="usm-notes-list">';
    while ( $query->have_posts() ) : $query->the_post();
        $date = get_post_meta( get_the_ID(), '_usm_due_date', true );
        $output .= '<li>';
        $output .= '<strong>' . get_the_title() . '</strong>';
        if ( $date ) {
            $output .= ' <span class="usm-date">— ' . esc_html( $date ) . '</span>';
        }
        $output .= '<p>' . get_the_excerpt() . '</p>';
        $output .= '</li>';
    endwhile;
    wp_reset_postdata();
    $output .= '</ul>';

    return $output;
}
add_shortcode( 'usm_notes', 'usm_notes_shortcode' );

// Stiluri pentru shortcode
function usm_notes_styles() {
    echo '<style>
        .usm-notes-list { list-style: none; padding: 0; }
        .usm-notes-list li { background: #fff; border: 1px solid #ddd; padding: 12px; margin-bottom: 10px; }
        .usm-notes-list strong { font-size: 16px; }
        .usm-date { color: #888; font-size: 13px; }
    </style>';
}
add_action( 'wp_head', 'usm_notes_styles' );