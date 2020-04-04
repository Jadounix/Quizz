<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Voir mes quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>
  <?php include '../includes/menu_deconnexion_ad.php'; ?>

   <h1> Mes quiz </h1>
   <div class="row"> <!--Pour avoir un affichage des quiz en ligne-->
     <?php
     //Interrogation de la base de données des quiz
     require("../bdd/connect.php");
     $req = 'SELECT * FROM QUIZ';
     $data = $bdd->query($req);
     $cpt=1;
     while ($Tuple=$data->fetch()) //On affiche tous les quiz présents dans la bdd
     {
       if($Tuple['login_ad']==$_SESSION['login_entre']) //On affiche uniquement les quiz qui correpondent à l'admin connecté
       {
         ?>
          <div class="col-sm-4">
            <div class="petit_bloc2" id="quiz<?php echo $cpt ?>"> <!-- On donne au quiz un id quizn avec n allant de 1 au nombre de quiz -->
              <h4><?php echo $Tuple['nom'] ?></h4> <!-- On affiche le nom du quiz -->
              <div class="bloc_bouton"> <!--On afficher le bouton pour commencer le quiz -->
                <br/><br/>
                <!-- Lien vers le bouton permettant d'éditer le quiz -->
                <a href="editer_quiz.php?id=<?php echo $cpt ?>"><input class="bouton2" type="button" value="Editer"></a>
              </div>
            </div>
          </div>
         <?php
         $cpt++;
       }
     }?>
  </div>
  <!-- Lien vers le bouton permettant de créer un quiz -->
  <div class="bloc_bouton">
   <a href="init_creation_quiz.php"> <input class="bouton2" type="button" value="Créer un quiz"> </a>
  </div>
   <?php include '../includes/footer.php'; ?>
   <?php include '../lib/bootstrap_footer.php'; ?>

 </body>

</html>
