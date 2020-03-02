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
  $nouvLog = $_POST['login_entre'];
  $nouvMdp = $_POST['pass_entre'];

  require("../bdd/connect.php");

  if(empty($_POST['statutA']))
  {
    //La personne est un JOUEUR -> A jout à la base de données
    $requete = $bdd->prepare("INSERT INTO JOUEUR(login_joueur,mdp_joueur) VALUES (:login,:mdp)");
    $requete->bindValue('login',$nouvLog,PDO::PARAM_STR);
    $requete->bindValue('mdp',$nouvMdp,PDO::PARAM_INT);
    echo 'Vous avez bien été inscrit ! Vous pouvez désormais vous connecter.';
  }
  elseif (empty($_POST['statutJ']))
  {
    //La personne est ADMIN -> A jout à la base de données
    $requete = $bdd->prepare("INSERT INTO ADMIN(login_ad,mdp_ad) VALUES (:login,:mdp)");
    $requete->bindValue('login',$nouvLog,PDO::PARAM_STR);
    $requete->bindValue('mdp',$nouvMdp,PDO::PARAM_INT);
    echo 'Vous avez bien été inscrit ! Vous pouvez désormais vous connecter.';
  }
  else
  {
    echo 'Erreur dans le choix du statut lors de son inscription';
  }
  $requete->execute();
   ?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
