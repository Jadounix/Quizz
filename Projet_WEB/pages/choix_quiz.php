<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style_voir_quiz.css">
  <title>Quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>
  <?php include '../includes/menu_deconnexion.php'; ?>

</head>

<body>
    <h2>Choix du quiz</h2>
    <br/>
    <div class="row"> <!--Pour avoir un affichage des quiz en ligne-->

    <?php
    //Interrogation de la base de données
    require("../bdd/connect.php");
    $req = 'SELECT * FROM QUIZ';
    $data = $bdd->query($req);
    $cpt=1;
    while ($Tuple=$data->fetch())
    {
      echo '<div class="col-sm-4"><div class="bloc_quiz" id="quiz'.$cpt.'">'; //On donne au quiz un id quizn avec n allant de 1 au nombre de quiz
      echo '<h4>'.$Tuple['nom'].'</h4>'; //On affiche le nom du quiz
      echo '<div class="bloc_bouton">'; //On afficher le bouton pour commenecer le quiz
      echo '<br/><br/><a href="jouer.php?id='.$cpt.'"> <input class="bouton1" type="button" value="Jouer"> </a>';
      echo '</div></div></div><br/>';
      $cpt++;
    }
     ?>
    </div>
    <br/><br/>
  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
