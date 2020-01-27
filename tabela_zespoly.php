<?php
session_start();
require_once 'database.php';
$zespolyQuery = $db->query('SELECT * FROM Zespol_muzyczny');
$zespoly = $zespolyQuery->fetchAll();

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
                    <th colspan="5" style="text-align: center">Lista Zespołów</th>
                </tr>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Liczba osób</th>
                    <th scope="col">Główny wokalista</th>
                    <th scope="col">Gatunek muzyczny</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($zespoly as $zespol) {
                        echo '<tr class="table-dark" style="color: black"><td>'
                            . $zespol[4] . '</td><td>' . $zespol[3] . '</td><td>'
                            . $zespol[2] . '</td><td>' . $zespol[1] . '</td><td>'
                            . $zespol[0] . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</main>
</body>
</html>
