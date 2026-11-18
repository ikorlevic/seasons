<?php
/**
 * Plugin Name: Seasons Kitchen Notes
 * Description: Editable seasonal notes for the From My Kitchen section on the main category page.
 * Version: 1.0.0
 * Requires PHP: 7.4
 * Text Domain: seasons
 */
if (!defined('ABSPATH')) { exit; }

function skn_register_notes() {
    register_post_type('kitchen_note', array(
        'labels' => array(
            'name' => __('Kitchen Notes', 'seasons'),
            'singular_name' => __('Kitchen Note', 'seasons'),
            'add_new_item' => __('Add Kitchen Note', 'seasons'),
            'edit_item' => __('Edit Kitchen Note', 'seasons'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-carrot',
        'supports' => array('title', 'editor', 'page-attributes'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'skn_register_notes');

function skn_add_meta_box() {
    add_meta_box('skn_details', __('Kitchen Note Details', 'seasons'), 'skn_render_meta_box', 'kitchen_note', 'normal', 'high');
}
add_action('add_meta_boxes', 'skn_add_meta_box');

function skn_render_meta_box($post) {
    wp_nonce_field('skn_save', 'skn_nonce');
    $season = get_post_meta($post->ID, '_seasons_note_season', true);
    $label = get_post_meta($post->ID, '_seasons_note_label', true);
    $tone = get_post_meta($post->ID, '_seasons_note_tone', true);
    echo '<p><label for="skn_season"><strong>' . esc_html__('Season', 'seasons') . '</strong></label><br><select id="skn_season" name="skn_season">';
    foreach (array('spring', 'summer', 'autumn', 'winter') as $choice) {
        echo '<option value="' . esc_attr($choice) . '" ' . selected($season, $choice, false) . '>' . esc_html(ucfirst($choice)) . '</option>';
    }
    echo '</select></p>';
    echo '<p><label for="skn_label"><strong>' . esc_html__('Small label above title', 'seasons') . '</strong></label><br><input class="widefat" type="text" id="skn_label" name="skn_label" value="' . esc_attr($label) . '"></p>';
    echo '<p><label for="skn_tone"><strong>' . esc_html__('Label color', 'seasons') . '</strong></label><br><select id="skn_tone" name="skn_tone">';
    foreach (array('green', 'teal', 'blue', 'orange') as $choice) {
        echo '<option value="' . esc_attr($choice) . '" ' . selected($tone, $choice, false) . '>' . esc_html(ucfirst($choice)) . '</option>';
    }
    echo '</select></p><p>' . esc_html__('Use the title and editor for the note. Set Order in Page Attributes. The theme can display up to six published notes for the current season.', 'seasons') . '</p>';
}

function skn_save_note($post_id) {
    if (!isset($_POST['skn_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['skn_nonce'])), 'skn_save') ||
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        !current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['skn_season'])) {
        $value = sanitize_key(wp_unslash($_POST['skn_season']));
        if (in_array($value, array('spring', 'summer', 'autumn', 'winter'), true)) {
            update_post_meta($post_id, '_seasons_note_season', $value);
        }
    }
    if (isset($_POST['skn_label'])) {
        update_post_meta($post_id, '_seasons_note_label', sanitize_text_field(wp_unslash($_POST['skn_label'])));
    }
    if (isset($_POST['skn_tone'])) {
        $value = sanitize_key(wp_unslash($_POST['skn_tone']));
        if (in_array($value, array('green', 'teal', 'blue', 'orange'), true)) {
            update_post_meta($post_id, '_seasons_note_tone', $value);
        }
    }
}
add_action('save_post_kitchen_note', 'skn_save_note');
