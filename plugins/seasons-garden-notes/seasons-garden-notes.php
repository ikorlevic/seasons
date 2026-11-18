<?php
/**
 * Plugin Name: Seasons Garden Notes
 * Description: Editable, season-specific personal gardening tips for the From My Garden homepage section.
 * Version: 1.0.0
 * Requires PHP: 7.4
 * Text Domain: seasons
 */
if (!defined('ABSPATH')) { exit; }

/**
 * Editable seasonal personal notes: Appearance is controlled by the theme,
 * while each card is managed under Garden Notes in WordPress admin.
 */
function seasons_register_garden_notes() {
    register_post_type('garden_note', array(
        'labels' => array(
            'name' => __('Garden Notes', 'seasons'),
            'singular_name' => __('Garden Note', 'seasons'),
            'add_new_item' => __('Add Garden Note', 'seasons'),
            'edit_item' => __('Edit Garden Note', 'seasons'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array('title', 'editor', 'page-attributes'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'seasons_register_garden_notes');

function seasons_garden_note_meta_box() {
    add_meta_box('seasons_garden_note_details', __('Garden Note Details', 'seasons'), 'seasons_render_garden_note_meta_box', 'garden_note', 'normal', 'high');
}
add_action('add_meta_boxes', 'seasons_garden_note_meta_box');

function seasons_render_garden_note_meta_box($post) {
    wp_nonce_field('seasons_save_garden_note', 'seasons_garden_note_nonce');
    $season = get_post_meta($post->ID, '_seasons_note_season', true);
    $label = get_post_meta($post->ID, '_seasons_note_label', true);
    $tone = get_post_meta($post->ID, '_seasons_note_tone', true);
    echo '<p><label for="seasons_note_season"><strong>' . esc_html__('Season', 'seasons') . '</strong></label><br><select name="seasons_note_season" id="seasons_note_season">';
    foreach (array('spring', 'summer', 'autumn', 'winter') as $choice) {
        echo '<option value="' . esc_attr($choice) . '" ' . selected($season, $choice, false) . '>' . esc_html(ucfirst($choice)) . '</option>';
    }
    echo '</select></p>';
    echo '<p><label for="seasons_note_label"><strong>' . esc_html__('Small label above title', 'seasons') . '</strong></label><br><input type="text" class="widefat" name="seasons_note_label" id="seasons_note_label" value="' . esc_attr($label) . '" placeholder="What I Learned"></p>';
    echo '<p><label for="seasons_note_tone"><strong>' . esc_html__('Label color', 'seasons') . '</strong></label><br><select name="seasons_note_tone" id="seasons_note_tone">';
    foreach (array('green', 'teal', 'blue', 'orange') as $choice) {
        echo '<option value="' . esc_attr($choice) . '" ' . selected($tone, $choice, false) . '>' . esc_html(ucfirst($choice)) . '</option>';
    }
    echo '</select></p><p>' . esc_html__('Use the title for the card heading and the main editor for its tip. Order cards using the Order field in Page Attributes. Up to six published notes per season appear on the homepage.', 'seasons') . '</p>';
}

function seasons_save_garden_note($post_id) {
    if (!isset($_POST['seasons_garden_note_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['seasons_garden_note_nonce'])), 'seasons_save_garden_note') ||
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        !current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['seasons_note_season'])) {
        $season = sanitize_key(wp_unslash($_POST['seasons_note_season']));
        if (in_array($season, array('spring', 'summer', 'autumn', 'winter'), true)) {
            update_post_meta($post_id, '_seasons_note_season', $season);
        }
    }
    if (isset($_POST['seasons_note_label'])) {
        update_post_meta($post_id, '_seasons_note_label', sanitize_text_field(wp_unslash($_POST['seasons_note_label'])));
    }
    if (isset($_POST['seasons_note_tone'])) {
        $tone = sanitize_key(wp_unslash($_POST['seasons_note_tone']));
        if (in_array($tone, array('green', 'teal', 'blue', 'orange'), true)) {
            update_post_meta($post_id, '_seasons_note_tone', $tone);
        }
    }
}
add_action('save_post_garden_note', 'seasons_save_garden_note');
