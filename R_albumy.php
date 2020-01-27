<?php
session_start();
require_once 'database.php';
$wczytaj_albumID = $_POST['wczytaj_albumID'];
$wczytaj = $db->prepare('SELECT * FROM Plyta WHERE PlytaID = :wczytaj_albumID');
$wczytaj ->bindValue(':wczytaj_albumID', $wczytaj_albumID, PDO::PARAM_INT);
$wczytaj ->execute();

$album = $wczytaj->fetch();

if ($album) {
    $wczytaj_zespol = $db->prepare('SELECT * FROM Zespol_muzyczny WHERE Zespol_muzycznyID = :wczytaj_zespolID');
    $wczytaj_zespol ->bindValue(':wczytaj_zespolID', $album[5], PDO::PARAM_INT);
    $wczytaj_zespol ->execute();

    $zespol = $wczytaj_zespol->fetch();

} else {
    $_SESSION['Errorlog'] = 'Podany indeks nie istnieje !';
    $_SESSION['podanyID'] = $wczytaj_albumID;
    header('Location: read_albumy.php');
    exit();
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
        <div class="CRUD_albumy col-8">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th colspan="5" style="text-align: center">Album</th>
                </tr>
                <tr>
                    <th scope="col">ID Albumu</th>
                    <th scope="col">Nazwa albumu</th>
                    <th scope="col">Rok wydania albumu</th>
                    <th scope="col">Liczba utworów</th>
                    <th scope="col">Liczba sprzedanych płyt</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    echo '<tr class="table-dark" style="color: black"><td>'
                        . $album[4] . '</td><td>' . $album[2] . '</td><td>'
                        . $album[3] . '</td><td>' . $album[1] . '</td><td>'
                        . $album[0] . '</td></tr>';
                ?>
                </tbody>
                <tr>
                    <th colspan="5" style="text-align: center">Zespół, który jest włąścicielem tego albumu.</th>
                </tr>
                <tr>
                    <th scope="col">ID zespołu</th>
                    <th scope="col">Nazwa zespołu</th>
                    <th scope="col">Liczba osób w zespole</th>
                    <th scope="col">Główny wokalista</th>
                    <th scope="col">Gatunek muzyczny</th>
                </tr>
                <tbody>
                <?php
                echo '<tr class="table-dark" style="color: black"><td>'
                    . $zespol[4] . '</td><td>' . $zespol[3] .
                    '</td><td>' . $zespol[2] . '</td><td>'
                    . $zespol[1] . '</td><td>' . $zespol[0] . '</td></tr>';
                ?>
                </tbody>
            </table>
        </div>
    </div>

</main>
</body>
</html>
