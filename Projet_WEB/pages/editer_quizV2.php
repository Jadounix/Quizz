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
      <?php
      $req_questions = "SELECT * FROM QUESTION WHERE $Tuple['no_quiz'] = $numero_quiz ";
      $data_questions = $bdd->query($req_questions);

      for($i=1;$nb_question;$i++)
      {
        $Tuple=$data_questions->fetch();
        ?>
        <form action="recup_editer_quizV2.php?id=<?php echo $i ?>" method="POST">

          <strong><div class="libelle_question"><?php echo $Tuple['lib_question'] ?></div></strong>
          <br>
          <label>Modifier la question</label>
          <br>
          <input type="text" name="new_lib<?php echo $i ?>">
          <input name="numero_question<?php echo $i ?>" type="hidden" value="<?php echo $Tuple['no_question'] ?>">
          <br>

          <input type="submit" name="bouton_executer" value="Valider" id="bouton_executer">
        </form>


        <?php
      }





       ?>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
