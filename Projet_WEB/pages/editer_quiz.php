<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editer un quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>
  <?php include '../includes/menu_deconnexion_ad.php'; ?>

</head>

<body>
    <?php
    //Interrogation de la base de données des quiz
    require("../bdd/connect.php");
    $req_quiz = 'SELECT * FROM QUIZ ';
    $data_quiz = $bdd->query($req_quiz);
    //On trouve la ligne qui correspond à l'id envoyé
    //Oon récupère avec cette boucle for les données correspondantes au quiz sélectionné : nom, numéro et nombre de questions
    for($i=1;$i<=$_GET['id'];$i++)
    {
      $Tuple=$data_quiz->fetch();
      $nom_quiz = $Tuple['nom'];
      $numero_quiz = $Tuple['no_quiz'];
      $nb_question = $Tuple['nb_question'];
    }
    ?>
    <h2><?php echo $nom_quiz ?></h2>

    <!-- Edition du quiz sous la forme d'un formulaire -->
    <div class="bloc2" id="edition">
      <form action="recup_editer_quiz.php" method="POST">

      <!-- Interrogation de la base de données des questions -->
      <?php
      $req_questions = 'SELECT * FROM QUESTION ';
      $data_questions = $bdd->query($req_questions);

      $i = 1; //Incrémentateur de la boucle while
      while($Tuple=$data_questions->fetch())
      {
        if($Tuple['no_quiz']==$numero_quiz)
        {
          ?>
          <br/>
          <!-- Libellé de la question -->
          <strong><div class="libelle_question"><?php echo $Tuple['lib_question'] ?></div></strong>
          <br/>
          <label>Modifier la question</label>
          <br/>
          <input type="text" name="new_lib<?php echo $i ?>"> <!--Ici on rentre le nouveau libellé de la question -->
          <input name="numero_question<?php echo $i ?>" type="hidden" value="<?php echo $Tuple['no_question'] ?>"> <!--input caché permettant de retenir le numero de la question entrée -->
          <br/>
          <?php

          //Si question ouverte
          if($Tuple['type']=='ouverte')
          {
            ?>
            <label>Ecrire la nouvelle bonne réponse</label>
            <br/>
            <textarea id="reponse" name="new_reponse_ouverte<?php echo $Tuple['no_question'] ?>" ></textarea>
            <?php
          }

          //Si question à choix multiple
          elseif ($Tuple['type']=='CM')
          {
            //Parcours de la base de données des réponses
            $req_rep = 'SELECT * FROM REPONSE';
            $data_rep = $bdd->query($req_rep);
            $num_sous_rep = 1; //Comteur qui va de 1 à 4 en fonction du numero de la réponse de la question à choix multiples

            while ($TupleR=$data_rep->fetch())
            {
              if($Tuple['no_question']==$TupleR['no_question']) //On cherche si la reponse est bien associée à la question
              {
                ?>
                <!-- Label pour le libellé de la réponse à modifier et textarea pour modifier cette réponse -->
                 <br>
                 <label class="libelle_reponse"><?php echo $TupleR['lib_rep']?></label>
                 <!--input caché qui garde en mémoire le libellé de la réponse-->
                 <input name="lib_reponse_cm<?php echo $TupleR['no_question'].'_'.$num_sous_rep ?>" type="hidden" value="<?php echo $TupleR['lib_rep'] ?>">
                 <br>
                 <textarea id="reponse" name="new_reponse_cm<?php echo $TupleR['no_question'].'_'.$num_sous_rep ?>" placeholder="Modifier la réponse ici" ></textarea>
                 <!--input caché qui garde en mémoire le numero de la sous reponse -->
                 <input name="id_rep<?php echo $TupleR['no_question'].'_'.$num_sous_rep ?>" type="hidden" value="<?php echo $TupleR['no_rep'] ?>">
                 <br>
                <?php
                /* Petite explication :
                lors d'une question à choix multiples, les réponses proposées lors du quiz ont un numero double. Un qui correspond à leur numero de réponse propre dans la base de données, et un deuxième (ici num_sous_rep) entre 1 et 3 (ou 4), qui correspond à l'ordre dans lequel ces réponse sont prposées dans le quiz. Par exemple, ici, la 7.2 correspondrait à la 7ème réponse de la bdd, qui lors l'orsqu'elle est proposée avec sa question, s'affiche en deuxième position.
                */
                $num_sous_rep++;
              }
            }
            ?>
            <!-- Bonne réponse dans le cas d'une question à choix multiple -->
            <br/>
            <label>Quelle sera la bonne réponse à cette question ?</label>
            <br/>
            <!-- un select permet de désigné laquelle des réponses doit être la bonne -->
            <select name="bonne_reponse_cm<?php echo $i ?>">
                <option value='0'>Inchangé</option>
                <?php
                for($k=1;$k<=3;$k++)
                {
                  echo "<option value='".$k."'>La réponse ".$k."</option>";
                }
                ?>
            </select>
            <?php
          }
          echo '<hr>'; //Ligne entre chaque question
        }
        $i++; //Compteur de la boucle while
      }
      ?>
      <!-- Envoie du formulaire avec le numero de quiz caché -->
      <div id="centre">
        <input class="bouton2" type="submit" name="bouton_executer" value="Valider" id="bouton_executer">
      </div>
      <input name="numero_quiz" type="hidden" value="<?php echo $numero_quiz ?>">
    </form>
    </div>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
