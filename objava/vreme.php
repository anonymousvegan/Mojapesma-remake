<?php
date_default_timezone_set("Europe/Belgrade");
$trenutnovreme = date("U");
$pre_koliko =$trenutnovreme - $vremesifrovano;
if($pre_koliko<60){
  if ($pre_koliko==1 || $pre_koliko==21 ||$pre_koliko==31 ||$pre_koliko==41 || $pre_koliko==51){
    $rec_s= " sekund ";
  }
  else if ($pre_koliko==2 || $pre_koliko==3 ||$pre_koliko==4 || $pre_koliko==22 || $pre_koliko==23 ||$pre_koliko==24 || $pre_koliko==32 || $pre_koliko==33 ||$pre_koliko==34 || $pre_koliko==42 || $pre_koliko==43 ||$pre_koliko==44|| $pre_koliko==52 || $pre_koliko==53 ||$pre_koliko==54){
    $rec_s = " sekudne ";
  }
  else{
    $rec_s = " sekundi ";
  }
  $vreme = "pre ". $pre_koliko . $rec_s;
}
else if($pre_koliko<3600){
  $minuta = floor($pre_koliko / 60);
  if($minuta==1 || $minuta == 21 || $minuta==31 || $minuta==41 || $minuta==51){
    $rec_m=" minut ";
  }else{
    $rec_m = " minuta ";
  }
  $sekundi = $pre_koliko % 60;
  if ($sekundi==1 || $sekundi==21 ||$sekundi==31 ||$sekundi==41 || $sekundi==51){
    $rec_s= " sekund ";
  }
  else if ($sekundi==2 || $sekundi==3 ||$sekundi==4 || $sekundi==22 || $sekundi==23 ||$sekundi==24 || $sekundi==32 || $sekundi==33 ||$sekundi==34 || $sekundi==42 || $sekundi==43 ||$sekundi==44|| $sekundi==52 || $sekundi==53 ||$sekundi==54){
    $rec_s = " sekudne ";
  }
  else{
    $rec_s = " sekundi ";
  }
  $vreme = "pre " . $minuta . $rec_m . $sekundi . $rec_s;
}
else if($pre_koliko<86400){
  $sati=floor($pre_koliko/3600);
  if($sati==1 || $sati==21 || $sati==31 || $sati==41 || $sati==51){
    $rec_h=" sat ";
  }
  else if($sati ==2 || $sati ==3 || $sati ==4 || $sati ==22 || $sati ==23 || $sati ==24 || $sati ==32 || $sati ==33 || $sati ==34 || $sati ==42 || $sati ==43 || $sati ==44 || $sati ==52 || $sati ==53 || $sati ==54){
    $rec_h=" sata ";
  }
  else{
    $rec_h=" sati ";
  }
  $minuta= floor(($pre_koliko%3600)/60);
  if($minuta==1 || $minuta == 21 || $minuta==31 || $minuta==41 || $minuta==51){
    $rec_m=" minut ";
  }else{
    $rec_m = " minuta ";
  }
  $vreme = "pre " . $sati . $rec_h . $minuta. $rec_m;
}
else if($pre_koliko<2592000){
  $dana = floor($pre_koliko/86400);
  if($dana==1 ||$dana==21 || $dana==31 ||$dana==41 ||$dana==51){
    $rec_d=" dan ";
  }else{
    $rec_d=" dana ";
  }
  $vreme = "pre ". $dana . $rec_d;
}
else{
  $vreme = date("d/m/Y H:i", $vremesifrovano);
}
?>