<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QuizCeption</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>
    <?php
    //L'utilisateur n'est pas connecté
    //$_POST['login_entre'] correspond au login que vient juste d'entrer l'utilisateur lors de sa connexion
    //$_SESSION['login_entre'] correspond au login que l'utilisateur a entré et qui a été conservé lorsqu'il navigue sur le site
    if(empty($_POST['login_entre']) and empty($_POST['pass_entre']) and empty($_SESSION['login_entre']))
    {
      //On inclue le menu correspondant
       include '../includes/menu_connexion.php'; ?>

       <h1>Bienvenue sur QuizCeption !</h1>
       <br/>
       <p class="bloc">
         Bonjour et bienvenue sur le site QuizCeption. <br><br>
         Ici vous pourrez jouer à des quiz, ou même créer votre propre quiz ! N’attendez plus et inscrivez vous !<br>
         Pour jouer à des quiz d’autres joueurs et tenter de faire les meilleurs scores possibles, inscrivez-vous en tant que joueur.
         Pour créer vos propres quiz et les faire découvrir à tous, inscrivez vous en tant qu’admin.<br><br>
         Si jamais tu es perdu, quoiqu’il arrive, le tutoriel est là pour t’aider !
      </p>

       <div class="bloc_bouton">
         <a href="login.php"> <input class="bouton1" type="button" value="Se connecter"> </a>
         <a href="inscription.php"> <input class="bouton1" type="button" value="S'inscrire"> </a>
       </div>
      <?php
    }

    /*On est dans l'état "connecté" en tant que joueur : $_POST['login_entre'] est vide car on ne vient pas de juste lancer le formulaire mais
    $_SESSION['login_entre'] n'est pas vide car on s'est déjà connecté */
    elseif (empty($_POST['login_entre']) and empty($_POST['pass_entre']) and !empty($_SESSION['login_entre']) and $_SESSION['etat']==true)
    {
       include '../includes/menu_deconnexion.php'; ?>
       <h1>Bienvenue sur QuizCeption !</h1>
       <br/>
       <p class="bloc">Bonjour et bienvenue sur le site QuizCeption. <br><br>
         Vous êtes connecté en tant que joueur, alors n'hésitez plus et partez à la conquête d’un quiz ! Vous pouvez également consulter vos scores.<br><br>
          Si jamais tu es perdu, quoiqu’il arrive, le tutoriel est là pour t’aider !
      </p>

       <div class="bloc_bouton">
         <a href="choix_quiz.php"> <input class="bouton1" type="button" value="Jouer !"> </a>
       </div>
        <?php
    }

    //On est dans l'état "connecté" en tant qu'admin (même principe que pour le joueur)
    elseif (empty($_POST['login_entre']) and empty($_POST['pass_entre']) and !empty($_SESSION['login_entre']) and $_SESSION['etat']==false)
    {
       include '../includes/menu_deconnexion_ad.php'; ?>
       <h1>Bienvenue sur QuizCeption !</h1>
       <br/>
       <p class="bloc">Bonjour et bienvenue sur le site QuizCeption. <br><br>
         Vous êtes connecté en tant qu’admin. Vous pouvez désormais créer votre propre quiz, et le faire partager à la communauté QuizCeption, alors n’attendez plus ! <br>
        Vous pouvez également modifier vos quiz déja existants.<br><br>
        Si jamais tu es perdu, quoiqu’il arrive, le tutoriel est là pour t’aider !
        </p>

       <div class="bloc_bouton">
         <a href="init_creation_quiz.php"> <input class="bouton1" type="button" value="Créer un quiz"> </a>
         <a href="voir_quiz.php"> <input class="bouton1" type="button" value="Voir mes quiz"> </a>
       </div>
        <?php
    }

    //Si on vient ici après une première tentative de connexion : le formulaire de connexion vient tout juste d'être envoyé
    else
    {
      //Connexion à la base de données
      require("../bdd/connect.php");
      //Les variables POST qui viennent d'être entrées sont affiliées à des variables SESSION pour être retenues sur tout le site
      $_SESSION['login_entre'] = $_POST['login_entre'];
      $_SESSION['pass_entre'] = $_POST['pass_entre'];
      $login_entre = $_SESSION['login_entre'];
      $pass_entre = $_SESSION['pass_entre'];

      $coJoueur = false; //booleen qui vaut false si je ne suis pas connecté en tant que joueur et true si c'est le cas

      //Base de données des joueurs
      $req_joueur = 'SELECT * FROM JOUEUR';
      $data_joueur = $bdd->query($req_joueur);
      //Base de données des admins
      $req_admin = 'SELECT * FROM ADMIN';
      $data_admin = $bdd->query($req_admin);

      while ($Tuple=$data_joueur->fetch())
      {
        if($Tuple['login_joueur']==$login_entre and $Tuple['mdp_joueur']==$pass_entre) //Dans ce cas on est joueur
        {
          ?>
          <?php include '../includes/menu_deconnexion.php'; ?>
          <h1>Bienvenue sur QuizCeption !</h1>
          <br/>
          <p class="bloc">Bonjour et bienvenue sur le site QuizCeption. <br><br>
            Vous êtes connecté en tant que joueur, alors n'hésitez plus et partez à la conquête d’un quiz ! Vous pouvez également consulter vos scores.<br><br>
             Si jamais tu es perdu, quoiqu’il arrive, le tutoriel est là pour t’aider !</p>

          <div class="bloc_bouton">
            <a href="choix_quiz.php"> <input class="bouton1" type="button" value="Jouer !"> </a>
          </div>
          <?php
          $coJoueur = true; //L'utilisateur est connecté donc pas besoin d'aller voir chez les admins
        }
      }

      $_SESSION['etat']=$coJoueur; //garde en mémoire l'état dans lequel est l'utilisateur
      $coAdmin = false; //L'utilisateur n'est pas connecté en tant qu'admin pour l'instant

      if($coJoueur==false) //si l'utilisateur n'est pas joueur on teste la base de données des admins
      {
        while ($Tuple=$data_admin->fetch()) //Parcourt de la base de données des admins
        {
          if($Tuple['login_ad']==$login_entre and $Tuple['mdp_ad']==$pass_entre)
          {
            $coAdmin = true; //L'utilisateur est un admin
          }
        }
      }
      //Affichage de la page en focntion des bool
      if($coAdmin==true)
      {
        include '../includes/menu_deconnexion_ad.php'; ?>

        <h1>Bienvenue sur QuizCeption !</h1>
        <br/>
        <p class="bloc">Bonjour et bienvenue sur le site QuizCeption. <br><br>
          Vous êtes connecté en tant qu’admin. Vous pouvez désormais créer votre propre quiz, et le faire partager à la communauté QuizCeption, alors n’attendez plus ! <br>
         Vous pouvez également modifier vos quiz déja existants.<br><br>
         Si jamais tu es perdu, quoiqu’il arrive, le tutoriel est là pour t’aider !</p>
        <div class="bloc_bouton">
          <a href="init_creation_quiz.php"> <input class="bouton1" type="button" value="Créer un quiz"> </a>
          <a href="voir_quiz.php"> <input class="bouton1" type="button" value="Voir mes quiz"> </a>
        </div>
         <?php
      }
      elseif($coAdmin==false && $coJoueur==false) //Le login ou le mot de passe correspond n'ont pas été trouvé dans la bdd
      {
        include '../includes/menu_connexion.php';
        echo 'Login ou mot de passe incorrect';
        session_destroy(); //On réinitialise les identifiants qui ont été entrés
      }

    }?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
