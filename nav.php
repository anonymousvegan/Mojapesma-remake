<header>
  <div class="logo">
  <a class="pocetnalink" href="index.php">
    <img class="logo-slika" src="fajlovi/logo.png" alt="logo">
    </a>   
    <a href="index.php" class="pocetnalink">
      <h1 class="logo-naziv">Moja pesma</h1>
    </a>
        </div>
      <input type="checkbox" id="nav-toggle" class="nav-toggle">
      <nav>
        <ul>
          <li>
            <a href="index.php">Početna</a></li>
          <li <?php if(isset($_SESSION["id"])){
                      echo 'onclick="dodaj()"';
                    }
                    else{
                      echo 'onclick="dodajneulogovan()"';
                    }
          ?>><a href="#">Dodaj tekst</a></li>
          <li>
            <div class="kategorije-container">
              <a href="#">Kategorije</a>        
              <div class="kategorije-dropdown">
                <ul>
                  <li onclick="promenikategoriju('sve')"><a class="kda" href="#">Sve</a></li>
                  <li onclick="promenikategoriju('ljubavne')"><a class="kda" href="#">Ljubavne</a></li>
                  <li onclick="promenikategoriju('decije')"><a class="kda" href="#">Dečije<a/></li>
                  <li onclick="promenikategoriju('porodicne')"><a class="kda" href="#">Porodične<a/></li>
                  <li onclick="promenikategoriju('zivotinje-i-priroda')"><a class="kda" href="#">Životinje/priroda</a></li>
                  <li onclick="promenikategoriju('rodoljubive-i-religijske')"><a class="kda" href="#">Rodoljubive/religijske</a></li>
                  <li onclick="promenikategoriju('ostale')"><a class="kda" href="#">Ostalo</a></li>
                </ul>
              </div>
            </div>
          </li>
        </ul>  
      </nav>
      <div class="profile-container">
        <input type="checkbox" id="arrow-toggle" class="arrow-toggle">
        <label for="arrow-toggle" class="arrow-toggle-label">    
        <div  class="profile-icon">
          <img src="fajlovi/<?php
          if(isset($_SESSION["id"])){
              require "backend/vezasabazom.php";
              $sql = "SELECT * FROM korisnici WHERE id=".$_SESSION["id"];
              $rezultat= mysqli_query($conn, $sql);
              $brojrezulta=mysqli_num_rows($rezultat);
              while($red=mysqli_fetch_assoc($rezultat)){
                $tip= gettype($red["profilna"]);
                if($tip=="null" || $tip=="NULL" || $tip==null){
                  echo "profile-icon.svg";
                }
                else if($tip=="string"){
                  echo  $red["profilna"];
                }
              }}
              else{
                  echo "profile-icon.svg";
              }
          ?>
            " alt="profile-icon">
            </div>
            <img class="arrow" src="./fajlovi/arrow.svg" alt="arrow"> 
        </label>
      <div class="dropdown-container">
        <ul>
          <?php
          if(isset($_SESSION["id"])){
            echo '<li>
                    <a href="uredi-profil.php">UREDI PROFIL</a>
                  </li>
                  <li>
                    <a href="profil.php?profil='.$_SESSION["ime"].'">TVOJE PESME</a>
                  </li>
                    <li>
                      <a onclick="izloguj_se()" href="backend/izloguj-se.php" class="dropdownlink">ODJAVI SE</a>
                    <li>
                  ';}
          else{
            echo '<li>
                    <a href="forme/prijava.php">PRIJAVI SE</a>
                  </li>
                  <li>
                    <a href="forme/registracija.php">REGISTRUJ SE</a>
                  </li>';
              }
          ?>
        </ul>
      </div>
    </div>
    <label for="nav-toggle" class="nav-toggle-label">
      <span></span>
    </label>
</header>