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


  require("../bdd/connect.php");

  //On recherche les questions qui correspondent au quiz dont le numero a été envoyé
  $numero_quiz = $_POST['numero_quiz'];
  $req_questions = "SELECT * FROM QUESTION WHERE no_quiz = $numero_quiz ";
  $data_questions = $bdd->query($req_questions);

  //Compteur
  $i = 0;

  while($Tuple=$data_questions->fetch())
  {
    // Ajout des questions à la base de données
    if(!empty($_POST['new_lib'.$i])) //Un nouveau libellé de question a été entré : on le modifie dans la bdd
    {
      $no_question = $_POST['numero_question'.$i];
      $requete_lib = $bdd->prepare("UPDATE QUESTION SET lib_question = :lib_question WHERE no_question = $no_question ");
      $requete_lib->bindValue('lib_question',$_POST['new_lib'.$i],PDO::PARAM_STR);
      $requete_lib->execute();
    }

    if(!empty($_POST['new_reponse_ouverte'.$i])) //Une nouvelle réponse a été entrée sur une question ouverte
    {
      //On change la bonne réponse dans la base de données des questions
      $requete_quest = $bdd->prepare("UPDATE QUESTION SET bonne_rep = :bonne_rep WHERE no_question = $no_question ");
      $requete_quest->bindValue('bonne_rep',$_POST['new_reponse_ouverte'.$i],PDO::PARAM_STR);
      $requete_quest->execute();
    }

    if(!empty($_POST['new_reponse_cm'.$i])) //Une nouvelle réponse a été entrée sur une question à choix multiple
    {
      $requete_rep->bindValue('lib_rep',$_POST['new_reponse_cm'.$i],PDO::PARAM_STR);
      $requete_rep->execute();
    }

    if(!empty($_POST['bonne_reponse_cm'.$i])) //Une nouvelle bonne réponse a été entrée sur une question à choix multiple : on la entre dans la bdd des questions
    {
      $requete_quest = $bdd->prepare("UPDATE QUESTION SET bonne_rep = :bonne_rep WHERE no_question = $no_question ");
      if($_POST['bonne_reponse_cm'.$i]==1)
      {
        $requete_quest->bindValue('bonne_rep',$_POST['bonne_reponse_cm'.$i],PDO::PARAM_STR);
        $requete_quest->execute();
      }
      elseif ($_POST['bonne_reponse_cm'.$i]==2)
      {
        $requete_quest->bindValue('bonne_rep',$_POST['bonne_reponse_cm'.$i],PDO::PARAM_STR);
        $requete_quest->execute();
      }
      else
      {
        $requete_quest->bindValue('bonne_rep',$_POST['bonne_reponse_cm'.$i],PDO::PARAM_STR);
        $requete_quest->execute();
      }


      //Vu que c'est une question à CM, on rentre aussi la réponse dans la bdd des réponses
      $requete_quest = $bdd->prepare("UPDATE REPONSE SET bonne_rep = :bonne_rep WHERE no_question = $no_question ");
      $requete_rep->bindValue('lib_rep',$_POST['new_reponse_cm'.$i],PDO::PARAM_STR);
      $requete_rep->execute();
    }
    $i++; //Incrémentation du compteur
  }

  $req_rep = 'SELECT * FROM REPONSE';
  $data_rep = $bdd->query($req_rep);


  ?>
   <p>Votre questionnaire a bien été modifié !</p>
   <br>
   <a href="index.php">Revenir à la page pricipale.</a>


  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
