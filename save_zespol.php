<?php
session_start();
if ( !empty($_POST)) {
    $nazwa_zespoluError = null;
    $gatunekError = null;
    $liczba_osobError = null;
    $wokalistaError = null;
    $zespolIDError = null;

    $nazwa_zespolu = $_POST['nazwa_zespolu'];
    $gatunek = $_POST['gatunek'];
    $liczba_osob = $_POST['liczba_osob'];
    $wokalista = $_POST['wokalista'];
    $zespolID = $_POST['zespolID'];

    $valid = true;

    if (empty($nazwa_zespolu)) {
        $nazwa_zespoluError = 'Wprowadź nazwę zespołu!';
        $valid = false;
    }

    if (empty($gatunek)) {
        $gatunekError = 'Wprowadź gatunek muzyczny zespołu!';
        $valid = false;
    } else if (!preg_match('/^([a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]+)$/', $gatunek))
    {
        $gatunekError = 'Wprowadź poprawny gatunek muzyczny zespołu!';
        $valid = false;
    }

    if (empty($liczba_osob)) {
        $liczba_osobError = 'Wprowadź liczbę osób zespołu!';
        $valid = false;
    } else if (!preg_match('/^([1-9]{1}[0-9]?)$/', $liczba_osob))
    {
        $liczba_osobError = 'Wprowadź poprawną liczbę osób!';
        $valid = false;
    }

    if (empty($wokalista)) {
        $wokalistaError = 'Wprowadź wokalistę zespołu!';
        $valid = false;
    } else if (!preg_match('/^([A-ZĄĘŁŃÓŚŹŻ]{1}[a-ząćęłńóśźż]+ {1}[A-ZĄĘŁŃÓŚŹŻ]{1}[a-ząćęłńóśźż]+)$/', $wokalista))
    {
        $wokalistaError = 'Wprowadź poprawnego wokalistę zespołu!';
        $valid = false;
    }

    if (empty($zespolID)) {
        $zespolIDError = 'Wprowadź ID zespołu!';
        $valid = false;
    } else if (!preg_match('/^([0-9]+)$/', $zespolID))
    {
        $zespolIDError = 'Wprowadź poprawne ID zespołu!';
        $valid = false;
    }
    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('INSERT INTO Zespol_muzyczny VALUES (:Gatunek_muzyczny, :Glowny_wokalista, :Liczba_osob_w_zespole, :Nazwa_zespolu, :Zespol_muzycznyID)');
        $query->bindValue(':Gatunek_muzyczny', $gatunek, PDO::PARAM_STR);
        $query->bindValue(':Glowny_wokalista', $wokalista, PDO::PARAM_STR);
        $query->bindValue(':Liczba_osob_w_zespole', $liczba_osob, PDO::PARAM_INT);
        $query->bindValue(':Nazwa_zespolu', $nazwa_zespolu, PDO::PARAM_STR);
        $query->bindValue(':Zespol_muzycznyID', $zespolID, PDO::PARAM_INT);
        $query->execute();
    } else {
        $_SESSION['nazwa_zespolu'] = $nazwa_zespolu;
        $_SESSION['gatunek'] = $gatunek;
        $_SESSION['liczba_osob'] = $liczba_osob;
        $_SESSION['wokalista'] = $wokalista;
        $_SESSION['zespolID'] = $zespolID;
        $_SESSION['nazwa_zespoluError'] = $nazwa_zespoluError;
        $_SESSION['gatunekError'] = $gatunekError;
        $_SESSION['liczba_osobError'] = $liczba_osobError;
        $_SESSION['wokalistaError'] = $wokalistaError;
        $_SESSION['zespolIDError'] = $zespolIDError;
        header('Location: C_zespoly.php');
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
            <span>Zespół Muzyczny został dodany do bazy! : )</span><br>
        </div>
    </div>
</main>
</body>
</html>
