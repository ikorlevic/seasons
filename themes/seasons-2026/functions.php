<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 19:04
 */

if(!function_exists("current_season")){
    function current_season() {
                                $season="spring";

                                $date = date("md");

                                if($date<"0321"){
                                    $season="winter";
                                }
                                elseif($date<"0621"){
                                    $season="spring";
                                }
                                elseif($date<"0921"){
                                    $season="summer";
                                }
                                elseif($date<"1221"){
                                    $season="autumn";
                                }else{
                                    $season="winter";
                                }

                                if($date >= "0102" && $date <= "0214"){
                                    $season = "valentines";
                                }elseif($date >= "1510" && $date <= "3110"){
                                    $season = "halloween";
                                }elseif("1224" <= $date && $date <="1226"){
                                    $season = "yule";
                                }elseif("1229"  <= $date && $date <= "0105"){
                                    $season = "ny";
                                }
                              return $season;
                              }
}

if(!function_exists("get_selected_season")){
function get_selected_season($obj) {
$season = "";
        if($obj->taxonomy === 'category') {
            $season = $obj->slug;
        } else {
              $categories = get_the_category($obj->term_id);


              $cat = $categories[0];
              $slug = $cat->slug;

              $par = get_category_parents($cat->term_id);
//               print_r($par);
              $season = str_replace("recipes-", "", $slug);
        }
    return $season;

}
}

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
            'header_top' => __( 'Menu Top','seasons' ),
            'footer'  => __( 'Footer Menu', 'seasons' ),
            'footer_mid'  => __( 'Footer Middle Menu', 'seasons' ),
            'footer_bottom'  => __( 'Footer Bottom Menu', 'seasons' ),
            'seasons' => __('Seasons Menu', 'seasons')
        ) );


    }
}
add_action( 'after_setup_theme', 'seasons_setup' );

add_filter( 'jetpack_implode_frontend_css', '__return_false', 99 );
add_action( 'wp_enqueue_scripts', 'crunchify_enqueue_scripts_styles' );

function crunchify_enqueue_scripts_styles() {

    wp_dequeue_script( 'devicepx' );

}

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
    'name'=>"Mailchimp",
    'id'=>'insta-feed',
    'description' => __( 'Widget area for mailchimp', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="title">',
    'after_title'   => '</h2>',
));

