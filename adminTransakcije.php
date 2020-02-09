<?php 
    include "./server/prebaciNaLogin.php";
    if($_SESSION["korisnik"]->nazivUloge!="admin"){
        header("location:index.php");
    }
    include "./server/broker.php";
    $broker=Broker::getBroker();
    $broker->izvrsi("select k.* from korisnik k inner join uloga u on (k.uloga=u.id) where not u.naziv='admin'");
    $rez=$broker->getRezultat();
    if(!$rez){
        echo $broker->getError();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>adminTransakcije</title>
</head>

<body class="pozadina">
    <?php include "header.php" ?>

    <div class="container polje">
        <br><br>
       

        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <button id="prikaziTransakcije">
                        PROTEKLE TRANSAKCIJE
                        </button>
                    </li>
                    <button id="prikaziKorisnike">
                        SPISAK KORISNIKA
                    </button>
                </ul>
            </div>
        </nav>

        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="row" id="transakcije">

        </div>
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div  id="korisnici" hidden="true">
            <table class="table display" id="korisniciTabela">
            <thead>
                <th>ID</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>E-mail</th>
                <th>Username</th>
                </thead>
                <tbody>
                    <?php
                        if($rez){
                            while($row=$rez->fetch_object()){
                                ?>
                                <tr id="<?php echo $row->id;?>">
                                <td><?php echo $row->id;?></td>
                                    <td><?php echo $row->ime;?></td>
                                    <td><?php echo $row->prezime;?></td>
                                    <td><?php echo $row->email;?></td>
                                    <td><?php echo $row->username;?></td>
                                </tr>
                                <?php
                            }
                        }

                    ?>


                </tbody>
            </table>
        </div>
        <?php include "footer.php" ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="DataTables-1.10.4/media/js/jquery.dataTables.min.js"></script>
    <script src="./jeditable/jquery.jeditable.js"></script>
        <script>
            $(document).ready(function () {
                napuniTransakcije();
                napraviTabelu();
                $("#prikaziTransakcije").click(function () {
                    $("#transakcije").attr("hidden", false);
                    $("#korisnici").attr("hidden", true);
                })
                $("#prikaziKorisnike").click(function () {
                    $("#transakcije").attr("hidden", true);
                    $("#korisnici").attr("hidden", false);
                })
            })
            function napuniTransakcije() {
                $.getJSON("./server/transakcije.php", function (data) {
                    if (data.greska) {
                        alert(data.greska);
                        return;
                    }
                    let i = 0;
                    $("#transakcije").html(`
                        <div class="row transakcija">
                <div class="col-2">
                    <p>Rb.</p>
                </div>
                <div class="col-3">
                    <p>E mail</p>
                </div>
                <div class="col-4">
                    <p>Username</p>
                </div>
                <div class="col-3">
                    <p><b>Suma</b></p>
                </div>
            </div>
                        `);
                    for (let transakcija of data) {
                        $("#transakcije").append(`
                        <div class="row transakcija">
                <div class="col-2">
                    <p>${++i}.</p>
                </div>
                <div class="col-3">
                    <p>${transakcija.email}</p>
                </div>
                <div class="col-4">
                    <p>${transakcija.username}</p>
                </div>
                <div class="col-3">
                    <p><b>${transakcija.ukupno}</b></p>
                </div>
            </div>
                        `)
                    }
                })
            }
            function napraviTabelu() {
                $("#korisniciTabela").dataTable({
                    "language": {
                        "url": "DataTables-1.10.4/i18n/serbian.json"
                    },
                })
            }
        </script>
    </div>
</body>

</html>