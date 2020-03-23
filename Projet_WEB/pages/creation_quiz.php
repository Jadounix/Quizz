<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style_creation_quiz.css">
  <title>Créer un quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>

</head>

<body>
  <?php
  {
   include '../includes/menu_deconnexion_ad.php'; ?>

   <h4> Créer un quiz </h4>
   <?php
   $nb_questions_entre = $_POST['nb_questions_entre'];

   ?><form class="bloc" action="creation_question.php" method="POST">

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
   for($i=1;$i<=$nb_questions_entre;$i++)
   {
     echo '<h2>Question n°'.$i.'</h2>'
     ?>
     <div class="form-group col-sm-6">
       <label for="Type">Quel sera le type de la question ?</label>
       <br>
       <input class="radio" type="radio" name="type_question<?php echo $i ?>" value="ouverte" id="Ouverte">
       <label class="radio" for="ouv">Question ouverte</label>
       <br>
       <input class="radio" type="radio" name="type_question<?php echo $i ?>" value="CM" id="Choix_multiples">
       <label class="radio" for="cm">Question à choix multiples</label>
     </div>

     <table class="table">
      <thead>
        <tr>
          <th scope="col">Quelle est l'intitulé de la question ?</th>
          <th scope="col">Quelles sont les réponses à proposer ? (Dans le cas d'une question à choix multiples)</th>
          <th scope="col">Quelle est la bonne réponse ? Attention, elle doit faire partie des réponses dans le cas d'une question à choix multiples.</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="text" name="lib_entre<?php echo $i ?>" placeholder="Intitulé de la question" required></td>
          <td><input type="text" name="lib_rep1_entre<?php echo $i ?>" placeholder="Réponse 1" ></td>
          <td><input type="text" name="bonne_rep_entre<?php echo $i ?>" placeholder="Bonne réponse" required></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="text" name="lib_rep2_entre<?php echo $i ?>" placeholder="Réponse 2"></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="text" name="lib_rep3_entre<?php echo $i ?>" placeholder="Réponse 3"></td>
          <td></td>
        </tr>
      </tbody>
     </table>
     <br/><br/>
     <?php
   }
    ?>
    <!-- Permet de garder en mémoire le nombre de questions pour l'envoyer dans le formulaire d'après -->
    <input name="nb_questions_entre" type="hidden" value="<?php echo $nb_questions_entre ?>">
    <button type="submit" name="connexion" class="bouton">Enregistrer</button>
   </form>
   <?php
 }?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
