<?php
session_start();
$idpesme = $_POST["idpesme"];
require "vezasabazom.php";
if(isset($_SESSION["id"])){
    $idkorisnika=$_SESSION["id"];
    $sql = "SELECT * FROM korisnici where id=". $idkorisnika;
    $rezultat= mysqli_query($conn, $sql);
    $brojrezulta=mysqli_num_rows($rezultat);
    while($red=mysqli_fetch_assoc($rezultat)){
        $korisnickoime = $red["ime"];
        if($red["ovlascenje"]=="admin"){
            $sql = "DELETE FROM pesme WHERE id=?;";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "greška u brisanju iz baze 1";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $idpesme);
                mysqli_stmt_execute($stmt);
            }
        }
        else{
            $sql = "SELECT * FROM pesme where id=".  $idpesme;
            $rezultat= mysqli_query($conn, $sql);
            $brojrezulta=mysqli_num_rows($rezultat);
            while($red=mysqli_fetch_assoc($rezultat)){
                $pisac= $red["pisac"];
                if($pisac==$korisnickoime && $pisac==$_SESSION["ime"]){
                    $sql = "DELETE FROM pesme WHERE id=?;";
                    $stmt=mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "greška u brisanju iz baze2";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "s", $idpesme);
                        mysqli_stmt_execute($stmt);
                    }
                }
            }
        }
    }
}