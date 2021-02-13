<?php
session_start();
if(isset($_POST["unosdugme"])){
    if(!isset($_SESSION["id"])){
        header("location: ../index.php?greska=neulogovan");
        exit();
    }
    else{
        require "vezasabazom.php";
        $id_pisca = $_POST["id"];
        if($id_pisca!=$_SESSION["id"]){
            header("location: ../index.php?greska=greskasasesijom");
            exit(); 
        }
        else if($_POST["kategorija"]=="neodređeno"){
            header("location: ../index.php?greska=neodabrana_kategorija");
            exit();
        }
        else{
            $naslov = $_POST["naslov"];
            $pesma= $_POST["pesma"];
            date_default_timezone_set("Europe/Belgrade");
            $vreme = date("U");
            $kategorija = $_POST["kategorija"];
            $pogodna= $_POST["pogodna"];
            $boja = $_POST["boja"];
            $publika= $_POST["publika"];
            $sql = "INSERT INTO pesme (id_pisca, naslov, pesma, pogodna, vreme, kategorija,  boja, publika) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt= mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../index.php?greska=sql_greska");
                exit();
            }   
            else{
                mysqli_stmt_bind_param($stmt, "isssssss", $id_pisca, $naslov, $pesma, $pogodna, $vreme, $kategorija, $boja, $publika);
                mysqli_stmt_execute($stmt);
                header("location: ../index.php");
            }
        }
    }
}
else{
    echo 'mislimo da nemate pristup ovoj stranici, vratite se na <a href="../index.php">početnu stranicu</a>';
}