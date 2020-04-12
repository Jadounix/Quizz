<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <?php include '../lib/bootstrap_header.php'; ?>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>
  <body>
    <?php include '../includes/menu_connexion.php'; ?>

    <h1>S'inscrire sur QuizCeption !</h1>

    <!-- Formulaire envoyé lors de l'inscription -->
    <form class="bloc1" action="ajout_membre.php" method="POST">
      <div class="row">
        <!-- Choix du login -->
        <div class="form-group col-sm-6">
          <label for="name"><strong>Choisissez un login :</strong></label>
          <input type="text" class="form-control" name="login_entre" placeholder="Votre login" required>
        </div>
        <!-- Choix du mot de passe -->
        <div class="form-group col-sm-6">
          <label for="password"><strong>Choisissez un mot de passe :</strong></label>
          <input type="password" class="form-control" name="pass_entre" placeholder="Votre mot de passe" required>
        </div></div>
        <!-- Choix du statut : Joueur ou Administrateur -->
        <div>
          <label for="Statut"><strong>Choisissez votre statut :</strong></label>
          <br/>
          <input type="radio" name="statutA" id="Administrateur">
          <label class="radio" for="ad">Administrateur</label>
          <br/>
          <input type="radio" name="statutJ" id="Joueur">
          <label class="radio" for="joueur">Joueur</label>
        </div>

      <!-- Bouton d'envoie du formulaire -->
      <div class="bloc_bouton">
      <button type="submit" name="connexion"  class="bouton1">Valider</button>
      </div>
  </form>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
