<?php


class Broker{
    
    private $mysqli;
    private $rezultat;
    private $poslednjaAkcija;
    private $greska;

    public function __construct(){
        $this->mysqli=new mysqli("localhost","root","","butik");

    }
    public function izvrsi($upit,$akcija){
        $this->rezultat=$this->mysqli->query($upit);
        if(!$this->rezultat){
            $this->poslednjaAkcija="greska";
            $greska=$this->mysqli->error;
        }else{
            $this->poslednjaAkcija=$akcija;
            $this->greska="";
        }
    }
    
}


?>