<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inscription - Fairrepack</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../vendor/images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../vendor/fonts/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    
    <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="../vendor/css/util.css">
    <link rel="stylesheet" type="text/css" href="../vendor/css/main.css">
    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/css/style.css">
    <link rel="icon" href="../vendor/img/fRepackFav.png" />
    <meta name="description" content="Aider l'environnement tout en vous aidant.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>

      <?php include '../vendor/include/navbar.php'; 
              include '../vendor/include/config.php'; 
    ?>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('../vendor/images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form"  method="POST" action="inscription_process.php" >
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-landscape"></i>
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        sing in
                    </span>
                    

                    <div class="wrap-input100 validate-input" data-validate = "">
                    <select class="input100" name="civilite">
                        <nom>civilite</nom>
                        <libellé>Civilité</libellé>
                        <option >M.</option>
                        <option >Mme.</option>
                        </select>
                    </div><br>
                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="text" name="nom" placeholder="Nom">
                

                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="text" name="prenom" placeholder="Prenom">
                

                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "">
                          <input class="input100" type="email" name="email" placeholder="Votre email">
                    

                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="tel" name="telephone" placeholder="Votre telephone">
        

                        
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "">
                          <input class="input100" type="text" name="adresse" placeholder="Votre adresse">
                    

                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "">
                          <input class="input100" type="text" name="ville" placeholder="ville">
                    

                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="text" name="cp" placeholder="code potale">
                  

                   </div>

                    <div class="wrap-input100 validate-input" data-validate = "">
                      <input class="input100" type="password" name="password" placeholder="Votre mot de passe">
                      

                      
                   </div>

                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="password" name="password2" placeholder="confirmer mot de passe">
                        

                    </div>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Signin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    
<!--===============================================================================================-->
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="../vendor/bootstrap/js/popper.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--=============../==================================================================================-->
    <script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="../vendor/daterangepicker/moment.min.js"></script>
    <script src="../vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="../vendor/js/main.js"></script>

</body>
</html>
