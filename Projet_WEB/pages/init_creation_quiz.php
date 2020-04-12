<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Créer un quiz</title>
  <meta name="description">
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>
  <?php include '../includes/menu_deconnexion_ad.php'; ?>

   <h2> Créer un quiz </h2>
    <!-- Formulaire du choix du nombre de question -->
    <form class="bloc2" action="creation_quiz.php" method="POST">
        <div class="form-group col-sm-6">
          <label for="nb_questions" class="h5">Combien de questions comportera votre quiz ?</label>
          <!-- select permet d'avoir un menu déroulant avec autant de réponse que l'on souhaite -->
          <select name="nb_questions_entre">
              <?php
              //L'utilisateur peut choisir entre 2 et 20 pour la création de son quiz
              for($i=2;$i<=20;$i++)
              {
                echo "<option value='".$i."'>".$i."</option>";
              } ?>
          </select>
        </div>
        <button type="submit" name="connexion" class="bouton2">Valider</button>
    </form>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
