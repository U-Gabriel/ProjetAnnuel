<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Paiement !</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<!-- proceder au paiment -->
<?php
 require_once('stripe-php-master/init.php'); // Ne pas oublier cte ligne +modifier lien vers la bonne librairie
 
\Stripe\Stripe::setApiKey("sk_test_51HvnSXLfVIRMJ0Ncpjn7oWRDYxGnYrk6LcmBNjeGGL3ww7KOh9JOoGEDJalpB1pJuQEjbpkQGZMm7aiQ8u1mvlF100N45PTHPw");

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
  
  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $price,
      'currency' => 'eur',
      'description' => 'Paiment',
      'receipt_email' => $email  
  ));
  $prix= $price/100;
  
   require ("../vendor/include/navbar.php"); 
   require ("../vendor/include/config.php"); 
  echo '<h1>Felicitation ! Votre paiment est accepté</h1>';
  echo '<h4>le total d\'achat: '.$prix.'€</h4>';
  echo '<h4>Nombre de Produit : '.$nbArticles.' Produit</h4>';
  echo '<h4>les produit acheter</h4>';
  for ($i=0; $i < $nbArticles; $i++){
    echo '<h5> - '.$marque[$i].' : '.$Prix[$i].' €</h5>';
   }
  echo '<h4>la date d\'achat : '.$date.'</h4>';
  echo '<h1>Adresse de livraison</h1>';
  echo '<h4>'.$adresse.' , '.$ville.' , '.$cp.'</h4>';
  echo '<h4>Une confirmation d\'achat est envoyé par courriel à : '.$email.'</h4>';
  ?>
  <h4>Confirmation d'achat : <a href="confirmation_achat.php?prix=<?php echo $prix ?>&adresse=<?php echo $adresse ?>&ville=<?php echo $ville ?>&cp=<?php echo $cp ?>&nbArticles=<?php echo $nbArticles ?>&marque=<?php for ($i=0; $i <$nbArticles; $i++) { 
     echo '-';
     echo $marque[$i];

  } ?>">Confirmation</a> </h4>
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
   echo "<h1>Merci de votre confiance a Fairrepack</h1>";
   }
   ?>
  <button><a href="produitListe.php">Boutique</a></button>


</body>
</html>