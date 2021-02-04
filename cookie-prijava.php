<?php 
echo "proveravam kolačiće <br>";
if(isset($_COOKIE["username"])&& isset($_COOKIE["selector"]) && isset($_COOKIE["token"])){
echo "svi kolačići su  podešeni";
$username= $_COOKIE["username"];
$selector= $_COOKIE["selector"];
$token= $_COOKIE["token"];
require "backend/vezasabazom.php";
echo "uspostavljena je veza sa bazom podataka <br>";
$sql = "SELECT * FROM  korisnici where username=? AND selector=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "greška sa bazom podataka  <br>";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $selector);
        mysqli_stmt_execute($stmt);
        echo "sql kod izvršen <br>";
        $rezultat = mysqli_stmt_get_result($stmt);
        $t= time()-3600*24*60;
        if(!$row=mysqli_fetch_assoc($rezultat)){
            echo "nema rezultata u bazi, brišem kolačiće <br>";
            setcookie("username",$korisnicko_ime, $t, "/");
            setcookie("selector", $selektor, $t, "/");
            setcookie("token", $token, $t, "/");
            exit();
        }
        else{
            echo "ima rezultata u bazi, proveravam token <br>";
            $tokenbin= hex2bin($token);
            $provera= password_verify($tokenbin, $row["token"]);
            if($provera===false){
                echo "provera nije uspela, brišem kolačiće <br>";
                setcookie("username",$korisnicko_ime, $t, "/");
                setcookie("selector", $selektor, $t, "/");
                setcookie("token", $token, $t, "/");
                exit();
            }
            else if($provera===true){
                echo "tjt brt sve radi  <br>";
            }
        }
    }
}
else{
    echo "nema kolačića, korisnik odjavljen";
}
?>