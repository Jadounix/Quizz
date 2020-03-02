<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include '../lib/bootstrap_header.php'; ?>
  </head>
  <body>
    <?php include '../includes/menu_connexion.php'; ?>

    <h1>S'inscrire à QuizLand !</h1>
    <form action="ajout_membre.php" method="POST">
      <div class="row">
        <div class="form-group col-sm-6">
          <label for="name" class="h4">Choissisez un login :</label>
          <input type="text" class="form-control" name="login_entre" placeholder="Votre login" required>
        </div>
        <div class="form-group col-sm-6">
          <label for="password" class="h4">Choissisez un mot de passe (chiffres uniquement) :</label>
          <input type="password" class="form-control" name="pass_entre" placeholder="Votre mot de passe" required>
        </div>
        <div class="form-group col-sm-6">
          <label for="Statut">Choissisez votre statut :</label>
          <br>
          <input type="radio" name="statutA" id="Administrateur">
          <label for="ad">Administrateur</label>
          <br>
          <input type="radio" name="statutJ" id="Joueur">
          <label for="joueur">Joueur</label>
        </div>
      </div>
      <button type="submit" name="connexion"  class="btn btn-success btn-lg pull-right ">Envoyer</button>
      <br>
  </form>
  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
