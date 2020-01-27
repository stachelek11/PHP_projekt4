<?php
session_start();
require_once 'database.php';

$wczytaj_zespolID = $_POST['zespolID'];
if (!isset($_SESSION['podi']) || isset($_SESSION['UpodanyID_zespolu'])) {
    $_SESSION['podi'] = $wczytaj_zespolID;
}
$wczytaj_zespol = $db->prepare('SELECT * FROM Zespol_muzyczny WHERE Zespol_muzycznyID = :wczytaj_zespolID');
$wczytaj_zespol ->bindValue(':wczytaj_zespolID', $_SESSION['podi'], PDO::PARAM_INT);
$wczytaj_zespol ->execute();

$zespol = $wczytaj_zespol->fetch();
if (!$_SESSION['gatunekError'] && !$_SESSION['nazwa_zespoluError'] && !$_SESSION['liczba_osobError'] && !$_SESSION['wokalistaError']) {
    if (!$zespol) {
        $_SESSION['UError_zespolu'] = 'Podany indeks nie istnieje !';
        $_SESSION['UpodanyID_zespolu'] = $wczytaj_zespolID;
        header('Location: U_zespolu.php');
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
    <!--         nawigacja-->
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
        <div class="CRUD_albumy create col-6 col-xl-4">
            <article>
                <form method="post" action="Update_zespolu.php">
                    <div class="form-group">
                        <label for="col-12 exampleTextarea">Nazwa zespołu</label>
                        <input class="col-12 form-control" placeholder="wszystkie znaki dozwolone" type="text" name="nazwa_zespolu"
                            <?php if (isset($zespol[3])) echo 'value="' . $zespol[3] . '"'?>>
                        <?php
                        if (isset($_SESSION['nazwa_zespoluError'])) {
                            echo '<span class="text-danger">' . $_SESSION['nazwa_zespoluError'] . '</span><br>';
                            unset($_SESSION['nazwa_zespoluError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Gatunek muzyczny</label>
                        <input class="col-12 form-control" placeholder="tylko litery" type="text" name="gatunek"
                            <?php if (isset($zespol[0])) echo 'value="' . $zespol[0] . '"'?>>
                        <?php
                        if (isset($_SESSION['gatunekError'])) {
                            echo '<span class="text-danger">' . $_SESSION['gatunekError'] . '</span><br>';
                            unset($_SESSION['gatunekError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Liczba osób w zespole</label>
                        <input class="col-12 form-control" placeholder="liczba od 1 do 99" type="number" name="liczba_osob"
                            <?php if (isset($zespol[2])) echo 'value="' . $zespol[2] . '"'?>>
                        <?php
                        if (isset($_SESSION['liczba_osobError'])) {
                            echo '<span class="text-danger">' . $_SESSION['liczba_osobError'] . '</span><br>';
                            unset($_SESSION['liczba_osobError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Główny wokalista</label>
                        <input class="col-12 form-control" type="text" placeholder="Imie i nazwisko z dużych liter" name="wokalista"
                            <?php if (isset($zespol[1])) echo 'value="' . $zespol[1] . '"'?>>
                        <?php
                        if (isset($_SESSION['wokalistaError'])) {
                            echo '<span class="text-danger">' . $_SESSION['wokalistaError'] . '</span><br>';
                            unset($_SESSION['wokalistaError']);
                        }
                        ?>
                        <input class="col-12 btn btn-outline-light submit" type="submit" value="Edytuj zespół">
                    </div>
                </form>
            </article>
        </div>
    </div>
</main>
</body>
</html>
