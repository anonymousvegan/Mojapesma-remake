<?php
    if(isset($id)!=true){
    $id =  $_POST["id"];
    }
    if(isset($_POST["limin"])){
        $limit=$_POST["limit"];
    }else{
        $limit=10;
    }
    require "backend/vezasabazom.php";
    $sql="SELECT komentari FROM pesme WHERE id=".$id;
    $rezultat = mysqli_query($conn, $sql);
    $brojrezulta=mysqli_num_rows($rezultat);
    $red=mysqli_fetch_assoc($rezultat);
    $komentari = $red["komentari"];
    $jsonkomentari = json_decode($komentari);
    $tip=gettype($jsonkomentari);
    if($tip=="object"){
      	$komentar = $jsonkomentari->komentar;
		$vremesifrovano = $jsonkomentari ->vreme;
		$autor = $jsonkomentari->idautora;
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
			}
			else{
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
			}
			else{
			$rec_m = " minuta ";
			}
			$vreme = "pre " . $sati . $rec_h . $minuta. $rec_m;
		}
		else if($pre_koliko<2592000){
		$dana = floor($pre_koliko/86400);
		if($dana==1 ||$dana==21 || $dana==31 ||$dana==41 ||$dana==51){
			$rec_d=" dan ";
		}
		else{
			$rec_d=" dana ";
		}
		$vreme = "pre ". $dana . $rec_d;
    }
    else{
      $vreme = date("d/m/Y H:i", $red["vreme"]);
    }
    require "backend/vezasabazom.php";
    $sql =  "SELECT * FROM korisnici WHERE id='". $autor ."';";
    $rezultat= mysqli_query($conn, $sql);
    $brojrezulta=mysqli_num_rows($rezultat);
    while ($red=mysqli_fetch_assoc($rezultat)){
      $tip= gettype($red["profilna"]);
            if($tip=="null" || $tip=="NULL" || $tip==null){
              $praviautor=$red["ime"];
              $profilna="fajlovi/profile-icon.svg";
            }
            else if($tip=="string"){
              $praviautor=$red["ime"];
              $profilna=$red["profilna"];
            }
          }
    echo '
    <div class="komentar">
        <a href="profil.php?profil='.$praviautor.'    " class="autorkomentara"><img class="komentariprofilna" src="'.$profilna.'"></a>
        <div class="grupa">
            <input type="hidden" name="idpesme"  value="    '.$id.'    ">
            <input type="hidden" name="broj"  value="    '.$i.'    ">
            <div class="autorivreme"><a href="profil.php?profil='.$praviautor.'    " class="autorkomentara">' .$praviautor .'</a>
            <div class="vremekomentara">' .$vreme .'</div></div>
            <div class="sadrzajkomentara">'. $komentar. '</div>
        </div>
    </div>';
    }
    else if($tip=="array"){
      $brojkomentara=count($jsonkomentari);
      for($i=0; $i<$brojkomentara; $i++){
        $objekat=$jsonkomentari[$i];
        $komentar =$objekat->komentar;
        $vremesifrovano = $objekat->vreme;
        $autor=$objekat->idautora;
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
          }
          else{
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
            }
            else{
              $rec_m = " minuta ";
            }
            $vreme = "pre " . $sati . $rec_h . $minuta. $rec_m;
          }
          else if($pre_koliko<2592000){
            $dana = floor($pre_koliko/86400);
            if($dana==1 ||$dana==21 || $dana==31 ||$dana==41 ||$dana==51){
              $rec_d=" dan ";
            }
            else{
              $rec_d=" dana ";
            }
            $vreme = "pre ". $dana . $rec_d;
          }
          else{
          $vreme = date("d/m/Y H:i", $red["vreme"]);
          }
          require "backend/vezasabazom.php";
          $sql =  "SELECT * FROM korisnici WHERE id='". $autor ."';";
          $rezultat= mysqli_query($conn, $sql);
          $brojrezulta=mysqli_num_rows($rezultat);
          while ($red=mysqli_fetch_assoc($rezultat)){
            $tip= gettype($red["profilna"]);
                  if($tip=="null" || $tip=="NULL" || $tip==null){
                    $profilna="fajlovi/profile-icon.svg";
                    $praviautor=$red["ime"];
                  }
                  else if($tip=="string"){
                    $praviautor=$red["ime"];
                    $profilna=$red["profilna"];
                  }
                }
      echo'
        <div class="komentar">
            <a href="profil.php?profil='.$praviautor.'    " class="autorkomentara"><img class="komentariprofilna" src="'.$profilna.'"></a>
            <div class="grupa">
                <input type="hidden" name="idpesme"  value="    '.$id.'    ">
                <input type="hidden" name="broj"  value="    '.$i.'    ">
                <div class="autorivreme"><a href="profil.php?profil='.$praviautor.'    " class="autorkomentara">' .$praviautor .'</a>
                <div class="vremekomentara">' .$vreme .'</div></div>
                <div class="sadrzajkomentara">'. $komentar. '</div>
            </div>
        </div>';
    }
  }
?>