<?php


class Broker{
    
    private $mysqli;
    private $rezultat;
    private static $instance;

    private function __construct(){
        $this->mysqli=new mysqli("localhost","root","","sminka");

    }
    public static function getBroker(){
        if(!isset($instance)){
            $instance=new Broker();
        }
        return $instance;
    }
    public function izvrsi($upit){
        $this->rezultat=$this->mysqli->query($upit);
       
    }
    public function getRezultat()
    {
        return $this->rezultat;
    }
    public function getError()
    {
        return $this->mysqli->error;
    }
}


?>