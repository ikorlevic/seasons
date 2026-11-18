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
            'header_left' => __( 'Menu Left','seasons' ),
            'header_right' => __( 'Menu Right','seasons' ),
            'header_mobile' => __( 'Mobile Menu','seasons' ),
            'footer'  => __( 'Footer Menu', 'seasons' ),
        ) );


    }
}
add_action( 'after_setup_theme', 'seasons_setup' );

register_sidebar(array(
    'name'=>"Banners",
    'id'=>'banners',
    'description' => __( 'Widget area for banners of home', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="banners %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="banners-title h1">',
    'after_title'   => '</h2>',
));

register_sidebar(array(
    'name'=>"Features",
    'id'=>'features',
    'description' => __( 'Widget area for featured posts', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="features %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="features-title">',
    'after_title'   => '</h2>',
));

register_sidebar(array(
    'name'=>"Instagram",
    'id'=>'insta-feed',
    'description' => __( 'Widget area for instagram', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
));

//add_action( 'widgets_init', 'theme_slug_widgets_init' );

add_action('add_meta_boxes','big_image_box');

function big_image_box(){
    add_meta_box( 'bigone', __( 'Big Image', 'seasons' ), 'big_image', 'post', 'side', 'low');
    add_meta_box( 'bigone', __( 'Big Image', 'seasons' ), 'big_image', 'recipes_menu', 'side', 'low');
    add_meta_box( 'bigone', __( 'Big Image', 'seasons' ), 'big_image', 'page', 'side', 'low');

}

function big_image($post){
    global $content_width, $_wp_additional_image_sizes;
    $image_id = get_post_meta( $post->ID, '_listing_image_id', true );
    $old_content_width = $content_width;
    $content_width = 254;
    if ( $image_id && get_post( $image_id ) ) {
        if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
            $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
        } else {
            $thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
        }
        if ( ! empty( $thumbnail_html ) ) {
            $content = $thumbnail_html;
            $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button" >' . esc_html__( 'Remove listing image', 'text-domain' ) . '</a></p>';
            $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="' . esc_attr( $image_id ) . '" />';
        }
        $content_width = $old_content_width;
    } else {
        $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
        $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set listing image', 'text-domain' ) . '" href="javascript:;" id="upload_listing_image_button" id="set-listing-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set listing image', 'text-domain' ) . '">' . esc_html__( 'Set listing image', 'text-domain' ) . '</a></p>';
        $content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="" />';
    }
    echo $content;
}

add_action( 'save_post', 'listing_image_save', 10, 1 );
function listing_image_save ( $post_id ) {
    if( isset( $_POST['_listing_cover_image'] ) ) {
        $image_id = (int) $_POST['_listing_cover_image'];
        update_post_meta( $post_id, '_listing_image_id', $image_id );
    }
}

add_action("admin_enqueue_scripts","custom_script");
function custom_script(){
    wp_enqueue_script( 'my_custom_script', get_template_directory_uri() . '/js/scripts.js', array(), '1.0' );
}

function load_ajax(){

    global $wp_query;

    // In most cases it is already included on the page and this line can be removed
    wp_enqueue_script('jquery');

    if(!is_home()){

    wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/ajax.js', array('jquery') );


    wp_localize_script( 'my_loadmore', 'seasons_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => serialize( $wp_query->query_vars ), // everything about your loop is here
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ) );


    wp_enqueue_script( 'my_loadmore' );
    }

}

add_action( 'wp_enqueue_scripts', 'load_ajax' );

function seasons_loadmore_ajax_handler(){

    // prepare our arguments for the query
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    // it is always better to use WP_Query but not here
    query_posts( $args );
    if(!is_single() && !is_home()):

    if( have_posts() ) :

        // run the loop
        while( have_posts() ): the_post();

            // look into your theme code how the posts are inserted, but you can use your own HTML of course
            // do you remember? - my example is adapted for Twenty Seventeen theme
            get_template_part( 'templates-part/content', get_post_format() );
            // for the test purposes comment the line above and uncomment the below one
            // the_title();


        endwhile;

    endif;
    endif;
    die; // here we exit the script and even no wp_reset_query() required!
}



add_action('wp_ajax_loadmore', 'seasons_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'seasons_loadmore_ajax_handler');

function menu_post_type() {
    register_post_type( 'recipes_menu',
        array(
            'labels' => array(
                'name' => __( 'Recipes Menu' ),
                'singular_name' => __( 'Menu' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'editor', 'custom-fields','thumbnail' ),
            'taxonomies' => array( 'category' ),
        )
    );
}

add_action( 'init', 'menu_post_type' );

function seasons_add_custom_types( $query ) {
    if( (is_category() || is_tag()) && $query->is_archive()
        && empty( $query->query_vars['suppress_filters'] ) ){
        $query->set( 'post_type', array(
            'post', 'recipes_menu'
        ));
    }
    return $query;
}

add_filter( 'pre_get_posts', 'seasons_add_custom_types' );

function custom_conference_in_home_loop( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'recipes_menu') );
    return $query;
}
add_filter( 'pre_get_posts', 'custom_conference_in_home_loop' );

add_theme_support( 'infinite-scroll', array(
    'container' => 'content',
    'render'=>'seasonsContent',
    'footer' => 'page',
) );

function seasonsContent(){
get_template_part( 'templates-part/content',get_post_format() );
}

function wpdocs_excerpt_more( $more ) {
    return sprintf( ' <a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More >', 'seasonsingarden' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

function defer_parsing_of_js ( $url ) {
    if(is_admin()) return $url;
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url;
    return "$url' defer ";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );