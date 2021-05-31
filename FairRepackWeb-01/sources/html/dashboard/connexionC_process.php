<?php session_start();
 require('../vendor/include/config.php');
 
//**************************************************************************************************
//verification Email and password*******************************************************************
if(isset($_POST['email']) && isset($_POST['password'])){

$email    = $_POST['email'];
$password = hash('sha256', $_POST['password']);

$q = "SELECT id_Client FROM client WHERE Email = ? AND Password = ?";
    $req = $bdd->prepare($q);
    $req->execute([$email, $password]);
    $results = $req->fetchAll();
     

if(count($results) == 0){
 	header('location: connexionC.php?msg=Identifiant incorrect!');
 	exit;
 }
else{
	$_SESSION['email']= $email;
	header('location:../index/index.php');
	exit;
}}

else{
	header('location: connexionC.php?msg=type mail and password !');
}
 

 ?>
