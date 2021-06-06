<?php session_start();
  if($_SESSION['email'] == null){
    header('Location: connexionC.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
</head>
<body>
<?php 
      include("../vendor/include/navbar.php"); 
      include("../vendor/include/config.php"); 
      $q='SELECT * FROM client WHERE Email=?';
      $req = $bdd->prepare($q);
      $req ->execute([$_SESSION['email']]);
      $results = $req->fetchAll(PDO::FETCH_ASSOC);
      foreach ($results as $key => $value) {
      

?>
<br><br><br>
<div class="container">
    <div class="main-body">
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo ''.$value['civilite'].''.$value['nom'].'' ?></h4>
                      <p class="text-secondary mb-1">Client Fairrepack</p>
                      <p class="text-muted font-size-sm"></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
   
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo ''.$value['civilite'].' '.$value['nom'].' '.$value['prenom'].'' ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $value['Email'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $value['N_telephone'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo ''.$value['Adresse'].' '.$value['ville'].' '.$value['cp'].'' ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info "  href="modife.php">Modifier mes informations</a>
                      <a class="btn btn-info "  href="delete.php">Supprimer mon compte</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h1 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>Mes achats</h1>
    <?php

    $q = "SELECT * FROM client WHERE Email = ?";
    $req = $bdd->prepare($q);
    $req->execute([$_SESSION["email"]]);
    $results = $req->fetchAll();
    foreach ($results as $key => $value) {
      $id = $value['Id_Client'];
      $spe = $value['Facture'];
      $spe2 =$value['colissimo'];
      echo "<h5>Vos Factures</h5>";
      if ($spe!=0) {
      echo "<hr>";
      for ($i=1; $i <= $spe ; $i++) { 
        echo "<a href='../buy/uploads_factures/Facture".$id."_".$i.".pdf'>Facture_$i</a><br>";
      }
        
        echo "<br>";

      }
      else{
        echo "Vous n'avez aucune Facture";
      }}
    echo "<h5>Vos achats</h5>";
    $q2 = "SELECT * FROM paiement WHERE email_client = ?";
    $req2 = $bdd->prepare($q2);
    $req2->execute([$_SESSION["email"]]);
    $results2 = $req2->fetchAll();
    foreach ($results2 as $key => $value2) {
    if ($value2['email_client']==NULL) {
      echo "Vous n'avez acheter aucune produit";
    }
    else{
      echo "<hr>";
      //echo "id_produit : ".$value2['id_produit']."";
      $stmt = $bdd->prepare('SELECT * FROM  produit WHERE Id_Produit = ?');
      if($stmt) {
      $stmt->execute([
      $value2['id_produit']
      ]);}
      $produit = $stmt->fetch(PDO::FETCH_ASSOC);
      echo 'Marque : '.$produit['Marque'].'';
      echo "<br>";
      echo 'Model : '.$produit['model'].'';
      echo "<br>";
      echo "Montant : ".$value2['Montant']." €";
      echo "<br>";
      echo "Date : ".$value2['date_achat']."";
      }
      }
    ?>
                      
                     
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h1 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>Mes vents</h1>
                      <?php
                      echo "<h5>Bon colissimo</h5>";echo "<hr>";
                     if ($value['colissimo']==0) {
                     echo "Vous n'avez aucun bon collisimo";
                   }
                   else{
                   for ($i=1; $i <= $spe2 ; $i++) { 
                     echo "<a href='../buy/uploads_colissimo/colissimo".$id."_".$i.".pdf'>Colissimo_$i</a><br>";
                     }
                   }
                     echo "<br><br><h5>Etat de votre Produit</h5>";echo "<hr>";
                     
                        $stmt = $bdd->prepare('SELECT * FROM  produit WHERE email_client = ?');
                        $stmt->execute([$_SESSION['email']]);
                        $produit = $stmt->fetchAll();
                  foreach ($produit as $key => $produit) {
                   if ($produit['Etat_Offre']==0) {
                     echo "Vous n'avez aucune produit en attend";
                   }
                   else{
                     echo "". $produit['Type'] . " : ";
                     echo "". $produit['model'] . "<br>";
                     echo "Marque : ". $produit['Marque'] . "<br>";
                     if ($produit['Etat_Offre']==1) {
                    
                      echo "<p style='color:green'>Votre produit est accepté<p>";
                     }
                     if ($produit['Etat_Offre']==2) {
                       
                       echo "<i class='bi bi-truck'></i>";
                       echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                             <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                             </svg>';
                       echo "<p style='color:green'>Envoi en cours...</p>";
                       echo "<a href='suivi.php'>Plus d'informations</a>";
                     }
                     if ($produit['Etat_Offre']==3) {
                       echo "<p style='color:green'>Produit reçu, en train d'etude</p>";
                       echo "<a href='suivi.php'>Plus d'informations</a>";
                     }
                     if ($produit['Etat_Offre']==4) {
                       $price=250;
                       ?>
                       <input type="hidden" id="price" value="<?php echo $price ?>" />
                       <input type="hidden" id="id" value="<?php echo $produit['Id_Produit'] ?>" />
                       <?php
                       echo "<p style='color:orange'>Votre produit ne convient pas au description<br> On vous proposons $price €<br></p>";
                       echo '<button style="margin-right:10px;" class="btn btn-info " onclick="Accepte()"><i class="bi bi-check2"></i>';
                       echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                             <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>';
                       echo " Accepté</button>";
                       echo '<button class="btn btn-info " onclick="Refuse()"><i class="bi bi-x-lg" ></i>';
                       echo '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                             <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                             </svg>';
                       echo " Refusé</button>";
                     }
                     if ($produit['Etat_Offre']==5) {
                       echo "<p style='color:red'>Malheuresement Votre produit est rejter<br> vous devez payer les frais de retour</p>";
                       echo "<button class='btn btn-info' onclick='rejeter()' >Recuperer mon produit</button>";
                     }
                     echo "<hr>";
                     }
}

                      ?>
                    </div>

                  </div>
                </div>
              </div>



            </div>
          </div>

        </div>
    </div>
    <?php require ("../vendor/include/footer.php"); ?>
    <script type="text/javascript">
    var price = document.getElementById('price').value;
    var id    = document.getElementById('id').value;
    function Accepte(){
    if ( confirm('je confirme et je valide de vendre mon produit a : '+ price +'€') ) {
        document.location.href="accepte.php?id="+ id; 
    } else {
    }
    }
    function Refuse(){
    if ( confirm('je confirme et je valide de refusé cet proposition !') ) {
        document.location.href="refuse.php?id="+ id; 
    } else {
    }
    }
    function rejeter(){
    if ( confirm('Malheuresement votre produit est rejeter') ) {
        document.location.href="refuse.php?id="+ id; 
    } else {
    }
    }

    </script>
  </body>
  </html>