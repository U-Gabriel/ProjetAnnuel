<?php session_start(); 
   if($_SESSION['email'] == null){
    header('Location: connexionC.php');
}
require('../vendor/include/config.php');
require('Fpdf/fpdf.php');


$fac = "Facture";
$Cpar1 = "Detaille de la Commande :";
$Cproduit="Produit : ##PRODUIT## ";
$Cprix=   "Estimation    : ##PRIX## Euro";
$Ddate = "Date : ##DATE##";
$Etat = "Etat : Colis A envoyer A l'usine";
$Livraison = "Mode de livraison : Bon colissimo ";
$Cpar2 = "Coordonnee de Facturation :";
$Ccivilite= "##CIVILITE##";
$Cnom="##NOM##";
$Cprenom="##PRENOM##";
$Cadresse="Adresse : ##ADRESSE##, ";
$Cville="##VILLE##, ";
$Ccp="##CP##";
$Col = "Votre Bon Colissimo !";



 $q='SELECT * FROM client WHERE Email=?';
                        $req = $bdd->prepare($q);
                        $req ->execute([$_SESSION['email']]);
                        $results = $req->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($results as $key => $value) {
                          $id = $value['Id_Client'];
                          $civilite=$value['civilite'];
                          $nom=$value['nom'];
                          $prenom=$value['prenom'];
                          $email=$value['Email'];
                          $adresse=$value['Adresse'];
                          $ville=$value['ville'];
                          $cp=$value['cp'];
                          $telephone=$value['N_telephone'];
                          $colissimo = $value['colissimo'];
                      }

$produit=$_GET['marque'];
$prix=$_GET['prix'];
$date = date("F  j/Y, g:i a"); 
/*$nom=$_GET['nom'];
$email=$_GET['email'];
$adresse=$_GET['adresse'];
$ville=$_GET['pays'];
$cp=$_GET['codepostal'];
$telephone=$_GET['telephone'];*/

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$Cproduit = str_replace('##PRODUIT##', $produit, $Cproduit);
$Cprix = str_replace('##PRIX##', $prix, $Cprix);
$Ccivilite = str_replace('##CIVILITE##', $civilite, $Ccivilite);
$Cnom = str_replace('##NOM##', $nom, $Cnom);
$Cadresse = str_replace('##ADRESSE##', $adresse, $Cadresse);
$Cville = str_replace('##VILLE##', $ville, $Cville);
$Ccp = str_replace('##CP##', $cp, $Ccp);
$Ddate = str_replace('##DATE##', $date, $Ddate);


$pdf->Image('../vendor/img/fRepackLogo.png',10,10,-300);
$pdf->Image('../vendor/img/logo_ESGI.png',160,10,-300);
$pdf->Ln(50);
$pdf->SetTextColor(255 , 0, 0);
$pdf->Cell(180,10,$fac,0,0,'C');
$pdf->SetTextColor(0 , 0, 0);
$pdf->Ln(30);
$pdf->Line(0, 100, 220,100);
$pdf->Cell(40,10,$Cpar1);
$pdf->Line(0, 90, 220,90);
$pdf->Ln(20);
$pdf->Cell(40,10,$Cproduit);

$pdf->Ln(15);
$pdf->Cell(40,10,$Cprix);
$pdf->Ln(15);
$pdf->Cell(40,10,$Ddate);
$pdf->Ln(15);
$pdf->Cell(40,10,$Etat);
$pdf->Ln(15);
$pdf->Cell(40,10,$Livraison);
$pdf->Ln(15);
$pdf->Line(0, 195, 220,195);
$pdf->Cell(40,10,$Cpar2);
$pdf->Line(0, 185, 220,185);
$pdf->Ln(20);
$pdf->Cell(40,10,$Ccivilite);
$pdf->Cell(40,10,$Cnom);
$pdf->Ln(10);
$pdf->Cell(40,10,$Cadresse);
$pdf->Ln(8);
$pdf->Cell(40,10,$Cville);
$pdf->Ln(8);
$pdf->Cell(40,10,$Ccp);
$pdf->Ln(50);
$pdf->Cell(40,10,$Col);
$pdf->Output('D', 'Facture'.date("Y_m_d").'.pdf', true);
$spe=$colissimo+1;
$pdf->Output('F', 'uploads_colissimo/colissimo'.$id.'_'.$spe.'.pdf', true);


$q2 = "UPDATE client SET  colissimo=?  WHERE Email=? ";
$req2 =$bdd->prepare($q2);
$req2->execute(array($spe,$email));

header('location: ../sell.php');
?>
