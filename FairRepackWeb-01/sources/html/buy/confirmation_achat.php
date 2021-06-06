<?php session_start(); 
   if($_SESSION['email'] == null){
    header('Location: connexionC.php');
}

require('../vendor/include/config.php');
require('Fpdf/fpdf.php');

//Amazon Coupons :  -EUR 1,08 


$fac = "Confirmation d'achat";
$Cpar1 = "Recapitulatif de la commande ";
$Cproduit="Produits : ##PRODUIT## ";
$Cprix=   "Sous-total des articles    : ##PRIX## Euro";
$Ddate = "Date d'achat : ##DATE##";
$Etat = "Etat : Achat confirme";
$Livraison = "Mode de livraison : Bon colissimo";
$Cadresse_l = "Adresse de livraison : ##ADRESSE_L##";
$Ccp_l="##CP_L##";
$Cville_l="##VILLE_L##";
$Cpar2 = "Coordonnee de Facturation :";
$Ccivilite= "##CIVILITE##";
$Cnom="##NOM##";
$Cprenom="##PRENOM##";
$Cadresse="Adresse : ##ADRESSE##, ";
$Cville="##VILLE##, ";
$Ccp="##CP##";




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
                          $facture = $value['Facture'];

                      }

$produit=$_GET['marque'];
$prix=$_GET['prix'];
$date = date("m.d.y, g:i a"); 
$adresse_l=$_GET['adresse'];
$cp_l=$_GET['cp'];
$ville_l=$_GET['ville'];
$nbArticles=$_GET['nbArticles'];



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$Cproduit = str_replace('##PRODUIT##', $produit, $Cproduit);
$Cprix = str_replace('##PRIX##', $prix, $Cprix);
$Ccivilite = str_replace('##CIVILITE##', $civilite, $Ccivilite);
$Cnom = str_replace('##NOM##', $nom, $Cnom);
$Cprenom = str_replace('##PRENOM##', $prenom, $Cprenom);
$Cadresse = str_replace('##ADRESSE##', $adresse, $Cadresse);
$Cville = str_replace('##VILLE##', $ville, $Cville);
$Ccp = str_replace('##CP##', $cp, $Ccp);
$Ddate = str_replace('##DATE##', $date, $Ddate);
$Cadresse_l = str_replace('##ADRESSE_L##', $adresse_l, $Cadresse_l);
$Cville_l = str_replace('##VILLE_L##', $ville_l, $Cville_l);
$Ccp_l = str_replace('##CP_L##', $cp_l, $Ccp_l);


$pdf->Image('../vendor/img/fRepackLogo.png',10,10,-300);
$pdf->Image('../vendor/img/logo_ESGI.png',160,10,-300);
$pdf->Ln(20);
$pdf->SetTextColor(255 , 0, 0);
$pdf->SetFontSize(13); 
$pdf->Cell(40,10,$marque[0]);
$pdf->Cell(180,10,$fac,0,0,'C');
$pdf->SetTextColor(0 , 0, 0);
$pdf->Ln(30);
$pdf->Line(0, 70, 220,70);
$pdf->Cell(40,10,$Cpar1);
$pdf->Line(0, 60, 220,60);
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
$pdf->Cell(10,10,$Cadresse_l);
$pdf->Ln(8);
$pdf->Cell(10,10,$Cville_l);
$pdf->Ln(8);
$pdf->Cell(10,10,$Ccp_l);
$pdf->Ln(30);
$pdf->Line(0, 195, 220,195);
$pdf->Cell(40,0,$Cpar2);
$pdf->Line(0, 205, 220,205);
$pdf->Ln(20);

$pdf->Cell(10,10,$Ccivilite);
$pdf->Cell(30,10,$Cnom);
$pdf->Cell(30,10,$Cprenom);
$pdf->Ln(10);
$pdf->Cell(40,10,$Cadresse);
$pdf->Ln(8);
$pdf->Cell(40,10,$Cville);
$pdf->Ln(8);
$pdf->Cell(40,10,$Ccp);
$pdf->Ln(20);
$pdf->Output('D', 'Facture'.$id.'.pdf', true);
$spe=$facture+1;
$pdf->Output('F', 'uploads_factures/Facture'.$id.'_'.$spe.'.pdf', true);

$q2 = "UPDATE client SET Facture=?  WHERE Email=? ";
$req2 =$bdd->prepare($q2);
$req2->execute(array($spe,$email));


?>
