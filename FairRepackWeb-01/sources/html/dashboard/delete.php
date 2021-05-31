<?php session_start();
 if($_SESSION['email'] == null){
    header('Location: connexionC.php');
  }
   include '../vendor/include/navbar.php'; 
   include '../vendor/include/config.php'; 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Suppresion</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
 <p>Voulez‑vous vraiment supprimer votre compte ?</p><br>
 <p>Pourquoi vous souhaitez nous quitter ?</p>
 <form>
 <input type="text" name="delete">	
 <input type="submit" name="supprimer" value="Supprimer">

 </form>

 <?php 
 if (isset($_GET["supprimer"])) {
 	  $q='DELETE FROM client WHERE Email=?';
      $req = $bdd->prepare($q);
      $req ->execute([$_SESSION['email']]);
      echo "votre compte Fairrepack a été supprimer";
 }

 ?>
 <?php require ("../vendor/include/footer.php"); ?>

</body>
</html>