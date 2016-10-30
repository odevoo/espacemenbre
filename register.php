
<?php
require_once "inc/functions.php";

session_start();
// sil il y a dees element dans la variable $_POST, on effectue les ations suivantes
if (!empty($_POST)) {
  $errors =  array();
  require_once 'inc/db.php';
  // VALIDATION DU USERNAME
  if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
    $errors['username'] = "Votre pseudo n'est pas valide";
  } else {
    $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
    $req->execute([$_POST['username']]);
    $user = $req->fetch();
    if ($user) {
      $errors['username'] = "Ce pseudo est déjà prix";
    }
  }
  //VALIDATION DE L'EMAIL

  if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Votre email n'est pas valide";
  }else {
    $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $req->execute([$_POST['email']]);
    $email = $req->fetch();
    if ($email) {
      $errors['email'] = "Cet email est déjà associé à un compte";
    }
  }
 //VALIDATION DU PASSWORD
  if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
    $errors['password'] = "Votre mot de passe n'est pas valide";
  }
 //SI PAS D'ERREUR ON CREER L4UTILISATEUR DANS LA BASE
  if (empty($errors)) {

    $req = $pdo->prepare('INSERT INTO users SET username = ?, password = ?, email= ?, confirmation_token = ?');
    // HASSHAGE DU PASSWORD
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // CREATION DU TOKEN DE 60 CARACTERE
    $token = str_random(60);
    $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
    //RECUPERATION DU DERNIER ID DE LA BASE
    $user_id = $pdo->lastInsertId();
    //ENVOI DU MAIL DE CONFIRMATION
    mail($_POST['email'], "Confirmation de votre compte', 'Afin de valider votre compte, merci de cliquer sur ce lien \n\nhttp://localhost/espacemenbre/confirm.php?id=$user_id&token=$token");
    $_SESSION['flash']['success'] = 'un email de confirmation vous a été envoyé';
    header('location: login.php');
    exit();
    // die('<div class="alert alert-success text-center"><p>Votre compte à bien été créé</p></div>');
  }

}
?>

<?php
require "inc/header.php";

;?>



<h1>S'inscire</h1>

<?php
// SI IL Y A DES ERREURS ON LES AFFICHES
if (!empty($errors)): ?>

<div class="alert alert-danger">
  <p>
    Votre forumulaire comporte des erreurs:
  </p>
  <ul>
    <?php foreach ($errors as $error):?>
      <li> <?= $error; ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<?php endif; ?>


<form class="" action="" method="post">
  <div class="form-group">
    <label for="">Pseudo</label>
    <input type="text" name="username" value="" class="form-control"  />
  </div>
  <div class="form-group">
    <label for="">Email</label>
    <input type="email" name="email" value="" class="form-control"  />
  </div>
  <div class="form-group">
    <label for="">Mot de passe</label>
    <input type="password" name="password" value="" class="form-control"  />
  </div>
  <div class="form-group">
    <label for="">Confirmer votre mot de passe</label>
    <input type="password" name="password_confirm" value="" class="form-control"  />
  </div>
  <button type="submit" class="btn btn-primary" >M'inscire</button>
</form>


<?php
require "inc/footer.php";

?>
