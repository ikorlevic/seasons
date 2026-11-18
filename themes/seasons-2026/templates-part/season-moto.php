<?php
 ini_set("display_errors",1);
  $actualSeason = current_season();
  $season = $actualSeason;

  if(is_home()) {
      $season = $actualSeason;
  } else {
        $obj = get_queried_object();
        $season = get_selected_season($obj);
  }
?>
<div class="moto text-center d-flex jcc align-center flex-column <?php echo $season ?>" >
    <h1 class="bolder title"><?php echo $season ?></h1>
    <h2 class="title italic"><?php echo season_moto($season) ?></h3>
    <p><?php echo season_desc($season) ?>
    </p>
<div>
        <div class="pill toggle" rel="#menu-seasons-menu">
            <?php echo $season ?>
       </div>
       <?php wp_nav_menu(array( 'theme_location' => 'seasons',"container_class"=>"pill-menu" ))?>
    </div>


</div>