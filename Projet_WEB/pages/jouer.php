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
    <div class="bloc_quiz">
    <?php
    //Interrogation de la base de données des quiz
    require("../bdd/connect.php");
    $req_quiz = 'SELECT * FROM QUIZ ';
    $data_quiz = $bdd->query($req_quiz);
    //On trouve la ligne qui correspond à l'id envoyé
    for($i=1;$i<=$_GET['id'];$i++)
    {
      //Passage d'une ligne à l'autre
      $Tuple=$data_quiz->fetch();
      $nom_quiz = $Tuple['nom'];
      $numero_quiz = $Tuple['no_quiz'];
      $nb_question = $Tuple['nb_question'];
    }
    echo '<h1>'.$nom_quiz.'<h1>'; //On affiche le nom du quiz
    echo '<hr>';

    //Début du quiz sous la forme d'un formulaire
    echo '<form action="resultat.php" method="POST">';
    //Interrogation de la base de données des questions
    $req_questions = 'SELECT * FROM QUESTION';
    $data_questions = $bdd->query($req_questions);
    for($i=1;$i<=$nb_question;$i++)
    {
      //Passage d'une ligne à l'autre
      $Tuple=$data_questions->fetch();
      if($Tuple['no_quiz']==$numero_quiz)
      {
        //Libellé de la question
        echo '<div class="libelle_question">'.$Tuple['lib_question'].'</div>';
        //Si question ouverte
        if($Tuple['type']=='ouverte')
        {
          echo '<textarea id="reponse" class="form-control" required></textarea>';
        }
        //Si question à choix multiple
        elseif ($Tuple['type']=='CM')
        {
          //Parcours de la base de données des réponses
          $req_rep = 'SELECT * FROM REPONSE';
          $data_rep = $bdd->query($req_rep);
          while ($TupleR=$data_rep->fetch())
          {
            if($Tuple['no_question']==$TupleR['no_question']) //On cherche si la reponse est bien associée à la question
            {
              ?>
               <br>
               <input type="radio" name ="reponse<?php echo $Tuple['no_question']?>" value="valeur">
               <label class="libelle_reponse"><?php echo $TupleR['lib_rep']?></label>
              <?php
            }
          }
        }
        echo '<br><br>';
      }
    }
    echo '<input type="submit" name="bouton_executer" value="Valider mon quiz" id="bouton_executer">';
    echo '</form>';
    ?>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
