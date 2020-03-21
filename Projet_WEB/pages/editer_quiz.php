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

    <!-- Edition du quiz sous la forme d'un formulaire -->
    <div class="bloc_quiz">
      <form action="fin_edition.php" method="POST">

      <!-- Interrogation de la base de données des questions -->
      <?php
      $req_questions = 'SELECT * FROM QUESTION';
      $data_questions = $bdd->query($req_questions);
      for($i=1;$i<=$nb_question;$i++)
      {
        $Tuple=$data_questions->fetch();
        if($Tuple['no_quiz']==$numero_quiz)
        {
          //Libellé de la question
          ?>
          <br/>
          <strong><div class="libelle_question"><?php echo $Tuple['lib_question'] ?></div></strong>
          <br>
          <label>Modifier la question</label>
          <br>
          <input type="text" name="new_lib<?php echo $i ?>">
          <input name="numero_question<?php echo $i ?>" type="hidden" value="<?php echo $Tuple['no_question'] ?>">
          <br>
          <?php

          //Si question ouverte
          if($Tuple['type']=='ouverte')
          {
            ?>
            <label>Ecrire la nouvelle bonne réponse</label>
            <br>
            <textarea id="reponse" name="new_reponse_ouverte<?php echo $Tuple['no_question'] ?>" ></textarea>
            <?php
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
                <!-- Label pour le libellé de la réponse à modifier et textarea pour modifier cette réponse -->
                 <br>
                 <label class="libelle_reponse"><?php echo $TupleR['lib_rep']?></label>
                 <input name="lib_reponse_cm" type="hidden" value="<?php echo $TupleR['lib_rep'] ?>"> <!--Garde en mémoire le libellé de la réponse-->
                 <br>
                 <textarea id="reponse" name="new_reponse_cm<?php echo $TupleR['no_question'] ?>" placeholder="Modifier la réponse ici" ></textarea>
                 <br>
                <?php
              }
            }
            ?>
            <!-- Bonne réponse dans le cas d'une question à choix multiple -->
            <br>
            <label>Quelle sera la bonne réponse à cette question ?</label>
            <br>
            <select name="bonne_reponse_cm<?php echo $TupleR['no_question'] ?>">
                <?php
                for($k=1;$k<=3;$k++)
                {
                  echo "<option value='".$k."'>La question ".$k."</option>";
                }
                ?>
            </select>
            <?php
          }
          echo '<hr>'; //Ligne entre chaque question
        }
      }
      ?>
      <!-- Envoie du formulaire avec le numero de quiz caché -->
      <input type="submit" name="bouton_executer" value="Valider" id="bouton_executer">
      <input name="numero_quiz" type="hidden" value="<?php echo $numero_quiz ?>">
    </form>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>