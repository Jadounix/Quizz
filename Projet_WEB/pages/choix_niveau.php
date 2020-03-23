<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style_jouer.css">
  <title>Quiz</title>
  <meta name="description">

  <?php include '../lib/bootstrap_header.php'; ?>
  <?php include '../includes/menu_deconnexion.php'; ?>

</head>

<body>
  <h2>Choix du niveau de difficulté</h2>

  <form class="bloc" action="jouer.php?id=<?php echo $_GET['id'] ?>" method="POST">
    <label for="Statut">Choisissez la difficulté du quiz :</label>
    <br/>
    <input class="radio" type="radio" name="niveau" value="facile">
    <label class="radio" for="facile">Facile</label>
    <br/>
    <input class="radio" type="radio" name="niveau" value="difficile">
    <label class="radio" for="difficile">Difficile</label>
    <br/>
    <button type="submit" name="connexion"  class="bouton">Valider</button>
  </form>


  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>

</body>

</html>
