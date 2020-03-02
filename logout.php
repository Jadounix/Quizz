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

    <?php
    $_SESSION = array();
    session_destroy();
    echo 'Vous avez bien été déconnecté !';
    echo "<br/>";
    echo '<a href="index.php">Revenir à la page pricipale.</a>';
    ?>

    <?php include '../includes/footer.php'; ?>
    <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
