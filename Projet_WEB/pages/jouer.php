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
    //On trouve la ligne qui correspond à l'id envoyé
    for($i=1;$i<$_GET['id'];$i++)
    {
      //Passage d'une ligne à l'autre
      $Tuple=$resultat->fetch();
    }
    echo '<h2>'.$Tuple['nom'].'<h2>'; //On affiche le nom du quiz
    

    ?>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
