<?php
if(isset($_COOKIE["username"])&& isset($_COOKIE["selector"]) && isset($_COOKIE["token"])){
$username= $_COOKIE["username"];
$selector= $_COOKIE["selector"];
$token= $_COOKIE["token"];
require "backend/vezasabazom.php";
$sql = "SELECT * FROM  korisnici where username=? AND selector=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "došlo je do greške u bazi podataka!";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $selector);
        mysqli_stmt_execute($stmt);
        $rezultat = mysqli_stmt_get_result($stmt);
        $t= time()-3600*24*60;
        if(!$row=mysqli_fetch_assoc($rezultat)){
            echo "došlo je do greške u bazi podataka!";
            setcookie("username", "", $t, "/");
            setcookie("selector", "", $t, "/");
            setcookie("token", "", $t, "/");
            exit();
        }
        else{
            $tokenbin= hex2bin($token);
            $provera= password_verify($tokenbin, $row["token"]);
            if($provera===false){
                setcookie("username", "", $t, "/");
                setcookie("selector", "", $t, "/");
                setcookie("token", "", $t, "/");
                exit();
            }
            else if($provera===true){
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
                        $selector = bin2hex(random_bytes(8));
                        $token = random_bytes(32);
                        $enkriptovantoken= password_hash($token, PASSWORD_DEFAULT);
                        $sql="UPDATE korisnici SET selector=?,  token = ?  WHERE username= ? ;";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "greška bazi podataka <br>";
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, "sss", $selector, $enkriptovantoken, $username);
                            mysqli_stmt_execute($stmt);
                            $t= time()+3600*24*60;
                            setcookie("username", $username, $t, "/");
                            setcookie("selector", $selector, $t, "/");
                            setcookie("token", bin2hex($token), $t, "/");
                        }
                    }
                    $_SESSION["id"]=$row["id"];
                    $_SESSION["ime"]=$row["username"];
                    $_SESSION["godine"]=$row["godine"];
                    $_SESSION["ovlascenje"]=$row["ovlascenje"];
                }
            }
        }
    }
}
?>