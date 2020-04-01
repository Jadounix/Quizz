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
