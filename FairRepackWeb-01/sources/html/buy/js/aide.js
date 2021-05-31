function create_aide(){
	const nameInput = document.getElementById('name');
	const descriptionInput = document.getElementById('description');


	const name = nameInput.value;
	const description = descriptionInput.value;




	const body = 'name=' + name + '&description=' + description;

	const request = new XMLHttpRequest();
	request.open('POST', 'php/create_aide.php');
	request.onreadystatechange = function() {
		if(request.readyState === 4) {
			displayAide();
		}
	}
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  	request.send(body);
}


function displayAide(){
  const request = new XMLHttpRequest();
  request.open('GET', 'php/display_produit.php');
  request.onreadystatechange = function() {
    if(request.readyState === 4) {
      const list = document.getElementById('aide_list');
      list.innerHTML = request.responseText;
    }
  }
  request.send();
}
