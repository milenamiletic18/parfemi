<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Katalog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
                    <h3>U ponudi posedujemo sledece artikle:</h3>
                </div>
                <div class="col-2"></div>
                <br>
                <br>
                
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-4">
                <div class="kartica">    
                <img src="./img/logo.png" height="140px;" width="140px;" >
                <br>
                <br>
                <h4>Shalimar</h4>
                <br>
                <br>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-8 cena"><p>3990.00 din.</p></div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <button class="form-control dugme">Dodaj u korpu</button>
                    </div>
                    <div class="col-2"></div>
                    
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?> 
</body>
</html>