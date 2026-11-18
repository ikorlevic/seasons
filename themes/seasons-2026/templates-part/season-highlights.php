<div class="highlights text-center">
    <h1>What's happening now</h1>
    <div  class="grid" >
    <?php
      $actualSeason = current_season();
      $season = $actualSeason;

      if(is_home()) {
          $season = $actualSeason;
      } else {
            $obj = get_queried_object();
            $season = get_selected_season($obj);
      }
    $high = season_high($season);
    foreach($high as $h) {
    ?>
    <div class="set d-flex flex-column text-center align-center">
    <div class="icon fill"><span class="material-symbols-outlined"><?php echo $h["icon"]?></span></div>
    <h4>
    <?php echo $h["title"] ?>
    </h3>
    <div>
    <?php echo $h["description"] ?>
    </div>
    </div>
<?php } ?>
</div>
</div>