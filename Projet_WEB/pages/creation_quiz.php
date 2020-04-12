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
  <?php
  {
   include '../includes/menu_deconnexion_ad.php'; ?>

   <h2> Créer un quiz </h2>
   <!-- On récupère le nombre de questions du quiz du questionnaire précédent -->
   <?php $nb_questions_entre = $_POST['nb_questions_entre'];?>

   <form class="bloc2" action="creation_question.php" method="POST">

   <!-- Partie qui correspond au nom du questionnaire et au temps accordé pour le faire -->
   <div class="form-group col-sm-6">
     <label for="Type">Quel est le nom de ce quiz ?</label>
     <br/>
     <input type="text" name="nom_quiz_entre" placeholder="Nom du quiz" required>
     <br/><br/>
     <label for="Type">Quel est le temps maximum accordé pour ce quiz (en minutes) ?</label>
     <br/>
     <input type="text" name="temps_max_entre" placeholder="Temps en minutes" required>
   </div>

   <hr/>
   <?php
   //Pour le nombre de questions choisi on demande à chauque fois si la question est ouverte ou à CM
   for($i=1;$i<=$nb_questions_entre;$i++)
   {
     echo '<div id = "question_numero_'.$i.'">';
     echo '<h2>Question n°'.$i.'</h2>'
     ?>
     <div class="form-group col-sm-6">
       <label for="Type">Quel sera le type de la question ?</label>
       <br>
       <!-- Lorsqu'on clique sur un des boutons de type radio, on appelle un script JS qui change l'affichage -->
       <!-- En focntion du type de réponse, les input ne sont pas les mêmes -->
       <input class="radio" type="radio" name="type_question<?php echo $i ?>" value="ouverte" id="Ouverte<?php echo $i ?>" onclick="hideReponseCM(<?php echo $i ?>)">
       <label class="radio" for="ouv">Question ouverte</label>
       <br>
       <input class="radio" type="radio" checked name="type_question<?php echo $i ?>" value="CM" id="Choix_multiples<?php echo $i ?>" onclick="showReponseCM(<?php echo $i ?>)">
       <label class="radio" for="cm">Question à choix multiples</label>
     </div>

     <!-- Tableau qui met en forme les choix de réponses que peut faire l'utilisateur -->
     <table class="table">
      <thead>
        <tr>
          <td scope="col">Quelle est l'intitulé de la question ?</td>
          <td scope="col" class="questionCM<?php echo $i ?>">Quelles sont les réponses à proposer ?</td>
          <td scope="col">Quelle est la bonne réponse ? Attention, elle doit faire partie des réponses dans le cas d'une question à choix multiples.</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="text" id="lib_entre<?php echo $i ?>" name="lib_entre<?php echo $i ?>" placeholder="Intitulé de la question" required></td>
          <td class="questionCM<?php echo $i ?>"><input type="text" id="lib_rep1_entre<?php echo $i ?>" name="lib_rep1_entre<?php echo $i ?>" placeholder="Réponse 1" required></td>
          <td><input type="text" id="bonne_rep_entre<?php echo $i ?>" name="bonne_rep_entre<?php echo $i ?>" placeholder="Bonne réponse" required></td>
        </tr>
        <tr>
          <td></td>
          <td class="questionCM<?php echo $i ?>"><input type="text" name="lib_rep2_entre<?php echo $i ?>" placeholder="Réponse 2"></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td class="questionCM<?php echo $i ?>"><input type="text" name="lib_rep3_entre<?php echo $i ?>" placeholder="Réponse 3"></td>
          <td></td>
        </tr>
      </tbody>
     </table>
     <br/><br/>
     <?php
     echo '</div>';
   }
    ?>
    <!-- Permet de garder en mémoire le nombre de questions pour l'envoyer dans le formulaire d'après -->
    <input name="nb_questions_entre" id="nb_questions" type="hidden" value="<?php echo $nb_questions_entre ?>">
    <!-- Bouton suivant qui affiche les questions les unes après les autres en faisant appelle au script JS -->
    <input type="button" name="bouton_suivant" value="Question suivante" id="bouton_suivant" onclick="testSuivant()">
    <input type="hidden" name="bouton_executer" value="Enregistrer" id="bouton_executer">
   </form>
   <?php
 }?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

  <!-- Script JavaScript qui permet de faire ne montrer qu'une question à la fois -->
  <script type="text/javascript" src="../includes/script_edition.js"> </script>


  <!-- Script JavaScript qui permet d'alterner l'affichage entre question ouverte et question fermée -->
  <script type="text/javascript">
  //Fonction qui va servir à cacher les input contenus dans une classe liés à une question à CM
  function hideReponseCM(num)
  {
    var nomClass = "questionCM"+num;
    var tab = document.getElementsByClassName(nomClass);
    for(var i = 0; i<tab.length; i++)
    {
      tab[i].style.display = "none"; //none = caché
    }
    //On enlève le required puisque cet input est caché et ne correspond pas à une question ouverte
    document.getElementById("lib_rep1_entre"+num).required = false;
  }

  //Fonction qui va servir à montrer les input contenus dans une classe liés à une question à CM
  function showReponseCM(num)
  {
    var nomClass = "questionCM"+num;
    var tab = document.getElementsByClassName(nomClass);
    for(var i = 0; i<tab.length; i++)
    {
      tab[i].style.display = "block"; //block = visible
    }
    //On est obligé de remplir au moins une réponse
    document.getElementById("lib_rep1_entre"+num).required = true;
  }
  </script>

</body>

</html>
