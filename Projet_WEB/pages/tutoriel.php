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
      else
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

    <p id = "image1">img1</p>
    <p id = "image2" style="display:none;">img2</p>
    <p id = "image3" style="display:none;">img3</p>
    <p id = "image4" style="display:none;">img4</p>
    <p id = "image5" style="display:none;">img5</p>

    <input type="button" name="bouton_suivant" value="Suivant" id="bouton_suivant" onclick="suivant()">


    <script type="text/javascript">
    var noSlide = 1;
    var nbSlides = 5;
    //Fonction pour cacher un element
    function hide(no)
    {
      var id = "image"+no;
      var elem = document.getElementById(id);
      elem.style.display = "none";
    }

    //Fonction pour afficher un element
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

    function suivant()
    {
      noSlide++;
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
