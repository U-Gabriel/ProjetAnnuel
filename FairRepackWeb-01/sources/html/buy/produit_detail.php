<?php session_start();

include '../vendor/include/navbar.php';
require('../vendor/include/config.php');

  if(isset($_GET['id']) AND !empty($_GET['id'])) {
     $date = date("d-m-Y");
     $getid = htmlspecialchars($_GET['id']);
     $article = $bdd->prepare('SELECT * FROM produit WHERE Id_Produit = ?');
     $article->execute(array($getid));
     $article = $article->fetch();
     if(isset($_POST['submit_commentaire'])) {
        if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
           $pseudo = htmlspecialchars($_POST['pseudo']);
           $commentaire = htmlspecialchars($_POST['commentaire']);
           if(strlen($pseudo) < 25) {
              $ins = $bdd->prepare('INSERT INTO commentaires (pseudo, commentaire, id_article, date_com) VALUES (?,?,?,?)');
              $ins->execute(array($pseudo,$commentaire,$getid,$date));
              $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";

           } else {
              $c_msg = "Erreur: Le pseudo doit faire moins de 25 caractères";
           }
        } else {
           $c_msg = "Erreur: Tous les champs doivent être complétés";
        }
     }
     $commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE id_article = ? ORDER BY id_article DESC');
     $commentaires->execute(array($getid));


  ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fair Repack - Produit !</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body  onload="displayCommentaire()">
    <main>
  
<?php

if(isset($_GET['id'])) {

  $id = $_GET['id'];

  $stmt = $bdd->prepare('SELECT * FROM  produit WHERE Id_Produit = ?');

  if($stmt) {
    $stmt->execute([
      $id
    ]);

}

$produit = $stmt->fetch(PDO::FETCH_ASSOC);

  if(!empty($produit['picture1'])){
  echo '<img style="height: 300px;width: 250px;" src="uploads_produit/' . $produit['picture1'] . '">';
  }
  if(!empty($produit['picture2'])){
  echo '<img style="height: 300px;width: 250px;" src="uploads_produit/' . $produit['picture2'] . '">';
  }
  if(!empty($produit['picture3'])){
  echo '<img style="height: 300px;width: 250px;" src="uploads_produit/' . $produit['picture3'] . '">';
  }

if($produit['typeAutre'] != 0){
  echo '<h3>' . "Type d'objet : " . '</h3>'; 
  echo '<h5>' . $produit['typeAutre'] . '<h5>' ;
}

echo '<h4>Marque : '.$produit['Marque'].'</h4>';
echo '<h4>Model : '.$produit['model'].'</h4>';

echo '<h4>Description :'.$produit['Description'].'</h4>'; 

echo '<h4>Prix : ' .$produit['Prix']. '</h4>'; 

if($produit['screenState'] != 0){
  echo '<h3>' . "État de l'écran : " . '</h3>'; 
  echo '<h5>' . $produit['screenState'] . '<h5>' ;
}

if($produit['chargeAutre'] != 0){
  echo '<h3>' . "Chargeur inclus : " . '</h3>'; 
  echo '<h5>' . $produit['chargeAutre'] . '<h5>' ;
}

if($produit['stockageCapacity'] != 0){
  echo '<h3>' . "Capacité de stockage : " . '</h3>'; 
  echo '<h5>' . $produit['stockageCapacity'] . '<h5>' ;
}


if($produit['coqueAspect'] != 0){
  echo '<h3>' . "Aspect extérieur de l'appareil : " . '</h3>'; 
  echo '<h5>' . $produit['coqueAspect'] . '<h5>' ;
}


}else { echo '-1';}

$marque= $produit['Marque'];
$prix= $produit['Prix'];
 ?>
 <button style="background-color: rgba(0,155,0,0.5);"><a href="panier.php?action=ajout&amp;l=<?php echo $marque; ?>&amp;q=1&amp;p=<?php echo $prix; ?>&amp;id=<?php echo $id; ?>">Ajouter au Panier</a></button>

 <h2>Commentaires:</h2>
  <form method="POST">
     <input type="text" name="pseudo" placeholder="Votre pseudo" /><br />
     <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
     <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
  </form>

  <?php if(isset($c_msg)) { echo $c_msg; } ?>
  <br /><br />
  <?php while($c = $commentaires->fetch()) { ?>
   <br> <b style="font-size: 10">le<?= $c['date_com'] ?></b><br>
     <b><?= $c['pseudo'] ?>:</b> <?= $c['commentaire']?><br />
  <?php } ?>
  <?php
  }
  ?>



</main>
<script src="js/listAndDet.js"></script>
 <?php require ("../vendor/include/footer.php"); ?>
</body>
</html>