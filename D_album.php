<?php
session_start();
if ( !empty($_POST)) {
    require 'database.php';

    $delalbumID = $_POST['delalbumID'];

    $wyciagnij_plytaID = $db->prepare('SELECT PlytaID FROM Plyta WHERE PlytaID = :plytaID');
    $wyciagnij_plytaID->bindValue(':plytaID', $delalbumID, PDO::PARAM_INT);
    $wyciagnij_plytaID->execute();
    $ile_plytaID = $wyciagnij_plytaID->rowCount();


    if (!empty($delalbumID && $ile_plytaID == 1)) {

        $sql = "DELETE FROM Plyta  WHERE PlytaID = ?";
        $q = $db->prepare($sql);
        $q->execute(array($delalbumID));
    } else {
        $_SESSION['DelErrorAlbum'] = 'Wprowadź poprawny indeks!';
        header('Location: del_album.php');
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
            <span>Album został usuniety z bazy!</span><br>
        </div>
    </div>
</main>
</body>
</html>
