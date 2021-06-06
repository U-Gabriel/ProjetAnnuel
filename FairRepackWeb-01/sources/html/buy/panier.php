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
    <!-- Site meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">
</head>
<body>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Panier</h1>
     </div>
</section>
<form method="post" action="panier.php">



<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Produit</th>
                            <th scope="col">Disponibilité</th>
                            <th scope="col" class="text-center">Quantité</th>
                            <th scope="col" class="text-right">Prix</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php


     if (creationPanier())
    {

       $nbArticles=count($_SESSION['panier']['libelleProduit']);
       if ($nbArticles <= 0)
        echo "Votre panier est vide";
       else
       {
          for ($i=0 ;$i < $nbArticles ; $i++)
          { ?>
                        <tr>
                            <td><img style='height: 100px;width: 100px;' src="uploads_produit/<?php echo $_SESSION['panier']['photoProduit'][$i]?>"></td>
                            <td><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
                            <td>En stock</td>
                            <td><input class="form-control" type="text" value="<?php echo $_SESSION['panier']['qteProduit'][$i] ?>" /></td>
                            <td class="text-right"><?php echo $_SESSION['panier']['prixProduit'][$i]*$_SESSION['panier']['qteProduit'][$i]?></td>
                            <?php echo "<td class='text-right'><button class='btn btn-sm btn-danger'><i class='fa fa-trash'><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\"></a></td>"; ?> 
                           
                        </tr>
                       <?php 
                         $marques = array(
                            $i => $_SESSION['panier']['libelleProduit'], 
                         );
                          $prixs = array(
                            $i => $_SESSION['panier']['prixProduit'], 
                         ); 
                          $ids = array(
                            $i => $_SESSION['panier']['idProduit'], 
                         );


                       }?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td class="text-right"><?php echo MontantGlobal(); }}?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Livraison</td>
                            <td class="text-right">6,90 €</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total a payer</strong></td>
                            <td class="text-right"><strong><?php echo MontantGlobal()+6.90;?></strong></td>
                        </tr>
                    </tbody>
                </table>
              
            </div>
        </div>
        
    </div>
</div>
 
</form>
<div  class="container mb-4">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light"><a href="produitListe.php">Continue l'achat</a></button>
                </div> 
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-block btn-light"><a href="../index/index.php">Quitter</a></button>
                </div>
            </div>
</div>
              
 
<div class="container mb-4" id="vent">
 <h1>Sélectionnez une adresse de livraison</h1><br>
 <form method="post">
 <input class="form-control" type="text" name="adresse" placeholder="Adresse"><br>
 <input class="form-control" type="text" name="ville" placeholder="Ville"><br>
 <input class="form-control" type="text" name="cp" placeholder="code postal"><br>
 <br><input class="form-control" type="text" name="promo" placeholder="Entrez un code promotionnel Fairrepack"><br> 
 <input type="submit" name="submit" class="btn btn-lg btn-block btn-success text-uppercase"  value ="Valider">
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
     $price_base= (MontantGlobal()+6.90)*100;
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