register_sidebar(array(
    'name'=>"Spring garden care",
    'id'=>'jobs-spring',
    'description' => __( 'Widget area Spring garden care', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s jobs">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="title">',
    'after_title'   => '</h2><div class="icon"></div>',
));

register_sidebar(array(
    'name'=>"Summer garden care",
    'id'=>'jobs-summer',
    'description' => __( 'Widget area Summer garden care', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s jobs">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="title">',
    'after_title'   => '</h2><div class="icon"></div>',
));

register_sidebar(array(
    'name'=>"Fall garden care",
    'id'=>'jobs-autumn',
    'description' => __( 'Widget area Fall garden care', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s jobs">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="title">',
    'after_title'   => '</h2><div class="icon"></div>',
));

register_sidebar(array(
    'name'=>"Winter garden care",
    'id'=>'jobs-winter',
    'description' => __( 'Widget area Winter garden care', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s jobs">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="title">',
    'after_title'   => '</h2><div class="icon"></div>',
));

register_sidebar(array(
    'name'=>"About",
    'id'=>'about',
    'description' => __( 'Widget area for about', 'seasons' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s inner">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
));

//add_action( 'widgets_init', 'theme_slug_widgets_init' );

//add_action('add_meta_boxes','big_image_box');

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

// add_action( 'save_post', 'listing_image_save', 10, 1 );
function listing_image_save ( $post_id ) {
    if( isset( $_POST['_listing_cover_image'] ) ) {
        $image_id = (int) $_POST['_listing_cover_image'];
        update_post_meta( $post_id, '_listing_image_id', $image_id );
    }
}

//add_action("admin_enqueue_scripts","custom_script");
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
            'show_in_rest' => true,
            'supports' => array( 'title', 'editor', 'custom-fields','thumbnail' ),
            'taxonomies' => array( 'category' ),
            'rewrite' => array(
                'slug' => 'menus',
                'with_front' => true
            )
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
add_filter( 'clean_url', 'defer_parsing_of_js', 30, 1 );

function related_posts( $atts ) {
    $a = shortcode_atts( array(
        'id' => '1'
    ), $atts );

    $tags = wp_get_post_tags($a['id']);


    if (!empty($tags)) {
        $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
        $args=array(
            'tag__in' => $tag_ids,
            'post__not_in' => array($a['id']),
            'posts_per_page'=>5, // Number of related posts that will be shown.
            'caller_get_posts'=>1
        );
        $my_query = new WP_query( $args );

        $related ="";

        if( $my_query->have_posts() ) {
            $related = '<div class="related"><h3>Related Posts</h3><div class="content">';

            while($my_query->have_posts()):
                $my_query->the_post();
                $related .='<div class="post"><div class="thumb"><a href="'. get_post_permalink().'" rel="bookmark" title=title="'. get_the_title().'">'. get_the_post_thumbnail() .'</a></div>
                        <h4><a href="'. get_post_permalink().'" rel="bookmark" title="'. get_the_title().'">'. get_the_title().'</a></h4>
                        <small>'. get_the_time('M j, Y').'</small>
                    </div>';
            endwhile;
            $related .= '</div></div>';
        }
    }

    return $related;
}

add_shortcode( 'related-posts', 'related_posts' );

if(!function_exists("season_moto")){
function season_moto($season) {
    switch ($season) {
      case 'spring':
        return $moto = 'Awakening & Renewal';
        break;
      case 'summer':
        return $moto = 'Abundance & Vitality';
        break;
      case 'autumn':
        return $moto = 'Awakening & Renewal';
        break;
      case 'winter':
         return $moto = 'Awakening & Renewal';
         break;
      default:
         return $moto = 'Awakening & Renewal';
    }

}
}

if(!function_exists("season_desc")){
function season_desc($season) {
//             $desc = 'As nature awakens from winter slumber, our garden bursts with new life. Delicate blooms emerge, birds return, and the air fills with the sweet promise of growth.'

        switch ($season) {
          case 'spring':
            return $desc = 'As nature awakens from winter slumber, our garden bursts with new life. Delicate blooms emerge, birds return, and the air fills with the sweet promise of growth.';
            break;
          case 'summer':
            return $desc = 'The garden reaches its peak with lush greenery and vibrant blooms. Warm days and long evenings create the perfect time to enjoy the fruits of your labor.';
            break;
          case 'autumn':
            return $desc = "As days grow shorter, the garden transforms into a tapestry of golden hues. <br> It's time to gather the harvest and prepare for the coming winter.";
            break;
          case 'winter':
            return $desc = 'Awakening & Renewal';
            break;
          default:
            return $desc = 'default';
            return $desc = 'As nature awakens from winter slumber, our garden bursts with new life. Delicate blooms emerge, birds return, and the air fills with the sweet promise of growth.';
        }
//         return $desc;
    }
}

if(!function_exists("season_high")){
function season_high($season) {

// 
//   halloween: [
//     { icon: 'Sprout', title: 'Pumpkin Displays', description: 'Showcase carved jack-o-lanterns' },
//     { icon: Candy, title: 'Spooky Decorations', description: 'Transform your garden into haunted haven' },
//     { icon: Wind, title: 'Autumn Ambiance', description: 'Crisp fall air sets the mood' },
//   ],
//   valentines: [
//     { icon: HeartHandshake, title: 'Romantic Setting', description: 'Create intimate garden spaces' },
//     { icon: 'Sprout', title: 'Blooming Love', description: 'Roses and flowers in full display' },
//     { icon: 'Coffee', title: 'Special Moments', description: 'Enjoy romantic garden gatherings' },
//   ],
//   christmas: [
//     { icon: Gift, title: 'Festive Decor', description: 'Lights and ornaments everywhere' },
//     { icon: 'Sprout', title: 'Evergreen Beauty', description: 'Holly, ivy, and winter plants' },
//     { icon: 'Coffee', title: 'Holiday Cheer', description: 'Celebrate the season outdoors' },
//   ],
//   newyears: [
//     { icon: Sparkles, title: 'New Beginnings', description: 'Fresh starts for your garden journey' },
//     { icon: 'Sprout', title: 'Year in Bloom', description: 'Plan the most beautiful garden yet' },
//     { icon: 'Coffee', title: 'Midnight Garden', description: 'Toast the new year under the stars' },
//   ],
// };
        switch ($season) {
          case 'spring':
            return [
                       [ 'icon'=> 'psychiatry', 'title'=> 'Planting Season', 'description'=> 'Perfect time for seeds and seedlings' ],
                       [ 'icon'=> 'water_drops', 'title'=> 'Spring Showers', 'description'=> 'Natural watering for new growth' ],
                       [ 'icon'=> 'air', 'title'=> 'Fresh Breezes', 'description'=> 'Gentle winds help pollination' ],
                    ];
            break;
          case 'summer':
            return [
                       [ 'icon'=> 'spa', 'title'=> 'Peak Growth', 'description'=> 'Gardens at their most productive' ],
                       [ 'icon'=> 'sprinkler', 'title'=> 'Regular Watering', 'description'=> 'Keep soil consistently moist' ],
                       [ 'icon'=> 'meal_lunch', 'title'=> 'Outdoor Living', 'description'=> 'Enjoy your garden oasis' ],
                   ];
            break;
          case 'autumn':
            return [
                       [ 'icon'=> 'nutrition', 'title'=> 'Harvest Time', 'description'=> 'Gather the fruits of your labor' ],
                       [ 'icon'=> 'air', 'title'=> 'Cool Winds', 'description'=> 'Refreshing autumn air' ],
                       [ 'icon'=> 'yard', 'title'=> 'Garden Planning', 'description'=> 'Design next year\'s layout' ],
                     ];
            break;
          case 'winter':
            return [
                       [ 'icon'=> 'snooze', 'title'=> 'Dormant Period', 'description'=> 'Plants rest and regenerate' ],
                       [ 'icon'=> 'weather_mix', 'title'=> 'Natural Moisture', 'description'=> 'Snow provides winter hydration' ],
                       [ 'icon'=> 'local_cafe', 'title'=> 'Reflection Time', 'description'=> 'Review and plan ahead' ],
                     ];
            break;
          default:
           $high = array("'icon'" => "",  "text" => "");
           return $high;
        }
    }
}
/**
 * Editorial homepage styles. Loaded only for the posts index.
 */
function seasons_enqueue_home_editorial_styles() {
    // The posts index and a configured static front page can both use this layout.
    if (is_home() || is_front_page()) {
        $stylesheet_path = get_template_directory() . '/css/home-editorial.css';
        wp_enqueue_style(
            'seasons-home-editorial',
            get_template_directory_uri() . '/css/home-editorial.css',
            array(),
            file_exists($stylesheet_path) ? (string) filemtime($stylesheet_path) : '1.1'
        );
    }
}
add_action('wp_enqueue_scripts', 'seasons_enqueue_home_editorial_styles');

/** Load the editorial footer styles on all front-end pages. */
function seasons_enqueue_footer_editorial_styles() {
    wp_enqueue_style('seasons-footer-editorial', get_template_directory_uri() . '/css/footer-editorial.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'seasons_enqueue_footer_editorial_styles');

/** Weather presentation only; PDS Weather owns the data and its configuration. */
function seasons_enqueue_header_weather_styles() {
    wp_enqueue_style('seasons-header-weather', get_template_directory_uri() . '/css/header-weather.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'seasons_enqueue_header_weather_styles');
