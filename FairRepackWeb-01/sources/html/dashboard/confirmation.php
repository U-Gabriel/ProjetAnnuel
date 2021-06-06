<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Confirmation</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
 	<?php include '../vendor/include/navbar.php'; 
        include '../vendor/include/config.php'; 
	?>
	 <section class="container-fluid" > 
      	                <h1 >confirmation de compte</h1><br>
                        <form method="POST" action="" >
                        <input type="text" name="confirmation" placeholder="code de confirmation"><br>
                        <input type='submit' value='Valider' name="Valider">
                        </form>
   </section>

<?php
echo $_SESSION['code'];
if (isset($_POST['Valider']) ){
 
  
  if ($_POST['confirmation']==$_SESSION['code']) {

    $q = 'UPDATE client SET confirmation = 1 WHERE email=?';
    $req = $bdd->prepare($q);
        $req->execute(array($_SESSION['email']));
        
        header('location: connexionC.php');
        

      }
  else{
   header('Location:confirmation.php?error=code_invalid');
  }}
  
?>

<?php include '../vendor/include/footer.php' ?>
</body>
</html>