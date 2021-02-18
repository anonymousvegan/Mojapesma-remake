<?php
session_start();
if(isset($_SESSION["id"])){ 
    require "vezasabazom.php";
    date_default_timezone_set("Europe/Belgrade");
    $id = $_POST["pesma"];
    $autor= $_POST["autor"];
    $komentar = $_POST["komentar"];
    $id_autora= $_SESSION["id"];
    $vreme=date("U");
    if($autor==$id_autora&& !empty($komentar)){
        $sql = "SELECT komentari FROM pesme WHERE id=". $id;
        $rezultat= mysqli_query($conn, $sql);
        $red=mysqli_fetch_assoc($rezultat);
        $komentari_u_bazi=$red["komentari"];
        $novi = new stdClass();
        $novi->idautora=$id_autora;
        $novi->komentar=$komentar;
        $novi->vreme=$vreme;
        $tip=gettype($komentari_u_bazi);
        if($tip=="NULL"){
            $niz=array($novi);
            ubaci_u_bazu($niz);
        }
        else{
            $stari=json_decode($komentari_u_bazi);
            array_push($stari, $novi);
            ubaci_u_bazu($stari);
        }
    }
}
else{
    echo "ulogujte se, greška u komentarisanju 4";
}
function ubaci_u_bazu($unos){
    global $conn, $niz, $id;
    $jsonunos=json_encode($unos);
    $sql = "UPDATE pesme set komentari=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn); 
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "greška u komentarisanju 3";
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, "ss", $jsonunos, $id);
        mysqli_stmt_execute($stmt);
        require "../ispiskomentara.php";
    }
}
?>