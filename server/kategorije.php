<?php
 include "prebaciNaLogin.php";
 include "broker.php";
 $broker=Broker::getBroker();
 $broker->izvrsi("select * from pol");
 $niz =  [];
 if(! $broker->getRezultat()){
     $niz["greska"]=$broker->getError();
 }else{
     while ($red = $broker->getRezultat()->fetch_object()) {
         array_push($niz, $red);
     }
 }
 
 echo json_encode($niz);
 
?>