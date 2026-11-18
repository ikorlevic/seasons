<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 19:04
 */

if(!function_exists("seasons_setup")){
    function seasons_setup(){
        load_theme_textdomain( 'seasons', get_template_directory() . '/languages' );

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );
//        set_post_thumbnail_size( 1200, 9999 );

        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        register_nav_menus( array(
            'header' => __( 'Main Menu',      'seasons' ),
            'footer'  => __( 'Footer Menu', 'seasons' ),
        ) );
    }
}

add_action( 'after_setup_theme', 'seasons_setup' );

