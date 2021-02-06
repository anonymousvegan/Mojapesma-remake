<?php
if (isset($_POST["restartuj-dugme"])){
    require "vezasabazom.php";
    $email= $_POST["email"];
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
            $selektor = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $url = "https://mojapesma.com/forme/unesite-novu-lozinku.php?selektor=" . $selektor . "&validator=".bin2hex($token);
            $vreme = date("U")+1800;
            $sql = "DELETE FROM passwordrestart WHERE email=?";
            $stmt= mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "došlo je do greške u bazi podataka";
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
            }
            $sql="INSERT INTO passwordrestart (email, selektor, token, vreme) VALUES (?, ?, ?, ?);";
            $stmt= mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "došlo je do grešek u bazi podataka";
                exit();
            }
            else{
                $enkriptovantoken= password_hash($token, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssss", $email, $selektor, $enkriptovantoken, $vreme);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            $to = $email;
            $subject ='Restartujte lozinke za mojapesma.com';
            $message='<p>zatražili ste novu lozinku za mojapesma.com?
            kliknite na link ispod da bi ste restartovali lozinku, ukoliko 
            to niste bili vi, ignorišite ovaj email</p>';
            $message .="<p>ovo je link za restartovanje lozinke </p>";
            $message .='<a href="' . $url . '">' . $url . '</a>';
            $hendlers ="From: mojapesma <podrska@mojapesma.com>\r\n";
            $hendlers .="Replay-To: podrska@mojapesma.com\r\n";
            $hendlers .="Content-type: text/html\r\n";
            mail($to, $subject, $message, $hendlers);
            header("location: ../forme/zaboravio-sam-lozinku.php?restart=uspesan");
        }
        else{
            header("location: ../forme/zaboravio-sam-lozinku.php?greska=nema_korisnika");
        }
    }
}
else{
    header("location: ../forme/prijava/prijava.php");
}