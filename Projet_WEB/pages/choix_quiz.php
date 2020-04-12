<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jouer au quiz</title>
  <meta name="description">
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <?php include '../lib/bootstrap_header.php'; ?>
  <?php include '../includes/menu_deconnexion.php'; ?>

</head>

<body>
    <h1>Choix du quiz</h1>
    <div class="row"> <!--Pour avoir un affichage des quiz en ligne-->

    <?php
    //Interrogation de la base de données des quiz
    require("../bdd/connect.php");
    $req = 'SELECT * FROM QUIZ';
    $data = $bdd->query($req);
    $cpt = 1;
    //On parcourt toute les lignes de la bdd des quiz pour afficher tous les quiz
    while ($Tuple=$data->fetch())
    {
     ?>
    <div class="col-sm-4">
      <div class="petit_bloc2" id="quiz<?php echo $cpt ?>"> <!-- On donne au quiz un id "quizn" avec n allant de 1 au nombre de quiz -->
      <h4><em><?php echo $Tuple['nom']?></em></h4> <!-- On affiche le nom du quiz -->
        <div class="bloc_bouton"> <!-- On affiche le bouton pour commencer le quiz -->
        <br/><br/>
        <!-- Le bouton Jouer envoie à la page de choix du niveau du quiz -->
        <a href="choix_niveau.php?id=<?php echo $cpt ?>"> <input class="bouton2" type="button" value="Jouer"></a>
        </div>
      </div>
    </div>
      <?php
      $cpt++;
    }
     ?>
    </div>


  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
