<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="pozadina">
<?php include "header.php" ?>
      
    <div class="container polje">
        <div class="row">
                <br>
                <br>
                <div class="col-2"></div>
                <div class="col-8 polje">
                    <h3>Proizvodi u vasoj korpi:</h3>
                </div>
                <div class="col-2"></div>
                <br>
                <br>
                
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-8">
                <hr>
                <div class="row odeljak">
                    <div class="col-2"> 
                        <p>1.</p>
                    </div>
                    <div class="col-4"> 
                        <p>Gucci martos</p>
                    </div>
                    <div class="col-3"> 
                        <p>2 kom.</p>
                    </div>
                    <div class="col-3"> 
                        <p>5000.00 din.</p>
                    </div>
                </div>
                <div class="row odeljak">
                    <div class="col-2"> 
                        <p>2.</p>
                    </div>
                    <div class="col-4"> 
                        <p>Gucci martos</p>
                    </div>
                    <div class="col-3"> 
                        <p>2 kom.</p>
                    </div>
                    <div class="col-3"> 
                        <p>5000.00 din.</p>
                    </div>
                </div>
                <div class="row odeljak">
                    <div class="col-2"> 
                        <p>3.</p>
                    </div>
                    <div class="col-4"> 
                        <p>Gucci martos</p>
                    </div>
                    <div class="col-3"> 
                        <p>2 kom.</p>
                    </div>
                    <div class="col-3"> 
                        <p>5000.00 din.</p>
                    </div>
                </div>
                <div class="row odeljak">
                    <div class="col-2"> 
                        <p>4.</p>
                    </div>
                    <div class="col-4"> 
                        <p>Gucci martos</p>
                    </div>
                    <div class="col-3"> 
                        <p>2 kom.</p>
                    </div>
                    <div class="col-3"> 
                        <p>5000.00 din.</p>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <br>
            </div>
            <div class="col-4">
                <div class="odeljak">
                    <h4>Racun:</h4>
                    <hr>
                    <p>Suma: 20000.00 din</p>
                    <p>PDV: 3400.00 din</p>
                    <p>Dostava: 170.00 din</p>
                    <hr>
                    <p>Total: 23570.00 din</p>
                    <button class="form-control dugme">Poruci</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>
</html>