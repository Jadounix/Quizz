<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Déconnexion</title>
    <?php include '../lib/bootstrap_header.php'; ?>
  </head>
  <body>
    <?php include '../includes/menu_connexion.php'; ?>

    <!-- Destruction des identifiants enregristrés dans les variables de SESSION -->
    <?php
    $_SESSION = array();
    session_destroy();
    ?>

    <h4>Vous avez bien été déconnecté !</h4>
    <br/>
    <a class="lien" href="index.php">➔ Revenir à la page principale.</a>

    <?php include '../includes/footer.php'; ?>
    <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
