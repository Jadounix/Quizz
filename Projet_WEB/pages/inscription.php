<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <?php include '../lib/bootstrap_header.php'; ?>
    <link rel="stylesheet" href="../css/style_inscription.css">
  </head>
  <body>
    <?php include '../includes/menu_connexion.php'; ?>

    <h1>S'inscrire à QuizLand !</h1>
    <form class="bloc" action="ajout_membre.php" method="POST">
      <div class="row">
        <div class="form-group col-sm-6">
          <label for="name" class="h4">Choisissez un login :</label>
          <input type="text" class="zone_saisie" name="login_entre" placeholder="Votre login" required>
        </div>
        <div class="form-group col-sm-6">
          <label for="password" class="h4">Choisissez un mot de passe (chiffres uniquement) :</label>
          <input type="password" name="pass_entre" placeholder="Votre mot de passe" required>
        </div>
        <div class="form-group col-sm-6">
          <label for="Statut">Choisissez votre statut :</label>
          <br>
          <input class="radio" type="radio" name="statutA" id="Administrateur">
          <label class="radio" for="ad">Administrateur</label>
          <br>
          <input class="radio" type="radio" name="statutJ" id="Joueur">
          <label class="radio" for="joueur">Joueur</label>
        </div>
      </div><br/><br/>
      <button type="submit" name="connexion"  class="bouton">Valider</button>
      <br/>
  </form>
  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
