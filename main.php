<main>
        <?php
        echo "1";
        include "pesma-preko-celog-ekrana.php";
        echo "</div>2";
        ?>
        <?php include "unos.php"?>
        <?php include "izbor.php"?>
        <div class="pesme" id="pesme"> 
        radi
        <?php 
        echo "dobijam bazu";
        require "backend/vezasabazom.php";
        require "objava/objava.php";

        ?>
        </div>
</main>