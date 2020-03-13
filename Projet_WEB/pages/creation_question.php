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
  $nouvNoQuestion=11; //test avec 11, comment faire varier ce num ?
  $nouvLib = $_POST['lib_entre'];
  $nouvBonneRep = $_POST['bonne_rep_entre'];
  $nouvLibRep1 = $_POST['lib_rep1_entre'];
  $nouvLibRep2 = $_POST['lib_rep2_entre'];
  $nouvLibRep3 = $_POST['lib_rep3_entre'];

  require("../bdd/connect.php");


  // Ajout de la question à la base de données
  $requete = $bdd->prepare("INSERT INTO QUESTION(no_question,lib_question,bonne_rep) VALUES (:no_quest,:lib,:br)");
  $requete->bindValue('no_quest',$nouvNumQuestion,PDO::PARAM_INT);
  $requete->bindValue('lib',$nouvLib,PDO::PARAM_STR);
  $requete->bindValue('br',$nouvBonneRep,PDO::PARAM_STR);


  $requete1 = $bdd->prepare("INSERT INTO REPONSE(lib_rep) VALUES (:lib_rep1)");
  $requete1->bindValue('lib_rep1',$nouvLibRep1,PDO::PARAM_STR);
  $requete2 = $bdd->prepare("INSERT INTO REPONSE(lib_rep) VALUES (:lib_rep2)");
  $requete2->bindValue('lib_rep2',$nouvLibRep2,PDO::PARAM_STR);
  $requete3 = $bdd->prepare("INSERT INTO REPONSE(lib_rep) VALUES (:lib_rep3)");
  $requete3->bindValue('lib_rep3',$nouvLibRep3,PDO::PARAM_STR);
  echo 'Votre question a bien été enregsitrée !';

  $requete->execute();
   ?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
