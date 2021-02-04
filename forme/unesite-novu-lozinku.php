<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moja pesma</title>
        <script data-ad-client="ca-pub-7058729872957014" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <link rel="icon" href="../fajlovi/logo.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
        <script src="script.js" defer></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="col-md-6 col-sm-9 col-xs-12" id="kolona">
            <form class="form-container" autocomplete="off" method="post" action="../backend/pozadinske/promenilozinku.php">
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