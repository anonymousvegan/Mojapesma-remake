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