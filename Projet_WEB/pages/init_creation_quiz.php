<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Créer un quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>
  <?php
  //On est dans l'état "connecté" en tant qu'admin
  if (empty($_POST['login_entre']) and empty($_POST['pass_entre']) and !empty($_SESSION['login_entre']))
  {
   include '../includes/menu_deconnexion_ad.php'; ?>

   <h2> Créer un quiz </h2>
    <br/>
    <form class="bloc2" action="creation_quiz.php" method="POST">
        <div class="form-group col-sm-6">
          <label for="nb_questions" class="h5">Combien de questions comportera votre quiz ?</label>
          <select name="nb_questions_entre">
              <?php
              for($i=2;$i<=20;$i++)
              {
                echo "<option value='".$i."'>".$i."</option>";
              } ?>
          </select>
        </div>
        <button type="submit" name="connexion"  class="bouton2">Valider</button>
    </form>
   <?php
 }?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
