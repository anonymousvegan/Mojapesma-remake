<!DOCTYPE html>
<?php
session_start();
if(isset($_COOKIE["token"]) || isset($_SESSION["id"])){
    header("location: ../");
    exit();
}
?>
<html lang="sr-RS">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moja pesma - Registracija</title>
        <link rel="icon" href="../fajlovi/logo.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
        <script src="script.js" defer></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body id="kolona">
            <form class="form-container"  method="post" action="../backend/registruj_se.php">
                <h1>Registruj se</h1>
                <?php
                    if(isset($_GET["greska"])){
                        if($_GET["greska"]=="prazno_polje"){
                            echo '<p class="greska">';
                            echo "Morate popuniti sva polja!</p>";
                        }
                        else if($_GET["greska"]=="sql_greska"){
                            echo '<p class="greska">';
                            echo "greska sa bazom podataka </p>";
                        }
                        else if($_GET["greska"]=="neispravno_ime"){
                            echo '<p class="greska">';
                            echo "Ime ne sme da sadrži specijalne znakove ili razmake</p>";
                        }
                        else if($_GET["greska"]=="ime_zauzeto"){
                            echo "<p class='greska'>To ime je već zauzeto, unesite drugo <br>";
                            echo "ukoliko već imate nalog";
                            echo "<a href='prijava.php'> prijavite se </a></p>";
                        }
                        else if($_GET["greska"]=="email_zauzet"){
                            echo "<p class='greska'>Već ste se registrovali, <br>";
                            echo "<a href='prijava.php'> prijavite se</a>, ili ";
                            echo 'ako ste zaboravili lozinku-<a href="zaboravio-sam-lozinku.php">kliknite ovde</a></p>';
                        }
                    }
                    if(isset($_GET["uspesno"])){
                        echo ' <p  class="uspesno">Čestitamo, uspešno ste se regisrovali, sada se možete <a href="prijava.php">prijaviti</a></p>';
                    }
                ?>
                <div class="form-group">
                    <input type="text"  placeholder=" " class="form-control" name="username" id="username" aria-describedby="emailHelp" autocomplete="on" required >
                    <label for="username" id="lusername">
                    <span class="label-tekst" id="username-label-tekst">Korisničko ime</span></label>
                </div>
                <div class="form-group">
                    <input type="email"  placeholder=" " class="form-control" name="email" id="email" aria-describedby="emailHelp" autocomplete="on" required >
                    <label for="email" id="lemail">
                    <span class="label-tekst" id="email-label-tekst">E-mail adresa</span></label>
                </div>
                <div class="form-group">
                    <input type="number" min="4" max="120" class="form-control" placeholder=" " name="godine" id="godine" aria-describedby="emailHelp" autocomplete="on" required >
                    <label for="godine" id="lgodine">
                    <span class="label-tekst" id="godine-label-tekst">Koliko imate godina?</span></label>
                </div>
                <div class="form-group">
                    <input type="password"  placeholder=" " name="password" class="form-control" autocomplete="new-password" id="password" required>
                    <label for="password" id="llozinka"><span class="label-tekst">Lozinka</span></label>
                </div>
                <button type="submit" name="registracija-dugme" class="btn btn-primary btn-block">Registruj se</button>
            </form>
        </div>
    </body>
</html>