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
  $i = 1;

  while($Tuple=$data_questions->fetch())
  {
    $no_question = $_POST['numero_question'.$i];
    //Modification du libellé de la question
    if(!empty($_POST['new_lib'.$i])) //Un nouveau libellé de question a été entré : on le modifie dans la bdd
    {
      $requete_lib = $bdd->prepare("UPDATE QUESTION SET lib_question = :lib_question WHERE no_question = $no_question ");
      $requete_lib->bindValue('lib_question',$_POST['new_lib'.$i],PDO::PARAM_STR);
      $requete_lib->execute();
    }

    //Modification de la réponse dans le cas d'une question ouverte
    if(!empty($_POST['new_reponse_ouverte'.$i]))
    {
      //On change la bonne réponse dans la base de données des questions
      $requete_quest = $bdd->prepare("UPDATE QUESTION SET bonne_rep = :bonne_rep WHERE no_question = $no_question ");
      $requete_quest->bindValue('bonne_rep',$_POST['new_reponse_ouverte'.$i],PDO::PARAM_STR);
      $requete_quest->execute();
    }

    //Modification d'une réponse dans le cas d'une question CM -> on modifie la reponse dans la bdd
    $p = 1; //Compteur de la boucle while
    while(isset($_POST['new_reponse_cm'.$i.'_'.$p]))
    {
      if(!empty($_POST['new_reponse_cm'.$i.'_'.$p]))
      {
        $id_rep = $_POST['id_rep'.$i.'_'.$p];
        $requete_rep = $bdd->prepare("UPDATE REPONSE SET lib_rep = :lib_rep WHERE no_rep = $id_rep");
        $requete_rep->bindValue('lib_rep',$_POST['new_reponse_cm'.$i.'_'.$p],PDO::PARAM_STR);
        $requete_rep->execute();
      }
      $p++;
    }

    //Modification de la bonne réponse dans le cas d'une question à CM
    if(isset($_POST['bonne_reponse_cm'.$i]) and ($_POST['bonne_reponse_cm'.$i]!="0"))
    {
      $requete_quest = $bdd->prepare("UPDATE QUESTION SET bonne_rep = :bonne_rep WHERE no_question = $no_question ");
      $num_sous_bonne_rep = $_POST['bonne_reponse_cm'.$i];
      if(empty($_POST['new_reponse_cm'.$i.'_'.$num_sous_bonne_rep]))
      {
        $requete_quest->bindValue('bonne_rep',$_POST['lib_reponse_cm'.$i.'_'.$num_sous_bonne_rep],PDO::PARAM_STR);
      }
      else
      {
        $requete_quest->bindValue('bonne_rep',$_POST['new_reponse_cm'.$i.'_'.$num_sous_bonne_rep],PDO::PARAM_STR);
      }
      $requete_quest->execute();
    }
    $i++; //Incrémentation du compteur
  }

  ?>
   <p>Votre questionnaire a bien été modifié !</p>
   <br>
   <a href="index.php">Revenir à la page pricipale.</a>


  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
