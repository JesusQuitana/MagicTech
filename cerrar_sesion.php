<?php

session_start();

if($_SESSION["login"]) {
    $_SESSION=[];
    header("location: index.php");
}

?>