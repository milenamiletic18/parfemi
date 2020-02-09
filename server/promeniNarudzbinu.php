<?php
    include "prebaciNaLogin.php";
    include "broker.php";
    if(isset($_POST["akcija"])){
        $broker=Broker::getBroker();
        if($_POST["akcija"]=="promeni"){
            if(intval($_POST["kolicina"]) && intval($_POST["kolicina"])>0){
                $broker->izvrsi("update narudzbina set kolicina=".$_POST["kolicina"]." where kupac=".$_SESSION["korisnik"]->id." and sminka=".$_POST["sminka"]);
            }else{
                echo "kolicina nije dobra";
            }
                
        }else{
            if($_POST["akcija"]=="poruci"){
                $broker->izvrsi("update narudzbina set naruceno=1 where kupac=".$_SESSION["korisnik"]->id);
            }else{
                if($_POST["akcija"]=="obrisi"){
                    $broker->izvrsi("delete from narudzbina where kupac=".$_SESSION["korisnik"]->id);
                }
            }
        }
        if(!$broker->getRezultat()){
            echo $broker->getError();
        }else{
            echo 'uspeh';
        }
    }


?>