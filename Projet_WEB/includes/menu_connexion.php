<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
    <title></title>
  </head>
  <body>
    <!-- Menu créé grâce à un exemple de menu en boostrap trouvé dans un tuto -->

    <!-- Balise du menu complet -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">

      <!-- Balise permettant de retourner sur la page d'accueil -->
      <a class="navbar-brand" href="index.php">QuizCeption</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Balise des différents onglets du menu -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" id="tuto" href="tutoriel.php">Tutoriel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="s_inscrire" href="inscription.php">S'inscrire</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="se_connecter" href="login.php">Se connecter</a>
          </li>
          <li class="nav-item">
            <div class="nav-link" id="non_connecte"> Non connecté </div>
          </li>
        </ul>
      </div>
    </nav>

  </body>
</html>
