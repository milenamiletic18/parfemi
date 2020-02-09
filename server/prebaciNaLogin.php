<?php

session_start();

if(!isset($_SESSION["korisnik"])){
    header("Location:login.php");
}

?>