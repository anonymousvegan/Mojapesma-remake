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
	$id= $_SESSION["id"];
	$ovlascenje=$_SESSION["ovlascenje"];	
	($_SESSION["godine"]>=18)? $ispis="sve" : $ispis="filter";
}else{
	$ovlascenje="neprijavljen";
	echo "nije podešena sesija <br>";
	echo $ovlascenje;
}
if($profil=="index_stranica_prikazi_sve"){
	if ($ovlascenje=="admin"){
		$sql= "SELECT * FROM pesme  ORDER BY vreme DESC LIMIT ". $broj.";";
	}
	else if($ovlascenje=="obican"){
		if($ispis=="sve"){
			$sql= "SELECT * FROM pesme WHERE publika='javno' OR publika='korisnici' OR id_pisca=".$id."  ORDER BY vreme  DESC LIMIT  ". $broj.";";
		}
		else if($ispis=="filter"){
			$sql= "SELECT * FROM pesme  WHERE id_pisca=" .$id." OR  ( pogodna='jeste' and (publika='javno' OR publika='korisnici')) ORDER BY vreme DESC LIMIT  ". $broj.";";
		}
	}
	else if($ovlascenje="neprijavljen"){
		$sql ="SELECT *  FROM pesme WHERE pogodna='jeste' and publika='javno' ORDER BY vreme DESC LIMIT  ". $broj.";";
	}
}
echo $sql;
require "ispis.php";
?>