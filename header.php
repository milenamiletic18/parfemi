<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <a class="navbar-brand" href="index.php"><img src='./img/logo.png' class="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">
              O nama
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="katalog.php">Katalog</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a href="login.php">Login</a>
        </form>
        <form class="form-inline my-2 my-lg-0">
          <a href="korpa.php"><img src='./img/korpa.png' class="logo"></a>
        </form>
        <form class="form-inline my-2 my-lg-0">

          <a href="logout"><img src='./img/logout.png' class="logo" hidden=<?php echo !isset($_SESSION["korisnik"]) ?>></a>
        </form>
      </div>
    </nav>
  </div>