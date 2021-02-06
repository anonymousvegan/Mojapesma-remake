<!DOCTYPE html>
<?php
session_start();
if( 
    ( isset($_COOKIE["token"]) and isset($_COOKIE["username"]) and isset($_COOKIE["selector"])
    )
    || isset($_SESSION["id"])){
    header("location: ../");
    exit();
}
?>
<html lang="sr-RS">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moja pesma</title>
        <link rel="icon" href="../fajlovi/logo.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="kolona">
        <div class="col-md-6 col-sm-9 col-xs-12" id="kolona">
            <form class="form-container" autocomplete="off" method="post" action="../backend/restartuj.php">
                <h1>Restartuj lozinku</h1>
                <?php
                    if(isset($_GET["restart"])){
                        if($_GET["restart"]=="uspesan"){
                            echo '<p class="uspesno">';
                            echo "Poslali smo vam E-mail za restartovanje lozinke!</p>";
                        }
                    }
                    else{
                        if(isset($_GET["greska"])){
                            echo '<p class="greska">';
                            if($_GET["greska"]=="sql_gresksa"){
                                echo "Došlo je do greške u bazi podataka</p>";
                            }
                            else if($_GET["greska"]=="nema_korisnika"){
                                echo "Korisnik ne postoji! ";
                                echo "Ukoliko ste novi, ";
                                echo '<a href="registracija.php">Registrujte se</a></p>';
                            }
                            else if($_GET["greska"]=="nepoznata"){
                            echo "Došlo je do nepoznate greške!</p>";
                            }
                        }
                        echo '  <div class="form-group">
                                    <input type="email" placeholder=" " class="form-control" onkeyup="pomeri()" name="email" id="email" aria-describedby="emailHelp" autocomplete="off" required >
                                    <label for="email" id="lemail">
                                        <span class="label-tekst" id="email-label-tekst">E-mail adresa</span>
                                    </label>
                                </div>
                                <button type="submit" name="restartuj-dugme" class="btn btn-primary btn-block">Zatraži novu lozinku</button>';
                        }
                ?>
            </form>
        </div>
    </body>
</html>