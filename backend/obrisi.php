<?php
session_start();
$idpesme = $_POST["idpesme"];
require "vezasabazom.php";
if(isset($_SESSION["id"])){
    $idkorisnika=$_SESSION["id"];
    $sql = "SELECT * FROM korisnici where id=". $idkorisnika;
    $rezultat= mysqli_query($conn, $sql);
    $red=mysqli_fetch_assoc($rezultat);
    if($red["ovlascenje"]=="admin"){
        obrisi_iz_baze();
    }
    else{
        $sql = "SELECT * FROM pesme where id=".  $idpesme;
        $rezultat= mysqli_query($conn, $sql);
        $red=mysqli_fetch_assoc($rezultat);
        $pisac= $red["id_pisca"];
        if($pisac==$_SESSION["id"]){
            obrisi_iz_baze();
        }
    }
}
function obrisi_iz_baze(){
    global $conn, $idpesme;
    $sql = "DELETE FROM pesme WHERE id=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "greška u brisanju iz baze ";
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $idpesme);
        mysqli_stmt_execute($stmt);
    }
}