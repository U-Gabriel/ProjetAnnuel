<?php session_start();
require('../vendor/include/config.php');


if(isset($_GET['type'])){
$type = $_GET['type'];

$stmt = $bdd->prepare('SELECT * FROM  produit WHERE Type = ?'); 

	if($stmt) {
	    $stmt->execute([
	      $type
	    ]);

	}

}
else{


$stmt = $bdd->query('SELECT * FROM  produit');
}

$produit = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Fair Repack - Produits !</title>
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../vendor/assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../vendor/css/styles-2.css" rel="stylesheet" />
</head>
    <?php  require ("../vendor/include/navbar.php");
    ?>
<body >
	
	

    <main style="background-color: rgba(0,0,0,0.1); ">
     <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Fairrepack</p>
                </div>
            </div>
        </header>

    <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        	<?php
                        	foreach ($produit as $ing) {
                        	
                        	
                        	?>
                    <div class="col mb-5">
                        <div class="card h-100">
                             <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" style="height: 250px" src="uploads_produit/<?php echo '' . $ing['picture1'] . ''?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo '<br>' . $ing['model'] . '<br>';  ?></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                   <?php echo '' . $ing['Prix'] . '€'; ?> 
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" onclick="detailProduit(<?php echo'' . $ing['Id_Produit'] . ''?>)">Details</a></div>
                  
                            </div>
                        </div>
                    </div>


<?php } ?>



                   </div>
               </div>
           </section>

</main>
<script src="js/listAndDet.js"></script>
<?php require ("../vendor/include/footer.php");  ?>
</body>
</html>