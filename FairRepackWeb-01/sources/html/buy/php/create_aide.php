<?php
session_start();

if(isset($_POST['name']) &&
  isset($_POST['description']) ){

  $name = $_POST['name'];
  $description = $_POST['description'];


  $pdo = new PDO('mysql:host=localhost;dbname=fairrepack;', 'root', 'root');

  $stmt = $pdo->prepare('INSERT INTO aide(name, description, reponse, email_client) VALUES (?, ?, ?, ?)');
  if($stmt){
    
    $success = $stmt->execute([
      $name,
      $description,
      "non",
      $_SESSION['email']
    ]);

    if($success == 0){
      echo '-3';
    }else{
      echo '0'; //SUCCESS
    }
  }else{
    echo '-2';
  }


}else {
  echo "<p>" . "Il semblerai que tu n'as pas incrit le nom ou la descriptiondu problème." . "</p>";
}


?>