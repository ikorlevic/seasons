<?php
namespace util;

// use util\Seasons;

class SeasonsIndicator {

function getCurrentSeason() {
  $season="spring";

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

  if($date >= "0102" && $date <= "0214"){
      $season = "valentines";
  }elseif($date >= "1510" && $date <= "3110"){
      $season = "halloween";
  }elseif("1224" <= $date && $date <="1226"){
      $season = "yule";
  }elseif("1229"  <= $date && $date <= "0105"){
      $season = "ny";
  }
return $season;
}
}