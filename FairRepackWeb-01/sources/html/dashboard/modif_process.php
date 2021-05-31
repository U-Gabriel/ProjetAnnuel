<?php  session_start();

include '../vendor/include/config.php';

$adresse=$_POST['adresse'];
$ville=$_POST['ville'];
$cp=$_POST['cp'];
$email=$_SESSION['email'];
$telephone=$_POST['telephone'];
$password=hash('sha256', $_POST['password']);

if (isset($_POST['submit_Add'])) { 

$q = "UPDATE client SET Adresse=?  WHERE Email=? ";
		$req =$bdd->prepare($q);
        $req->execute(array($adresse,$email));

$q1 = "UPDATE client SET ville=?  WHERE Email=? ";
		$req1 =$bdd->prepare($q1);
        $req1->execute(array($ville,$email));

$q2 = "UPDATE client SET cp=?  WHERE Email=? ";
		$req2 =$bdd->prepare($q2);
        $req2->execute(array($cp,$email));

}

if (isset($_POST['submit_Tel'])) { 


$q = "UPDATE client SET N_telephone=$telephone  WHERE Email=?";
		$req = $bdd->prepare($q);
        $req->execute([$_SESSION['email']]);

}


if (isset($_POST['submit_Pass'])) { 


$q = "UPDATE client SET Password=? WHERE Email=?";
		$req = $bdd->prepare($q);
        $req->execute(array($password,$_SESSION['email']));

}



        header('location:profil.php');

        

?>