<?php
if(isset($_POST["registracija-dugme"])){#provera da li je došao na stranicu klikom na dugme.
    require "vezasabazom.php";
    $korisnicko_ime = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $godine = $_POST["godine"];
    $ovlascenje = "obican";
    if(empty($korisnicko_ime) || empty($password) || empty($email) || empty($godine)) { #provera validnosti
        header("location: ../forme/registracija.php?greska=prazno_polje");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9šđćčžŠĐĆČŽабвгдђежзијклљмнљопрстћуфхцчџшАБВГДЂЕЖЗИЈКЛЉМНЊОПРИСТЋУФХЦЧЏШ]*$/", $korisnicko_ime)){
        header("location: ../forme/registracija.php?greska=neispravno_ime");
        exit();
    }else{ #provera da li ima specijalnih karaktera, dozvoljava ćirilicu.
        $sql = "SELECT  ime FROM korisnici where ime=?;";
        $stmt= mysqli_stmt_init($conn); 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../forme/registracija.php?greska=sql_greska");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $korisnicko_ime);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $proverarezultata=mysqli_stmt_num_rows($stmt);
            if($proverarezultata>0){
                header("location: ../forme/registracija.php?greska=ime_zauzeto");
                exit();  
            }
            else{
                $sql = "SELECT  email FROM korisnici where email=?;"; 
                $stmt= mysqli_stmt_init($conn); 
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../forme/registracija.php?greska=sql_greska");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $proverarezultata=mysqli_stmt_num_rows($stmt);
                    if($proverarezultata>0){
                        header("location: ../forme/registracija.php?greska=email_zauzet");
                        exit();  
                    }
                    else{
                        $sql = "INSERT INTO korisnici (username, email, password, godine, ovlascenje) VALUES (?, ?, ?, ?, ?)";
                        $stmt= mysqli_stmt_init($conn); 
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("location: ../forme/registracija.php?greska=sql_greska");
                            exit();
                        }   
                        else{
                            $enkriptovanasifra=password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "sssss", $korisnicko_ime, $email, $enkriptovanasifra, $godine, $ovlascenje);
                            mysqli_stmt_execute($stmt);
                            header("location: ../forme/registracija.php?uspesno=da");
                        }
                    }
                }
            }   
        }   
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("location: ../forme/registracija.php");
}