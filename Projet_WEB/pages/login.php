<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <?php include '../lib/bootstrap_header.php'; ?>
    <link rel="stylesheet" href="../css/style_inscription.css">
  </head>
  <body>
    <?php include '../includes/menu_connexion.php'; ?>

    <h1>Connexion à l'espace membre</h1>
    <form class="bloc" action="index.php" method="POST">
      <div class="row">
        <div class="form-group col-sm-6">
          <label for="name" class="h4">Login :</label>
          <input type="text" class="form-control" name="login_entre" placeholder="Votre login" required>
        </div>
        <div class="form-group col-sm-6">
          <label for="password" class="h4">Mot de passe : </label>
          <input type="password" class="form-control" name="pass_entre" placeholder="Votre mot de passe" required>
        </div>
      </div>
      <button type="submit" name="connexion"  class="bouton">Valider</button>
      <br>
  </form>
  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
