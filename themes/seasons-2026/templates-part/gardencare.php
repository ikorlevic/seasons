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
<div class="gardencare" >
<?php get_sidebar("jobs-".$season);   ?>
</div>