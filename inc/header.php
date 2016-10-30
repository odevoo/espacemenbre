
<?php
//Si il n'y a pas de $_SESSION demarrée, on n'en start une
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <title>Espace menbre</title>

  <!-- Bootstrap core CSS -->
  <link href="css/app.css" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Espace membre</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <!-- On n'affichie une navbar different en fonction de la présence ou non d'une authentification active -->
          <?php if (isset($_SESSION['auth'])): ?>
            <li><a href="logout.php">Se deconnecter</a></li>
            <li><a href="chat.php">Chat</a></li>
          <?php else: ?>
            <li class="active"><a href="register.php">S'inscrire</a></li>
            <li><a href="login.php">Se connecter</a></li>
          <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">


      <!-- AFFICHAGE DES MSG DE LA VARIABLE SESSION -->

      <?php if (isset($_SESSION['flash'])): ?>
        <?php foreach ($_SESSION['flash'] as $type => $message): ?>

          <div class="alert alert-<?= $type; ?>">
            <?= $message; ?>
          </div>

        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
      <?php endif ?>
