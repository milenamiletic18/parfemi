<?php

    include "broker.php";
    $broker=Broker::getBroker();
    if(isset($_POST["uloguj"])){
        logovanje($broker);
    }else{
        if(isset($_POST["registruj"])){
            
            $broker->izvrsi("select* from korisnik where username='".$_POST["username"]."' or email='".$_POST["email"]."'");
            $rez=$broker->getRezultat();
            if(!$rez){
                echo $broker->getError();
            }else{
                $kor=$rez->fetch_object();
                if($kor){
                    echo "losi podaci";
                }else{
                    $broker->izvrsi("insert into korisnik(ime,prezime,username,email,sifra)
                         values ('".$_POST["ime"]."','".$_POST["prezime"]."','".$_POST["username"]."','".$_POST["email"]."','".$_POST["sifra"]."')");
                    $rez=$broker->getRezultat();
                    if(!$rez){
                        echo $broker->getError();
                    }else{
                       logovanje($broker);
                    }
                    
                }
            }
        }
    }
    function logovanje($broker){
        $broker->izvrsi("select k.*, u.naziv as 'nazivUloge' from korisnik k inner join uloga u on (k.uloga=u.id) where k.username='".$_POST["username"]."' and k.sifra='".$_POST["sifra"]."'");
        $rez=$broker->getRezultat();
        if(!$rez){
            echo $broker->getError();
        }else{
            $kor=$rez->fetch_object();
            if(!$kor){
                echo "losi podaci";
            }else{
                session_start();
                $_SESSION["korisnik"]=$kor;
                echo 'ok';
            }
        }
    }
?>