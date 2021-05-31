function searchListe(Type) {
	console.log(Type)
  const request = new XMLHttpRequest();
  window.location.replace('../buy/produitListe.php?type=' + Type);

}

function detailProduit(idIng) {
  const request = new XMLHttpRequest();
  window.location.replace('produit_detail.php?id=' + idIng);


}

