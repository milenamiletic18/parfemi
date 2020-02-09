<?php session_start();

  function funkcija($data){

  }
?>
<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">
              O NAMA
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="katalog.php">KATALOG</a>
          </li>
          <?php
            if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge=="admin" ){

              ?>
            <li class="nav-item">
              <a class="nav-link" href="adminKatalog.php">IZMENI KATALOG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="adminTransakcije.php">TRASAKCIJE I KORISNICI</a>
            </li>
              <?php
            }
          ?>
        </ul>
        <ul style='margin-left:50px; color:white'>
                <?php
                $url = 'api.openweathermap.org/data/2.5/weather?q=Belgrade,RS&appid=0698506360165ed4342b801d515e7a30&units=metric';
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, false);
                $curl_odgovor = curl_exec($curl);
                curl_close($curl);
                $parsiran_json = json_decode($curl_odgovor);
                echo "<li>Temperatura: " . $parsiran_json->main->temp . "°C,&nbsp</li><li>Vetar: " . $parsiran_json->wind->speed . " km/h,&nbsp</li>" . "</li><li>Vlažnost vazduha: " . $parsiran_json->main->humidity . "%</li>";
                ?>
            </ul>
        <?php
          if(!isset($_SESSION["korisnik"])){
            ?>
              <form class="form-inline my-2 my-lg-0">
              <a href="login.php" >Login</a>
            </form>

            <?php

          }else{
            ?>
            <form class="form-inline my-2 my-lg-0">
              <a href="korpa.php"  ><img src='./img/korpa.png' class="logo"></a>
            </form>
            <form class="form-inline my-2 my-lg-0">
              <a href="./server/logout.php"><img src='./img/logout.png' class="logo" ></a>
            </form>
            <?php
          }


        ?>
        
        
      </div>
    </nav>
  </div>