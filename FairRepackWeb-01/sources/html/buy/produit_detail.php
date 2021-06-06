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
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Fair Repack - Produit !</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../vendor/assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../vendor/css/styles.css" rel="stylesheet" />
            
        <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendor/css/style.css">
        <link rel="icon" href="../vendor/img/fRepackFav.png" />
        <meta name="description" content="Aider l'environnement tout en vous aidant.">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        </head>
    <body onload="displayCommentaire()">
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

$marque= $produit['Marque'];
$prix= $produit['Prix'];
?>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                      <img class="card-img-top mb-5 mb-md-0" src="uploads_produit/<?php echo '' . $produit['picture1'] . ''?>" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1"><?php echo $produit['Type']?></div>
                        <h1 class="display-5 fw-bolder"><?php echo $produit['model']?></h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through"><strike><?php echo $prix+10?>€</strike></span>
                            <span><?php echo $prix?>€</span>
                        </div>
                        <p class="lead"><?php echo $produit['Description']?></p>
                        <div class="d-flex">
                           
                            <button class="btn btn-outline-dark flex-shrink-0" type="button"><a href="panier.php?action=ajout&amp;l=<?php echo $marque; ?>&amp;q=1&amp;p=<?php echo $prix; ?>&amp;id=<?php echo $id; ?>">
                            <i class="bi-cart-fill me-1"></i>
                            Ajouter au panier
                            </a></button>
                        </div>
                    </div>
                </div><br><br>
                <h2 class="display-5 fw-bolder">Commentaires:</h2>
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
               </div>

 
        </section>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Special Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                    $18.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Sale Item</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                    $25.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Popular Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    $40.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

  
<?php
}
?>





</main>
<script src="js/listAndDet.js"></script>
 <?php require ("../vendor/include/footer.php"); ?>
</body>
</html>