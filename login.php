<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body class="pozadina">
    <?php include "header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4  forma">
                <br>
                <h2>
                    <center>Dobrodošli!</center>
                </h2>
                <br>
                <input type="text" class="form-control" placeholder="username" id="username">
                <br>
                <input type="password" class="form-control" placeholder="sifra" id="sifra">
                <br>
                <input type="text" class="form-control" placeholder="Ime" id="ime" hidden="true">
                <br>
                <input type="text" class="form-control" placeholder="Prezime" id="prezime" hidden="true">
                <br>
                <input type="text" class="form-control" placeholder="Email" id="email" hidden="true">
                <br>

                <br>
                <button class="form-control dugme" id="Login">Login</button>

                <button class="form-control dugme" id="regForma">Nemaš nalog?</button>
                <button class="form-control dugme" id="register" hidden="true">Register</button>
            </div>
            <div class="col-md-4"></div>

        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#regForma").click(function () {
                $("#ime").attr("hidden", false);
                $("#prezime").attr("hidden", false);
                $("#email").attr("hidden", false);
                $("#register").attr("hidden", false);
                $("#Login").hide();
                $("#regForma").hide();
            });
            $("#register").click(function () {
                let ime = $("#ime").val();
                let prezime = $("#prezime").val();
                let email = $("#email").val();
                let username = $("#username").val();
                let sifra = $("#sifra").val();
                $.post("./server/uloguj.php", { registruj: true, ime: ime, prezime: prezime, email: email, username: username, sifra: sifra }, function (data) {
                   
                    if (data === "ok") {
                        window.location = "http://localhost/sminka/index.php";
                    }
                })
            })
            $("#Login").click(function () {
                let username = $("#username").val();
                let sifra = $("#sifra").val();
                $.post("./server/uloguj.php", { uloguj: true, username: username, sifra: sifra }, function (data) {
                    console.log(data);
                    if (data === "ok") {
                        window.location = "http://localhost/sminka/index.php";
                    }
                })
            })

        })

    </script>
</body>

</html>