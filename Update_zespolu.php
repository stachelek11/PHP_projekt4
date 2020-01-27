<?php
session_start();

if ( !empty($_POST)) {
    $nazwa_zespolu = $_POST['nazwa_zespolu'];
    $gatunek = $_POST['gatunek'];
    $liczba_osob = $_POST['liczba_osob'];
    $wokalista = $_POST['wokalista'];

    $valid = true;

    if (empty($nazwa_zespolu)) {
        $nazwa_zespoluError = 'Nazwa zespołu nie może być pusta!';
        $valid = false;
    }

    if (empty($gatunek)) {
        $gatunekError = 'Gatunek muzyczny nie może być pusty!';
        $valid = false;
    } else if (!preg_match('/^([a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+)$/', $gatunek))
    {
        $gatunekError = 'Wprowadź poprawny gatunek muzyczny zespołu!';
        $valid = false;
    }

    if (empty($liczba_osob)) {
        $liczba_osobError = 'Liczba zespołu nie może być pusta!';
        $valid = false;
    } else if (!preg_match('/^([1-9]{1}[0-9]?)$/', $liczba_osob))
    {
        $liczba_osobError = 'Wprowadź poprawną liczbę osób!';
        $valid = false;
    }

    if (empty($wokalista)) {
        $wokalistaError = 'Wokalista nie może być pusty!';
        $valid = false;
    } else if (!preg_match('/^([A-ZĄĘŁŃÓŚŹŻ]{1}[a-ząćęłńóśźż]+ {1}[A-ZĄĘŁŃÓŚŹŻ]{1}[a-ząćęłńóśźż]+)$/', $wokalista))
    {
        $wokalistaError = 'Wprowadź poprawnego wokalistę zespołu!';
        $valid = false;
    }

    if ($valid == true) {
        require 'database.php';

        $data = [
            'Gatunek_muzyczny' => $gatunek,
            'Glowny_wokalista' => $wokalista,
            'Liczba_osob_w_zespole' => $liczba_osob,
            'Nazwa_zespolu' => $nazwa_zespolu,
            'Zespol_muzycznyID' => $_SESSION['podi'],
        ];
        $sql = "UPDATE Zespol_muzyczny SET Gatunek_muzyczny=:Gatunek_muzyczny, Glowny_wokalista=:Glowny_wokalista, Liczba_osob_w_zespole=:Liczba_osob_w_zespole, Nazwa_zespolu=:Nazwa_zespolu WHERE Zespol_muzycznyID=:Zespol_muzycznyID";

        $stmt = $db->prepare($sql);
        $stmt->execute($data);



    } else {
        $_SESSION['nazwa_zespoluError'] = $nazwa_zespoluError;
        $_SESSION['gatunekError'] = $gatunekError;
        $_SESSION['liczba_osobError'] = $liczba_osobError;
        $_SESSION['wokalistaError'] = $wokalistaError;
        header('Location: R_Update_zespolu.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projekt PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container-fluid">
    <!-- nawigacja   -->
    <div class="nawigacja row">
        <span class="wybor_tabel col-12">Wybierz tabelę:</span>
        <div class="col-12 white-line"></div>
        <div class="nawigacja col-12">

            <div class="nawigacja2 row">
                <div class="col-6"><a href="Menu_albumy.html" class="col-12 btn btn-outline-light">Płyty (albumy)</a></div>
                <div class="col-6"><a href="Menu_zespoly.html" class="col-12 btn btn-outline-light">Zespoły Muzyczne</a></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="CRUD_albumy Prawidlowo_dodany_zespol col-8">
            <span>Zespół Muzyczny edytowany poprawnie! : )</span><br>
        </div>
    </div>
</main>
</body>
</html>
