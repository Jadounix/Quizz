<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <title>Voir mes meilleurs scores</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>

  <?php include '../includes/menu_deconnexion.php'; ?>

  <h2> Mes scores </h2>

  <?php

  //Interrogation de la base de données des scores
  require("../bdd/connect.php");
  $req_score = 'SELECT MAX(nb_points) as nb_points, no_quiz, temps, login_joueur FROM SCORE GROUP BY no_quiz';
  $data_score = $bdd->query($req_score);
  $tab_score=[]; //Tableau qui contiendra les scores

  //les scores sont stockés par quiz dans un tableau de tableaux
  while($Tuple_score=$data_score->fetch())
  {
    if($Tuple_score['login_joueur']==$_SESSION['login_entre']){ //Seuls les scores du joueur connecté s'affichent
      $tab_score[]=['no_quiz'=>$Tuple_score['no_quiz'], 'Temps réalisé'=>$Tuple_score['temps'], 'Score réalisé'=>$Tuple_score['nb_points']];
    }
  }

  //Affichage des scores sous la forme d'un tableau pour que ce soit structuré
  $i = 1; //Compteur pour la boucle foreach
  //On parcourt tous les scores de la table
  foreach($tab_score as $sous_tab)
  {
    //Interrogation de la base de données des quiz pour retrouver le nom du quiz
    require("../bdd/connect.php");
    $req_quiz = 'SELECT * FROM QUIZ';
    $data_quiz = $bdd->query($req_quiz);
    ?>
    <div class="bloc1" id="quiz<?php echo $i ?>">
    <table class="tableau">
     <thead>
       <tr>
         <th scope="col">Nom du quiz</th>
         <th scope="col">Temps réalisé</th>
         <th scope="col">Score réalisé</th>
       </tr>
     </thead>
     <tbody>
       <tr>
         <td><?php while($Tuple_quiz=$data_quiz->fetch()) //On cherche le nom du quiz associé au numéro du quiz
         {
           if($Tuple_quiz['no_quiz']==$sous_tab['no_quiz'])
           {
             echo $Tuple_quiz['nom']; //Affichage du nom du quiz
             $nb_questions = $Tuple_quiz['nb_question'];
           }
         } ?>
         </td>
         <td><?php echo (int) ($sous_tab['Temps réalisé']/60)."min ".($sous_tab['Temps réalisé']%60)."s"?></td> <!-- Affichage du temps -->
         <td><?php echo $sous_tab['Score réalisé'].'/'.$nb_questions ?></td> <!-- Affichage du score -->
       </tr>
     </tbody>
   </table></div><br/>
  <?php $i++;
  } ?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

 </body>

</html>
