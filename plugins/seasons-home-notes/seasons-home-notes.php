<?php
/**
 * Plugin Name: Seasons Home Notes
 * Description: Editable seasonal notes for the From My Home section on the main category page.
 * Version: 1.0.0
 * Requires PHP: 7.4
 * Text Domain: seasons
 */
if (!defined('ABSPATH')) { exit; }

function shn_register_notes() {
    register_post_type('home_note', array(
        'labels' => array(
            'name' => __('Home Notes', 'seasons'),
            'singular_name' => __('Home Note', 'seasons'),
            'add_new_item' => __('Add Home Note', 'seasons'),
            'edit_item' => __('Edit Home Note', 'seasons'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-admin-home',
        'supports' => array('title', 'editor', 'page-attributes'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'shn_register_notes');

function shn_add_meta_box() {
    add_meta_box('shn_details', __('Home Note Details', 'seasons'), 'shn_render_meta_box', 'home_note', 'normal', 'high');
}
add_action('add_meta_boxes', 'shn_add_meta_box');

function shn_render_meta_box($post) {
    wp_nonce_field('shn_save', 'shn_nonce');
    $season = get_post_meta($post->ID, '_seasons_note_season', true);
    $label = get_post_meta($post->ID, '_seasons_note_label', true);
    $tone = get_post_meta($post->ID, '_seasons_note_tone', true);
    echo '<p><label for="shn_season"><strong>' . esc_html__('Season', 'seasons') . '</strong></label><br><select id="shn_season" name="shn_season">';
    foreach (array('spring', 'summer', 'autumn', 'winter') as $choice) {
        echo '<option value="' . esc_attr($choice) . '" ' . selected($season, $choice, false) . '>' . esc_html(ucfirst($choice)) . '</option>';
    }
    echo '</select></p>';
    echo '<p><label for="shn_label"><strong>' . esc_html__('Small label above title', 'seasons') . '</strong></label><br><input class="widefat" type="text" id="shn_label" name="shn_label" value="' . esc_attr($label) . '"></p>';
    echo '<p><label for="shn_tone"><strong>' . esc_html__('Label color', 'seasons') . '</strong></label><br><select id="shn_tone" name="shn_tone">';
    foreach (array('green', 'teal', 'blue', 'orange') as $choice) {
        echo '<option value="' . esc_attr($choice) . '" ' . selected($tone, $choice, false) . '>' . esc_html(ucfirst($choice)) . '</option>';
    }
    echo '</select></p><p>' . esc_html__('Use the title and editor for the note. Set Order in Page Attributes. The theme can display up to six published notes for the current season.', 'seasons') . '</p>';
}

function shn_save_note($post_id) {
    if (!isset($_POST['shn_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['shn_nonce'])), 'shn_save') ||
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        !current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['shn_season'])) {
        $value = sanitize_key(wp_unslash($_POST['shn_season']));
        if (in_array($value, array('spring', 'summer', 'autumn', 'winter'), true)) {
            update_post_meta($post_id, '_seasons_note_season', $value);
        }
    }
    if (isset($_POST['shn_label'])) {
        update_post_meta($post_id, '_seasons_note_label', sanitize_text_field(wp_unslash($_POST['shn_label'])));
    }
    if (isset($_POST['shn_tone'])) {
        $value = sanitize_key(wp_unslash($_POST['shn_tone']));
        if (in_array($value, array('green', 'teal', 'blue', 'orange'), true)) {
            update_post_meta($post_id, '_seasons_note_tone', $value);
        }
    }
}
add_action('save_post_home_note', 'shn_save_note');
