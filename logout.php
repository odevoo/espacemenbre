<?php
// quand l'utilisateur clique sur "logout" on ajoute un message dans "flas" et on redirige sur login
session_start();
// ON DETRUIT LE COOKIE
setcookie('remenber', NULL, -1);
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';
header('location: login.php');
