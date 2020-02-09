<?php
    require "broker.php";
    session_start();
    if(!isset($_SESSION["korisnik"])){
        echo "ulogujte se";
    }else{
        $broker=Broker::getBroker();
        if(!isset($_POST["sminka"]) || !intval($_POST["sminka"])){
            echo "los sminka";
            exit;
        }
        $broker->izvrsi("select * from narudzbina where naruceno=0 and sminka=".$_POST["sminka"]." and kupac=".$_SESSION["korisnik"]->id."");
            $rez=$broker->getRezultat();
            if(!$rez){
                echo $broker->getError();
            }
            $nar=$rez->fetch_object();
            if($nar){
                $broker->izvrsi("update narudzbina set kolicina=".(intval($nar->kolicina)+1)." where id=".$nar->id." and sminka=".$_POST["sminka"]." and kupac=".$_SESSION["korisnik"]->id."");
            }else{
                $broker->izvrsi("insert into narudzbina(kupac,sminka,kolicina) values (".$_SESSION["korisnik"]->id.",".$_POST["sminka"].",1)");
            }
            $rez=$broker->getRezultat();
            if(!$rez){
                echo $broker->getError();
            }
            echo "uspesno dodata stavka u korpu";
    }


?>