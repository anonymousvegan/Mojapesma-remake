<?php
session_start();  
if(isset($_SESSION["id"])){ #zaštita da ne komentariše neulogovan
    require "vezasabazom.php";
    $id = $_POST["pesma"];
    $autor= $_POST["autor"];
    $komentar = $_POST["komentar"];
    $ime= $_SESSION["ime"];
    $vreme=date("U");
    if($autor==$ime&&$komentar!=null){ #zaštita od menjanja koda u frontu
        $sql = "SELECT * FROM pesme WHERE id=". $id;
        $rezultat= mysqli_query($conn, $sql);
        $red=mysqli_fetch_assoc($rezultat);
        $trenutni_komentari=$red["komentari"];
        if($trenutni_komentari==null){ #kod ukoliko je ovo prvi komentar na toj pesmi.
            $zaunos = new stdClass();
            $zaunos->autor=$autor;
            $zaunos->idautora=$_SESSION[id];
            $zaunos->komentar=$komentar;
            $zaunos->vreme=$vreme;
            $jsonunos=json_encode($zaunos);
            $sql = "UPDATE pesme set komentari=? WHERE id=?";
            $stmt = mysqli_stmt_init($conn); 
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "greška u komentarisanju 1";
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "ss", $jsonunos, $id);
                mysqli_stmt_execute($stmt);
                require "../../ispiskomentara.php";
            } 
        }else{ #kod ukoliko već ima komentara 
            $stari=json_decode($trenutni_komentari);
            $type = gettype($stari); # tip će biti  array ili object u zavisnosti da li ima 1 ili više komentara
            if ($type=="object"){
                $novi = new stdClass();
                $novi->autor=$autor;
                $novi->idautora=$_SESSION[id];
                $novi->komentar=$komentar;
                $novi->vreme=$vreme;
                $zaunos=array($stari, $novi);
                $jsonunos=json_encode($zaunos);
                $sql = "UPDATE pesme set komentari=? WHERE id=?";
                $stmt = mysqli_stmt_init($conn); 
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "greška u komentarisanju 2";
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "ss", $jsonunos, $id);
                    mysqli_stmt_execute($stmt);
                    require "../../ispiskomentara.php";
                } 
            }else if($type=="array"){
                $novi = new stdClass();
                $novi->autor=$autor;
                $novi->idautora=$_SESSION[id];
                $novi->komentar=$komentar;
                $novi->vreme=$vreme;
                array_push($stari, $novi);
                $jsonunos=json_encode($stari);
                $sql = "UPDATE pesme set komentari=? WHERE id=?";
                $stmt = mysqli_stmt_init($conn); 
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "greška u komentarisanju 3";
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "ss", $jsonunos, $id);
                    mysqli_stmt_execute($stmt);
                    require "../../ispiskomentara.php";
                }
            }
        }
    }
}
else{
     echo "ulogujte se, greška u komentarisanju 4";
}
?>