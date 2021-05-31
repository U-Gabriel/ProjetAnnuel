<?php
session_start();
include '../../vendor/include/config.php';
$choice = $_POST['choice'];
$marque = $_POST['marque'];
$description = $_POST['description'];
$fonctionnement = $_POST['fonctionnement'];
$annee = $_POST['annee'];
$couleur = $_POST['couleur'];
$model = $_POST['model'];

if(empty($_POST['enveloppe'])){
  $enveloppe = "";
}else{
  $enveloppe = $_POST['enveloppe'];
}


if(!empty($_POST['stateScreen']) && !empty($_POST['capacity'])){
  $stateScreen = $_POST['stateScreen'];
  $capacity = $_POST['capacity'];
}else{
  $stateScreen = 0;
  $capacity = 0;
}

if(!empty($_POST['type']) && !empty($_POST['charge'])){
  $type = $_POST['type'];
  $charge = $_POST['charge'];
}else{
  $type = 0;
  $charge = 0;
}

//enregistrement dans uploads:
// Chemin vers le dossier d'uploads

$path = '../uploads_produit';

// Si le dossier n'existe pas, le créer

if(!file_exists($path)){
  mkdir($path, 0777);
}

$timestamp = time();

//pour l'image1, verification du support:

$acceptable= [
  'produit_image1.jpeg',
  'produit_image1.png',
  'produit_image1.gif',
];
if(in_array($_FILES['produit_image1']['type'], $acceptable)){
  header('location: sell.php?msg= type de fichier invalide. ');
  exit;
}

// Récupération de l'extension du fichier

$original_name = $_FILES['produit_image1']['name'];
$temp_array = explode('.', $original_name);
$extension = end($temp_array);
$produit_image1 = 'produit_image1-' . $timestamp . '.' . $extension;

$image_path = $path . '/' . $produit_image1;

if(move_uploaded_file($_FILES['produit_image1']['tmp_name'], $image_path)) {
  echo 'ok';
}else{
  $produit_image1 = 0;
}

//pour l'image2, verification du support:

$acceptable= [
  'produit_image2.jpeg',
  'produit_image2.png',
  'produit_image2.gif',
];
if(in_array($_FILES['produit_image2']['type'], $acceptable)){
  header('location: sell.php?msg= type de fichier invalide. ');
  exit;
}


// Récupération de l'extension du fichier

$original_name = $_FILES['produit_image2']['name'];
$temp_array = explode('.', $original_name);
$extension = end($temp_array);
$produit_image2 = 'produit_image2-' . $timestamp . '.' . $extension;

$image_path = $path . '/' . $produit_image2;

if(move_uploaded_file($_FILES['produit_image2']['tmp_name'], $image_path)) {
  echo 'ok';
}else{
  $produit_image2 = 0;
}


//pour l'image3, verification du support:

$acceptable= [
  'produit_image3.jpeg',
  'produit_image3.png',
  'produit_image3.gif',
];
if(in_array($_FILES['produit_image3']['type'], $acceptable)){
  header('location: sell.php?msg= type de fichier invalide. ');
  exit;
}

// Récupération de l'extension du fichier

$original_name = $_FILES['produit_image3']['name'];
$temp_array = explode('.', $original_name);
$extension = end($temp_array);
$produit_image3 = 'produit_image3-' . $timestamp . '.' . $extension;

$image_path = $path . '/' . $produit_image3;

if(move_uploaded_file($_FILES['produit_image3']['tmp_name'], $image_path)) {
  echo 'ok';
}else{
  $produit_image3 = 0;
}



//Calcul d'estimation***********************************************************************************************************************************
   $req= $bdd->prepare('SELECT * FROM  model WHERE marque= ? AND model=?'); // 
    if($req){ 
      $req->execute([$marque,$model]);
    }
    $produit = $req->fetch();
    $price = $produit['prix'];
    if ($price=0) {
      $price=100;  
    }
if ($enveloppe=="Cassé" ||  $stateScreen=="Cassé") {
   
   $price = $price/75;

}
if ($enveloppe=="Micro-rayures" ||  $stateScreen=="Micro-rayures") {
   
   $price = $price/10;

}
if ($enveloppe=="Rayures" ||  $stateScreen=="Rayures") {
   
   $price = $price/25;

}
if ($fonctionnement=="no") {
   
   $price = $price/80;

}
 //-10% taxe 
 $price = $price - $price/10;
 if($price<5){
  $price=5;
 }

 if ($price<50) {
   $Prix_F="<50";
 }
  if ($price>50 && $price<100) {
   $Prix_F="50-100";
 }
  if ($price>100 && $price<200) {
   $Prix_F="100-200";
 }
 if ($price>200 && $price<300) {
   $Prix_F="200-300";
 }
 if ($price>300 && $price<400) {
   $Prix_F="300-400";
 }
 if ($price>400) {
   $Prix_F=">400";
 } 



  $stmt = $bdd->prepare('INSERT INTO produit(Type, Description, Marque,model,couleur, fonctionnel, Prix,Prix_F, Etat_Offre, picture1, picture2, picture3, Année, screenState, typeAutre, chargeAutre, stockageCapacity, coqueAspect) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)');
  if($stmt){
    
    $success = $stmt->execute([
      $choice,
      $description,
      $marque,
      $model,
      $couleur,
      $fonctionnement,
      $price,
      $Prix_F,
      1,
      $produit_image1,
      $produit_image2,
      $produit_image3,
      $annee,
      $stateScreen,
      $type,
      $charge,
      $capacity,
      $enveloppe
    ]);
 
    if($success == 0){
      echo '-3';
      header('location: ../sell.php?msg=Un problème est survenue.');
    }
    else{
      echo '0'; //SUCCESS
      echo "<script>confirm( price.innerHTML =  'le prix est :' +$price )</script>";
      header('location: ../doc.php?marque='.$marque.'&model='.$model.'&type='.$choice.'&prix='.$price.'');
      }
  }
  else{
    echo '-2';
    header('location: ../sell.php?msg=Un problème est survenue.');
  }


?>
