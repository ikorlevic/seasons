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
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />

    <link href='https://fonts.googleapis.com/css?family=Bad+Script|Raleway:400,200,300,500' rel='stylesheet' type='text/css'>

<!--    <link rel="alternate" href="http://seasons-in-garden.com--><?php //echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); ?><!--" hreflang="en" />-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/style.css"/>
    <script src="https://apis.google.com/js/platform.js" async defer>
        {lang: 'en-GB'}
    </script>
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

?>
<body class="<?php echo $season?>">
<div class="wrapper">
    <header>
        <div class="logo">
            <?php if(is_home()): ?>
            <h1>
                <img src="<?php echo get_template_directory_uri()?>/images/logo/seasons-in-garden-<?php echo $season?>.png" alt="Seasons in the garden, works and all">
                <span><?php wp_title();?></span>
            </h1>
                <?php else: ?>
                <h1>
                    <a href="<?php echo esc_url(home_url("/"))?>">
                        <img src="<?php echo get_template_directory_uri()?>/images/logo/seasons-in-garden-<?php echo $season?>.png" alt="Seasons in the garden, works and all">
                        <span>Seasons in garden</span>
                    </a>
                </h1>
            <?php endif; ?>
        </div>
        <nav>
            <?php wp_nav_menu(array( 'theme_location' => 'header',"container_class"=>"navigation" ))?>
        </nav>
    </header>
