<?php
require "fpdf.php";

require '../database.php';
$_SESSION['Suma'] = 0;

class myPDF extends FPDF {
    function ile_sprzedanych($db) {
            $stmt = $db->query('SELECT Plyta.Nazwa_plyty, Plyta.Liczba_utworow, Plyta.Rok_wydania, Plyta.Liczba_sprzedanych_egzemplarzy, Zespol_muzyczny.Nazwa_zespolu FROM Plyta INNER JOIN Zespol_muzyczny ON Plyta.Zespol_muzycznyID = Zespol_muzyczny.Zespol_muzycznyID WHERE Zespol_muzyczny.Zespol_muzycznyID = 1');
            while ($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $_SESSION['Suma'] = $_SESSION['Suma'] + $data->Liczba_sprzedanych_egzemplarzy;
            }

    }
    function header() {
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Tabela "Albumy Muzyczne"',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Wszystkie albumy zespolu "Enej".',0,0,'C');
        $this->Ln(20);
        $this->SetFont('Times','',12);
        $this->Cell(276,10,"Suma wszystkich sprzedanych albumow: {$_SESSION['Suma']}",0,0,'C');
        $this->Ln(20);
    }
    function footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Strona '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times','B',12);

        $this->Cell(60,10,'Nazwa albumu',1,0,'C');
        $this->Cell(40,10,'Liczba utworow',1,0,'C');
        $this->Cell(30,10,'Rok wydania',1,0,'C');
        $this->Cell(50,10,'Sprzedane egzemplarze',1,0,'C');
        $this->Cell(50,10,'Nazwa zespolu',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        $stmt = $db->query('SELECT Plyta.Nazwa_plyty, Plyta.Liczba_utworow, Plyta.Rok_wydania, Plyta.Liczba_sprzedanych_egzemplarzy, Zespol_muzyczny.Nazwa_zespolu FROM Plyta INNER JOIN Zespol_muzyczny ON Plyta.Zespol_muzycznyID = Zespol_muzyczny.Zespol_muzycznyID WHERE Zespol_muzyczny.Zespol_muzycznyID = 1');
        while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->Cell(60,10,$data->Nazwa_plyty,1,0,'L');
            $this->Cell(40,10,$data->Liczba_utworow,1,0,'C');
            $this->Cell(30,10,$data->Rok_wydania,1,0,'C');
            $this->Cell(50,10,$data->Liczba_sprzedanych_egzemplarzy,1,0,'C');
            $this->Cell(50,10,$data->Nazwa_zespolu,1,0,'L');
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
$pdf->Output('D');