<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 18:07
 */
?>
<!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="alternate" href="http://prood-os.com<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); ?>" hreflang="en" />
    <meta http-equiv="content-language" content="en">
    <meta name="msvalidate.01" content="6740AAFC7566B4907FF1CAB0449ACECF" />
<!--    <title>--><?php //echo wp_title()?><!--</title>-->
    <meta name="robots" content="index,follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-16x16.png" />
    <meta name="google-site-verification" content="JIcWSriz0gRfb6DKeST3AdyvJVH9HP8Bh9RrOoIiqoQ" />
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-6862177376862828",
            enable_page_level_ads: true
        });
    </script>
    <style> body{display:none;}</style>
    <?php wp_head();?>
</head>
<?php $season="spring";

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

if($date=="0214"){
    $season = "valentines";
}elseif($date=="1031"){
    $season = "halloween";
}elseif("1224"<= $date && $date <="1226"){
    $season = "yule";
}elseif("1231"== $date || $date =="0101"){
    $season = "ny";
}

?>
<body class="<?php echo $season?>">
<div class="wrapper">
    <header class="top">
        <div id="search-container" class="search-box-wrapper">
            <div class="search-box">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="toggle desktop-hide" rel=".mobile-menu">Menu</div>
        <div class="toggle-search mobile desktop-hide" rel="search-container"><svg class="svg-icon" width="40" height="40" viewBox="0 0 20 20"><path d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"></path></svg></div>

        <nav class="menu-left mobile-hide">
            <?php wp_nav_menu(array( 'theme_location' => 'header_left',"container_class"=>"navigation" ))?>
        </nav>
        <img alt="Seasons In Garden" onclick="window.location='<?php echo esc_url(home_url("/"))?>'" class="logo" src="<?php echo get_template_directory_uri()?>/images/logo/logo-<?php echo $season?>.png" alt="Seasons in the garden, works and all">
        <nav class="menu-right mobile-hide">
            <?php wp_nav_menu(array( 'theme_location' => 'header_right',"container_class"=>"navigation" ))?>
        </nav>
    </header>

    <nav class="mobile-menu desktop-hide">
        <div class="toggle" rel=".mobile-menu">X</div>
        <?php wp_nav_menu(array( 'theme_location' => 'header_mobile',"container_class"=>"navigation" ))?>
    </nav>

<div class="bigone">
    <?php $bigone = get_post_meta($post->ID,'_listing_image_id');
     if ($bigone[0]){
        echo '<img src="'.wp_get_attachment_url($bigone[0]).'" alt="'. get_post_meta($bigone[0] , '_wp_attachment_image_alt', true).'"/>';

            $title = get_the_title($post->ID);
            if(isset($_GET['s'])) $title = $_GET["s"];

          if(!is_page('cookie-policy') && !is_page('privacy-policy'))  echo "<div class='overlay'><h2 class='h1'>$title</h2>";

         if(is_home() || is_archive()){
             $link = get_the_permalink($post->ID);
             echo "<a class='button' href='$link'>Read</a>";
        }
        echo "</div>";
     }else{
     ?>
    <img src="<?php echo get_template_directory_uri()?>/images/big.jpg" alt="Seasons in Garden" title="Seasons in Garden"/>
    <?php
         if($post->ID){
             if(isset($_GET['s'])) $title = $_GET["s"];

             if(!is_page('cookie-policy') && !is_page('privacy-policy'))  echo "<div class='overlay'><h2 class='h1'>$title</h2>";

             if(is_home() || is_archive()){
                 $link = get_the_permalink($post->ID);
                 echo "<a class='button' href='$link'>Read</a>";
             }
             echo "</div>";
         }
     } ?>
</div>
<?php wp_reset_query(); ?>