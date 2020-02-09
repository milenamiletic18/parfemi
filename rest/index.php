<?php
require 'flight/Flight.php';
require 'jsonindent.php';
//registracija baze Database
Flight::register('db', 'Database', array('parfemi'));

Flight::route('/', function(){
	die("Izabereti neku od ruta...");
});
Flight::route("GET /parfem.json",function(){
    header("Content-Type: application/json; charset=utf-8");
    $db=Flight::db();
    $db->ExecuteQuery("select p.*, pl.naziv as 'pol_naziv' from parfem p inner join pol pl on (p.pol=pl.id)");

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
Flight::route("GET /parfem.xml",function(){
    header("Content-Type: application/xml");
    $db=Flight::db();
    $db->ExecuteQuery("select p.*, pl.naziv as 'pol_naziv' from parfem p inner join pol pl on (p.pol=pl.id)");
    $dom = new DomDocument('1.0','utf-8');
	if(!$db->getResult()){
		$greska = $dom->appendChild($dom->createElement('greska'));
	}else{
		$parfemi = $dom->appendChild($dom->createElement('parfemi'));
		while ($red = $db->getResult()->fetch_object()){
            $parfem = $parfemi->appendChild($dom->createElement('parfem'));
            
			$id = $parfem->appendChild($dom->createElement('id'));
            $id->appendChild($dom->createTextNode($red->id));
            
            $naziv = $parfem->appendChild($dom->createElement('naziv'));
            $naziv->appendChild($dom->createTextNode($red->naziv));

            $cena = $parfem->appendChild($dom->createElement('cena'));
            $cena->appendChild($dom->createTextNode($red->cena));

			$pol = $parfem->appendChild($dom->createElement('pol'));
            $pol->appendChild($dom->createTextNode($red->pol));
            $pol_naziv = $parfem->appendChild($dom->createElement('pol_naziv'));
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
	if(!isset($niz["kupac"]) || !isset($niz["parfem"])|| !isset($niz["kolicina"])){
		echo 'Nisu poslati svi podaci';
		return;
	}
	if(!validanaNarudzbina($niz["parfem"],$niz["kupac"],$niz["kolicina"])){
		echo 'Nisu validni svi podaci'; 
		return;
	}
	$db->ExecuteQuery("insert into narudzbina(kupac,parfem,kolicina) values (".$niz["kupac"].",".$niz["parfem"].",".$niz["kolicina"].")");
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
Flight::route("delete /parfem/@id",function($id){
	header("Content-Type: text/plain; charset=utf-8");
	$db = Flight::db();
	$db->ExecuteQuery("delete from parfem where id=".$id);
	if(!$db->getResult()){
		echo ''.$db->getError().'';
	}else{
		echo 'uspeh';
	}
});
Flight::start();

function validanaNarudzbina($parfem,$kupac,$kolicina){
    
    $parfem=intval(trim($parfem));
    $kupac=intval(trim($kupac));
    $kolicina=intval(trim($kolicina));
    return $parfem && $kupac && $parfem>0 && $kupac>0 && $kolicina && $kolicina>0;
}

?>
