<?php session_start();  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Filtrage</title>
	<meta charset="utf-8">
</head>
<body>

<form action="" method="post">

    <select name="type">
    <option disabled selected>Type</option>
    <option name="type" value="phone"> Téléphone</option>
    <option name="type" value="touchpad"> Tablette</option>
    <option name="type" value="player"> Consôle de jeux</option> 
    <option name="type" value="photoAndCamera">Appareil Photo & Camera</option>
    <option name="type" value="audio">Casque Audio & ecouteurs</option>
    <option name="type" value="pc">PC Portable</option>
    <option name="type" value="Watch">Montre connectée</option>
    </select>


    <select name="marque">
    <option disabled selected>Marque</option>
    <option value="Apple">Apple</option>
    <option value="Huawei">Huawei</option>
    <option value="LG">LG</option> 
    <option value="Samsung">Samsung</option>
    <option value="Sony">Sony</option>
    <option value="Nokia">Nokia</option>
    <option value="Motorola">Motorola</option>
    <option value="Xiaomi">Xiaomi</option>
    </select>

    <select name="prix">
    <option disabled selected>Prix</option>
    <option name="prix" value="<50"> <50 Euro</option>
    <option name="prix" value="50-100">50-100 Euro</option> 
    <option name="prix" value="100-200">100-200 Euro</option>
    <option name="prix" value="200-300">200-300 Euro</option>
    <option name="prix" value="300-400">300-400 Euro</option>
    <option name="prix" value=">400"> >400 Euro</option>
    </select>

    <select name="etat">
    <option disabled selected>Etat</option>
    <option name="etat" value="Neuf">Comme neuf </option>
    <option name="etat" value="BonEtat">Bon état </option>
    <option name="etat" value="Correct">État correct </option> 
    <option name="etat" value="Stallone">Stallone</option>
    </select>

    <select name="annee">
    <option disabled selected>Année de sortie</option>
    <option value="2010">2010</option>
    <option value="2011">2011</option>
    <option value="2012">2012</option>
    <option value="2013">2013</option>
    <option value="2014">2014</option>
    <option value="2015">2015</option>
    <option value="2016">2016</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    <option value="2021">2021</option>
    </select>

    <select name="coleurs">
    <option disabled selected>Coleurs</option>
    <option value="Noir">Noir</option>
    <option value="Blanc">Blanc</option>
    <option value="Argent">Argent</option>
    <option value="Gris">Gris</option>
    <option value="Bleu">Bleu</option>
    <option value="Or">Or</option>
    <option value="Rouge">Rouge</option>
    <option value="Mauve">Mauve</option>
    <option value="Marron">Marron</option>
    <option value="Beige">Beige</option>
    <option value="Jaune">Jaune</option>
    </select>

    <input type="submit" name="submit" value="Rechercher">

</form>

<?php 

require('../vendor/include/config.php');

 if(isset($_POST['submit'])){
        
        $type = $_POST['type'];
        if (!isset($type)) {
            $type = NULL;
        }
        
        $prix = $_POST['prix'];
        if (!isset($prix)) {
            $prix = NULL;
        }
        
        $etat = $_POST['etat'];
        if (!isset($etat)) {
            $etat = NULL;
        }

        $coleur = $_POST['coleurs'];
        if (!isset($coleur)) {
            $coleur = NULL;
        }

        $annee = $_POST['annee'];
        if (!isset($annee)) {
            $annee = NULL;
        }

        $marque = $_POST['marque'];
        if (!isset($marque)) {
            $marque = NULL;
        }


    $stmt = $bdd->prepare('SELECT * FROM  produit WHERE Type = ? AND Marque=? AND coleur = ? AND Prix_F = 0 AND Etat_Offre = 1 AND Année = ?'); // 
    if($stmt) { 
    	$stmt->execute([$type,$marque,$coleur,$annee]);//,
    }
    

    $produit = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($produit as $ing) {

	echo '<br>' . $ing['Description'] . '<br>'; 
	echo '<br>Marque : ' . $ing['Marque'] . '<br>'; 
    echo '<br>Prix : ' . $ing['Prix'] . '<br>'; 
    echo '<br><button onclick="detailProduit(' . $ing['Id_Produit'] . ')">Détails</button><br>';

	if(!empty($ing['picture1'])){
	echo '<img src="uploads_produit/' . $ing['picture1'] . '">';
	continue;
	}
	if(!empty($ing['picture2'])){
	echo '<img src="uploads_produit/' . $ing['picture2'] . '">';
	continue;
	}
	if(!empty($ing['picture3'])){
	echo '<img src="uploads_produit/' . $ing['picture3'] . '">';
	continue;
	}
    if(empty($ing['picture1']) && empty($ing['picture2']) && empty($ing['picture3'])){
        continue;
    }

    }

    
    
 }





?>



<script src="js/listAndDet.js"></script>

</body>
</html>