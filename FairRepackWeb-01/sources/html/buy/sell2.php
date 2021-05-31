<?php session_start();  
include('../vendor/include/config.php');
require('Fpdf/fpdf.php');
include '../vendor/include/navbar.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Revendre</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
  <script src="js/sell.js" charset="utf-8"></script>
<form id=paiement action="doc.php">
 
  <fieldset>
  	<legend>Detaille de votre Produit</legend>
  	 <?php  
   $price = $_GET['prix'];
   $marque = $_GET['marque'];
   //required autofocus
   echo "la marque : ".$marque."<br><br>";
   echo "<p>".$price."euros versés directement sur votre compte en banque.</p>";
   echo "<p id=price name=price>Notre meilleure offre :".$price." Euro</p><br>";
   ?>
        
            <input id=price name=price type=text style="display: none" value=<?php echo $price ?>>
            <input id=marque name=marque type=text style="display: none" value=<?php echo $marque ?>>
          
   
  </fieldset>

  
  <fieldset>
    <legend>Votre identité</legend>

    <ol>
      <li>
        <label for=nom>Nom</label>
        <input id=nom name=nom type=text placeholder="Prénom et nom" required autofocus>
      </li>
      <li>
        <label for=email>Email</label>
        <input id=email name=email type=email placeholder="exemple@domaine.com" required>
      </li>
      <li>
        <label for=telephone>Téléphone</label>
        <input id=telephone name=telephone type=tel placeholder="par ex: +3375500000000" required>
      </li>
    </ol>
  </fieldset>

  <fieldset>
    <legend>Adresse de Facturation</legend>
      <ol>
        <li>
          <label for=adresse>Adresse</label>
          <textarea id=adresse name=adresse rows=5 required></textarea>
        </li>
        <li>
          <label for=codepostal>Code postal</label>
          <input id=codepostal name=codepostal type=text required>
        </li>
          <li>
          <label for=pays>Pays</label>
          <input id=pays name=pays type=text required>
        </li>
      </ol>
    </fieldset>
   
    

  <fieldset >
    <button type="submit" name="detaille">Detaille de la commande</button>
    
  </fieldset>
</form>
<?php include 'paiment.php';  
      include '../vendor/include/navbar.php';
?>
</body>
</html>