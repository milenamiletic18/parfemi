<?php
echo "fs";
include "./prebaciNaLogin.php";
if($_SESSION["korisnik"]->nazivUloge!="admin"){
    echo "aefsg";
    //header("location:../index.php");
}else{
   
   
    $url = 'http://localhost/parfemi/rest/parfem/'.$_POST["id"];
    $curl = curl_init($url);
    echo "pocetak";
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "delete");
    $curl_odgovor = curl_exec($curl);
    curl_close($curl);
    echo $curl_odgovor;


}


?>