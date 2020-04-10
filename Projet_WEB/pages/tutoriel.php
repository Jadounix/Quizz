<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tuto</title>
    <?php include '../lib/bootstrap_header.php'; ?>
  </head>

  <body>
    <?php
    //On affiche le menu en fonction de si l'utilisateur est connecté ou non
    if(isset($_SESSION['login_entre'])) //On est connecté
    {
      if (isset($_SESSION['etat']) and $_SESSION['etat']==true) //L'utilisateur est un joueur
      {
        include '../includes/menu_deconnexion.php';
      }
      else //On est connecté mais pas un joueur, donc on est admin
      {
        include '../includes/menu_deconnexion_ad.php';
      }
    }
    else //L'utilisateur n'est pas connecté
    {
      include '../includes/menu_connexion.php';
    }
    ?>

    <h1>Tutoriel du site QuizCeption</h1>

    <!-- Bouton qui permettent d'accéder directemment à l'un des tutos -->
    <div class="bloc_bouton">
      <input type="button" class="bouton1" value="S'inscrire" id="bouton_suivant" onclick="afficherSlide(2)">
      <input type="button" class="bouton1" value="Se connecter" id="bouton_suivant" onclick="afficherSlide(3)">
      <input type="button" class="bouton1" value="Jouer à un quiz" id="bouton_suivant" onclick="afficherSlide(4)">
      <input type="button" class="bouton1" value="Voir mes scores" id="bouton_suivant" onclick="afficherSlide(8)">
      <input type="button" class="bouton1" value="Créer un quiz" id="bouton_suivant" onclick="afficherSlide(9)">
      <input type="button" class="bouton1" value="Modifier un quiz" id="bouton_suivant" onclick="afficherSlide(13)">
    </div>

    <br/>

    <!-- Images du tuto à faire défiler
    La première est affiché, les autres sont cachés pour l'instant -->
    <div class="bloc1">
      <div id="centre">
        <img src="../images/Tuto1.png" alt="tutoriel" id="image1" height="360px" width="640px"/>
      </div>
      <?php
      $nbSlides = 15;
      for($i=2;$i<=$nbSlides;$i++)
      {
        ?>
        <div class="centre">
          <img src="../images/Tuto<?php echo $i ?>.png" alt="tutoriel" id="image<?php echo $i ?>" height="360px" width="640px" style="display:none;"/>
        </div>
        <?php
      } ?>

      <!-- Bouton suivant qui permet de faire défiler les images -->
      <div class="bloc_bouton">
        <input type="button" class="bouton1" value="Suivant" id="bouton_suivant" onclick="suivant()">
      </div>
    </div>



    <script type="text/javascript">

    var noSlide = 1; //Numero de slide en cours
    var nbSlides = 15; //Nombre de slides à faire défiler

    //Fonction qui cache un élément
    function hide(no)
    {
      var id = "image"+no;
      var elem = document.getElementById(id);
      elem.style.display = "none";
    }

    //Fonction qui affiche un élément
    function show(no)
    {
      var id = "image"+no;
      var elem = document.getElementById(id);
      elem.style.display = "block";
    }

    //Fonction qui affiche une des slides du tuto et qui cache les autres
    function afficherSlide(num)
    {
      noSlide = num;
      for(var i=1;i<=nbSlides;i++)
      {
        hide(i);
      }
      show(num);
    }

    //Fonction qui s'active l'orsqu'on clique sur le bouton suivant
    function suivant()
    {
      noSlide++; //On incrémente le numéro de la slide et on l'affiche en cachant les autres
      afficherSlide(noSlide);
      //Si j'arrive au bout je reviens au début
      if(noSlide>=nbSlides)
      {
        noSlide = 0;
      }
    }
    </script>

  <?php include '../includes/footer.php'; ?>
  <?php include '../lib/bootstrap_footer.php'; ?>
  </body>
</html>
