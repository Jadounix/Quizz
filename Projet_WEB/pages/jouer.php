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

    //Interrogation de la base de données des questions
    $req_questions = 'SELECT * FROM QUESTION';
    $data_questions = $bdd->query($req_questions);
    for($i=1;$i<=$nb_question;$i++)
    {
      $Tuple=$data_questions->fetch();
      if($Tuple['no_quiz']==$numero_quiz)
      {
        //Libellé de la question
        echo '<br/><strong><div class="libelle_question">'.$Tuple['lib_question'].'</div></strong>';
        //Si question ouverte
        if($Tuple['type']=='ouverte')
        {
          echo '<textarea id="reponse" name="reponse'.$Tuple['no_question'].'" class="form-control" required></textarea>';
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
               <input type="radio" name ="reponse<?php echo $Tuple['no_question']?>" value="<?php echo $TupleR['lib_rep']?>">
               <label class="libelle_reponse"><?php echo $TupleR['lib_rep']?></label>
              <?php
            }
          }
        }
        echo '<br><br>';
      }
    }
    ?>
    <input type="submit" name="bouton_executer" value="Valider mon quiz" id="bouton_executer">
    <input name="nb_questions" type="hidden" value="<?php echo $nb_question ?>">
    <input name="no_quiz" type="hidden" value="<?php echo $numero_quiz ?>">
    <input name="start" type="hidden" value="<?php echo $start ?>">
    </form>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
