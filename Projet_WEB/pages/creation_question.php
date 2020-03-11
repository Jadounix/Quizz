<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include '../lib/bootstrap_header.php'; ?>
  </head>
  <body>
  <?php include '../includes/menu_deconnexion_ad.php'; ?>

  <?php
  $nouvLib = $_POST['lib_entre'];
  $nouvBonneRep = $_POST['bonne_rep_entre'];
  $nouvLibRep = $_POST['lib_rep_entre'];

  require("../bdd/connect.php");


  // Ajout de la question à la base de données
  $requete = $bdd->prepare("INSERT INTO QUESTION(lib_question,bonne_rep) VALUES (:lib,:br)");
  $requete->bindValue('lib',$nouvLib,PDO::PARAM_STR);
  $requete->bindValue('br',$nouvBonneRep,PDO::PARAM_INT);

  $requete2 = $bdd->prepare("INSERT INTO REPONSE(lib_rep) VALUES (:lib_rep)");
  $requete2->bindValue('lib_rep',$nouvLibRep,PDO::PARAM_STR);
  echo 'Votre question a bien été enregsitrée';

  $requete->execute();
   ?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
