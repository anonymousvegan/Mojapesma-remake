<?php
session_start();
if(isset($_SESSION["id"])){
    require "vezasabazom.php";
    $id_pesme = $_POST["id"];
    $id_korisnika= $_POST["profil"];
    if($id_korisnika==$_SESSION["id"]){
        $sql = "SELECT lajkovao FROM pesme WHERE id=". $id_pesme;
        $rezultat= mysqli_query($conn, $sql);
        $red=mysqli_fetch_assoc($rezultat);
        $lajkovao=$red["lajkovao"];
        if(gettype($lajkovao)=="NULL" or $lajkovao==="[]"){
            $niz = array($_SESSION["id"]);
            ubaci_u_bazu();
            vrati();
        }
        else{
            $niz=json_decode($lajkovao,true);
            if(in_array($_SESSION["id"], $niz)){
                $index = array_search($_SESSION["id"],$niz);
                if($index !== FALSE){
                    unset($niz[$index]);
                    $niz = array_values($niz);
                }
                ubaci_u_bazu();
                vrati();
            }
            else{
                array_push($niz, $_SESSION["id"]);
                ubaci_u_bazu();
                vrati();
            }
        }
    }
}
function ubaci_u_bazu(){
    global $conn, $niz, $id_pesme;
    $jsonniz= json_encode($niz);
    $sql = "UPDATE pesme set  lajkovao=? WHERE id=?";
    $stmt= mysqli_stmt_init($conn); 
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "greška 1";
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss",  $jsonniz,  $id_pesme);
        mysqli_stmt_execute($stmt);
    }
}
function vrati(){
    global $conn, $id_pesme;
    $sql = "SELECT lajkovao FROM pesme WHERE id=". $id_pesme;
    $rezultat= mysqli_query($conn, $sql);
    $red=mysqli_fetch_assoc($rezultat);
    $lajkovao=$red["lajkovao"];
    $tip=gettype($lajkovao);
    if($tip==="NULL" || $lajkovao==="[]"){
        $broj_lajkova=0;
    }
    else{
        $niz_lajkova=json_decode($lajkovao);
        $broj_lajkova=count($niz_lajkova);
    }
    echo $broj_lajkova;
}
?>