<?php
session_start();

if ( !empty($_POST)) {

    $zespolID = $_POST['ID_zespolu_muzycznego'];
    $rok = $_POST['rok_wydania'];
    $nazwa_plyty = $_POST['nazwa_albumu'];
    $liczba_utworow = $_POST['liczba_utworow'];
    $liczba_albumow = $_POST['liczba_sprzedanych'];

    $valid = true;

    require_once 'database.php';
    $wyciagnij_zespolID = $db->prepare('SELECT Zespol_muzycznyID FROM Zespol_muzyczny WHERE Zespol_muzycznyID = :zespolID');
    $wyciagnij_zespolID ->bindValue(':zespolID', $zespolID, PDO::PARAM_INT);
    $wyciagnij_zespolID ->execute();
    $ile_zespoID = $wyciagnij_zespolID->rowCount();

    if (empty($nazwa_plyty)) {
        $nazwa_plytyError = 'Nazwa płyty nie może być pusta!';
        $valid = false;
    }

    if (empty($liczba_utworow)) {
        $liczba_utworowError = 'Liczba utworów nie może być pusta!';
        $valid = false;
    } else if (!preg_match('/^([1-9]{1}[0-9]?)$/', $liczba_utworow))
    {
        $liczba_utworowError = 'Wprowadź poprawną liczbę utworów albumu!';
        $valid = false;
    }

    if (empty($zespolID)) {
        $zespolIDError = 'ID zespołu nie może być puste!';
        $valid = false;
    } else if ($ile_zespoID != 1) {
        $zespolIDError = 'Zespół o podanym ID nie istnieje!';
        $valid = false;
    } else if (!preg_match('/^([0-9]+)$/', $zespolID))
    {
        $zespolIDError = 'Wprowadź poprawne ID zespołu!';
        $valid = false;
    }

    if (empty($liczba_albumow)) {
        $liczba_albumowError = 'Liczba sprzedanych albumów nie może być pusta!';
        $valid = false;
    } else if (!preg_match('/^([1-9]{1}[0-9]{0,6})$/', $liczba_albumow))
    {
        $liczba_albumowError = 'Wprowadź poprawną liczbę sprzedanych albumów!';
        $valid = false;
    }

    if (empty($rok)) {
        $rokError = 'Rok powstania albumu nie może być pusty!';
        $valid = false;
    } else if (!preg_match('/^((1[0-9]{3})|(20[0-1]{1}[0-9]{1})|(2020))$/', $rok))
    {
        $rokError = 'Wprowadź poprawny rok powstania albumu!';
        $valid = false;
    }

    if ($valid == true) {
        $data = [
            'Liczba_sprzedanych_egzemplarzy' => $liczba_albumow,
            'Liczba_utworow' => $liczba_utworow,
            'Nazwa_plyty' => $nazwa_plyty,
            'Rok_wydania' => $rok,
            'Zespol_muzycznyID' => $zespolID,
            'PlytaID' => $_SESSION['dam'],
        ];
        $sql = "UPDATE Plyta SET Liczba_sprzedanych_egzemplarzy=:Liczba_sprzedanych_egzemplarzy, Liczba_utworow=:Liczba_utworow, Nazwa_plyty=:Nazwa_plyty, Rok_wydania=:Rok_wydania, Zespol_muzycznyID=:Zespol_muzycznyID WHERE PlytaID=:PlytaID";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

    } else {
        $_SESSION['liczba_sprzedanychError'] = $liczba_albumowError;
        $_SESSION['liczba_utworowError'] = $liczba_utworowError;
        $_SESSION['nazwa_albumuError'] = $nazwa_plytyError;
        $_SESSION['rok_wydaniaError'] = $rokError;
        $_SESSION['ID_zespolu_muzycznegoError'] = $zespolIDError;
        header('Location: R_Update_albumu.php');
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
            <span>Album edytowany poprawnie! : )</span><br>
        </div>
    </div>
</main>
</body>
</html>
