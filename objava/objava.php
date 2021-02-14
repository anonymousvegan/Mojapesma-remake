<?php
if(!isset($_SESSION["id"])){
	session_start();
}
if(!isset($conn)){
	require "../backend/vezasabazom.php";
}
(isset($_POST["broj"])) ? $broj=$_POST["broj"] : $broj= 10;
(isset($_POST["profil"])) ? $profil=$_POST["profil"] : $profil= "index_stranica_prikazi_sve";
if(isset($_SESSION["id"])){
	$ovlascenje=$_SESSION["ovlascenje"];
	($_SESSION["godine"])
}
if($profil=="index_stranica_prikazi_sve"){
  if ($ovlascenje=="admin"){
    $sql= "SELECT * FROM pesme  ORDER BY vreme DESC LIMIT ". $broj.";";
  }
  else{
    if($ispis=="sve"){
     	$sql= "SELECT * FROM pesme  ORDER BY vreme DESC LIMIT  ". $broj.";";
    }
    else if($ispis=="filter"){
        $sql= "SELECT * FROM pesme  WHERE pogodna='jeste' ORDER BY vreme DESC LIMIT  ". $broj.";";
    }
}}
echo $sql;
require "ispis.php";
?>