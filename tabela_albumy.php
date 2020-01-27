<?php
session_start();
require_once 'database.php';
$albumyQuery = $db->query('SELECT * FROM Plyta');
$albumy = $albumyQuery->fetchAll();

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
                    <th colspan="6" style="text-align: center">Lista Albumów</th>
                </tr>
                <tr>
                    <th scope="col">ID Albumu</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Rok wydania</th>
                    <th scope="col">Liczba utworów</th>
                    <th scope="col">Liczba sprzedanych płyt</th>
                    <th scope="col">ID Zespołu Muzycznego</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($albumy as $album) {
                    echo '<tr class="table-dark" style="color: black"><td>'
                        . $album[4] . '</td><td>' . $album[2] . '</td><td>'
                        . $album[3] . '</td><td>' . $album[1] . '</td><td>'
                        . $album[0] . '</td><td>' . $album[5] . '</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</main>
</body>
</html>
