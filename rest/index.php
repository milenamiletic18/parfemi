<?php
require 'flight/Flight.php';
require 'jsonindent.php';
//registracija baze Database
Flight::register('db', 'Database', array('sminka'));

Flight::route('/', function(){
	die("Izabereti neku od ruta...");
});
Flight::route("GET /sminka.json",function(){
    header("Content-Type: application/json; charset=utf-8");
    $db=Flight::db();
    $db->ExecuteQuery("select p.*, pl.naziv as 'pol_naziv' from sminka p inner join pol pl on (p.pol=pl.id)");

	$niz =  [];
	if(! $db->getResult()){
		$niz["greska"]=$db->getError();
	}else{
		while ($red = $db->getResult()->fetch_object()) {
			array_push($niz, $red);
		}
	}
    

    echo indent(json_encode($niz));
});
Flight::route("GET /narudzbina.json",function(){
    header("Content-Type: application/json; charset=utf-8");
    $db=Flight::db();
    $db->ExecuteQuery("select * from narudzbina");

    $niz =  [];
    if(! $db->getResult()){
		$niz["greska"]=$db->getError();
	}else{
		while ($red = $db->getResult()->fetch_object()) {
			array_push($niz, $red);
		}
	}
    echo indent(json_encode($niz));
});
Flight::route("GET /sminka.xml",function(){
    header("Content-Type: application/xml");
    $db=Flight::db();
    $db->ExecuteQuery("select p.*, pl.naziv as 'pol_naziv' from sminka p inner join pol pl on (p.pol=pl.id)");
    $dom = new DomDocument('1.0','utf-8');
	if(!$db->getResult()){
		$greska = $dom->appendChild($dom->createElement('greska'));
	}else{
		$sminkai = $dom->appendChild($dom->createElement('sminkai'));
		while ($red = $db->getResult()->fetch_object()){
            $sminka = $sminkai->appendChild($dom->createElement('sminka'));
            
			$id = $sminka->appendChild($dom->createElement('id'));
            $id->appendChild($dom->createTextNode($red->id));
            
            $naziv = $sminka->appendChild($dom->createElement('naziv'));
            $naziv->appendChild($dom->createTextNode($red->naziv));

            $cena = $sminka->appendChild($dom->createElement('cena'));
            $cena->appendChild($dom->createTextNode($red->cena));

			$pol = $sminka->appendChild($dom->createElement('pol'));
            $pol->appendChild($dom->createTextNode($red->pol));
            $pol_naziv = $sminka->appendChild($dom->createElement('pol_naziv'));
			$pol_naziv->appendChild($dom->createTextNode($red->pol_naziv));
			
		}
		
	}
	$xml_string = $dom->saveXML(); 
		echo $xml_string;

});
Flight::route('POST /narudzbina',function(){
	header("Content-Type: text/plain; charset=utf-8");
	$db = Flight::db();
	$podaci = file_get_contents('php://input');
	$niz = json_decode($podaci,true);
	if(!isset($niz["kupac"]) || !isset($niz["sminka"])|| !isset($niz["kolicina"])){
		echo 'Nisu poslati svi podaci';
		return;
	}
	if(!validanaNarudzbina($niz["sminka"],$niz["kupac"],$niz["kolicina"])){
		echo 'Nisu validni svi podaci'; 
		return;
	}
	$db->ExecuteQuery("insert into narudzbina(kupac,sminka,kolicina) values (".$niz["kupac"].",".$niz["sminka"].",".$niz["kolicina"].")");
	if(!$db->getResult()){
		echo $db->getError();
	}else{
		echo 'uspeh';
	}
});
Flight::route("PUT /uloga/@id",function($id){
	header("Content-Type: text/plain; charset=utf-8");
	$db = Flight::db();
	$podaci = file_get_contents('php://input');
	$niz = json_decode($podaci,true);
	if(!isset($niz["naziv"])){
		echo 'Nisu poslati svi podaci';
		return;
	}
	$db->ExecuteQuery("update uloga set naziv='".$niz["naziv"]."' where id=".$id);
	if(!$db->getResult()){
		echo $db->getError();
	}else{
		echo 'uspeh';
	}
});
Flight::route("delete /sminka/@id",function($id){
	header("Content-Type: text/plain; charset=utf-8");
	$db = Flight::db();
	$db->ExecuteQuery("delete from sminka where id=".$id);
	if(!$db->getResult()){
		echo ''.$db->getError().'';
	}else{
		echo 'uspeh';
	}
});
Flight::start();

function validanaNarudzbina($sminka,$kupac,$kolicina){
    
    $sminka=intval(trim($sminka));
    $kupac=intval(trim($kupac));
    $kolicina=intval(trim($kolicina));
    return $sminka && $kupac && $sminka>0 && $kupac>0 && $kolicina && $kolicina>0;
}

?>
