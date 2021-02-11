<?php
$rezultat= mysqli_query($conn, $sql);
$brojrezulta=mysqli_num_rows($rezultat);
while($red=mysqli_fetch_assoc($rezultat)){
require "vreme.php";
    $sql =  "SELECT * FROM korisnici WHERE ime='". $red["pisac"] ."';";
    $rezultatprofilna= mysqli_query($conn, $sql);
    $brojrezulta=mysqli_num_rows($rezultatprofilna);
    while ($redprofilna = mysqli_fetch_assoc($rezultatprofilna)){
            $tip=gettype($redprofilna["profilna"]);
            if($tip=="null" || $tip=="NULL" || $tip==null){
              $profilna="fajlovi/profile-icon.svg";
            }
            else if ($tip == "string") {
              $profilna = $redprofilna["profilna"];
            }
          }
echo '<div class="card text-center kartica '.$red["boja"].'" id="'.$red["id"].'">';
echo    '<div class="card-header pisac">';
echo        '<div class="profilna-pisca">
                <a href="profil.php?profil='.$red["pisac"].'">
                  	<img src="'.$profilna.'">
                </a>
            </div>';
echo        '<a class="link-prema-piscu" href="profil.php?profil='.$red["pisac"].'">'. $red["pisac"] . '</a>';
echo        '<div class="tacke" onclick="prikaziOpcije(this)">
                <img src="fajlovi/tacke.png">
                <div class="opcije">';

                if($_SESSION["ovlascenje"]=="admin" || $_SESSION["ime"]==$red["pisac"] ){
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
if($ovlascenje=="nelogovan"){
  echo '<div onclick="lajkujnelogovan()"  class="srce">
          <img src="fajlovi/srce-prazno.svg">
            <span id="' .$red["id"] . 'brojlajkova">' . $red["lajkova"] .'</span>
        </div>
        <div class="vreme-tekst">' . $vreme . '</div>
        <div onclick="prikazikomentare('.$red["id"].')" class="ikonicazakomentarkontejner">
          <img class="ikonicazakomentar" src="fajlovi/komentar.svg" /> </div>';
}
else{
  $lajkovao=$red["lajkovao"];
  $niz=json_decode($lajkovao);
  if(in_array($_SESSION["ime"], $niz)){
    echo '<div onclick="lajkuj('.$red["id"].","."'".$_SESSION["ime"]."')".'"'. ' class="srce">
            <img src="fajlovi/srce-puno.png">
            <span id="' .$red["id"] . 'brojlajkova">' . $red["lajkova"] .'</span>
          </div>
          <div class="vreme-tekst">' . $vreme . '</div>
          <div onclick="prikazikomentare('.$red["id"].')" class="ikonicazakomentarkontejner">
          <img class="ikonicazakomentar" src="fajlovi/komentar.svg" /> </div>';
  }
  else{
    echo '<div onclick="lajkuj('.$red["id"].","."'".$_SESSION["ime"]."')".'"'. ' class="srce">
            <img src="fajlovi/srce-prazno.svg">
            <span id="' .$red["id"] . 'brojlajkova">' . $red["lajkova"] .'</span>
          </div>
          <div class="vreme-tekst">' . $vreme .'</div>
          <div onclick="prikazikomentare('.$red["id"].')" class="ikonicazakomentarkontejner">
            <img class="ikonicazakomentar" src="fajlovi/komentar.svg" />
          </div>';
  }
}
echo '</div></div>';
}