<?php
session_start();
include_once("fonctions-panier.php");
include '../vendor/include/navbar.php';
require('../vendor/include/config.php');

   $l = $_GET['l'];
   $p = $_GET['p'];
   $q = $_GET['q'];
  $photo =  $_GET['id'];
  $stmt = $bdd->prepare('SELECT * FROM  produit WHERE Id_Produit = ?');
  if($stmt) {$stmt->execute([$photo]);
  }
$produit = $stmt->fetch(PDO::FETCH_ASSOC);
$ph = $produit["picture1"];
$action = $_GET['action'];

   if ($action=="ajout") {
     ajouterArticle($l,$q,$p,$ph,$photo);
   }
   if ($action=="suppression") {
     supprimerArticle($l);
   }
   if ($action=="refresh") {
     for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
   }



echo '<?xml version="1.0" encoding="utf-8"?>';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Panier !</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<form method="post" action="panier.php">
<table style="width: 1500px">
    <tr>
        <td colspan="5">Votre panier</td>
    </tr>
    <tr>
        <td>Produit</td>
        <td>Quantité</td>
        <td>Prix Unitaire</td>
        <td>Action</td>
        <td>Photo</td>
    </tr>


    <?php


    if (creationPanier())
    {

       $nbArticles=count($_SESSION['panier']['libelleProduit']);
       if ($nbArticles <= 0)
        echo "Votre panier est vide";
       else
       {
          for ($i=0 ;$i < $nbArticles ; $i++)
          {
             echo "<tr>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
             echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
             echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">Supprimer</a></td>";
             echo "<td><img style='height: 200px;width: 150px;' src='uploads_produit/" .$_SESSION['panier']['photoProduit'][$i] . "'></td>";
             echo "</tr>";
           $marques = array(
              $i => $_SESSION['panier']['libelleProduit'], 
           );
            $prixs = array(
              $i => $_SESSION['panier']['prixProduit'], 
           ); 
            $ids = array(
              $i => $_SESSION['panier']['idProduit'], 
           );
          }

          echo "<tr><td colspan=\"2\"> </td>";
          echo "<td colspan=\"2\">";
          echo "Total : ".MontantGlobal();
          echo "</td></tr>";

          echo "<tr><td colspan=\"4\">";
          echo "<input type=\"submit\" value=\"Rafraichir\"/>";
          echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

          echo "</td></tr>";
       }
    }
    ?>


</table>
</form>
<button><a href="produitListe.php">Precedent</a></button>

<!--<button><a href="vent.php?marque=<?php //echo $l ?>">Passer la commande</a></button>-->

<button onclick="vent()">Passer la commande</button>




 <div style="display: none;" id="vent">
 <h1>Sélectionnez une adresse de livraison</h1><br>
 <form method="post">
 <input type="text" name="adresse" placeholder="Adresse"><br>
 <input type="text" name="ville" placeholder="Ville"><br>
 <input type="text" name="cp" placeholder="code postal"><br>
 <br><input type="text" name="promo" placeholder="Entrez un code promotionnel Fairrepack"><br> 
 <input type="submit" name="submit" value ="Valider">
 </form>
 <?php 
     if (isset($_POST["promo"])) {
     $code = $_POST["promo"];
     $q = "SELECT * FROM promo WHERE code_promo= ?";
     $req = $bdd->prepare($q);
     $req->execute([$code]);
     $results = $req->fetch(PDO::FETCH_ASSOC);
     //$results = $req->fetchAll();
     $promo = $results["code_promo"];
     $pourcentage = $results["pourcentage"];
     if ($promo == $code) {
      echo "Felicitation vous avez ". $pourcentage*100 ." % de reduction";
     }

     else{
       echo "le code promo est incorrect !";
     }
     $adresse=$_POST["adresse"];
     $ville =$_POST["ville"];
     $cp=$_POST["cp"];
     }
     $price_base= MontantGlobal()*100;
     echo "<br>Prix de base : " . $price_base/100 . "€";
     if($pourcentage!=0 && $promo == $code){
     $price= MontantGlobal()*100*$pourcentage;
     echo "<br>Montant total : " . $price/100 . "€";
     }
     else{
      $price=$price_base;
     }
     $marque=array();
     $id=array();
     $Prix= array();
     for ($y=0 ;$y < $nbArticles ; $y++){
     $id[$nbArticles][$y]=$ids[$i-1][$y];
     }
     for ($y=0 ;$y < $nbArticles ; $y++){
     $marque[$nbArticles][$y]=$marques[$i-1][$y];
     }
     for ($y=0 ;$y < $nbArticles ; $y++){
     $Prix[$nbArticles][$y]=$prixs[$i-1][$y];
     }
     ?>

  
    <form action="proceder_paiment.php" method="POST" > 
    <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_51HvnSXLfVIRMJ0NcCHXIOAVZycXjrTFFufc6xxM2TMBpUIOXxlXTRjo39eHjHfJRifhFxi7FBMRB2yESP5r1DC3P00DWr1W2jB"
    data-amount= "<?php echo $price ;?>"
    data-name="FairRepack"
    data-description="Paiment"
    data-image="suppImage/logo.png"
    data-locale="auto"
    data-currency="eur"
    data-label="Acheter" >
    </script>
    <input type="hidden" name="prix" value="<?php echo $price ;?>">
    <input type="hidden" name="email" value="<?php echo $_SESSION['email'] ;?>">
    <input type="hidden" name="adresse" value="<?php echo $adresse ;?>">
    <input type="hidden" name="ville" value="<?php echo $ville ;?>">
    <input type="hidden" name="cp" value="<?php echo $cp ;?>">
    <input type="hidden" name="nbArticles" value="<?php echo $nbArticles ?>">
    <?php for ($i=0; $i < $nbArticles; $i++){ ?>
    <input type="hidden" name="marque[]" value="<?php echo $marque[$nbArticles][$i]?>">
    <input type="hidden" name="id[]" value="<?php echo $id[$nbArticles][$i]?>">
    <input type="hidden" name="Prix[]" value="<?php echo $Prix[$nbArticles][$i]?>">
    <?php } ?>
    </form>

 </div>
 <script type="text/javascript">
   function vent(){
      const div= document.getElementById('vent');
      div.style.display="inline";
   }
 </script>
  <?php require ("../vendor/include/footer.php"); ?>
</body>
</html>