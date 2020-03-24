<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <?php include '../lib/bootstrap_header.php'; ?>
  </head>
  <body>
    <?php include '../includes/menu_connexion.php'; ?>

    <h1>S'inscrire à QuizLand !</h1>
    <form class="bloc" action="ajout_membre.php" method="POST">
      <div class="row">
        <div class="form-group col-sm-6">
          <label for="name"><strong>Choisissez un login :</strong></label>
          <input type="text" class="form-control" name="login_entre" placeholder="Votre login" required>
        </div>
        <div class="form-group col-sm-6">
          <label for="password"><strong>Choisissez un mot de passe (chiffres uniquement) :</strong></label>
          <input type="password" class="form-control" name="pass_entre" placeholder="Votre mot de passe" required>
        </div></div>
        <div>
          <label for="Statut"><strong>Choisissez votre statut :</strong></label>
          <br/>
          <input class="radio" type="radio" name="statutA" id="Administrateur">
          <label class="radio" for="ad">Administrateur</label>
          <br/>
          <input class="radio" type="radio" name="statutJ" id="Joueur">
          <label class="radio" for="joueur">Joueur</label>
        </div>

      <div class="bloc_bouton">
      <button type="submit" name="connexion"  class="bouton1">Valider</button>
      </div>
  </form>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
