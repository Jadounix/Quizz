var nbQuestions = parseInt(document.getElementById("nb_questions").value);
var numQuestion = 1;

afficherQuestion(numQuestion);
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

function afficherQuestion(num)
{
  for(var i=1;i<=nbQuestions;i++)
  {
    hide(i);
  }
  show(num);
}

function suivant()
{
  numQuestion++;
  afficherQuestion(numQuestion);

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

function testSuivant()
{
  var ids;
  if(document.getElementById("Choix_multiples"+numQuestion).checked)
  {
    ids = ["lib_entre"+numQuestion,"bonne_rep_entre"+numQuestion,"lib_rep1_entre"+numQuestion];
  }
  else
  {
    ids = ["lib_entre"+numQuestion,"bonne_rep_entre"+numQuestion];
  }

  var cpt = 0;
  for(var i=0; i<ids.length; i++)
  {
    var input = document.getElementById(ids[i]);
    if(input.value!="")
    {
      cpt++;
    }
    else
    {
      alert("Vous n'avez pas rempli tous les champs ;)");
    }
  }
  if(cpt==ids.length)
  {
    suivant();
  }
}
