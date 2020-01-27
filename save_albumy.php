<?php
session_start();
if ( !empty($_POST)) {
    $liczba_albumowError = null;
    $liczba_utworowError = null;
    $nazwa_plytyError = null;
    $rokError = null;
    $plytaIDError = null;
    $zespolIDError = null;


    $zespolID = $_POST['zespolID'];
    $plytaID = $_POST['plytaID'];
    $rok = $_POST['rok'];
    $nazwa_plyty = $_POST['nazwa_plyty'];
    $liczba_utworow = $_POST['liczba_utworow'];
    $liczba_albumow = $_POST['liczba_albumow'];

    require_once 'database.php';
    $wyciagnij_zespolID = $db->prepare('SELECT Zespol_muzycznyID FROM Zespol_muzyczny WHERE Zespol_muzycznyID = :zespolID');
    $wyciagnij_zespolID ->bindValue(':zespolID', $zespolID, PDO::PARAM_INT);
    $wyciagnij_zespolID ->execute();
    $ile_zespoID = $wyciagnij_zespolID->rowCount();

    $valid = true;

    if (empty($nazwa_plyty)) {
        $nazwa_plytyError = 'Wprowadź nazwę płyty!';
        $valid = false;
    }

    if (empty($liczba_utworow)) {
        $liczba_utworowError = 'Wprowadź liczbę utworów albumu!';
        $valid = false;
    } else if (!preg_match('/^([1-9]{1}[0-9]?)$/', $liczba_utworow))
    {
        $liczba_utworowError = 'Wprowadź poprawną liczbę utworów albumu!';
        $valid = false;
    }

    if (empty($zespolID)) {
        $zespolIDError = 'Wprowadź ID zespołu!';
        $valid = false;
    } else if ($ile_zespoID != 1) {
        $zespolIDError = 'Zespół o podanym ID nie istnieje!';
        $valid = false;
    } else if (!preg_match('/^([0-9]+)$/', $zespolID))
    {
        $zespolIDError = 'Wprowadź poprawne ID zespołu!';
        $valid = false;
    }

    if (empty($plytaID)) {
        $plytaIDError = 'Wprowadź ID płyty!';
        $valid = false;
    } else if (!preg_match('/^([0-9]+)$/', $plytaID))
    {
        $plytaIDError = 'Wprowadź poprawne ID płyty!';
        $valid = false;
    }

    if (empty($liczba_albumow)) {
        $liczba_albumowError = 'Wprowadź liczbę sprzedanych albumów!';
        $valid = false;
    } else if (!preg_match('/^([1-9]{1}[0-9]{0,6})$/', $liczba_albumow))
    {
        $liczba_albumowError = 'Wprowadź poprawną liczbę sprzedanych albumów!';
        $valid = false;
    }

    if (empty($rok)) {
        $rokError = 'Wprowadź rok powstania albumu!';
        $valid = false;
    } else if (!preg_match('/^((1[0-9]{3})|(20[0-1]{1}[0-9]{1})|(2020))$/', $rok))
    {
        $rokError = 'Wprowadź poprawny rok powstania albumu!';
        $valid = false;
    }

    if ($valid) {
        $query = $db->prepare('INSERT INTO Plyta VALUES (:Liczba_sprzedanych_egzemplarzy, :Liczba_utworow, :Nazwa_plyty, :Rok_wydania, :PlytaID, :Zespol_muzycznyID)');
        $query->bindValue(':Liczba_sprzedanych_egzemplarzy', $liczba_albumow, PDO::PARAM_INT);
        $query->bindValue(':Liczba_utworow', $liczba_utworow, PDO::PARAM_INT);
        $query->bindValue(':Nazwa_plyty', $nazwa_plyty, PDO::PARAM_STR);
        $query->bindValue(':Rok_wydania', $rok, PDO::PARAM_INT);
        $query->bindValue(':PlytaID', $plytaID, PDO::PARAM_INT);
        $query->bindValue(':Zespol_muzycznyID', $zespolID, PDO::PARAM_INT);
        $query->execute();
    } else {
        $_SESSION['liczba_albumow'] = $liczba_albumow;
        $_SESSION['liczba_utworow'] = $liczba_utworow;
        $_SESSION['nazwa_plyty'] = $nazwa_plyty;
        $_SESSION['rok'] = $rok;
        $_SESSION['plytaID'] = $plytaID;
        $_SESSION['zespolID'] = $zespolID;
        $_SESSION['liczba_albumowError'] = $liczba_albumowError;
        $_SESSION['liczba_utworowError'] = $liczba_utworowError;
        $_SESSION['nazwa_plytyError'] = $nazwa_plytyError;
        $_SESSION['rokError'] = $rokError;
        $_SESSION['plytaIDError'] = $plytaIDError;
        $_SESSION['zespolIDError'] = $zespolIDError;
        header('Location: C_albumy.php');
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
            <span>Album został dodany do bazy! : )</span><br>
        </div>
    </div>
</main>
</body>
</html>
