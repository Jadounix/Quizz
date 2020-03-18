<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_header.css">
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
      <a class="navbar-brand" href="index.php">Quiz</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" id="jouer" href="choix_quiz.php">Jouer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="voir_scores" href="voir_score.php">Voir mes meilleurs scores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="se_deconnecter" href="logout.php">Se déconnecter</a>
          </li>
          <li class="nav-item">
            <div class="nav-link" id="etat_connexion"> Connecté en tant que <?php echo $_SESSION['login_entre'] ?> </div>
          </li>
        </ul>
      </div>
    </nav>


  </body>
</html>
