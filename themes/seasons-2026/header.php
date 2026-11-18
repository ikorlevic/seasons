<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 18:07
 */

// use util\SeasonsIndicator;
//   include get_template_directory().'/util/SeasonsIndicator.php';
//   $seasonsIndicator = new SeasonsIndicator();
//   $actualSeason = $seasonsIndicator->getCurrentSeason();

  $actualSeason = current_season();
  $season = $actualSeason;

  if(is_home()) {
      $season = $actualSeason;
  } else {
        $obj = get_queried_object();
        $season = get_selected_season($obj);
  }

//     print_r($season);
  $isCurrentSeason = $season === $actualSeason;
?>
<!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="content-language" content="en">
    <meta name="msvalidate.01" content="6740AAFC7566B4907FF1CAB0449ACECF" />
<!--    <title>--><?php //echo wp_title()?><!--</title>-->
    <meta name="robots" content="index,follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-16x16.png" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" defer/>

    <meta name="google-site-verification" content="JIcWSriz0gRfb6DKeST3AdyvJVH9HP8Bh9RrOoIiqoQ" />
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-6862177376862828",
            enable_page_level_ads: true
        });
    </script>
    <style>html, body { padding:0; margin:0; font-family:Arial, Helvetica, sans-serif; }</style>
    <?php wp_head();?>
</head>
<?php

?>
<body class="<?php echo $season?>">
<div class="wrapper">
    <header class="top bg-<?php echo $season?>" >
        <div id="search-container" class="search-box-wrapper" style="display: none;">
            <div class="search-box">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="header-main d-flex jcse mx-20 align-center">
            <?php if (!is_home()){ ?>
        <div class="toggle left">
            <button onclick="window.location='<?php echo esc_url(home_url("/"))?>'" />
        </div>
        <?php } ?>
        <!-- img alt="Seasons In Garden" onclick="window.location='<?php echo esc_url(home_url("/"))?>'" class="logo" src="<?php echo get_template_directory_uri()?>/images/logo/logo-<?php echo $season?>.svg" alt="Seasons in the garden, works and all" -->
        <h2 onclick="window.location='<?php echo esc_url(home_url("/"))?>'">Seasons in Garden</h2>

        <nav class="menu-top " >
            <?php wp_nav_menu(array( 'theme_location' => 'header_top',"container_class"=>"navigation" ))?>
        </nav>

        <?php if (function_exists('pdsweather_display')) : ?>
            <div class="seasons-header-weather d-inline-flex align-center jcc" aria-label="<?php esc_attr_e('Current weather', 'seasons'); ?>">
                <?php echo pdsweather_display(); ?>
            </div>
        <?php endif; ?>

        <div class="toggle right" rel="#search-container">
            <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M31.0367 15.9441C31.0367 24.1568 24.503 30.7835 16.4812 30.7835C8.45936 30.7835 1.92566 24.1568 1.92566 15.9441C1.92566 7.73129 8.45936 1.10455 16.4812 1.10455C24.503 1.10455 31.0367 7.73129 31.0367 15.9441Z" stroke="black" stroke-width="2"/>
                <line y1="-1" x2="22.4194" y2="-1" transform="matrix(0.657323 0.753609 -0.751542 0.659685 26.1888 25.4478)" stroke="black" stroke-width="2"/>
            </svg>
        </div>
        </div>
    </header>
                <?php get_template_part('templates-part/season-moto', get_post_format()); ?>
<?php wp_reset_query(); ?>