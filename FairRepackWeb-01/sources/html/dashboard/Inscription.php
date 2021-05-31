<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Inscription</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
	<body>
    <?php include('../vendor/include/navbar.php'); ?>
    <main>

      	                <h1 class="inscription">inscription</h1><br>
                        <form class="FORM"  method="POST" action="inscription_process.php" >
                        <select name="civilite">
                        <nom>civilite</nom>
                        <libellé>Civilité</libellé>
                        <option >M.</option>
                        <option >Mme.</option>
                        </select><br>
                        <input class="INPUT" type="text" name="nom" placeholder="Nom"><br>
                        <input class="INPUT" type="text" name="prenom" placeholder="Prenom"><br>
 	                      <input class="INPUT" type="email" name="email" placeholder="Votre email"><br>
                        <input class="INPUT" type="tel" name="telephone" placeholder="Votre telephone"><br>
 	                      <input class="INPUT" type="text" name="adresse" placeholder="Votre adresse"><br>
 	                      <input class="INPUT" type="text" name="ville" placeholder="ville"><br>
                        <input class="INPUT" type="text" name="cp" placeholder="code potale"><br>
 	                      <input class="INPUT" type="password" name="password" placeholder="Votre mot de passe"><br>
                        <input class="INPUT" type="password" name="password2" placeholder="confirmer mot de passe"><br>
                        <input  type='submit' value='Valider' name="Valider">
                        </form>

          </main>

            <?php include('../vendor/include/footer.php'); ?>
     </body>
</html>