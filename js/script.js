$('#envoi').click(function(e){
  e.preventDefault(); // on empêche le bouton d'envoyer le formulaire

  //var pseudo = encodeURIComponent( $('#pseudo').val() ); // on sécurise les données
  var message = encodeURIComponent( $('#message').val() );

  if(message !== ""){ // on vérifie que les variables ne sont pas vides
    $.ajax({
      url : "traitement.php", // on donne l'URL du fichier de traitement
      type : "POST", // la requête est de type POST
      data : "&message=" + message
      //data : "pseudo=" + pseudo + "&message=" + message // et on envoie nos données
    });
    $('#messages').append("<p>" + message + "</p>");
    //$('#messages').append("<p>" + pseudo + " dit : " + message + "</p>"); // on ajoute le message dans la zone prévue
  }
});
