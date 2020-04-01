var nbQuestions = parseInt(document.getElementById("nb_questions").value); //Récupère un nombre de question en string et le convertit en int
var numQuestion = 1;

afficherQuestion(numQuestion); //Appel à la focntion afficherQuestion : affiche la première question et cache les suivantes

//Fonction pour cacher un element (ici une question du quiz)
function hide(num)
{
  var id = "question_numero_"+num;
  var elem = document.getElementById(id);
  elem.style.display = "none";
}

//Fonction pour afficher un element (ici une question du quiz)
function show(num)
{
  var id = "question_numero_"+num;
  var elem = document.getElementById(id);
  elem.style.display = "block";
}

//Fonction qui affiche une question en particulier et cache les autres
function afficherQuestion(num)
{
  for(var i=1;i<=nbQuestions;i++)
  {
    hide(i);
  }
  show(num);
}

//Fonction appelée par la fonction testSuivant, qui passe d'une question à une autre si tous les champs sont remplis
function suivant()
{
  numQuestion++;
  afficherQuestion(numQuestion);

  //Quand on arrive au bout deq question, le bouton suivant est caché, et le bouton envoyé apparait
  if(numQuestion >= nbQuestions)
  {
    //On cache le bouton question suivante
    var boutonSuivant = document.getElementById("bouton_suivant");
    boutonSuivant.style.display = "none";

    //On affiche le bouton envoyer en changeant son type
    var boutonExecuter = document.getElementById("bouton_executer");
    boutonExecuter.type = "submit";
  }
}

//Fonction appelée lors du clique sur le bouton suivant, qui verifie que tout les champs sont remplis
function testSuivant()
{
  var ids;
  //En fonction du type de la question (ouverte ou CM), on crée un tableau contenant les id des champs qui doivent être remplis
  if(document.getElementById("Choix_multiples"+numQuestion).checked)
  {
    ids = ["lib_entre"+numQuestion,"bonne_rep_entre"+numQuestion,"lib_rep1_entre"+numQuestion];
  }
  else
  {
    ids = ["lib_entre"+numQuestion,"bonne_rep_entre"+numQuestion];
  }

  var cpt = 0;
  //On incrémente un compteur à chaque fois qu'un champ est bien rempli
  for(var i=0; i<ids.length; i++)
  {
    var input = document.getElementById(ids[i]);
    if(input.value!="")
    {
      cpt++;
    }
    else //S'il manque une réponse, on crée une alerte à l'utilisateur
    {
      alert("Vous n'avez pas rempli tous les champs ;)");
    }
  }
  if(cpt==ids.length) //Si tous les champs sont pleins l'utilisateur peut passer à la question suivante
  {
    suivant();
  }
}
