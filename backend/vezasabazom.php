<?php
$servername="localhost";
$dBUsername="root";
$dBPassword="SHkola.debLinux20.04";
$dBName="mojapesma";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("došlo je do greške:".mysqli_connect_error());
}
