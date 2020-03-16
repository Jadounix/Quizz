<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style_voir_quiz.css">
  <title>Voir mes quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>
  <?php
  //On est dans l'état "connecté" en tant qu'admin
  if (empty($_POST['login_entre']) and empty($_POST['pass_entre']) and !empty($_SESSION['login_entre']))
  {
   include '../includes/menu_deconnexion_ad.php'; ?>

   <h2> Mes quiz </h2>
   <div class="bloc_quiz">
   <?php
   //Interrogation de la base de données
   require("../bdd/connect.php");
   $req = 'SELECT * FROM QUIZ';
   $data = $bdd->query($req);
   $cpt=1;
   while ($Tuple=$data->fetch())
   {
     echo '<div id="quiz'.$cpt.'">'; //On donne au quiz un id quizn avec n allant de 1 au nombre de quiz
     echo '<h2>'.$Tuple['nom'].'<h2>'; //On affiche le nom du quiz
     echo '<div class="bloc_bouton">'; //On afficher le bouton pour commencer le quiz
     echo '<a href="#?id='.$cpt.'" target="_blank"> <input class="bouton" type="button" value="Editer"> </a>'; // A modifier
     echo '</div></div>';
     $cpt++;
   }
    ?>
   </div>

   <?php
 }?>
   <?php include '../includes/footer.php'; ?>
   <?php include '../lib/bootstrap_footer.php'; ?>

 </body>

 </html>
