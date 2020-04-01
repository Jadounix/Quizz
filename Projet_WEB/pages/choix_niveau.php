<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jouer au quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>
  <?php include '../includes/menu_deconnexion.php'; ?>

</head>

<body>
  <h1>Choix du niveau de difficulté</h1>

  <!-- Formulaire pour envoyer le niveau de difficulté choisi lors d'un quiz -->

  <!-- En fonction de la difficulté choisi on revoit un id différent, qui permet de changer le nombre de réponse lors de questions à choix multiples -->
  <form class="bloc2" action="jouer.php?id=<?php echo $_GET['id'] ?>" method="POST">
    <label for="Statut"><strong>Choisissez la difficulté du quiz :</strong></label>
    <br/>
    <input class="radio" type="radio" name="niveau" value="facile">
    <label class="radio" for="facile">Facile</label>
    <br/>
    <input class="radio" type="radio" name="niveau" value="difficile">
    <label class="radio" for="difficile">Difficile</label>
    <br/>
    <button type="submit" name="connexion"  class="bouton2">Valider</button>
  </form>


  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
