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

  $numero_quiz = $_POST['numero_quiz'];

  //Acces à la base de données des quiz
  require("../bdd/connect.php");

  // Ajout des questions à la base de données
   for($i=1;$i<=$_POST['nb_questions_entre'];$i++)
   {
     $requete_quest = $bdd->prepare("INSERT INTO QUESTION(lib_question,bonne_rep) VALUES (:lib_question,:bonne_rep)");
     $requete_rep = $bdd->prepare("INSERT INTO REPONSE(lib_rep) VALUES (:lib_rep)");

     $requete = $bdd->prepare("UPDATE QUESTION SET ville = :ville WHERE id=:id"))
      $requete->bindValue('id',$lid , PDO::PARAM_INT );
      $requete->bindValue('ville',$laville ,PDO::PARAM_STR );


     if(!empty($_POST['new_lib'.$i])) //Un nouveau libellé de question a été entré
     {
       $requete_quest->bindValue('lib_question',$_POST['new_lib'.$i],PDO::PARAM_STR);
       $requete_quest->execute();
     }
     if(!empty($_POST['new_reponse_ouverte'.$i])) //Une nouvelle réponse a été entrée sur une question ouverte
     {
       $requete_quest->bindValue('bonne_rep',$_POST['new_reponse_ouverte'.$i],PDO::PARAM_STR);
       $requete_rep->bindValue('lib_rep',$_POST['new_reponse_ouverte'.$i],PDO::PARAM_STR);

       $requete_quest->execute();
     }
     if(!empty($_POST['new_reponse_cm'.$i])) //Une nouvelle réponse a été entrée sur une question à choix multiple
     {
       $requete_rep->bindValue('lib_rep',$_POST['new_reponse_cm'.$i],PDO::PARAM_STR);
       $requete_quest->execute();
     }

     //Ajout des réponses correspondantes à chaque question
     $requete_rep1 = $bdd->prepare("INSERT INTO REPONSE(lib_rep,no_question) VALUES (:lib_rep,:no_question)");
     $requete_rep1->bindValue('lib_rep',$_POST['lib_rep1_entre'.$i],PDO::PARAM_STR);
     $requete_rep1->bindValue('no_question',$no_new_quest+$i,PDO::PARAM_INT);
     $requete_rep1->execute();

   }

  ?>
   <p>Votre questionnaire a bien été modifié !</p>
   <br>
   <a href="index.php">Revenir à la page pricipale.</a>


  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
