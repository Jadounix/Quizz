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

   <?php include '../includes/menu_deconnexion.php'; ?>

   <h2> Mes scores </h2>

   <?php
   //Interrogation de la base de données des scores
   /*require("../bdd/connect.php");
   $req_score = 'SELECT * FROM SCORE';
   $data_score = $bdd->query($req_score);

   //Interrogation de la base de données des quiz pour retrouver le nom du quiz
   require("../bdd/connect.php");
   $req_quiz = 'SELECT * FROM QUIZ';
   $data_quiz = $bdd->query($req_quiz);

   $quiz=[];
   $dejaDansTab=false;

   while($Tuple_score=$data_score->fetch()){
     if($Tuple_score['login_joueur']==$_SESSION['login_entre'])
     {
       foreach($quiz as $element){
         if($element==$Tuple_score['no_quiz']){
           $dejaDansTab=true;echo "v";
         }
         else{$dejaDansTab=false;echo "f";}
       }

       if($dejaDansTab==false){
         $quiz[]=$Tuple_score['no_quiz'];
       }
     }
   }*/
   require("../bdd/connect.php");
   $req_score = 'SELECT DISTINCT * FROM SCORE'; //changer cette requête pour ne prendre que le meilleur score de chaque quiz
   $data_score = $bdd->query($req_score);
   $quiz=[];

   while($Tuple_score=$data_score->fetch()){
    $quiz[$Tuple_score['no_quiz']]=['Temps réalisé'=>$Tuple_score['temps'], 'Score réalisé'=>$Tuple_score['nb_points']];
  } //les scores sont stockés par quiz dans ce tableau de tableaux, seulement ce n'est pas le meilleur score qui est stocké :'(

   print_r($quiz); //pour afficher le tableau pour les tests

   ?>

   <?php include '../includes/footer.php'; ?>
   <?php include '../lib/bootstrap_footer.php'; ?>

 </body>

 </html>
