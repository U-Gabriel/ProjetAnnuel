function sellSmart(form){
     const choiceInput = document.getElementById("choice");
     const choice = choiceInput.value;
}


 
function getListContent(oFormChoice1)
{
  var nIndex = oFormChoice1.selectedIndex;// le choix de l'utilisateur
  var sValue = oFormChoice1[nIndex].text;// le texte associé
  sUrlFileTxt = "Liste_Model/fairRepack"+sValue + ".txt";// l'url du fichier texte

  //var oContenuForm2 = document.form.elements;
  //var form2elements = oContenuForm2["form2"];
  var form2elements = document.getElementById("form2");

  // si l'utilisateur n'a pas effectue de choix --> sortie
  if (sValue == "Marque") return;
  else  var oXhr = 0; 

  // Pour les autres navigateurs (Mozilla, Firefox, Safari, Konqueror, Opéra, IE7)
  if(window.XMLHttpRequest)
  {
    oXhr = new XMLHttpRequest(); 
    console.log("oui - (Mozilla, Firefox, Safari, Konqueror, Opéra, IE7 - xhr est un " + oXhr);
  }
  else if(window.ActiveXObject)// Pour Internet Explorer (IE 5, IE 5.5, IE 6)
  { 
    oXhr = new ActiveXObject("Microsoft.XMLHTTP");
    console.log("oui - IE 5, IE 5.5, IE 6 - xhr est un " + oXhr);
  }       
  else 
  {
    alert("Votre navigateur n'est pas compatible avec AJAX..."); 
    return;
  }
    
  // écoute l'événement AJAX
  oXhr.onreadystatechange = function()
  { 
    // récupère la réponse du serveur
    if(oXhr.readyState==4 && oXhr.status==200)
    {
      console.log("Fichier transmis");

      var sContentFile = oXhr.responseText;
      buildFormContent(sContentFile, form2elements);
    } 
  }

  // le random pour éviter la mise en cache du navigateur
  oXhr.open("GET", sUrlFileTxt+"?rand="+Math.random(), false);
  oXhr.send(null);
}

function buildFormContent(sContentForm, sTitleChoice)
{
  var form2options = sContentForm.split("\n");// sépération des intitulés de chaque option

  sTitleChoice.length = 1;
  sTitleChoice.length = form2options.length;
  
  // remplis la liste
  for (i=1; i < form2options.length; i++)
    sTitleChoice[i].text = form2options[i];
}


function sellChoice(){

	const price =0;
    
	const choiceInput = document.getElementById("choice");
  const marqueInput = document.getElementById("marque");
	const modeleInput = document.getElementById("description");
	const screenInput = document.getElementById("stateScreen");
	const fonctionInput = document.getElementById("fonctionnement");
  const produitInput1 = document.getElementById("produit_image1");
 	const produitInput2 = document.getElementById("produit_image2");
	const produitInput3 = document.getElementById("produit_image3");
	const anneeInput =  document.getElementById("annee");
  const modelInput =  document.getElementById("model");
  const coleurInput =  document.getElementById("coleur");


	const choice = choiceInput.innerHTML;
    const marque = marqueInput.value;
	const modele = modeleInput.value;
	const enveloppe = form.enveloppe.value;
	const screen = screenInput.value;
	const fonctionnement = fonctionInput.value;
    const fileProduit1 = produitInput1.value;
	const fileProduit2 = produitInput2.value;
	const fileProduit3 = produitInput3.value;
	const annee = anneeInput.value;
    const model = modelInput.value;
    const coleur = coleurInput.value;

  if(choice == "phone" || choice == "touchpad"){
	var stateScreen = form.ecran.value;
	var capacity = form.capacity.value;
     
  }


  if(choice == "other"){
	var typeInput = document.getElementById("type");
	var type = typeInput.value;

	var chargeInput = document.getElementById("charge");
	var charge = chargeInput.value;
  }


    


  


 
 


	if(choice == "phone"){
	var body =  'choice=' + choice + '&marque=' + marque + '&modele=' + modele + '$Prix=' + price +'&enveloppe='  + enveloppe + '&fonctionnement=' + fonctionnement + '&fileProduit1=' + fileProduit1
	+ '&fileProduit2=' + fileProduit2 + '&fileProduit3=' + fileProduit3 + '&annee=' + annee + '&stateScreen=' + stateScreen + '&capacity=' + capacity + '&coleur=' + coleur + '&model=' + model;
	}

	if(choice == "touchpad"){
	var body =  'choice=' + choice + '&marque=' + marque + '&modele=' + modele + '&enveloppe=' + enveloppe + '&fonctionnement=' + fonctionnement + '&fileProduit1=' + fileProduit1
	+ '&fileProduit2=' + fileProduit2 + '&fileProduit3=' + fileProduit3 + '&stateScreen=' + stateScreen + '&annee=' + annee + '&capacity=' + capacity+ '&coleur=' + coleur + '&model=' + model;
	}

	if(choice == "player"){
	var body =  'choice=' + choice + '&marque=' + marque + '&modele=' + modele + '&enveloppe=' + enveloppe + '&fonctionnement=' + fonctionnement + '&annee=' + annee + '&fileProduit1=' + fileProduit1
	+ '&fileProduit2=' + fileProduit2 + '&fileProduit3=' + fileProduit3+ '&coleur=' + coleur + '&model=' + model;
	}

	if(choice == "other"){
	var body =  'choice=' + choice + '&marque=' + marque + '&modele=' + modele + '&enveloppe=' + enveloppe + '&fonctionnement=' + fonctionnement + '&annee=' + annee + '&fileProduit1=' + fileProduit1
	+ '&fileProduit2=' + fileProduit2 + '&fileProduit3=' + fileProduit3 + '&type=' + type + '&charge=' + charge+ '&coleur=' + coleur + '&model=' + model;
	}
    
	const request = new XMLHttpRequest();
	request.open('POST', 'php/sell_verif.php');
	request.onreadystatechange = function() {
		if(request.readyState === 4) {
			console.log("ok");
		}
	}
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  	request.send(body);



}

