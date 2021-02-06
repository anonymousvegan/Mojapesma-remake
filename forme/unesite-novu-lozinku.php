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
            <form class="form-container" autocomplete="off" method="post" action="../backend/promenilozinku.php">
                <h1>Promeni lozinku</h1>
                <?php
                    if(isset($_GET["selektor"]) && isset($_GET["validator"])){
                        $selektor=$_GET["selektor"];
                        $validator= $_GET["validator"];
                        echo'
                        <div class="form-group">
                            <input type="password" placeholder=" " class="form-control" name="password" id="password" aria-describedby="emailHelp" autocomplete="off" required >
                            <label for="password" id="lpassword">
                            <span class="label-tekst" id="username-label-tekst">Unesite novu lozinku</span></label>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder=" " class="form-control" name="password2" id="password2" aria-describedby="emailHelp" autocomplete="off" required >
                            <label for="password2" id="lpassword2">
                            <span class="label-tekst" id="username-label-tekst">Unesite novu lozinku</span></label>
                        </div>   
                    <input type="hidden" name="selektor" value="'.$selektor.'">
                    <input type="hidden" name="validator" value="'.$validator.'">
                    <button type="submit" name="promeni" class="btn btn-primary btn-block">Promeni lozinku</button>';
                    }
                    else {
                    echo '<p class="greska">';
                    echo "Došlo je do greške, mislimo da nemate pristup ovoj stranici! </p>";
                    }
                ?>
            </form>
        </div>
    </body>
</html>