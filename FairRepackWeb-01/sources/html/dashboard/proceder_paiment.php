<!-- proceder au paiment -->
<?php
  require_once('stripe-php-7.77.0/init.php'); // Ne pas oublier cte ligne +modifier lien vers la bonne librairie

\Stripe\Stripe::setApiKey("sk_test_51HvnSXLfVIRMJ0Ncpjn7oWRDYxGnYrk6LcmBNjeGGL3ww7KOh9JOoGEDJalpB1pJuQEjbpkQGZMm7aiQ8u1mvlF100N45PTHPw");

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $price  = $_POST['prix'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $price,
      'currency' => 'eur',
      'description' => 'Achat produit',
      'receipt_email' => $email  
  ));

  echo '<h1>Payment accepted!</h1>';
  
?>