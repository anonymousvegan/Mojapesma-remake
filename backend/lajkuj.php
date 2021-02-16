<?php
session_start();
if(isset($_SESSION["ime"])){
    require "pozadinske/vezasabazom.php";
    $id = $_POST["id"];
    $profil= $_POST["profil"];
    $ime = $_SESSION["ime"]; 
    if($profil==$ime){
        $sql = "SELECT * FROM pesme WHERE id=". $id;
        $rezultat= mysqli_query($conn, $sql);
        $red=mysqli_fetch_assoc($rezultat);
        $broj_lajkova=$red["lajkova"];
        $novi_broj_lajkova=$broj_lajkova+1;
        $sql = "SELECT * FROM pesme WHERE id=". $id;
        $rezultat= mysqli_query($conn, $sql);
        $red=mysqli_fetch_assoc($rezultat);
        $lajkovao=$red["lajkovao"];
        if($lajkovao=="null"|| $lajkovao==null || $lajkovao==""){
            $niz = array($_SESSION["ime"]);
            $jsonniz= json_encode($niz);
            $sql = "UPDATE pesme set lajkova=?, lajkovao=? WHERE id=?";
            $stmt= mysqli_stmt_init($conn); 
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "greška 1";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "sss", $novi_broj_lajkova, $jsonniz,  $id);
                mysqli_stmt_execute($stmt);
                $sql = "SELECT * FROM pesme WHERE id=". $id;
                $rezultat= mysqli_query($conn, $sql);
                $red=mysqli_fetch_assoc($rezultat);
                $broj_lajkova=$red["lajkova"];
                echo $broj_lajkova;
            }
        }
        else{
            $niz=json_decode($lajkovao);
            if(in_array($_SESSION["ime"], $niz)){
                $novi_broj_lajkova=$broj_lajkova -1;
                $index = array_search($_SESSION["ime"],$niz);
                if($index !== FALSE){
                    unset($niz[$index]);
                }
                $jsonniz=json_encode($niz);
                $sql = "UPDATE pesme set lajkova=?, lajkovao=? WHERE id=?";
                $stmt= mysqli_stmt_init($conn); 
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "greška 1";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "sss", $novi_broj_lajkova, $jsonniz,  $id);
                    mysqli_stmt_execute($stmt);
                    $sql = "SELECT * FROM pesme WHERE id=". $id;
                    $rezultat= mysqli_query($conn, $sql);
                    $red=mysqli_fetch_assoc($rezultat);
                    $broj_lajkova=$red["lajkova"];
                    echo $broj_lajkova;
                }  
            }
            else{
                array_push($niz, $_SESSION["ime"]);
                $jsonniz=json_encode($niz);
                $sql = "UPDATE pesme set lajkova=?, lajkovao=? WHERE id=?";
                $stmt= mysqli_stmt_init($conn); 
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "greška 1";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "sss", $novi_broj_lajkova, $jsonniz,  $id);
                    mysqli_stmt_execute($stmt);
                    $sql = "SELECT * FROM pesme WHERE id=". $id;
                    $rezultat= mysqli_query($conn, $sql);
                    $red=mysqli_fetch_assoc($rezultat);
                    $broj_lajkova=$red["lajkova"];
                    echo $broj_lajkova;
                }
            }
        }
    }
}
else{
    echo "Ulogujte se!";
}
?>