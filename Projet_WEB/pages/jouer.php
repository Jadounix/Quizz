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
    <?php
    //Interrogation de la base de données des quiz
    require("../bdd/connect.php");
    $req_quiz = 'SELECT * FROM QUIZ ';
    $data_quiz = $bdd->query($req_quiz);
    //On trouve la ligne qui correspond à l'id envoyé
    for($i=1;$i<=$_GET['id'];$i++)
    {
      $Tuple=$data_quiz->fetch();
      $nom_quiz = $Tuple['nom'];
      $numero_quiz = $Tuple['no_quiz'];
      $nb_question = $Tuple['nb_question'];
    }
    ?>

    <h2><?php echo $nom_quiz ?></h2>
    <hr/>

    <!-- Début du quiz sous la forme d'un formulaire -->
    <div class="bloc_quiz"><form action="resultat.php" method="POST">

    <?php
    // Mise en route du chronomètre
    $start = microtime(true);

    //Récupération du niveau de difficulté
    $niveau=$_POST['niveau'];

    //Interrogation de la base de données des questions
    $req_questions = 'SELECT * FROM QUESTION';
    $data_questions = $bdd->query($req_questions);

    for($i=1;$i<=$nb_question;$i++)
    {
      $TupleQ=$data_questions->fetch();
      echo '<div id = "question_numero_'.$i.'">';
      if($TupleQ['no_quiz']==$numero_quiz)
      {
        //Libellé de la question
        echo '<br/><strong><div class="libelle_question">'.$TupleQ['lib_question'].'</div></strong>';
        //Si question ouverte
        if($TupleQ['type']=='ouverte')
        {
          echo '<textarea id="reponse" name="reponse'.$TupleQ['no_question'].'" class="form-control"></textarea>';
        }
        //Si question à choix multiple
        elseif ($TupleQ['type']=='CM' and $niveau=="facile")
        {
          //Parcours de la base de données des réponses
          $req_rep = 'SELECT * FROM REPONSE';
          $data_rep = $bdd->query($req_rep);
          $cpt=0;
          $br=false; //Devient vrai si la bonne réponse a été affichée
          while ($TupleR=$data_rep->fetch() and $cpt<2)
          {
            if($TupleQ['no_question']==$TupleR['no_question'] and $TupleQ['bonne_rep']==$TupleR['lib_rep']) //On cherche si la reponse est bien associée à la question
            {
              ?>
               <br>
               <input type="radio" checked name ="reponse<?php echo $TupleQ['no_question']?>" value="<?php echo $TupleR['lib_rep']?>">
               <label class="libelle_reponse"><?php echo $TupleR['lib_rep']?></label>
               Bonne rep <!--pour les tests-->
              <?php
              $cpt++;
            }
            else if($TupleQ['no_question']==$TupleR['no_question'] and $TupleQ['bonne_rep']!=$TupleR['lib_rep']){
              if($cpt==0){
              ?>
               <br>
               <input type="radio" checked name ="reponse<?php echo $TupleQ['no_question']?>" value="<?php echo $TupleR['lib_rep']?>">
               <label class="libelle_reponse"><?php echo $TupleR['lib_rep']?></label>
               Mauvaise rep
              <?php

                $cpt++;
              }
            }
          }
        }
        elseif ($TupleQ['type']=='CM' and $niveau=="difficile")
        {
          //Parcours de la base de données des réponses
          $req_rep = 'SELECT * FROM REPONSE';
          $data_rep = $bdd->query($req_rep);
          while ($TupleR=$data_rep->fetch())
          {
            if($TupleQ['no_question']==$TupleR['no_question']) //On cherche si la reponse est bien associée à la question
            {
              ?>
               <br>
               <input type="radio" checked name ="reponse<?php echo $TupleQ['no_question']?>" value="<?php echo $TupleR['lib_rep']?>">
               <label class="libelle_reponse"><?php echo $TupleR['lib_rep']?></label>
              <?php
            }
          }
        }
        echo '<br><br>';
      }
      echo '</div>';
    }
    ?>
    <input type="button" name="bouton_suivant" value="Question suivante" id="bouton_suivant" onclick="suivant()">
    <input type="hidden" name="bouton_executer" value="Valider mon quiz" id="bouton_executer">
    <input name="nb_questions" id="nb_questions" type="hidden" value="<?php echo $nb_question ?>">
    <input name="no_quiz" type="hidden" value="<?php echo $numero_quiz ?>">
    <input name="start" type="hidden" value="<?php echo $start ?>">
    </form>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

  <script type="text/javascript" src="../includes/script.js"> </script>

</body>

</html>
