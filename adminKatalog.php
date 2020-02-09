<?php 
    include "./server/prebaciNaLogin.php";
    if(!$_SESSION["korisnik"]->nazivUloge=="admin"){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Katalog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="pozadina">
    <?php include "header.php" ?>

    <div class="container polje">
        <div class="row">
            <br>
            <br>
            <div class="col-2"></div>
            <div class="col-8 polje">
                <h3>U ponudi imate sledece artikle:</h3>
            </div>
            <div class="col-2"></div>
            <br>
            <br>
        </div>
        <br><br><br>
        <div id="parfemiContainer" class="row">
           


        </div>
    </div>


    <?php include "footer.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            prikaziParfeme();
            $("#dodaj").click(function () {
                console.log("dodaj");
            })
        })
        function prikaziParfeme() {
            $.getJSON("http://localhost/parfemi/rest/parfem.json", function (data) {
                console.log(data);
                if (data.greska) {
                    alert(data.greska);
                    return;
                }
                $("#parfemiContainer").html("");
                for (let parfem of data) {
                    $("#parfemiContainer").append(`
                    <div class="col-4">
                <div class="kartica">
                    <img src="${(parfem.slika)?parfem.slika.substring(1):"./img/pitanje.png"}" height="140px;" width="140px;">
                    <br>
                    <br>
                    <h4>${parfem.naziv}</h4>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-8 cena">
                            <p>${parfem.cena} din.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="form-control dugme" id="${parfem.id}-obrisi" style="background-color: red;">Obrisi</button>
                        </div>
                        <div class="col-6">
                            <button class="form-control dugme" id="${parfem.id}-promeni" style="background-color: green;">Izmeni</button>
                        </div>
                    </div>
                </div>
            </div>
                    `);
                    $(`#${parfem.id}-obrisi`).click(function () {
                        console.log("dugme");
                        $.post("./server/obrisiParfem.php", { id: parfem.id }, function (data) {
                            console.log(data);
                            /*  if (data !== "uspeh") {
                                 alert(data);
                             } */
                            prikaziParfeme();
                        })
                    })
                    $(`#${parfem.id}-promeni`).click(function () {
                        window.location.assign("./parfem.php?idParfema=" + parfem.id);
                    })

                }
                $("#parfemiContainer").append(`
                <div class="col-4">
                <img id="dodaj" src="./img/add.png" class="add">
            </div>
                `);
                $(`#dodaj`).click(function () {
                    window.location.assign("./parfem.php");
                })
            })
        }
    </script>
</body>

</html>