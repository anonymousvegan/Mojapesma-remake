<?php
echo "proveravam kolačiće <br>";
if(isset($_COOKIE["username"])&& isset($_COOKIE["selector"]) && isset($_COOKIE["token"])){
$username= $_COOKIE["username"];
$selector= $_COOKIE["selector"];
$token= $_COOKIE["token"];
echo "čitam kolačiće: <br>";
echo "username=" . $username  . "<br>";
echo "selector=" . $selector  . "<br>";
echo "token=" . $token  . "<br>";
require "backend/vezasabazom.php";
echo "povezan sam sa bazom podataka <br>";
$sql = "SELECT * FROM  korisnici where username=? AND selector=?;";
    echo "proveeravam da li postoji selektor u bazi <br>";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "došlo je do grešk eu proveri <br>";
        exit();
    }
    else {
        echo "rezultat se traže u bazi <br>";
        mysqli_stmt_bind_param($stmt, "ss", $username, $selector);
        mysqli_stmt_execute($stmt);
        $rezultat = mysqli_stmt_get_result($stmt);
        $t= time()-3600*24*60;
        if(!$row=mysqli_fetch_assoc($rezultat)){
            echo "nema u bazi rezultata, brišem kolačiće<br>";
            setcookie("username", "", $t, "/");
            setcookie("selector", "", $t, "/");
            setcookie("token", "", $t, "/");
            exit();
        }
        else{
            echo "ima rezultata u bazi<br>";
            $tokenbin= hex2bin($token);
            $provera= password_verify($tokenbin, $row["token"]);
            if($provera===false){
                echo "provera nije uspela, brišem  kolačiće <br>";
                setcookie("username", "", $t, "/");
                setcookie("selector", "", $t, "/");
                setcookie("token", "", $t, "/");
                exit();
            }
            else if($provera===true){
                echo "provera uspela, kontaktiram bazu <br>";
                $sql= "SELECT * FROM korisnici WHERE username=?;";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "greška u bazi podataka <br>";
                    exit();   
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt);
                    $rezultati=mysqli_stmt_get_result($stmt);
                    if($row=mysqli_fetch_assoc($rezultati)){
                        echo "stigli rezultati iz baze, pravim nove selektore i tokene <br>";
                        $selector = bin2hex(random_bytes(8));
                        $token = random_bytes(32);
                        $enkriptovantoken= password_hash($token, PASSWORD_DEFAULT);
                        $sql="UPDATE korisnici SET selector=?,  token = ?  WHERE username= ? ;";
                        echo "ubacujem u bazu nove";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "greška u ubacivanju novih u bazu <br>";
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, "sss", $selector, $enkriptovantoken, $username);
                            mysqli_stmt_execute($stmt);
                            echo "novo ubačeno u bazu, pravim nove kolačiće <br>";
                            $t= time()+3600*24*60;
                            setcookie("username", $username, $t, "/");
                            setcookie("selector", $selector, $t, "/");
                            setcookie("token", bin2hex($token), $t, "/");
                            echo "novi kolačići podešeni : <br>";
                            echo "username=" . $username  . "<br>";
                            echo "selector=" . $selector  . "<br>";
                            echo "token=" . bin2hex($token)  . "<br>";
                        }
                    }
                    echo "pravim sesiju <br>";
                    $_SESSION["id"]=$row["id"];
                    $_SESSION["username"]=$row["username"];
                    $_SESSION["godine"]=$row["godine"];
                    $_SESSION["ovlascenje"]=$row["ovlascenje"];
                    echo "sesija-ime:  ". $row["username"];
                    echo "sesija-id:  ". $row["id"];
                    echo "sesija-godine:  ". $row["godine"];
                }
            }
        }
    }
}
else{
    echo "nema kolačića- odjavljeni ste";
}
?>