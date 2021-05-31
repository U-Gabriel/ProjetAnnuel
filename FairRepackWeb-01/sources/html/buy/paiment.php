<?php session_start();

 ?>     
<form action="proceder_paiment.php" method="POST" style="display: none;">
           
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_51HvnSXLfVIRMJ0NcCHXIOAVZycXjrTFFufc6xxM2TMBpUIOXxlXTRjo39eHjHfJRifhFxi7FBMRB2yESP5r1DC3P00DWr1W2jB"
    data-amount= "<?php echo $price ;?>"
    data-name="FairRepack"
    data-description="Paiment"
    data-image="../vendor/img/fRepackFav.png"
    data-locale="auto"
    data-currency="eur"
    data-label="Acheter" >
  </script>
   <input style="display: none;" type="text" name="prix" value="<?php echo $price ;?>">
   <input style="display: none;" type="text" name="marque" value="<?php echo $marque ;?>">
   <input style="display: none;" type="text" name="model" value="<?php echo $model ;?>">
   <input style="display: none;" type="text" name="email" value="<?php echo $_SESSION['email'] ;?>">
</form>

<!--src + class : ne pas toucher
data-key : ta clé d'api Stripe
data-amount : le montant affiché sur le formulaire 500 = 5€ ; 1000 = 10€
data-name : le nom de ta marque
data-description : ton produit vendu
data-image : image qui illustre ta marque, ton produit..
data locale : laisser sur auto pour que Stripe traduise la langue du formulaire en fonction des paramètres du navigateur de l'utilisateur
data-currency : les lettres de référence de votre monnaie -->







