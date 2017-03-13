<?php
require'fpdf181/fpdf.php';
require_once 'Dataccess/formation.php';
$id=$_POST["choix"];
$formationEmploye = pdftest($id);
$formationEmploye->date=date("d/m/y");

class PDF extends FPDF
{
// En-tête

function Header()
{
    // Logo
    
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(40);
    // Titre
    $this->Cell(100,10,'Confirmation de votre Formation',1,0,'C');
    // Saut de ligne
    $this->Ln(20);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation de la classe dérivée

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(40);

$pdf->SetTitle(utf8_decode($formationEmploye->titre));


$pdf->SetFont('Arial','B',20);
$pdf->Write(5,utf8_decode($formationEmploye->titre));
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','B',12);
$pdf->Write(5,'Date de la formation: ');
$pdf->SetFont('Arial','',12);
$pdf->Write(5,utf8_decode($formationEmploye->date).'.');
$pdf->ln();
$pdf->SetFont('Arial','B',12);
$pdf->Write(5,'Lieu de la formation: ');
$pdf->SetFont('Arial','',12);
$pdf->Write(5,utf8_decode($formationEmploye->rue.' '.$formationEmploye->ville).'.');
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','B',12);
$pdf->Write(5,"Description de la formation : ");
$pdf->ln();
$pdf->SetFont('Arial','',12);
$pdf->Write(5,utf8_decode($formationEmploye->description),'C');
           

             
			

$pdf->Output();
?>