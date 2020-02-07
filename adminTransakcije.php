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

<body class="pozadina">
    <?php include "header.php" ?>

    <div class="container polje">
        <br><br>
        <div class="odeljak">
            <img src="./img/pitanje.png" height="200px" width="200px">
        </div>


        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <button id="prikaziTransakcije">
                            Protekle transakcije
                        </button>
                    </li>
                    <button id="prikaziKorisnike">
                        Spisak korisnika
                    </button>
                </ul>
            </div>
        </nav>

        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="row" id="transakcije">
            <div class="row transakcija">
                <div class="col-2">
                    <p>1.</p>
                </div>
                <div class="col-3">
                    <p>20-01-2019</p>
                </div>
                <div class="col-4">
                    <p>milena97@gmail.com</p>
                </div>
                <div class="col-3">
                    <p><b>34570.00 din.</b></p>
                </div>
            </div>
            <div class="row transakcija">
                <div class="col-2">
                    <p>1.</p>
                </div>
                <div class="col-3">
                    <p>20-01-2019</p>
                </div>
                <div class="col-4">
                    <p>milena97@gmail.com</p>
                </div>
                <div class="col-3">
                    <p><b>34570.00 din.</b></p>
                </div>
            </div>
            <div class="row transakcija">
                <div class="col-2">
                    <p>1.</p>
                </div>
                <div class="col-3">
                    <p>20-01-2019</p>
                </div>
                <div class="col-4">
                    <p>milena97@gmail.com</p>
                </div>
                <div class="col-3">
                    <p><b>34570.00 din.</b></p>
                </div>
            </div>
            <div class="row transakcija">
                <div class="col-2">
                    <p>1.</p>
                </div>
                <div class="col-3">
                    <p>20-01-2019</p>
                </div>
                <div class="col-4">
                    <p>milena97@gmail.com</p>
                </div>
                <div class="col-3">
                    <p><b>34570.00 din.</b></p>
                </div>
            </div>
        </div>
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="row" id="korisnici" hidden="true">
            <div class="row korisnici">
                <div class="col-2">
                    <p>1.</p>
                </div>
                <div class="col-3">
                    <p>Milena Miletic</p>
                </div>
                <div class="col-4">
                    <p>061/6202600</p>
                </div>
                <div class="col-3">
                    <p>milena97@gmail.com</p>
                </div>
            </div>
            <div class="row korisnici">
                <div class="col-2">
                    <p>1.</p>
                </div>
                <div class="col-3">
                    <p>Milena Miletic</p>
                </div>
                <div class="col-4">
                    <p>061/6202600</p>
                </div>
                <div class="col-3">
                    <p>milena97@gmail.com</p>
                </div>
            </div>
            <div class="row korisnici">
                <div class="col-2">
                    <p>1.</p>
                </div>
                <div class="col-3">
                    <p>Milena Miletic</p>
                </div>
                <div class="col-4">
                    <p>061/6202600</p>
                </div>
                <div class="col-3">
                    <p>milena97@gmail.com</p>
                </div>
            </div>
            <div class="row korisnici">
                <div class="col-2">
                    <p>1.</p>
                </div>
                <div class="col-3">
                    <p>Milena Miletic</p>
                </div>
                <div class="col-4">
                    <p>061/6202600</p>
                </div>
                <div class="col-3">
                    <p>milena97@gmail.com</p>
                </div>
            </div>
        </div>
        <?php include "footer.php" ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#prikaziTransakcije").click(function () {
                    $("#transakcije").attr("hidden", false);
                    $("#korisnici").attr("hidden", true);
                })
                $("#prikaziKorisnike").click(function () {
                    $("#transakcije").attr("hidden", true);
                    $("#korisnici").attr("hidden", false);
                })
            })

        </script>
    </div>
</body>

</html>