<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Espace_personnel</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php 
	include '../vendor/include/config.php';
	include '../vendor/include/navbar.php';
	if (isset($_SESSION["email"])) {
	$q = "SELECT * FROM client WHERE Email = ?";
    $req = $bdd->prepare($q);
    $req->execute([$_SESSION["email"]]);
    $results = $req->fetchAll();
    foreach ($results as $key => $value) {
		echo "<h3>Bonjour ".$value['civilite']." ".$value['prenom']." ".$value['nom']." Bienvenue dans votre espace personnel</h3>";
	    $id = $value['Id_Client'];
	    $spe = $value['Facture'];
	    $spe2 =$value['colissimo'];
	    echo "<h4>Vos Factures</h4>";
	    if ($spe!=0) {
	    echo "<hr>";
	    for ($i=1; $i <= $spe ; $i++) { 
	    	echo "<a href='../buy/uploads_factures/Facture".$id."_".$i.".pdf'>Facture_$i</a><br>";
	    }
        
        echo "<hr><br>";

	    }
	    else{
	    	echo "Vous n'avez aucune Facture";
	    }
        echo "<h4>Bon colissimo</h4>";
        if ($value['colissimo']==0) {
	    	echo "Vous n'avez aucun bon collisimo";
	    }
	    else{
	    for ($i=1; $i <= $spe2 ; $i++) { 
        echo "<a href='../buy/uploads_colissimo/colissimo".$id."_".$i.".pdf'>Colissimo_$i</a><br>";
        }
        }
        echo "<h4>Etat de votre Produit</h4>";
        if ($value['Etat_Offre']==0) {
	    	echo "Vous n'avez aucune produit en attend";
	    }
	    else{
        if ($value['Etat_Offre']==1) {
        	echo "Votre produit est accepté, vous allez recevoire bientot un virement de $prix Euro";
        }
        if ($value['Etat_Offre']==2) {
        	echo "Envoi en cours...";
        }
        if ($value['Etat_Offre']==3) {
        	echo "Produit reçu, en train d'etude";
        }
        if ($value['Etat_Offre']==4) {
        	echo "Votre produit ne convient pas au description, nous vous proposons $pirce Euro";
        }
        if ($value['Etat_Offre']==5) {
        	echo "Malheuresement Votre produit est rejter, vous devez payer les frais de livraison";
        }
	    
	    }
    }
    echo "<h4>Vos achats</h4>";
    $q2 = "SELECT * FROM paiement WHERE email_client = ?";
    $req2 = $bdd->prepare($q2);
    $req2->execute([$_SESSION["email"]]);
    $results2 = $req2->fetchAll();
    foreach ($results2 as $key => $value2) {
     if ($value2['email_client']==NULL) {
	    echo "Vous n'avez acheter aucune produit";
	    }
	    else{
	    echo "<hr>";
	    //echo "id_produit : ".$value2['id_produit']."";
         $stmt = $bdd->prepare('SELECT * FROM  produit WHERE Id_Produit = ?');
         if($stmt) {
         $stmt->execute([
         $value2['id_produit']
         ]);}
         $produit = $stmt->fetch(PDO::FETCH_ASSOC);
        echo 'Marque : '.$produit['Marque'].'';
        echo "<br>";
        echo 'Model : '.$produit['model'].'';
	    echo "<br>";
	    echo "Montant : ".$value2['Montant']."";
	    echo "<br>";
	    echo "Date : ".$value2['date_achat']."";
	    echo "<hr>";
	    }
        }
        
 

    }
	else{
		header('location: connexionC.php');
	}
    include '../vendor/include/footer.php';
	?>
    
</body>
</html>