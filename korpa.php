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
    <title>KORPA</title>
</head>

<body class="pozadina">
    <?php include "header.php" ?>

    <div class="container polje">
        <div class="row">
            <br>
            <br>
            <div class="col-2"></div>
            <div class="col-8 polje">
                <h3>Proizvodi u vašoj korpi:</h3>
            </div>
            <div class="col-2"></div>
            <br>
            <br>

        </div>
        <br><br><br>
        <div class="row">
            <div id="narudzbine" class="col-8">
                <hr>


                <br>
                <hr>
                <br>
                <br>
            </div>
            <div class="col-4">
                <div class="odeljak">
                    <h4>Račun:</h4>
                    <hr>
                    <p id="ukupno"></p>

                    <button id="poruci" class="form-control dugme">Poruči</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            napuniNarudzbine();
            $("#poruci").click(function () {
                $.post("./server/promeniNarudzbinu.php", { akcija: "poruci" }, function (data) {
                    if (data !== "uspeh")
                        alert(data);
                    izracunajUkupno();
                    napuniNarudzbine();
                })
            })
        })
        function napuniNarudzbine() {
            $.getJSON("./server/narudzbine.php", function (data) {

                if (data.greska) {
                    alert(data.greska);
                    return;
                }
                let i = 0;
                let suma = 0;
                $("#narudzbine").html("<hr>");
                for (let narudzbina of data) {
                    suma += narudzbina.cena * narudzbina.kolicina;
                    $("#narudzbine").append(`
                    <div class="row odeljak">
                    <div class="col-1">
                        <p>${++i}.</p>
                    </div>
                    <div class="col-3">
                        <p>${narudzbina.naziv}</p>
                    </div>
                    <div class="col-3">
                        <p><input type="number" id=${i}-narudzbina value=${narudzbina.kolicina} style="max-width:50px;">  kom.</p>
                    </div>
                    <div class="col-3">
                        <p>${narudzbina.cena} din.</p>
                    </div>
                    <div class="col-2">
                        <button id=${i}-obrisi class="btn btn-danger">X</button class="btn btn-danger">
                    </div>
                </div>
                    `);
                    $(`#${i}-obrisi`).click(function () {

                        $.post("./server/promeniNarudzbinu.php", { akcija: "obrisi", sminka: narudzbina.sminka }, function (data) {
                            if (data !== "uspeh")
                                alert(data);
                            izracunajUkupno();
                            napuniNarudzbine();
                        })
                    })
                    $(`#${i}-narudzbina`).change(function (e) {

                        let kol = $(`#${i}-narudzbina`).val();
                        $.post("./server/promeniNarudzbinu.php", { akcija: "promeni", sminka: narudzbina.sminka, kolicina: kol }, function (data) {
                            if (data !== "uspeh")
                                alert(data);
                            izracunajUkupno();
                        })
                    })
                }

                $("#ukupno").html(`Suma: ${suma} din`);
            })
        }

        function izracunajUkupno() {
            $.getJSON("./server/narudzbine.php", function (data) {
                if (data.greska) {
                    alert(data.greska);
                    return;
                }
                let suma = 0;
                for (let narudzbina of data) {
                    suma += narudzbina.cena * narudzbina.kolicina;
                }
                $("#ukupno").html(`Suma: ${suma} din`);

            })
        }
    </script>
</body>

</html>