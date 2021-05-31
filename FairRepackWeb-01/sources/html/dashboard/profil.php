<?php session_start();
  if($_SESSION['email'] == null){
    header('Location: connexionC.php');
  }
  ?>
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

<?php include("../vendor/include/navbar.php"); 
      include("../vendor/include/config.php"); 
?>

<body>
     <?php
                        include('includes/config.php');


                        $q='SELECT * FROM client WHERE Email=?';
                        $req = $bdd->prepare($q);
                        $req ->execute([$_SESSION['email']]);
                        $results = $req->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($results as $key => $value) {
                        ?>
    <section>
                          <h1 class="TITLE">Profil</h1><br>
                          <p class="TITLE"><?php echo' Nom   : '.$value['nom'].''; ?></p>
                          <p class="TITLE"><?php echo' Prenom   : '.$value['prenom'].''; ?></p>
                          <p class="TITLE"><?php echo' Civilite   : '.$value['civilite'].''; ?></p>
                          <p class="TITLE"><?php echo' Email     : '.$value['Email'].''; ?><br>
                          <p class="TITLE"><?php echo' Adresse   : '.$value['Adresse'].''; ?><br>
                          <p class="TITLE"><?php echo' ville  : '.$value['ville'].''; ?><br>
                          <p class="TITLE"><?php echo' code postale   : '.$value['cp'].''; ?><br>
                          <p class="TITLE"><?php echo' Telephone : '.$value['N_telephone'].''; }?><br><br><br>
                          <a href="modife.php">Modifier votre Profil</a>
                          <a href="delete.php">Supprimer Compte</a>
                        
     </section> 
      <?php require ("../vendor/include/footer.php"); ?>
</body>
</html>