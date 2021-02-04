<?php
if(isset($_POST["login"])){
    require "vezasabazom.php";
    $korisnicko_ime=$_POST["username"];
    $sifra=$_POST["password"];
    if(empty($korisnicko_ime) || empty($sifra)){
        header("location: ../forme/prijava.php?greska=prazno_polje");
        exit();      
    }
    else{
        $sql= "SELECT * FROM korisnici WHERE username=? OR email=?;";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../forme/prijava.php?greska=sql_greska");
            exit();   
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $korisnicko_ime, $korisnicko_ime);
            mysqli_stmt_execute($stmt);
            $rezultati=mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($rezultati)){
                $tacnasifra= password_verify($sifra, $row["password"]);
                if($tacnasifra==false){
                    header("location: ../forme/prijava.php?greska=netacna_lozinka");
                    exit();  
                }
                else if($tacnasifra==true){
                    if(isset($_POST["sacuvaj"])){
                        $selector = bin2hex(random_bytes(8));
                        $token = random_bytes(32);
                        $enkriptovantoken= password_hash($token, PASSWORD_DEFAULT);
                        $sql="UPDATE korisnici SET selector=?,  token = ?  WHERE username= ? ;";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("location: ../forme/prijava.php?greska=sql_greska");
                            exit();   
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, "sss", $selector, $enkriptovantoken, $korisnicko_ime);
                            mysqli_stmt_execute($stmt);
                            $t= time()+3600*24*60;
                            setcookie("username",$korisnicko_ime, $t, "/");
                            setcookie("selector", $selector, $t, "/");
                            setcookie("token", bin2hex($token), $t, "/");
                        }
                    }
                    session_start();
                    $_SESSION["id"]=$row["id"];
                    $_SESSION["username"]=$row["username"];
                    $_SESSION["godine"]=$row["godine"];
                    $_SESSION["ovlascenje"]=$row["ovlascenje"];
                    header("location: ..?uspeh=prijavauspela");
                    exit();
                }
                else{
                    header("location: ../forme/prijava.php?greska=nepoznata");
                    exit();   
                }
            }
            else{
                header("location: ../forme/prijava.php?greska=nema_korisnika");
                exit();   
            }
        }
    }

}
else{
    header("location: ../forme/prijava.php");
    exit();
}