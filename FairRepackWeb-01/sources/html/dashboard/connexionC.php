<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Connexion</title>
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
    <main>

            <form action="connexionC_process.php" method="POST" class="CONNEXION">
                <h1>CONNEXION</h1>
            <input class="INPUT" type="email" name="email" placeholder="Votre Email"><br>
            <input class="INPUT" type="password" name="password" placeholder="Votre mot de passe"><br>
            <input class="SUBMIT" type="submit" value="Connexion">
            </form>

            <a href="inscription.php">Créer un compte</a>
    </main>
    <?php include '../vendor/include/footer.php'; 
    ?>
     </body>
</html>