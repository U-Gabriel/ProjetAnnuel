<?php session_start();

require('../vendor/include/config.php');

//**************************************************************************************************
//eviter les scriptes et enlever les espaces********************************************************
    $email = htmlspecialchars(trim($_POST['email']));
    $password = hash('sha256', $_POST['password']);
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $N_telephone = htmlspecialchars(trim($_POST['telephone']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $ville = htmlspecialchars(trim($_POST['ville']));
    $cp = htmlspecialchars(trim($_POST['cp']));
    $civilite = htmlspecialchars(trim($_POST['civilite']));

$code= "";
for ($i=0; $i <5 ; $i++) { 
  $code .=mt_rand(1,9);
}
$CO=$_SESSION['code']=$code;
$_SESSION['email']=$email;
$message = 'Bonjour, votre code de confirmation est  : $CO'; 
mail($email, 'Confirmation email', $message);

//**************************************************************************************************
//insertions des donnees a la bdd ******************************************************************
 $q = 'INSERT INTO client (Email, Password,N_telephone,Adresse,nom,prenom,ville,cp,civilite,confirmation) VALUES (:val1, :val2, :val3, :val4, :val5,:val6, :val7, :val8,:val9, :val10)';
 $req = $bdd->prepare($q);
 $req->execute([
	'val1' => $email,
	'val2' => $password,
	'val3' => $N_telephone,
	'val4' => $adresse,
	'val5' => $nom,
	'val6' => $prenom,
	'val7' => $ville,
	'val8' => $cp,
	'val9' => $civilite,
	'val10'=> 0
	
 ]);

//**************************************************************************************************
//si l'inscription est reussie on passe a la page de connexion**************************************
header('location: confirmation.php');
exit;


?>










