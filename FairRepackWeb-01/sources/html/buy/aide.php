<?php session_start();
require('../vendor/include/config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Aide !</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body onload="displayAide()">
<?php include('../vendor/include/navbar.php'); ?>

<main>
	<h1>Bienvenue dans la page aide de FairRepack</h1>

	<p>Établie dans l'Ouest de Paris depuis 2016, Fair Repack est une jeune société française de vente de
produits électroniques reconditionnés. Jouant sur la volonté de changement de comportement des
consommateurs, elle a pour mission de rendre des produits reconditionnés aussi fiables que
désirables : ils ont tout du neuf sauf le prix et sont tous vérifiés et restaurés par des experts.</p><br>

<p>Si vous avez un problème, prévenez-nous, un administrateur se fera une joie de vous répondre.</p>

<div>
		<h1>Ajout d'un produit</h1>
					<div>
			<input type="text" id="name" placeholder="nom de la demande"><br>
			<br><input type="text" id="description" placeholder="Description de la demande"><br>
			<br><button onclick="create_aide()">Demander</button>
		</div>
</div>

<div>
		<h1>Vos questions</h1><br>
		<div id="aide_list">
		</div>
	</div>

</main>
<script src="js/aide.js" charset="utf-8"></script>
<?php require ("../vendor/include/footer.php"); ?> 
</body>
</html>