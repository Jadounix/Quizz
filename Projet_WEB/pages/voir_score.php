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

   <?php include '../includes/menu_deconnexion.php'; ?>

   <h2> Mes scores </h2>

   <?php
   //Interrogation de la base de données des scores
   require("../bdd/connect.php");
   $req = 'SELECT * FROM SCORE';
   $data = $bdd->query($req);

   while($Tuple=$data->fetch())
   {
     if($Tuple['login_joueur']==$_SESSION['login_entre'])
     {
       ?>
       <table class="table">
        <thead>
          <tr>
            <th scope="col">Temps Réalisé</th>
            <th scope="col">Score Réalisé</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $Tuple['temps'] ?></td>
            <td><?php echo $Tuple['nb_points'] ?></td>
          </tr>
        </tbody>
       </table>
       <?php
     }
   }
     ?>

   <?php include '../includes/footer.php'; ?>
   <?php include '../lib/bootstrap_footer.php'; ?>

 </body>

 </html>
