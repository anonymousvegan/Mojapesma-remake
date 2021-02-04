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
        <script data-ad-client="ca-pub-7058729872957014" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ovo su moje custom skripte -->
        <script src="script/filter.js" defer></script>
        <script src="script/komentarisanje.js" defer></script>
        <script src="script/lajkuj.js" defer></script>
        <script src="script/logout.js" defer></script>
        <script src="script/prethodna-sledeca.js" defer></script>
        <script src="script/prikazivise.js" defer></script>
        <script src="script/opcijePesme.js" defer></script>
        <script src="script/promeniboju.js" defer></script>
        <script src="script/alert.js" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
        echo "počinje php kod <br> ";
        if(!isset($_SESSION["id"]) && !isset($_SESSION["username"])){
            echo "nije podešena sesija, zato  ulazimo  u proveru kolačića <br>";
            include "cookie-prijava.php";
        }
        else{
            echo "podešena  je sesija , nema  potrebe za kolačićima  ";
        }
        ?>
        <?php include "nav.php" ?>
        <?php
            $profil="index_stranica_prikazi_sve";
            if(isset($_SESSION["ime"])){
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
        <?php include "foother.php" ?>
        <script>
            broj=5
            //deo koda za izbor kategorije
            var kategorija="sve";
            function  promenikategoriju(k){
                kategorija=k;
                broj=5
                prikazi_jos();
            }
            //ostatak koda
            function prikazi_jos(){
                broj+=5;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("pesme").innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "objava/prikazi_jos.php", false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("broj="+broj+"&kategorija="+kategorija);
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