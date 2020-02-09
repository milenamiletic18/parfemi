<?php

include "prebaciNaLogin.php";
include "broker.php";
$broker=Broker::getBroker();
$broker->izvrsi("select k.email,k.username, sum(n.kolicina*p.cena) as 'ukupno'
     from narudzbina n inner join parfem p on(n.parfem=p.id) inner join korisnik k on (k.id=n.kupac)
        where n.naruceno=1 group by k.id");
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