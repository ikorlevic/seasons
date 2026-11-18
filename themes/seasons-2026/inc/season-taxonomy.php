<?php
/**
 * Cross-category seasons for posts. Seasonal classification is optional.
 * Legacy season categories remain intact until content/query migration.
 */
function seasons_register_season_taxonomy() {
    register_taxonomy('content_season', array('post', 'recipes_menu'), array(
        'labels' => array(
            'name' => __('Seasons', 'seasons'),
            'singular_name' => __('Season', 'seasons'),
            'search_items' => __('Search Seasons', 'seasons'),
            'all_items' => __('All Seasons', 'seasons'),
            'edit_item' => __('Edit Season', 'seasons'),
            'update_item' => __('Update Season', 'seasons'),
            'add_new_item' => __('Add New Season', 'seasons'),
            'new_item_name' => __('New Season Name', 'seasons'),
            'menu_name' => __('Seasons', 'seasons'),
        ),
        'public' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'season', 'with_front' => false),
    ));
}
add_action('init', 'seasons_register_season_taxonomy');

function seasons_ensure_season_terms() {
    foreach (array('spring' => 'Spring', 'summer' => 'Summer', 'autumn' => 'Autumn', 'winter' => 'Winter') as $slug => $name) {
        if (!term_exists($slug, 'content_season')) {
            wp_insert_term(__($name, 'seasons'), 'content_season', array('slug' => $slug));
        }
    }
}
add_action('init', 'seasons_ensure_season_terms', 20);
