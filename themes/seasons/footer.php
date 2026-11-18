<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 18:08
 */
?>
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
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-84575133-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>