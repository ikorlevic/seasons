<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 18:08
 */
?>
<?php get_sidebar() ?>
<footer>
	<div class="wrapper">
        <nav>
            <?php wp_nav_menu(array("theme_location"=>"footer"))?>
        </nav>
	</div>
    </footer>


<?php
wp_footer();
?>



<link href="https://fonts.googleapis.com/css?family=Cantarell" rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/src/style.min.css?v=<?php echo date("YmdHis") ?>"/>
<style> body{display:block;}</style>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/jquery.js"></script>
<script type="text/javascript">
    $(".toggle").click(function(e){
        var el = $(this).attr("rel");
        $(el).toggleClass("open");
    });

    $(".toggle-search").click(function(e){
        e.stopPropagation();
        e.preventDefault();

        var el = $(this).attr("rel");
        if(el == undefined) el = $(this).find("a").attr('rel');
        $('#'+el).toggleClass("open");
    });
</script>
<!-- Google Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-84575133-2', 'auto');
    ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-84575133-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-84575133-2');
</script>
<!--    <link rel="alternate" href="http://seasons-in-garden.com--><?php //echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); ?><!--" hreflang="en" />-->

<script src="https://apis.google.com/js/platform.js" async defer>
    {lang: 'en-GB'}
</script>
</body>
</html>