<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Paiement !</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body style="background-color:rgba(0,0,0,0.1)">

<!-- proceder au paiment -->
<?php
 /*require_once('stripe-php-master/init.php'); // Ne pas oublier cte ligne +modifier lien vers la bonne librairie
 
\Stripe\Stripe::setApiKey("sk_test_51HvnSXLfVIRMJ0Ncpjn7oWRDYxGnYrk6LcmBNjeGGL3ww7KOh9JOoGEDJalpB1pJuQEjbpkQGZMm7aiQ8u1mvlF100N45PTHPw");
*/
  $token  = $_POST['stripeToken'];
  //$email  = $_POST['stripeEmail'];
  $date= date("m.d.y"); 
  $price  = $_POST['prix'];
  $email = $_POST['email'];
  $adresse=$_POST['adresse'];
  $ville =$_POST['ville'];
  $cp=$_POST['cp'];
  $nbArticles=$_POST['nbArticles'];
  for ($i=0; $i < $nbArticles; $i++){
    $marque[$i] = $_POST['marque'][$i];
    $id[$i] = $_POST['id'][$i];
    $Prix[$i] = $_POST['Prix'][$i];
  }
  
/*  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $price,
      'currency' => 'eur',
      'description' => 'Paiment',
      'receipt_email' => $email  
  ));*/
  $prix= $price/100;
  
   require ("../vendor/include/navbar.php"); 
   require ("../vendor/include/config.php"); 
   
  echo '<div class="container mb-4" style="display: flex; flex-direction: row;background-color:white" >';
  echo '<div class="container mb-4">';
  echo '<br><br><h4>Felicitation ! Votre paiment est accepté</h4><hr>';
  echo '<h6>le total d\'achat: '.$prix.'€</h6>';
  echo '<h6>Nombre de Produit : '.$nbArticles.' Produit</h6>';
  echo '<h6>les produits acheter</h6>';
  for ($i=0; $i < $nbArticles; $i++){
    echo '<h6> - '.$marque[$i].' : '.$Prix[$i].' €</h6>';
   }
  echo '<h6>la date d\'achat : '.$date.'</h6>';
  echo '<br><br><h4>Adresse de livraison</h4><hr>';
  echo '<h6>'.$adresse.' , '.$ville.' , '.$cp.'</h6>';
  echo '<br><h6>Une confirmation d\'achat est envoyé par courriel à : '.$email.'</h6>';
  ?>
  <h6>Confirmation d'achat : <a href="confirmation_achat.php?prix=<?php echo $prix ?>&adresse=<?php echo $adresse ?>&ville=<?php echo $ville ?>&cp=<?php echo $cp ?>&nbArticles=<?php echo $nbArticles ?>&marque=<?php for ($i=0; $i <$nbArticles; $i++) { 
     echo '-';
     echo $marque[$i];

  } ?>">Confirmation</a> </h6>
  <br>
  <?php  
   for ($i=0; $i < $nbArticles ; $i++) { 
   $q = 'INSERT INTO paiement (email_client,id_produit,Montant,date_achat) VALUES ( :val1, :val2, :val3, :val4)';
   $req = $bdd->prepare($q);
   $req->execute([
  'val1' => $email,
  'val2' => $id[$i],
  'val3' => $Prix[$i],
  'val4' => $date
   ]);
   
   }echo "<br><br><h4>Merci de votre confiance a Fairrepack</h4>";
   ?>
  <br><button class="btn btn-outline-dark flex-shrink-0"><a href="produitListe.php">Boutique</a></button>
</div>
<div class="container mb-4">
  <br><br><img src="../vendor/img/remerciement.jpg">
</div>
</div>

<?php include '../vendor/include/footer.php'; ?>

</body>
</html>