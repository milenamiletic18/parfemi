<?php


include "broker.php";

$broker=Broker::getBroker();
if(!isset($_FILES['slika'])){
    if($_POST["akcija"]=="dodaj"){
        $broker->izvrsi("insert into parfem(naziv,cena,pol) values ('".$_POST["naziv"]."',".$_POST["cena"].",".$_POST["pol"].")");
        $rez=$broker->getRezultat();
            if(!$rez){
                echo $broker->getError();
            }
            echo "uspesno dodat parfem";
    }
    if($_POST["akcija"]=="izmeni"){
        $broker->izvrsi("update parfem set naziv='".$_POST["naziv"]."', cena=".$_POST["cena"].", pol=".$_POST["pol"]." where id=".$_POST["id"]);
        $rez=$broker->getRezultat();
            if(!$rez){
                echo $broker->getError();
            }
            echo "uspesno izmenjen parfem";
    }
}else{
    $filename = $_FILES['slika']['name'];
    $location = "../img/".$filename;
        if(move_uploaded_file($_FILES['slika']['tmp_name'],$location)){
            //$id,$naziv,$kategorija,$velicina,$boja,$slika,$opis,$cena
            if($_POST["akcija"]=="dodaj"){
                $broker->izvrsi("insert into parfem(naziv,cena,pol,slika) values ('".$_POST["naziv"]."',".$_POST["cena"].",".$_POST["pol"].",'".$location."')");
            }
            if($_POST["akcija"]=="izmeni"){
                $broker->izvrsi("update parfem set slika='".$location."', naziv='".$_POST["naziv"]."', cena=".$_POST["cena"].", pol=".$_POST["pol"]." where id=".$_POST["id"]);

            }
            if($broker->getError()!=""){
                echo $broker->getError();
            }else{
                echo "Uspeh";
            }
         }else{
            echo "Slika nije prebacena";
         }
        
    
    
}


?>