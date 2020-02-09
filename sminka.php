<?php 
    include "./server/prebaciNaLogin.php";
    if(!$_SESSION["korisnik"]->nazivUloge=="admin"){
        header("location:index.php");
    }
    $sminka;
    if(isset($_GET["idSminke"])){
        include "./server/broker.php";
        $broker=Broker::getBroker();
        $broker->izvrsi("select * from sminka where id=".$_GET["idSminke"]);
        $sminka= $broker->getRezultat()->fetch_object();
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
    <title>Document</title>
</head>

<body>
    <?php include "header.php";
        if(!isset($_GET["idSminke"])){
            ?>
    <div>
        <h1>Dodaj šminku</h1>
        <form class="mt-5">
            <div class="form-group">
                <input type="text" class="form-control" id="naziv" placeholder="Naziv">
            </div>

            <div class="form-group">
                <select class="form-control" id="pol">

                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" type="number" id="cena" placeholder="Cena">
            </div>
            <div class="form-group">
                <input type="file" class="form-control-file" id="slika" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" id="dodajSminku">Dodaj šminku</button>
            </div>
        </form>
    </div>

    <?php
        }else{
            ?>
    <div>
        <h1>Izmeni šminku</h1>
        <form class="mt-5">
            <div class="form-group">
                <input type="text" class="form-control" id="naziv" placeholder="Naziv"
                    value="<?php echo $sminka->naziv;?>">
            </div>

            <div class="form-group">
                <select class="form-control" id="pol">

                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" type="number" id="cena" placeholder="Cena"
                    value="<?php echo $sminka->cena;?>">
            </div>
            <div class="form-group">
                <input type="file" class="form-control-file" id="slika" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" onClick="izmeni(<?php echo $_GET["idSminke"];?>)">Izmeni šminku</button>
            </div>
        </form>
    </div>



    <?php
        }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            napuniPolove();
            $("#dodajSminku").click(function (e) {
                e.preventDefault();
                let naziv = $("#naziv").val();
                let cena = $("#cena").val();
                let pol = $("#pol").val();
                let fd = new FormData();
                let slika = $("#slika")[0].files[0];
                fd.append("slika", slika);
                fd.append("naziv", naziv);
                fd.append("cena", cena);
                fd.append("pol", pol);
                fd.append("akcija", "dodaj");
                $.ajax(
                    {

                        url: "./server/izmenaSminke.php",
                        type: 'post',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (obj, mess) {

                        }

                    }
                )
            })
        })
        function izmeni(id){
            let naziv = $("#naziv").val();
                let cena = $("#cena").val();
                let pol = $("#pol").val();
                let fd = new FormData();
                let slika = $("#slika")[0].files[0];
                fd.append("slika", slika);
                fd.append("naziv", naziv);
                fd.append("cena", cena);
                fd.append("pol", pol);
                fd.append("id", id);
                fd.append("akcija", "izmeni");
                $.ajax(
                    {

                        url: "./server/izmenaSminke.php",
                        type: 'post',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (obj, mess) {

                        }

                    }
                )
        }
        function napuniPolove() {
            $.getJSON("./server/kategorije.php", function (data) {
                console.log(data);

                if (data.greska) {
                    alert(data.greska);
                    return;
                }
                $("#pol").html("");
                for (let kat of data) {
                    $("#pol").append(`<option value="${kat.id}" >${kat.naziv}</option>`);
                }
                <?php 
                if (isset($_GET["idSminke"])) {
                    ?>
                        $("#pol").val(<?php echo $sminka->pol; ?>);
                    <?php 
                }
                ?>
            })
        }
    </script>
</body>

</html>