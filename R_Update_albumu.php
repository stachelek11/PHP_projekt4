<?php
session_start();
require 'database.php';

$wczytaj_albumID = $_POST['albumID'];
if (!isset($_SESSION['dam']) || isset($_SESSION['UpodanyID_albumu'])) {
    $_SESSION['dam'] = $wczytaj_albumID;
}
$wczytaj_album = $db->prepare('SELECT * FROM Plyta WHERE PlytaID = :wczytaj_albumID');
$wczytaj_album ->bindValue(':wczytaj_albumID', $_SESSION['dam'], PDO::PARAM_INT);
$wczytaj_album ->execute();

$album = $wczytaj_album->fetch();
if (!$_SESSION['liczba_sprzedanychError'] && !$_SESSION['liczba_utworowError'] && !$_SESSION['nazwa_albumuError'] && !$_SESSION['rok_wydaniaError'] && !$_SESSION['ID_zespolu_muzycznegoError']) {
    if (!$album) {
        $_SESSION['UError_albumu'] = 'Podany indeks nie istnieje !';
        $_SESSION['UpodanyID_albumu'] = $wczytaj_albumID;
        header('Location: U_albumu.php');
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
                <form method="post" action="Update_albumu.php">
                    <div class="form-group">
                        <label for="col-12 exampleTextarea">Nazwa albumu</label>
                        <input class="col-12 form-control" placeholder="wszystkie znaki dozwolone" type="text" name="nazwa_albumu"
                            <?php if (isset($album[2])) echo 'value="' . $album[2] . '"'?>>
                        <?php
                        if (isset($_SESSION['nazwa_albumuError'])) {
                            echo '<span class="text-danger">' . $_SESSION['nazwa_albumuError'] . '</span><br>';
                            unset($_SESSION['nazwa_albumuError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Rok wydania</label>
                        <input class="col-12 form-control" placeholder="liczba od 1000 do 2020" type="number" name="rok_wydania"
                            <?php if (isset($album[3])) echo 'value="' . $album[3] . '"'?>>
                        <?php
                        if (isset($_SESSION['rok_wydaniaError'])) {
                            echo '<span class="text-danger">' . $_SESSION['rok_wydaniaError'] . '</span><br>';
                            unset($_SESSION['rok_wydaniaError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Liczba utworów</label>
                        <input class="col-12 form-control" placeholder="liczba od 1 do 99" type="number" name="liczba_utworow"
                            <?php if (isset($album[1])) echo 'value="' . $album[1] . '"'?>>
                        <?php
                        if (isset($_SESSION['liczba_utworowError'])) {
                            echo '<span class="text-danger">' . $_SESSION['liczba_utworowError'] . '</span><br>';
                            unset($_SESSION['liczba_utworowError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Liczba sprzedanych płyt</label>
                        <input class="col-12 form-control" type="text" placeholder="Liczba od 1 do 9 999 999" name="liczba_sprzedanych"
                            <?php if (isset($album[0])) echo 'value="' . $album[0] . '"'?>>
                        <?php
                        if (isset($_SESSION['liczba_sprzedanychError'])) {
                            echo '<span class="text-danger">' . $_SESSION['liczba_sprzedanychError'] . '</span><br>';
                            unset($_SESSION['liczba_sprzedanychError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">ID Zespołu Muzycznego</label>
                        <input class="col-12 form-control" type="text" placeholder="liczba od 0 do 999..." name="ID_zespolu_muzycznego"
                            <?php if (isset($album[5])) echo 'value="' . $album[5] . '"'?>>
                        <?php
                        if (isset($_SESSION['ID_zespolu_muzycznegoError'])) {
                            echo '<span class="text-danger">' . $_SESSION['ID_zespolu_muzycznegoError'] . '</span><br>';
                            unset($_SESSION['ID_zespolu_muzycznegoError']);
                        }
                        ?>
                        <input class="col-12 btn btn-outline-light submit" type="submit" value="Edytuj album">
                    </div>
                </form>
            </article>
        </div>
    </div>
</main>
</body>
</html>
