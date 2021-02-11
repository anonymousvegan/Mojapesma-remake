<?php
if(isset($_POST["kategorija"])){
  $kategorija= $_POST["kategorija"];
}
else{
  $kategorija="sve";
}
if($kategorija=="sve"){
  $deosqlazaktegoriju=" ";
  $deosqlazaktegorijusaand=" ";
}
else{
  $deosqlazaktegoriju= " where kategorija='". $kategorija. "'";
  $deosqlazaktegorijusaand=" AND kategorija='". $kategorija. "'";
}
if($profil=="index_stranica_prikazi_sve"){
  if ($ovlascenje=="admin"){
    $sql= "SELECT * FROM pesme " .$deosqlazaktegoriju. " ORDER BY vreme DESC LIMIT 5;";
  }
  else{
    if($ispis=="sve"){
      $sql= "SELECT * FROM pesme " .$deosqlazaktegoriju. " ORDER BY vreme DESC LIMIT 5;";
    }
    else if($ispis=="filter"){
      $sql= "SELECT * FROM pesme  WHERE pogodna='jeste' " .$deosqlazaktegoriju. " ORDER BY vreme DESC LIMIT 5; ";
    }
}}
else if($profil=="pretraga_stranica_prikazi_rezultate"){
  if ($ovlascenje=="admin"){
    $sql= "SELECT * FROM pesme WHERE  (pesma like '%".$pretraga . "%' OR naslov like '%".$pretraga . "%') " .$deosqlazaktegoriju. " ORDER BY vreme DESC LIMIT 5;";
  }else{
    if($ispis=="sve"){
      $sql= "SELECT * FROM pesme WHERE  (pesma like '%".$pretraga . "%' OR naslov like '%".$pretraga . "%')" .$deosqlazaktegoriju. " ORDER BY vreme DESC LIMIT 5;";
    }
    else if($ispis=="filter"){
      $sql= "SELECT * FROM pesme WHERE (pesma like '%".$pretraga . "%' OR naslov like '%".$pretraga . "%') AND pogodna='jeste' " .$deosqlazaktegoriju. " ORDER BY vreme DESC LIMIT 5;";
    }
  }
}
else{
  if ($ovlascenje=="admin"){
    $sql= "SELECT * FROM pesme WHERE pisac='".$profil . "' " .$deosqlazaktegoriju. " ORDER BY vreme DESC LIMIT 5;";
  }
  else{
    if($ispis=="sve"){
    $sql= "SELECT * FROM pesme WHERE pisac='". $profil . "' " .$deosqlazaktegoriju. " ORDER BY vreme DESC LIMIT 5;";
    }
    else if($ispis=="filter"){
      $sql= "SELECT * FROM pesme WHERE pogodna='jeste' AND pisac='". $profil . "' " .$deosqlazaktegoriju. "ORDER BY vreme DESC LIMIT 5;";
    } 
}}
require "ispis.php";
?>