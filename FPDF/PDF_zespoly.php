<?php
require "fpdf.php";

require '../database.php';
$_SESSION['Suma'] =0;

class myPDF extends FPDF {
    function ile_sprzedanych($db) {
        $stmt = $db->query('SELECT * FROM Zespol_muzyczny WHERE Gatunek_muzyczny = "Rap"');
        while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $_SESSION['Suma']= $stmt->rowCount();
        }
    }
    function header() {
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Tabela "Zespoly Muzyczne"',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Wszystkie zespoly z gatunkiem muzycznym "Rap"',0,0,'C');
        $this->Ln(20);
        $this->SetFont('Times','',12);
        $this->Cell(276,10,"Ilosc zespolow o gatunku muzycznym - Rap: {$_SESSION['Suma']}",0,0,'C');
        $this->Ln(20);
    }
    function footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Strona '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(20,10,'ID',1,0,'C');
        $this->Cell(50,10,'Nazwa Zespolu',1,0,'C');
        $this->Cell(50,10,'Gatunek Muzyczny',1,0,'C');
        $this->Cell(30,10,'Ilosc Czlonkow',1,0,'C');
        $this->Cell(60,10,'Glowny Wokalista',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        $stmt = $db->query('SELECT * FROM Zespol_muzyczny WHERE Gatunek_muzyczny = "Rap"');
        while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->Cell(20,10,$data->Zespol_muzycznyID,1,0,'C');
            $this->Cell(50,10,$data->Nazwa_zespolu,1,0,'L');
            $this->Cell(50,10,$data->Gatunek_muzyczny,1,0,'L');
            $this->Cell(30,10,$data->Liczba_osob_w_zespole,1,0,'C');
            $this->Cell(60,10,$data->Glowny_wokalista,1,0,'L');
            $this->Ln();
        }
    }

}

$pdf = new myPDF();
$pdf->ile_sprzedanych($db);
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();