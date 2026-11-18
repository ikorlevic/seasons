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
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/src/header.min.css?v=2" defer />

    <meta name="google-site-verification" content="JIcWSriz0gRfb6DKeST3AdyvJVH9HP8Bh9RrOoIiqoQ" />
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-6862177376862828",
            enable_page_level_ads: true
        });
    </script>

    <style> body article{ display:none; }</style>
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

        <nav class="menu-left mobile-hide">
            <ul>
                <li><a href="https://www.facebook.com/seasonsingarden/" target="_blank"><svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-prefix="fab" data-icon="facebook-square" class="svg-inline--fa fa-facebook-square fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M448 80v352c0 26.5-21.5 48-48 48h-85.3V302.8h60.6l8.7-67.6h-69.3V192c0-19.6 5.4-32.9 33.5-32.9H384V98.7c-6.2-.8-27.4-2.7-52.2-2.7-51.6 0-87 31.5-87 89.4v49.9H184v67.6h60.9V480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48z"/></svg></a></li>
                <li><a href="https://instagram.com/seasonsingarden/" target="_blank"><svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a></li>
                <li><a href="https://www.pinterest.com/seasonsingarden0762/" target="_blank"><svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-prefix="fab" data-icon="pinterest-square" class="svg-inline--fa fa-pinterest-square fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M448 80v352c0 26.5-21.5 48-48 48H154.4c9.8-16.4 22.4-40 27.4-59.3 3-11.5 15.3-58.4 15.3-58.4 8 15.3 31.4 28.2 56.3 28.2 74.1 0 127.4-68.1 127.4-152.7 0-81.1-66.2-141.8-151.4-141.8-106 0-162.2 71.1-162.2 148.6 0 36 19.2 80.8 49.8 95.1 4.7 2.2 7.1 1.2 8.2-3.3.8-3.4 5-20.1 6.8-27.8.6-2.5.3-4.6-1.7-7-10.1-12.3-18.3-34.9-18.3-56 0-54.2 41-106.6 110.9-106.6 60.3 0 102.6 41.1 102.6 99.9 0 66.4-33.5 112.4-77.2 112.4-24.1 0-42.1-19.9-36.4-44.4 6.9-29.2 20.3-60.7 20.3-81.8 0-53-75.5-45.7-75.5 25 0 21.7 7.3 36.5 7.3 36.5-31.4 132.8-36.1 134.5-29.6 192.6l2.2.8H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48z"/></svg></a></li>
            </ul>
        </nav>
        <div class="toggle socials" rel=".menu-left"><svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-prefix="fas" data-icon="share-square" class="svg-inline--fa fa-share-square fa-w-18" role="img" viewBox="0 0 576 512"><path fill="currentColor" d="M568.482 177.448L424.479 313.433C409.3 327.768 384 317.14 384 295.985v-71.963c-144.575.97-205.566 35.113-164.775 171.353 4.483 14.973-12.846 26.567-25.006 17.33C155.252 383.105 120 326.488 120 269.339c0-143.937 117.599-172.5 264-173.312V24.012c0-21.174 25.317-31.768 40.479-17.448l144.003 135.988c10.02 9.463 10.028 25.425 0 34.896zM384 379.128V448H64V128h50.916a11.99 11.99 0 0 0 8.648-3.693c14.953-15.568 32.237-27.89 51.014-37.676C185.708 80.83 181.584 64 169.033 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48v-88.806c0-8.288-8.197-14.066-16.011-11.302a71.83 71.83 0 0 1-34.189 3.377c-7.27-1.046-13.8 4.514-13.8 11.859z"/></svg></div>

        <img alt="Seasons In Garden" onclick="window.location='<?php echo esc_url(home_url("/"))?>'" class="logo" src="<?php echo get_template_directory_uri()?>/images/logo/logo-<?php echo $season?>.png" alt="Seasons in the garden, works and all">

        <div class="toggle right" rel="#search-container">
            <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
        </div>
        <div class="toggle right" rel=".menu-right">
            <span class="mobile-hide">Menu</span>
            <svg width="15" height="40" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-prefix="fas" data-icon="ellipsis-v" class="svg-inline--fa fa-ellipsis-v fa-w-6" role="img" viewBox="0 0 192 512"><path fill="currentColor" d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z"/></svg>
        </div>
        <nav class="menu-right">
            <?php wp_nav_menu(array( 'theme_location' => 'header_right',"container_class"=>"navigation" ))?>
        </nav>
    </header>

    <nav class="menu-top">
        <?php wp_nav_menu(array( 'theme_location' => 'header_top',"container_class"=>"navigation" ))?>
    </nav>

<?php wp_reset_query(); ?>