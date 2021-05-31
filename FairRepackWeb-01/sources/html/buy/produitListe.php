<?php session_start();
require('../vendor/include/config.php');


if(isset($_GET['type'])){
$type = $_GET['type'];

$stmt = $bdd->prepare('SELECT * FROM  produit WHERE Type = ?'); 

	if($stmt) {
	    $stmt->execute([
	      $type
	    ]);

	}

}
else{


$stmt = $bdd->query('SELECT * FROM  produit');
}

$produit = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Produits !</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body style="background-color: rgba(0,0,0,0.1); ">
	
	<?php  require ("../vendor/include/navbar.php");
           include 'filtrage.php';
	?>

    <main>
  
<?php



  /*echo '<h1>' . $produit['nom'] . '</h1>';  position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%); */

foreach ($produit as $ing) {
    echo '<div  style="background-color: white; 
   margin-top:50px;
   display: flex;
   flex-wrap: wrap;
   height: 330px;
   width:190px;
   text-align:center;
   border-radius: 10px;
   box-shadow: 10px 5px 5px #73e2ac;
    ">';
	echo '<br>' . $ing['Description'] . ''; 
	echo '<br>' . $ing['Marque'] . ''; 
	echo '<br>' . $ing['model'] . '<br>'; 
    echo '<br><button onclick="detailProduit(' . $ing['Id_Produit'] . ')">Détails</button><br>';
	if(!empty($ing['picture1'])){
	echo '<img style="height: 200px;width: 150px;" src="uploads_produit/' . $ing['picture1'] . '">';
	continue;
	}
	if(!empty($ing['picture2'])){
	echo '<img style="height: 200px;width: 150px;" src="uploads_produit/' . $ing['picture2'] . '">';
	continue;
	}
	if(!empty($ing['picture3'])){
	echo '<img style="height: 200px;width: 150px;" src="uploads_produit/' . $ing['picture3'] . '">';
	continue;
	}
	if(empty($ing['picture1']) && empty($ing['picture2']) && empty($ing['picture3'])){
		continue;
	}
    echo '</div>';   
    
        

    
}


            ?>   
</main>
<script src="js/listAndDet.js"></script>
<?php require ("../vendor/include/footer.php");  ?>
</body>
</html>