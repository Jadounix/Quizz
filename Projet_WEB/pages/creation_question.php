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
  $nouvLib = $_POST['lib_entre'];
  $nouvBonneRep = $_POST['choix_entre'];

  require("../bdd/connect.php");


  // Ajout de la question à la base de données
  $requete = $bdd->prepare("INSERT INTO QUESTION(lib_question,bonne_rep, type) VALUES (:login,:mdp)");
  $requete->bindValue('login',$nouvLog,PDO::PARAM_STR);
  $requete->bindValue('mdp',$nouvMdp,PDO::PARAM_INT);
  echo 'Vous avez bien été inscrit ! Vous pouvez désormais vous connecter.';

  $requete->execute();
   ?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
