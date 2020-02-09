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
                <h3>U ponudi imate sledeće artikle:</h3>
            </div>
            <div class="col-2"></div>
            <br>
            <br>
        </div>
        <br><br><br>
        <div id="sminkaContainer" class="row">
           


        </div>
    </div>


    <?php include "footer.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            prikaziSminku();
            $("#dodaj").click(function () {
                console.log("dodaj");
            })
        })
        function prikaziSminku() {
            $.getJSON("http://localhost/sminka/rest/sminka.json", function (data) {
                console.log(data);
                if (data.greska) {
                    alert(data.greska);
                    return;
                }
                $("#sminkaContainer").html("");
                for (let sminka of data) {
                    $("#sminkaContainer").append(`
                    <div class="col-4">
                <div class="kartica">
                    <img src="${(sminka.slika)?sminka.slika.substring(1):"./img/pitanje.png"}" height="140px;" width="140px;">
                    <br>
                    <br>
                    <h4>${sminka.naziv}</h4>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-8 cena">
                            <p>${sminka.cena} din.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="form-control dugme" id="${sminka.id}-obrisi" style="background-color: red;">Obrisi</button>
                        </div>
                        <div class="col-6">
                            <button class="form-control dugme" id="${sminka.id}-promeni" style="background-color: green;">Izmeni</button>
                        </div>
                    </div>
                </div>
            </div>
                    `);
                    $(`#${sminka.id}-obrisi`).click(function () {
                        console.log("dugme");
                        $.post("./server/obrisiSminku.php", { id: sminka.id }, function (data) {
                            console.log(data);
                            /*  if (data !== "uspeh") {
                                 alert(data);
                             } */
                            prikaziSminku();
                        })
                    })
                    $(`#${sminka.id}-promeni`).click(function () {
                        window.location.assign("./sminka.php?idSminke=" + sminka.id);
                    })

                }
                $("#sminkaContainer").append(`
                <div class="col-4">
                <img id="dodaj" src="./img/add.png" class="add">
            </div>
                `);
                $(`#dodaj`).click(function () {
                    window.location.assign("./sminka.php");
                })
            })
        }
    </script>
</body>

</html>