<?php
    include "prebaciNaLogin.php";
    include "broker.php";
    $broker=Broker::getBroker();
    $broker->izvrsi("select n.*, p.cena,p.naziv from narudzbina n inner join parfem p on(n.parfem=p.id) where n.naruceno=0");
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