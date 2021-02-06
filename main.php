<main>
        <?php include "pesma-preko-celog-ekrana.php"?>
        <?php include "unos.php"?>
        <?php include "izbor.php"?>
        <div class="pesme" id="pesme"> 
        <?php 
        require "backend/pozadinske/vezasabazom.php";
        require "objava/objava.php";
        ?>
        </div>
</main>