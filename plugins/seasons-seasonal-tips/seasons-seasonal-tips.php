<?php
/**
 * Plugin Name: Seasons Seasonal Tips
 * Description: Editable seasonal highlights for Garden, Recipe Book, and At Home.
 * Version: 1.0.0
 * Requires PHP: 7.4
 * Text Domain: seasons
 */
if (!defined('ABSPATH')) { exit; }

function sst_register_tips() {
    register_post_type('seasonal_tip', array(
        'labels' => array(
            'name' => __('Seasonal Tips', 'seasons'),
            'singular_name' => __('Seasonal Tip', 'seasons'),
            'add_new_item' => __('Add Seasonal Tip', 'seasons'),
            'edit_item' => __('Edit Seasonal Tip', 'seasons'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-lightbulb',
        'supports' => array('title', 'editor', 'page-attributes'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'sst_register_tips');

function sst_add_meta_box() {
    add_meta_box('sst_tip_details', __('Seasonal Tip Details', 'seasons'), 'sst_render_meta_box', 'seasonal_tip', 'normal', 'high');
}
add_action('add_meta_boxes', 'sst_add_meta_box');

function sst_render_meta_box($post) {
    wp_nonce_field('sst_save_tip', 'sst_nonce');
    $area = get_post_meta($post->ID, '_seasons_tip_area', true);
    $season = get_post_meta($post->ID, '_seasons_tip_season', true);
    $icon = get_post_meta($post->ID, '_seasons_tip_icon', true);
    echo '<p><label for="sst_area"><strong>' . esc_html__('Main category', 'seasons') . '</strong></label><br><select id="sst_area" name="sst_area">';
    foreach (array('garden' => 'Garden', 'kitchen' => 'Recipe Book', 'home' => 'At Home') as $value => $label) {
        echo '<option value="' . esc_attr($value) . '" ' . selected($area, $value, false) . '>' . esc_html($label) . '</option>';
    }
    echo '</select></p><p><label for="sst_season"><strong>' . esc_html__('Season', 'seasons') . '</strong></label><br><select id="sst_season" name="sst_season">';
    foreach (array('spring', 'summer', 'autumn', 'winter') as $value) {
        echo '<option value="' . esc_attr($value) . '" ' . selected($season, $value, false) . '>' . esc_html(ucfirst($value)) . '</option>';
    }
    echo '</select></p><p><label for="sst_icon"><strong>' . esc_html__('Material Symbols icon name', 'seasons') . '</strong></label><br><input class="widefat" type="text" id="sst_icon" name="sst_icon" value="' . esc_attr($icon) . '" placeholder="local_florist"></p>';
    echo '<p>' . esc_html__('Use the title for the highlight heading, the editor for a short description, and Page Attributes Order to choose display order. Up to four published tips per category and season are shown.', 'seasons') . '</p>';
}

function sst_save_tip($post_id) {
    if (!isset($_POST['sst_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['sst_nonce'])), 'sst_save_tip') ||
        (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
        !current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['sst_area'])) {
        $area = sanitize_key(wp_unslash($_POST['sst_area']));
        if (in_array($area, array('garden', 'kitchen', 'home'), true)) {
            update_post_meta($post_id, '_seasons_tip_area', $area);
        }
    }
    if (isset($_POST['sst_season'])) {
        $season = sanitize_key(wp_unslash($_POST['sst_season']));
        if (in_array($season, array('spring', 'summer', 'autumn', 'winter'), true)) {
            update_post_meta($post_id, '_seasons_tip_season', $season);
        }
    }
    if (isset($_POST['sst_icon'])) {
        update_post_meta($post_id, '_seasons_tip_icon', sanitize_text_field(wp_unslash($_POST['sst_icon'])));
    }
}
add_action('save_post_seasonal_tip', 'sst_save_tip');

/**
 * Get up to four editable highlights for one main category and gardening season.
 * Returns WP_Query; callers must wp_reset_postdata() after using the loop.
 */
function sst_get_tips($area, $season) {
    if (!in_array($area, array('garden', 'kitchen', 'home'), true) ||
        !in_array($season, array('spring', 'summer', 'autumn', 'winter'), true)) {
        return new WP_Query(array('post__in' => array(0)));
    }
    return new WP_Query(array(
        'post_type' => 'seasonal_tip',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'meta_query' => array(
            array('key' => '_seasons_tip_area', 'value' => $area),
            array('key' => '_seasons_tip_season', 'value' => $season),
        ),
        'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'),
        'ignore_sticky_posts' => true,
    ));
}
