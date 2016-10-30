<?php

// on se connecte à notre base de données
require "inc/db.php";
require "inc/functions.php";
logged_only();

if(isset($_POST['submit'])){ // si on a envoyé des données avec le formulaire

    if(!empty($_POST['message'])){ // si les variables ne sont pas vides
        // echo "<pre>".print_r($_SESSION)."
        // </pre>";
        // echo "<pre>".$_SESSION['auth']->username."
        // </pre>";
        $pseudo = $_SESSION['auth']->username;
        $message = mysql_real_escape_string($_POST['message']); // on sécurise nos données

        //puis on entre les données en base de données :
        $req = $pdo->prepare('INSERT INTO chat VALUES("", :pseudo, :message)');
        $req->execute(array(
            'pseudo' => $pseudo,
            'message' => $message
        ));

    }
    else{
        echo "Vous avez oublié de remplir un des champs !";
    }

}
