<?php session_start();
require('../vendor/include/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Revendre !</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>


<?php include '../vendor/include/navbar.php'; ?>
<main>
   <form action = "barre_recherche.php" method = "get">
   <input type = "search" name = "terme">
   <input type = "submit" name = "s" value = "Rechercher">
   </form>
  <?php if(isset($_SESSION['email'])){ ?>
  <div>
  <h1>Vente de produit</h1>
    <p> On va te poser des questions qui nous permettront d'évaluer ton produit<br>
      Déjà, que souhaites-tu vendre ?</p>
      <form  method="post" autocomplete="off" enctype="multipart/form-data">
      <div id="choice">
        <input type="radio" name="choice" value="phone"> Téléphone<br>
        <input type="radio" name="choice" value="touchpad"> Tablette<br>
        <input type="radio" name="choice" value="player"> Consôle de jeux<br>
        <input type="radio" name="choice" value="other"> Autres<br>
      </div>
        <button onclick="sellSmart()">Quel et votre choix ?</button><br>
    </form>

    <?php 
    if(isset($_POST['choice'])){
      $choice = $_POST['choice'];
      ?>
    <form action="php/sell_verif.php" method="post" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="choice" value=<?php echo $choice; ?>>
    <?php
    if($choice == "phone"){
    ?>
     
    <h1>Quelle est la marque de votre mobile ?</h1>
    <select name="marque" id="form1" onChange="getListContent(this)">
    <option disabled selected>Marque</option>
    <option  value="Apple">Apple</option>
    <option  value="Huawei">Huawei</option>
    <option  value="LG">LG</option> 
    <option  value="Samsung">Samsung</option>
    <option  value="Sony">Sony</option>
    <option  value="Nokia">Nokia</option>
    <option  value="Motorola">Motorola</option>
    <option  value="Xiaomi">Xiaomi</option>
    <option  value="Autre">Autre</option>
    </select>
    <h1>Quelle est le model de votre mobile ?</h1>
    <select name="model" id="form2">
    <option>Choisissez</option>
    </select>



 
  <div id="stateScreen">
   <h1>Dans quel état est l’écran ?</h1>
   <input type="radio" value="Intact" name="stateScreen">Intact</input>
   <input type="radio" value="MicroRayures" name="stateScreen">Micro-rayures</input>
   <input type="radio" value="Rayures" name="stateScreen">Rayures</input>
   <input type="radio" value="Cassé" name="stateScreen">Cassé</input>
   </div>

    <div id="capacity">
    <h1>Quelle est sa capacité en gigabit?</h1>
   <input type="radio" value="16Go" name="capacity">
   <label for="16Go">16Go</label>
   <input type="radio" value="32Go" name="capacity">
   <label for="32Go">32Go</label>
   <input type="radio" value="64Go" name="capacity">
   <label for="64Go">64Go</label>
   <input type="radio" value="128Go" name="capacity">
   <label for="128Go">128Go</label>
   <input type="radio" value="256Go" name="capacity">
   <label for="256Go">256Go</label>
   </div>


  


    <?php
    }
    if($choice == "touchpad"){
      ?>

      <h1>Quelle est la marque de votre tablette ?</h1>
  <select  name="marque">
    <option value="">Marque</option>
    <option value="Apple">Apple</option>
    <option value="Samsung">Samsung</option>
    <option value="Huawei">Huawei</option>
    <option value="Autre">Autre</option>
  </select>


<div id="capacity">
    <h1>Quelle est sa capacité en gigabit?</h1>
   <input type="radio" value="16Go" name="capacity">
   <label for="16Go">16Go</label>
   <input type="radio" value="32Go" name="capacity">
   <label for="32Go">32Go</label>
   <input type="radio" value="64Go" name="capacity">
   <label for="64Go">64Go</label>
   <input type="radio" value="128Go" name="capacity">
   <label for="128Go">128Go</label>
   <input type="radio" value="256Go" name="capacity">
   <label for="256Go">256Go</label>
</div>

<div>
    <h1>Dans quel état est l’écran ?</h1>
   <input type="radio" value="Intact" name="ecran">Intact
   <input type="radio" value="MicroRayures" name="ecran">Micro-rayures
   <input type="radio" value="Rayures" name="ecran">Rayures
   <input type="radio" value="Cassé" name="ecran">Cassé
</div>

    <?php
  }
  if($choice == "player"){
    
    ?>

  <h1>Quelle est la marque de votre appareil ?</h1>
  <select name="marque">
    <option value="">Marque</option>
    <option value="Microsoft">Microsoft</option>
    <option value="Nitendo">Nitendo</option>
    <option value="Sony">Sony</option>
  </select>

    <?php
  }
  if ($choice == "other") {

    ?>

          <h1>Quel type de produit souhaitez-vous vendre ?</h1>
  <select id="type">
    <option disabled selected>Type de Produit</option>
    <option value="photoAndCamera">Appareil Photo & Camera</option>
    <option value="audio">Casque Audio & ecouteurs</option>
    <option value="pc">PC Portable</option>
    <option value="Watch">Montre connectée</option>
  </select>

        <h1>Quelle est sa marque?</h1>
    <input type="text" name="marque">


       <h1>Avez vous le chargeur de votre produit ?</h1>
    <select id="charge">
      <option disabled selected>Chargeur</option>
      <option value="no">Non</option>
      <option value="yes">Oui</option>
    </select>

  </select>

    <?php
    
  }
?>
      <div>

    <h1>Votre produit est-il fonctionnel ?</h1>
    <select name="fonctionnement">
    <option value="">Fonctionnement</option>
    <option value="yes">Oui</option>
    <option value="no">Non</option>
  </select>
</div>

<div>
    <h1>Quel est l'état extérieur de l'appareil ?</h1>
   <input type="radio" value="Intact" name="enveloppe">Intact
   <input type="radio" value="MicroRayures" name="enveloppe">Micro-rayures
   <input type="radio" value="Rayures" name="enveloppe">Rayures
   <input type="radio" value="Cassé" name="enveloppe">Cassé
</div>

       <h1>L'année de sortie</h1>
    <select name="annee">
      <option value="">Année</option>
      <option value="2010">2010</option>
      <option value="2011">2011</option>
      <option value="2012">2012</option>
      <option value="2013">2013</option>
      <option value="2014">2014</option>
      <option value="2015">2015</option>
      <option value="2016">2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
    </select>


    <h1>Couleur de l'appareil</h1>
    <select name="couleur" name="coleur">
    <option value="">Couleurs</option>
    <option value="Noir">Noir</option>
    <option value="Blanc">Blanc</option>
    <option value="Argent">Argent</option>
    <option value="Gris">Gris</option>
    <option value="Bleu">Bleu</option>
    <option value="Or">Or</option>
    <option value="Rouge">Rouge</option>
    <option value="Mauve">Mauve</option>
    <option value="Marron">Marron</option>
    <option value="Beige">Beige</option>
    <option value="Jaune">Jaune</option>
    </select>

      <h1>Avez vous d'autres description ?</h1>
    <input type="text" name="description">

    <h1>Une ou plusieurs image à proposé ?</h1>
  <input type="file" name="produit_image1">
  <input type="file" name="produit_image2">
  <input type="file" name="produit_image3"><br>

  <br><input type="submit" value="Valider"><br>


  <?php

    }
  ?>
</form>



  <?
  }
  else{
    ?>
    <h3>Connectez-vous</h3><br>
    <h4><a href="../dashboard/Inscription.php">Inscription</a><h4>
    <h4><a href="../dashboard/connexionC.php">Connexion</a><h4>
 <?php
  }
    ?>


</div>
</main>
<script src="js/sell.js" charset="utf-8"></script>
 <?php require ("../vendor/include/footer.php"); ?>
</body>
</html>