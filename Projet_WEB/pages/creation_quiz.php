<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style_creation.css">
  <title>Créer un quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>
  <?php
  //On est dans l'état "connecté" en tant qu'admin
  elseif (empty($_POST['login_entre']) and empty($_POST['pass_entre']) and !empty($_SESSION['login_entre']))
  {
   include '../includes/menu_deconnexion.php'; ?>

   <h2> Créer un quiz </h2>
   <<?php
   $num=1;
   echo '<h1>Question n°'.$num.'</h1>'
    ?>
   <form class="bloc" action="creation_question.php" method="POST">
     <div class="row">
       <div class="form-group col-sm-6">
         <input type="text" class="zone_saisie" name="login_entre" placeholder="Intitulé de la question" required>
       </div>
       <div class="form-group col-sm-6">
         <input type="password" name="pass_entre" placeholder="Choix 1" required>
       </div>
       <div class="form-group col-sm-6">
         <input type="password" name="pass_entre" placeholder="Choix 2" required>
       </div>
       <div class="form-group col-sm-6">
         <input type="password" name="pass_entre" placeholder="Choix 3" required>
       </div>
     </div><br/><br/>

     <button type="submit" name="connexion"  class="bouton">Enregistrer</button>
   </form>


  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
