<?php
session_start();
session_unset();
session_destroy();
$t= time()-3600*24*60;
setcookie("username", "", $t, "/");
setcookie("selector", "", $t, "/");
setcookie("token", "", $t, "/");
header("location: ../");