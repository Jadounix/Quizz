<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style_index.css">
  <title>Quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>
    <?php
    //Si on est pas connecté
    if(empty($_POST['login_entre']) and empty($_POST['pass_entre']) and empty($_SESSION['login_entre']))
    {
       include '../includes/menu_connexion.php'; ?>

      <?php
      echo 'je ne suis pas connecté sur le site';
      //AFFICHAGE DE LA PAGE
    }

    //On est dans l'état "connecté" en tant que joueur
    elseif (empty($_POST['login_entre']) and empty($_POST['pass_entre']) and !empty($_SESSION['login_entre']))
    {
       include '../includes/menu_deconnexion.php'; ?>

        <?php

        //AFFICHAGE DE LA PAGE

    }

    //On est dans l'état "connecté" en tant qu'admin
    elseif (empty($_POST['login_entre']) and empty($_POST['pass_entre']) and !empty($_SESSION['login_entre']))
    {
       include '../includes/menu_deconnexion.php'; ?>

        <?php

        //AFFICHAGE DE LA PAGE

    }

    //Si on vient ici après une première tentative de connexion
    else
    {
      require("../bdd/connect.php");
      $_SESSION['login_entre'] = $_POST['login_entre'];
      $_SESSION['pass_entre'] = $_POST['pass_entre'];
      $login_entre = $_SESSION['login_entre'];
      $pass_entre = $_SESSION['pass_entre'];

      //Base de données des joueur
      $req_joueur = 'SELECT * FROM JOUEUR';
      $data_joueur = $bdd->query($req_joueur);
      //Base de données des admins
      $req_admin = 'SELECT * FROM ADMIN';
      $data_admin = $bdd->query($req_admin);

      $co = false; //booleen qui va servir à ne pas chercher dans la base de données des admins si on est un joueur

      while ($Tuple=$data_joueur->fetch())
      {
        if($Tuple['login_joueur']==$login_entre and $Tuple['mdp_joueur']==$pass_entre)
        {
          ?>
          <?php include '../includes/menu_deconnexion.php'; ?>

          <?php
          $co = true; // je suis connecté donc pas besoin d'aller voir chez les admins

          //AFFICHAGE DE LA PAGE EN TANT QU JOUEUR
          echo 'je suis connecté en tant que joueur';
        }
      }

      if($co==false) //si je ne suis pas joueur je teste la base de données des admins
      {
        while ($Tuple=$data_admin->fetch())
        {
          if($Tuple['login_ad']==$login_entre and $Tuple['mdp_ad']==$pass_entre)
          {
            ?>
            <?php include '../includes/menu_deconnexion_ad.php'; ?>

            <?php

            //AFFICHAGE DE LA PAGE EN TANT QU'admin
            echo 'je suis connecté en tant que ad';
          }
          else
          {
            echo 'Login ou mot de passe incorrect';
          }
        }
      }






    }?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
