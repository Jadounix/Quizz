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

  <?php

  require("../bdd/connect.php");

  $nouvLog = $_POST['login_entre'];
  $nouvMdp = $_POST['pass_entre'];

  $log = 0; //Variable qui vaut 0 si le login est libre, 1 sinon

  //On veut vérifier que le login n'est pas déjà dans une base de données
  $reqJoueur = 'SELECT login_joueur FROM JOUEUR';
  $dataJoueur = $bdd->query($reqJoueur);
  while($TupleJoueur=$dataJoueur->fetch())
  {
    if($TupleJoueur['login_joueur']==$nouvLog)
    {
      $log = 1;
    }
  }

  $reqAd = 'SELECT login_ad FROM ADMIN';
  $dataAd = $bdd->query($reqAd);
  while($TupleAd=$dataAd->fetch())
  {
    if($TupleAd['login_ad']==$nouvLog)
    {
      $log = 1;
    }
  }

  if(isset($_POST['statutA']) and $log==0)
  {
    //La personne est un JOUEUR -> A jout à la base de données
    $requete = $bdd->prepare("INSERT INTO JOUEUR(login_joueur,mdp_joueur) VALUES (:login,:mdp)");
    $requete->bindValue('login',$nouvLog,PDO::PARAM_STR);
    $requete->bindValue('mdp',$nouvMdp,PDO::PARAM_INT);
    $requete->execute();
    echo 'Vous avez bien été inscrit ! Vous pouvez désormais vous connecter.';
  }
  elseif (isset($_POST['statutJ']) and $log==0)
  {
    //La personne est ADMIN -> A jout à la base de données
    $requete = $bdd->prepare("INSERT INTO ADMIN(login_ad,mdp_ad) VALUES (:login,:mdp)");
    $requete->bindValue('login',$nouvLog,PDO::PARAM_STR);
    $requete->bindValue('mdp',$nouvMdp,PDO::PARAM_INT);
    $requete->execute();
    echo 'Vous avez bien été inscrit ! Vous pouvez désormais vous connecter.';
  }
  else
  {
    echo "Vous n'avez pas choisi de statut, ou le login choisi a déjà été utilisé.";
  }
  echo "<br/>";
  echo '<a class="lien" href="inscription.php">➔ Revenir à la page précédente.</a>';
   ?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
