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

  <?php

  require("../bdd/connect.php");

  //Infos rentrées par l'utilisateur
  $nouvLog = $_POST['login_entre'];
  $nouvMdp = $_POST['pass_entre'];

  $log = 0; //Variable qui vaut 0 si le login est libre, 1 sinon

  //On veut vérifier que le login n'est pas déjà dans une base de données
  //On parcourt la bdd des joueurs
  $reqJoueur = 'SELECT login_joueur FROM JOUEUR';
  $dataJoueur = $bdd->query($reqJoueur);
  while($TupleJoueur=$dataJoueur->fetch())
  {
    if($TupleJoueur['login_joueur']==$nouvLog)
    {
      //Le login est déjà utilisé : la variable vaut 1
      $log = 1;
    }
  }
  //On parcourt la bdd des admins
  $reqAd = 'SELECT login_ad FROM ADMIN';
  $dataAd = $bdd->query($reqAd);
  while($TupleAd=$dataAd->fetch())
  {
    if($TupleAd['login_ad']==$nouvLog)
    {
      //Le login est déjà utilisé : la variable vaut 1
      $log = 1;
    }
  }

  //Le login n'a pas été utilisé donc log vaut 0
  //$_POST['statutJ'] existe, donc la personne a choisi d'être joueur
  if(isset($_POST['statutJ']) and $log == 0)
  {
    //Ajout à la base de données
    $requete = $bdd->prepare("INSERT INTO JOUEUR(login_joueur,mdp_joueur) VALUES (:login,:mdp)");
    $requete->bindValue('login',$nouvLog,PDO::PARAM_STR);
    $requete->bindValue('mdp',$nouvMdp,PDO::PARAM_INT);
    $requete->execute();
    echo 'Vous avez bien été inscrit ! Vous pouvez désormais vous connecter.';
  }
  //$_POST['statutA'] existe, donc la personne a choisi d'être joueur
  elseif (isset($_POST['statutA']) and $log == 0)
  {
    //Ajout à la base de données
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
  ?>
  <br/>
  <a class="lien" href="inscription.php">➔ Revenir à la page précédente.</a>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
