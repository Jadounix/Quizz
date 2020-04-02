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

    <!-- Images du tuto à faire défiler
    La première est affcihé, les autres sont cachés pour l'instant -->
    <p class="image_tuto" id = "image1">img1</p>
    <p class="image_tuto" id = "image2" style="display:none;">img2</p>
    <p class="image_tuto" id = "image3" style="display:none;">img3</p>
    <p class="image_tuto" id = "image4" style="display:none;">img4</p>
    <p class="image_tuto" id = "image5" style="display:none;">img5</p>

    <!-- Bouton suivant qui permet de faire défiler les images -->
    <div class="bloc_bouton">
      <input type="button" class="bouton1" value="Suivant" id="bouton_suivant" onclick="suivant()">
    </div>

    <script type="text/javascript">

    var noSlide = 1; //Numero de slide en cours
    var nbSlides = 5; //Nombre de slides à faire défiler

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
