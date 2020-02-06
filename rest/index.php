<?php
require 'flight/Flight.php';
require 'jsonindent.php';
//registracija baze Database
Flight::register('db', 'Database', array('baza_biblioteka'));

Flight::route('/', function(){
	die("Izabereti neku od ruta...");
});
//postavljanje metode pristupa,
//fajl kome se pristupa i 
//funkciju koja ce se izvrsiti tom prilikom
Flight::route('GET /biblioteka',function(){
    //postavljanje HTTP hedera
    //servis vraca podatke u JSON formatu
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
    //baza izvrsava dati upit i 
    //smesta ga u svoj atribut result
	$db->ExecuteQuery("select * from biblioteka");

	$niz =  [];
	while ($red = $db->getResult()->fetch_object())
	{
		array_push($niz,$red);
	}
    //salje podatke klijentu
	echo indent(json_encode($niz));
});
Flight::route('GET /biblioteka/@id',function($id){
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
    $db->ExecuteQuery("select * from biblioteka where id=".$id);
    
    $red = $db->getResult()->fetch_object();
	echo indent(json_encode($red));
});
Flight::route('GET /biblioteka/@id/knjige',function($id){
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
	$db->ExecuteQuery("select k.*, bk.broj_primeraka as 'brojPrimeraka' from knjiga k inner join biblioteka_knjiga bk on (k.id=bk.knjiga)  where bk.biblioteka=".$id);

	$niz =  [];
	while ($red = $db->getResult()->fetch_object())
	{
		array_push($niz,$red);
	}

	echo indent(json_encode($niz));
});

Flight::route('POST /biblioteka',function(){
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
    //prima body parametre
    $podaci = file_get_contents('php://input');
    //pretvara JSON tekst 
    //u asocijativni niz
    $niz = json_decode($podaci,true);
    if(isset($niz["naziv"]) && isset($niz["adresa"])){
        $db->ExecuteQuery("insert INTO bibiloteka(naziv,adresa) VALUES ('".$niz["naziv"]."','".$niz["adresa"]."')");
    }else{
        echo "Losi ulazni parametri";
    }
    echo ($db->getResult())?"uspeh":"greska";
	
});
Flight::route('PUT /biblioteka/@id',function($id){
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
    $podaci = file_get_contents('php://input');
    $niz = json_decode($podaci,true);
    $flag=0;
    if(isset($niz["naziv"]) ){
        $flag=1;
        $db->ExecuteQuery("update biblioteka SET naziv='".$niz["naziv"]."' WHERE id=".$id);
    }if(isset($niz["adresa"])){
        $flag=1;
        $db->ExecuteQuery("update biblioteka SET adresa='".$niz["adresa"]."' where id=".$id);
    }
    if($flag==0){
        echo "Losi ulazni parametri";
        return;
    }
    echo ($db->getResult())?"uspeh":"greska";
	
});
Flight::route('delete /biblioteka/@id',function($id){
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->ExecuteQuery("DELETE FROM biblioteka WHERE id=".$id);

    echo ($db->getResult())?"uspeh":"greska";
});


Flight::route('GET /knjiga',function(){
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
	$db->ExecuteQuery("select k.*, kat.naziv as 'kategorija_naziv' from knjiga k inner join kategorija_knjige kat on (kat.id=k.kategorija)");

	$niz =  [];
	while ($red = $db->getResult()->fetch_object())
	{
		array_push($niz,$red);
	}

	echo indent(json_encode($niz));
});
Flight::route('GET /knjiga/@id',function($id){
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
	$db->ExecuteQuery("select k.*, kat.naziv as 'kategorija_naziv' from knjiga k inner join kategorija_knjige kat on (kat.id=k.kategorija) where k.id=".$id);

	$red = $db->getResult()->fetch_object();
	echo indent(json_encode($red));
});

Flight::route('POST /knjiga',function(){
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
    $podaci = file_get_contents('php://input');
    $niz = json_decode($podaci,true);
    
    if(isset($niz["naziv"]) && isset($niz["kategorija"])&& isset($niz["broj_strana"])){
        $db->ExecuteQuery("insert INTO knjiga (naziv,kategorija,broj_strana) VALUES ('".$niz["naziv"]."',".$niz["kategorija"].",".$niz["broj_strana"].")");
    }else{
        echo "Losi ulazni parametri";
    }
    echo ($db->getResult())?"uspeh":"greska";
	
});
Flight::route('PUT /knjiga/@id',function($id){
    header("Content-Type: application/json; charset=utf-8");    
    $db = Flight::db();
    $podaci = file_get_contents('php://input');
    $niz = json_decode($podaci,true);
    $flag=0;
    if(isset($niz["naziv"]) ){
        $flag=1;
        $db->ExecuteQuery("update knjiga SET naziv='".$niz["naziv"]."' WHERE id=".$id);
    }if(isset($niz["kategorija"])){
        $flag=1;
        $db->ExecuteQuery("update knjiga SET kategorija=".$niz["kategorija"]." where id=".$id);
    }
    if(isset($niz["kategorija"])){
        $flag=1;
        $db->ExecuteQuery("update knjiga SET broj_strana=".$niz["broj_strana"]." where id=".$id);
    }
    if($flag==0){
        echo "Losi ulazni parametri";
        return;
    }
    echo ($db->getResult())?"uspeh":"greska";
	
});
Flight::route('delete /knjiga/@id',function($id){
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->ExecuteQuery("DELETE FROM knjiga WHERE id=".$id);

    echo ($db->getResult())?"uspeh":"greska";
});



Flight::start();
?>
