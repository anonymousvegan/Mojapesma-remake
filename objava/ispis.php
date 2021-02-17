<?php
$rezultat= mysqli_query($conn, $sql);
$brojrezulta=mysqli_num_rows($rezultat);
while($red=mysqli_fetch_assoc($rezultat)){
	$lajkovao= $red["lajkovao"];
	$tip_lajkovao= gettype($lajkovao);
	if($tip_lajkovao=="NULL"){
		$broj_lajkova=0;
	}
	else{
		$niz_lajkova=json_decode($lajkovao);
		$broj_lajkova=count($niz_lajkova);
	}
	require "vreme.php";
	$sql_za_pisca =  "SELECT * FROM korisnici WHERE id='". $red["id_pisca"] ."';";
	$rezultati_za_pisca= mysqli_query($conn, $sql_za_pisca);
	while ($red_za_pisca = mysqli_fetch_assoc($rezultati_za_pisca)){
		$korisnicko_ime_pisca= $red_za_pisca["username"];
		$profilna_pisca=$red_za_pisca["profilna"];
		$tip=gettype($profilna_pisca);
		if($tip=="null" || $tip=="NULL" || $tip==null){
			$profilna="fajlovi/profile-icon.svg";
		}
		else if ($tip == "string") {
			$profilna_pisca = "fajlovi/". $profilna_pisca;
		}
	}
echo '<div class="card text-center kartica '.$red["boja"].'" id="'.$red["id"].'">';
echo    '<div class="card-header pisac">';
echo        '<div class="profilna-pisca">
                <a href="proflili/'.$korisnicko_ime_pisca.'">
                  	<img src="'.$profilna_pisca.'">
                </a>
            </div>';
echo        '<a class="link-prema-piscu" href="proflili/'.$korisnicko_ime_pisca.'">'. $korisnicko_ime_pisca . '</a>';
echo        '<div class="tacke" onclick="prikaziOpcije(this)">
                <img src="fajlovi/tacke.png">
                <div class="opcije">';
                if($_SESSION["ovlascenje"]=="admin" || $_SESSION["id"]==$red["id_pisca"]){
                echo'<a onclick="obrisi('.$red["id"].')" class="opcija btn btn-danger">Obriši</a>';
                }
                echo '
                 <a onclick="prijavi('.$red["id"].')" class="opcija btn btn-warning">Prijavi</a>
                </div>
              </div>';
echo   '</div> 
<div class="card-body telo-kartice">';
echo '<div class="sadrzaj">';
echo '<h5 class="card-title naslov">'.$red["naslov"].'</h5>';
echo '<p class="card-text pesma">' .$red["pesma"].'</p></div>';
echo '<div class="komentari">neki-komentar</div>';
echo '<button onclick="prikazivise('.$red["id"].')" class="btn btn-primary prikazi-vise">Procitaj vise</a>';
echo '</div>
<div class="card-footer text-muted vreme">';
if($ovlascenje=="neprijavljen"){
  echo '<div onclick="lajkujnelogovan()"  class="srce">
          <img src="fajlovi/srce-prazno.svg">
            <span id="' .$red["id"] . 'brojlajkova">' . $broj_lajkova .'</span>
        </div>
        <div class="vreme-tekst">' . $vreme . '</div>
        <div onclick="prikazikomentare('.$red["id"].')" class="ikonicazakomentarkontejner">
          <img class="ikonicazakomentar" src="fajlovi/komentar.svg" /> </div>';
}
else{
  if($broj_lajkova>0 and in_array($_SESSION["id"], $niz_lajkova)){
    echo '<div onclick="lajkuj('.$red["id"].","."'".$_SESSION["id"]."')".'"'. ' class="srce">
            <img src="fajlovi/srce-puno.png">
            <span id="' .$red["id"] . 'brojlajkova">' . $broj_lajkova .'</span>
          </div>
          <div class="vreme-tekst">' . $vreme . '</div>
          <div onclick="prikazikomentare('.$red["id"].')" class="ikonicazakomentarkontejner">
          <img class="ikonicazakomentar" src="fajlovi/komentar.svg" /> </div>';
  }
  else{
    echo '<div onclick="lajkuj('.$red["id"].","."'".$_SESSION["id"]."')".'"'. ' class="srce">
            <img src="fajlovi/srce-prazno.svg">
            <span id="' .$red["id"] . 'brojlajkova">' . $broj_lajkova .'</span>
          </div>
          <div class="vreme-tekst">' . $vreme .'</div>
          <div onclick="prikazikomentare('.$red["id"].')" class="ikonicazakomentarkontejner">
            <img class="ikonicazakomentar" src="fajlovi/komentar.svg" />
          </div>';
    	}
	}
echo '</div></div>';
}