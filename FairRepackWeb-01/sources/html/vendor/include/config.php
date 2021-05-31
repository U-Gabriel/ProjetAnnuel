<?php
try{
	$bdd = new PDO('mysql:host=localhost:3306;dbname=fairrepack','root','root');
}
catch(Exception $e){
	die('Erreur :' . $e->getMessage());
}
?>