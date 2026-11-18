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
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/src/header.min.css?v=4" defer/>

    <meta name="google-site-verification" content="JIcWSriz0gRfb6DKeST3AdyvJVH9HP8Bh9RrOoIiqoQ" />
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-6862177376862828",
            enable_page_level_ads: true
        });
    </script>
    <style>
        html, body{ padding:0; margin: 0; font-family: Arial, Helvetica, sans-serif; }
        body article{ display:none; }</style>
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
        <div id="search-container" class="search-box-wrapper" style="display: none;">
            <div class="search-box">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="header-main">
        <div class="toggle left" rel=".menu-right">
            <svg width="34" height="18" viewBox="0 0 34 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="1" y1="16.0707" x2="32.0396" y2="16.0707" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <line x1="1" y1="1.07074" x2="32.0396" y2="1.07074" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <img alt="Seasons In Garden" onclick="window.location='<?php echo esc_url(home_url("/"))?>'" class="logo" src="<?php echo get_template_directory_uri()?>/images/logo/logo-<?php echo $season?>.svg" alt="Seasons in the garden, works and all">

        <div class="toggle right" rel="#search-container">
            <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M31.0367 15.9441C31.0367 24.1568 24.503 30.7835 16.4812 30.7835C8.45936 30.7835 1.92566 24.1568 1.92566 15.9441C1.92566 7.73129 8.45936 1.10455 16.4812 1.10455C24.503 1.10455 31.0367 7.73129 31.0367 15.9441Z" stroke="black" stroke-width="2"/>
                <line y1="-1" x2="22.4194" y2="-1" transform="matrix(0.657323 0.753609 -0.751542 0.659685 26.1888 25.4478)" stroke="black" stroke-width="2"/>
            </svg>
        </div>
        </div>
        <nav class="menu-right">
            <?php wp_nav_menu(array( 'theme_location' => 'header_right',"container_class"=>"navigation" ))?>
        </nav>
    </header>

    <nav class="menu-top">
        <?php wp_nav_menu(array( 'theme_location' => 'header_top',"container_class"=>"navigation" ))?>
    </nav>

<?php wp_reset_query(); ?>