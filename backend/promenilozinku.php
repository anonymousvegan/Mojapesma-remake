<?php
if(isset($_POST["promeni"])){ #dozvoljava ulaz samo klikom na dugme! 
    $selektor= $_POST["selektor"];
    $validator= $_POST["validator"];
    $novasifra= $_POST["password"];
    $novasifra2 = $_POST["password2"];
    if (empty($novasifra) || empty($novasifra2)){ #provera popunjenosti polja
        echo "Morate popuniti sva polja";
        exit();
    }
    else if ($novasifra != $novasifra2){ #provera da li se šifre poklapaju
        echo "šifre koje ste uneli se ne poklapaju";
        exit();
    }
    $trenutnovreme= date("U");
    require "vezasabazom.php";
    $sql = "SELECT * FROM  passwordrestart where selektor=? AND vreme>=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "greška sa bazom podataka u promeni šifre, kod grešek : 1";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $selektor, $trenutnovreme);
        mysqli_stmt_execute($stmt);
        $rezultat = mysqli_stmt_get_result($stmt);
        if(!$row=mysqli_fetch_assoc($rezultat)){
            echo "nismo pronašli vaš email u bazi ili je vreme isteklo. ";
            exit();
        }
        else{
            $tokenbin= hex2bin($validator);
            $provera= password_verify($tokenbin, $row["token"]);
            if($provera===false){
                echo "kod greške: 2, morate ponovo zatražiti novu šifru, nismo verifikovali vaš zahtev, ";
                exit();
            }
            else if($provera===true){
                $email= $row["email"];
                $sql= "SELECT * FROM korisnici WHERE email=?;";
                $stmt=mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "greška sa bazom podataka- kod grešek : 3";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $rezultat = mysqli_stmt_get_result($stmt);
                    if(!$row===mysqli_fetch_assoc($rezultat)){
                        echo "nismo pronašli korisnika sa tim email-om, kod greške 4";
                        exit();
                    }
                    else{
                        $sql= "UPDATE korisnici set sifra =? WHERE email=?;";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "greška sa bazom podataka- kod grešek : 5";
                            exit();
                        }
                        else{
                            $novaenkriptovanasifra= password_hash($novasifra, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $novaenkriptovanasifra, $email);
                            mysqli_stmt_execute($stmt);
                            $sql ="DELETE FROM passwordrestart WHERE email=?;";
                            $stmt=mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "greška u brisanju iz baze, kod greške: 6";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($stmt, "s", $email);
                                mysqli_stmt_execute($stmt);
                                header("location: ../../forme/prijava.php?restart=uspesan");
                            }
                        }
                    }
                }
            }
        }
    }
}
else{
    header("location: ../../forme/prijava.php?greska=nedozvoljeni_restart");
    exit();
}