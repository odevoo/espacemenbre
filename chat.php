<?php require "inc/header.php"; ?>


<div id="messages">
  <!-- les messages du tchat -->
</div>

<form method="POST" action="traitement.php">
  <div class="form-group">
    <input type="text" class="form-control" name="message" id="message"></input>
    <input class="btn btn-primary" type="submit" name="submit" value="Envoyez votre message !" id="envoi" />
  </div>

</form>


<?php require "inc/footer.php"; ?>
