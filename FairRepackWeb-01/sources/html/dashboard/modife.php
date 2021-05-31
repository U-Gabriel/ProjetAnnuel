<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Profil</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
     
     
    <section class="container-fluid" id="SECTION">
      	               
                      
                        <form method="POST" action="modif_process.php">

                          <h1 class="TITLE">Modifier votre adresse</h1><br>
                          
                          <input class="INPUT" type="text" name=adresse placeholder="Type the new address">
                          <input class="INPUT" type="text" name=ville placeholder="Ville">
                          <input class="INPUT" type="text" name=cp placeholder="Code postale">
                          <input class="SUBMIT" type="submit" name="submit_Add" value="Modifier">

                          <h1 class="TITLE">Modifier numero telephone</h1><br>
                         
                          <input class="INPUT" type="text" name="telephone" placeholder="new Number phone">
                          <input class="SUBMIT" type="submit" name="submit_Tel" value="Modifier">

                          <h1 class="TITLE">Modifier mot de passe</h1><br>
                          
                          <input class="INPUT" type="password" name="password" placeholder="nouveau mot de passe">
                          <input class="SUBMIT" type="submit" name="submit_Pass" value="Modifier">


                        </form> 
     </section> 

     <?php include '../vendor/include/footer.php';  ?>
</body>
</html>