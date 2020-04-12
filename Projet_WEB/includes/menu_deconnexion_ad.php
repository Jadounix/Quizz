
    <!-- Menu créé grâce à un exemple de menu en boostrap trouvé dans un tuto -->

    <!-- Balise permettant de retourner sur la page d'accueil -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
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
            <a class="nav-link" id="creer" href="init_creation_quiz.php">Créer un quiz</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="voir_quiz" href="voir_quiz.php">Voir mes quiz</a>
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
