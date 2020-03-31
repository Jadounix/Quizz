<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Créer un quiz</title>
    <?php include '../lib/bootstrap_header.php'; ?>
  </head>
  <body>
  <?php include '../includes/menu_deconnexion_ad.php'; ?>

  <?php
  //Acces à la base de données des quiz
  require("../bdd/connect.php");

  //On récupère le numero du dernier quiz créé
  $requete_no_quiz = "SELECT MAX(no_quiz) as max FROM QUIZ";
  $data_no_quiz = $bdd->query($requete_no_quiz);
  $Tuple=$data_no_quiz->fetch();
  $no_new_quiz = $Tuple['max'];

  $requete_quiz = $bdd->prepare("INSERT INTO QUIZ(no_quiz,nom,meilleur_score,meilleur_temps,temps_max,nb_question,login_ad) VALUES (:no_quiz,:nom,:meilleur_score,:meilleur_temps,:temps_max,:nb_question,:login_ad)");
  $requete_quiz->bindValue('no_quiz',$no_new_quiz+1,PDO::PARAM_INT);
  $requete_quiz->bindValue('nom',$_POST['nom_quiz_entre'],PDO::PARAM_STR);
  $requete_quiz->bindValue('meilleur_score',0,PDO::PARAM_INT);
  $requete_quiz->bindValue('meilleur_temps',0,PDO::PARAM_INT);
  $requete_quiz->bindValue('temps_max',$_POST['temps_max_entre'],PDO::PARAM_INT);
  $requete_quiz->bindValue('nb_question',$_POST['nb_questions_entre'],PDO::PARAM_INT);
  $requete_quiz->bindValue('login_ad',$_SESSION['login_entre'],PDO::PARAM_STR);
  $requete_quiz->execute();

  //On récupère le numero de la dernière question créée
  $requete_no_quest = "SELECT MAX(no_question) as maxQ FROM QUESTION";
  $data_no_quest = $bdd->query($requete_no_quest);
  $TupleQ = $data_no_quest->fetch();
  $no_new_quest = $TupleQ['maxQ'];

  // Ajout des questions à la base de données
  for($i=1;$i<=$_POST['nb_questions_entre'];$i++)
  {
    $requete_quest = $bdd->prepare("INSERT INTO QUESTION(no_question,lib_question,bonne_rep,type,no_quiz) VALUES (:no_question,:lib_question,:bonne_rep,:type,:no_quiz)");
    $requete_quest->bindValue('no_question',$no_new_quest+$i,PDO::PARAM_INT);
    $requete_quest->bindValue('lib_question',$_POST['lib_entre'.$i],PDO::PARAM_STR);
    $requete_quest->bindValue('bonne_rep',$_POST['bonne_rep_entre'.$i],PDO::PARAM_STR);
    $requete_quest->bindValue('type',$_POST['type_question'.$i],PDO::PARAM_STR);
    $requete_quest->bindValue('no_quiz',$no_new_quiz+1,PDO::PARAM_INT);
    $requete_quest->execute();

    //On récupère le numero de la dernière réponse créée
    $requete_no_rep = "SELECT MAX(no_rep) as maxR FROM REPONSE";
    $data_no_rep = $bdd->query($requete_no_rep);
    $TupleR = $data_no_rep->fetch();
    $no_new_rep = $TupleR['maxR'];

    //Ajout des réponses correspondantes à chaque question, si elles ont été entrées.
    if(!empty($_POST['lib_rep1_entre'.$i]))
    {
      $requete_rep1 = $bdd->prepare("INSERT INTO REPONSE(no_rep,lib_rep,no_question) VALUES (:no_rep,:lib_rep,:no_question)");
      $requete_rep1->bindValue('no_rep',$no_new_rep+1,PDO::PARAM_INT);
      $requete_rep1->bindValue('lib_rep',$_POST['lib_rep1_entre'.$i],PDO::PARAM_STR);
      $requete_rep1->bindValue('no_question',$no_new_quest+$i,PDO::PARAM_INT);
      $requete_rep1->execute();
    }

    if(!empty($_POST['lib_rep2_entre'.$i]))
    {
      $requete_rep2 = $bdd->prepare("INSERT INTO REPONSE(no_rep,lib_rep,no_question) VALUES (:no_rep,:lib_rep,:no_question)");
      $requete_rep2->bindValue('no_rep',$no_new_rep+2,PDO::PARAM_INT);
      $requete_rep2->bindValue('lib_rep',$_POST['lib_rep2_entre'.$i],PDO::PARAM_STR);
      $requete_rep2->bindValue('no_question',$no_new_quest+$i,PDO::PARAM_INT);
      $requete_rep2->execute();
    }

    if(!empty($_POST['lib_rep3_entre'.$i]))
    {
      $requete_rep3 = $bdd->prepare("INSERT INTO REPONSE(no_rep,lib_rep,no_question) VALUES (:no_rep,:lib_rep,:no_question)");
      $requete_rep3->bindValue('no_rep',$no_new_rep+3,PDO::PARAM_INT);
      $requete_rep3->bindValue('lib_rep',$_POST['lib_rep3_entre'.$i],PDO::PARAM_STR);
      $requete_rep3->bindValue('no_question',$no_new_quest+$i,PDO::PARAM_INT);
      $requete_rep3->execute();
    }
  }

  echo 'Votre questionnaire a bien été créé !';
  echo '<br>';
  echo '<a href="index.php">Revenir à la page pricipale.</a>';
   ?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
