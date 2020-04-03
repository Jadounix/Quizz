<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Résultat</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>
  <?php include '../includes/menu_deconnexion.php'; ?>

</head>

<body>
    <h2>Score</h2>

    <div class="bloc_score">
    <?php
    //Arrêt du chronomètre
    $stop = microtime(true);
    //Calcul du temps total passé sur le quiz
    $chrono = round($stop - $_POST['start']); //start récupéré avec hidden

    //Compteur de bonnes réponses
    $cpt_bonne_rep = 0;

    //Parcours de la base de données des questions
    require("../bdd/connect.php");
    $req_quest = 'SELECT * FROM QUESTION';
    $data_quest = $bdd->query($req_quest);
    for($i=1;$i<=$_POST['nb_questions'];$i++)
    {
      $Tuple=$data_quest->fetch(); //On parcourt toutes réponses enrées
      if($Tuple['bonne_rep']==$_POST['reponse'.$i])
      {
        $cpt_bonne_rep++; //Si la réponse est bonne on incrémente
      }
    }
    ?>
      <!-- Affichage des scores en fonction du nombre de bonnes réponses -->
      <div class="bloc2" id="centre">
        <?php
        if($cpt_bonne_rep>=7)
        {
          ?>
          <p>Félicitations ! Votre score est de : <?php echo $cpt_bonne_rep ?> / <?php echo $_POST['nb_questions'] ?></p>
          <div class="image">
            <img src="../images/victoire.png" alt="Victoire !" width="30%"/><br/>
          </div>
          <?php
        }
        elseif ($cpt_bonne_rep<7 && $cpt_bonne_rep>=5)
        {
          ?>
          <p>Pas mal ! Votre score est de : <?php echo $cpt_bonne_rep ?></p>
          <div class="image">
            <img src="../images/pouce_haut.png" alt="Pas mal...réessayez !" height="30%"/><br/>
          </div>
          <?php
        }
        else
        {
          ?>
          <p>Dommage ! Votre score n'est que de : <?php echo $cpt_bonne_rep ?>... Ne perdez pas espoir, vous pouvez rejouer !</p>
          <div class="image">
            <img src="../images/pouce_bas.png" alt="Défaite...réessayez !" height="85px" width="85px"/>
          </div>
          <br/>
          <?php
        }
        //Affichage du chrono
        $min = (int) ($chrono/60);
        $sec = $chrono%60;
        echo 'Vous avez réalisé ce quiz en '.$min.' minute(s) et '.$sec.' seconde(s)';
         ?>
      </div>

      <div class="bloc_bouton">
        <a href="choix_quiz.php"> <input class="bouton2" type="button" value="Jouer à un nouveau quiz"> </a>
      </div>
    </div>

    <!-- Enregistrement du score dans la base de données -->
    <?php
    $requete = $bdd->prepare("INSERT INTO SCORE(nb_points,temps,login_joueur, no_quiz) VALUES (:nb_points,:temps,:login_joueur,:no_quiz)");
    $requete->bindValue('nb_points',$cpt_bonne_rep,PDO::PARAM_INT);
    $requete->bindValue('temps',$chrono,PDO::PARAM_INT); //On enregistre le temps en secondes
    $requete->bindValue('login_joueur',$_SESSION['login_entre'],PDO::PARAM_STR);
    $requete->bindValue('no_quiz',$_POST['no_quiz'],PDO::PARAM_INT);
    $requete->execute();
     ?>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
