<!DOCTYPE html>
<?php
session_start();
?>
<html lang="sr-RS">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Moja pesma. Napišite svoju životnu pesmu. Na ovom mestu imate prilku da iskažete svoja osećanja ili emocije kroz poeziju, takodje mogućnost deljenja pesama kroz celu platformu sa drugim korisnicima">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moja pesma</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="nav.css">
        <link rel="stylesheet" href="objava/objava.css">
        <link rel="stylesheet" href="izbor.css">
        <link rel="stylesheet" href="unos.css">
        <link rel="stylesheet" href="pesma-preko-celog-ekrana.css">
        <link rel="stylesheet" href="prijavi.css">
        <link rel="stylesheet" href="alert.css">
        <link rel="icon" href="fajlovi/logo.png">
        <!-- ovo su moje custom skripte -->
        <script src="script/filter.js" defer></script>
        <script src="script/komentarisanje.js" defer></script>
        <script src="script/lajkuj.js" defer></script>
        <script src="script/prethodna-sledeca.js" defer></script>
        <script src="script/prikazivise.js" defer></script>
        <script src="script/opcijePesme.js" defer></script>
        <script src="script/promeniboju.js" defer></script>
        <script src="script/alert.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    </head>   
        <body>
        <?php
        if(!isset($_SESSION["id"]) && !isset($_SESSION["username"])){  
            include "cookie-prijava.php";
        }
        ?>
        <?php include "nav.php" ?>
        <?php
            if(isset($_SESSION["id"])){
                if($_SESSION["ovlascenje"]=="admin"){
                    $ispis="sve";
                    $ovlascenje="admin";
                }
                else{
                    settype($_SESSION["godine"], int);
                if  ($_SESSION["godine"]>=18){
                    $ispis="sve";
                    $ovlascenje="obican";
                }
                else {
                    $ispis="filter";
                    $ovlascenje="obican";
                }
                }
            }
            else{
                $ispis="filter";
                $ovlascenje="nelogovan";
            }
        ?>
        <?php include "main.php" ?>
        <script>
            broj=5;
            var kategorija="sve";
            //ostatak koda
            function prikazi_jos(){
                broj+=5;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("pesme").innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "objava/objava.php", false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("broj="+broj);
            }
            $(window).scroll(function() {
            if($(window).scrollTop() + window.innerHeight >= $(document).height()-100) {
                prikazi_jos()
            }
            });
        </script>
        <?php include "prijavi.php"?>
        <?php include "alert.html"?>
        </body>
</html>