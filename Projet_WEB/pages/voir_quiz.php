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
   <br/>
   <div class="row"> <!--Pour avoir un affichage des quiz en ligne-->
   <?php
   //Interrogation de la base de données
   require("../bdd/connect.php");
   $req = 'SELECT * FROM QUIZ';
   $data = $bdd->query($req);
   $cpt=1;
   while ($Tuple=$data->fetch())
   {
     ?>
      <div class="col-sm-4">
        <div class="bloc_quiz" id="quiz<?php echo $cpt ?>"> <!-- On donne au quiz un id quizn avec n allant de 1 au nombre de quiz -->
          <h4><?php echo $Tuple['nom'] ?></h4> <!-- On affiche le nom du quiz -->
          <div class="bloc_bouton"> <!--On afficher le bouton pour commencer le quiz -->
            <br/><br/>
            <a href="editer_quiz.php?id=<?php echo $cpt ?>"><input class="bouton1" type="button" value="Editer"></a>
          </div>
        </div>
      </div>
      <br/>
     <?php
     $cpt++;
   }
    ?>
  </div>
  <br/><br/>
   <a href="init_creation_quiz.php"> <input class="bouton2" type="button" value="Créer un quiz"> </a>
   <?php
 }?>
   <?php include '../includes/footer.php'; ?>
   <?php include '../lib/bootstrap_footer.php'; ?>

 </body>

 </html>
