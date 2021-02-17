<?php
    if(!isset($id)){
    	$id =  $_POST["id"];
    }
    require "backend/vezasabazom.php";
	date_default_timezone_set("Europe/Belgrade");
    $sql="SELECT komentari FROM pesme WHERE id=".$id;
    $rezultat = mysqli_query($conn, $sql);
    $brojrezulta=mysqli_num_rows($rezultat);
    $red=mysqli_fetch_assoc($rezultat);
	$komentari=$red["komntari"];
	if($komentari!="[]" or gettype($komentari)!="NULL"){
		$jsonkomentari=json_decode($komentari);
		foreach ($jsonkomentari as $objekat){
        $komentar =$objekat->komentar;
        $vremesifrovano = $objekat->vreme;
        $autor=$objekat->idautora;
		require "objave/vreme";
		require "backend/vezasabazom.php";
		$sql =  "SELECT * FROM korisnici WHERE id='". $autor ."';";
		$rezultat= mysqli_query($conn, $sql);
		$red=mysqli_fetch_assoc($rezultat);
		$tip= gettype($red["profilna"]);
		if($tip=="NULL"){
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
?>