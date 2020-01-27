<?php
session_start();
if ( !empty($_POST)) {
    require 'database.php';

    $delzespolID = $_POST['delzespolID'];

    $wyciagnij_zespolID = $db->prepare('SELECT Zespol_muzycznyID FROM Zespol_muzyczny WHERE Zespol_muzycznyID = :zespolID');
    $wyciagnij_zespolID->bindValue(':zespolID', $delzespolID, PDO::PARAM_INT);
    $wyciagnij_zespolID->execute();
    $ile_zespoID = $wyciagnij_zespolID->rowCount();


    if (!empty($delzespolID) && $ile_zespoID == 1) {
        $sql = "DELETE FROM Zespol_muzyczny  WHERE Zespol_muzycznyID = ?";
        $q = $db->prepare($sql);
        $q->execute(array($delzespolID));
    } else {
        $_SESSION['DelErrorZespol'] = 'Wprowadź poprawny indeks!';
        header('Location: del_zespol.php');
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
            <span>Zespół Muzyczny został usuniety z bazy!</span><br>
        </div>
    </div>
</main>
</body>
</html>
