<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style_score.css">
  <title>Quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>
  <?php include '../includes/menu_deconnexion.php'; ?>

</head>

<body>
    <h2>Score</h2>
    <br/>
    <div class="bloc_score">
    <?php
    //Compteur de bonnes réponses
    $cpt_bonne_rep = 0;

    //Parcours de la base de données des questions
    require("../bdd/connect.php");
    $req_quest = 'SELECT * FROM QUESTION';
    $data_quest = $bdd->query($req_quest);
    for($i=1;$i<=$_POST['nb_questions'];$i++)
    {
      $Tuple=$data_quest->fetch();
      if($Tuple['bonne_rep']==$_POST['reponse'.$i])
      {
        $cpt_bonne_rep++;
      }
    }
    ?>
      <div class="annonce_score">
        <?php
        if($cpt_bonne_rep>=7)
        {
          ?>
          <p>Félicitations ! Votre score est de : <?php echo $cpt_bonne_rep ?></p>
          <?php
        }
        elseif ($cpt_bonne_rep<7 && $cpt_bonne_rep>=5)
        {
          ?>
          <p>Pas mal ! Votre score est de : <?php echo $cpt_bonne_rep ?></p>
          <?php
        }
        else {
          ?>
          <p>Dommage ! Votre score n'est que de : <?php echo $cpt_bonne_rep ?>... Ne perdez pas espoir, vous pouvez rejouer !</p>
          <?php
        }
         ?>
      </div>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
