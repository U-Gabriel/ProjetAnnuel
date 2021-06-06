<?php session_start();
  if($_SESSION['email'] == null){
    header('Location: connexionC.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
</head>
<body>
<?php 
  include("../vendor/include/navbar.php"); 
  include("../vendor/include/config.php"); 
?>	
<p>merci de votre confiance a Fairrepack !</p>
<?php
$id=$_GET['id'];
$q = "DELETE FROM produit WHERE Id_Produit = ?";
	$req = $bdd->prepare($q);
        $req->execute([$id]);

?>

<p>Votre produit est retirer</p>
<button style="margin-right:10px;" class="btn btn-info " ><a href="../buy/aide.php">Aide</a></button>
<button style="margin-right:10px;" class="btn btn-info " ><a href="../buy/produitListe.php">Boutique</a></button>




 <?php require ("../vendor/include/footer.php"); ?>
</body>
</html>
