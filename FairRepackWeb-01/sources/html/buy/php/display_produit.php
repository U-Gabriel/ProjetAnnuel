<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=fairrepack;', 'root', 'root');

$stmt = $pdo->query('SELECT name, description, reponse, email_client FROM  aide');   
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table>';
echo '<tr> <th>Nom</th> <th>Description</th> <th>Réponse</th>  </tr>';

foreach ($res as $ing) {
  if($ing['email_client'] == $_SESSION['email']){
        echo '<tr>';

        echo '<td>' . $ing['name'] . '</td>';

        echo '<td>' . $ing['description'] . '</td>';

        if($ing['reponse'] == "non"){
          echo '<td>' . "En attente d'une réponse" . '</td>';
        }else{
          echo '<td>' . $ing['reponse'] . '</td>';
        }
       
        echo '</tr>';

  }

}

echo '</table>';


?>