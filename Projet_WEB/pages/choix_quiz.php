<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style_jouer.css">
  <title>Quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>
  <?php include '../includes/menu_deconnexion.php'; ?>

</head>

<body>
    <h1>Choix du quiz</h1>
    <div class="bloc_quiz">
    <?php
    //Interrogation de la base de données
    require("../bdd/connect.php");
    $req = 'SELECT * FROM QUIZ';
    $data = $bdd->query($req);
    $cpt=1;
    while ($Tuple=$data->fetch())
    {
      echo '<div id="quiz'.$cpt.'">'; //On donne au quiz un id quizn avec n allant de 1 au nombre de quiz
      echo '<h2>'.$Tuple['nom'].'<h2>'; //On affiche le nom du quiz
      echo '<div class="bloc_bouton">'; //On afficher le bouton pour commenecer le quiz
      echo '<a href="jouer.php" target="_blank"> <input class="bouton" type="button" value="Commencer le quiz"> </a>';
      echo '</div></div>';
      $cpt++;
    }
     ?>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
