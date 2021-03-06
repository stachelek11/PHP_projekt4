<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projekt PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../xampp/htdocs/Projekt4_WWW/style.css">
</head>
<body>
<main class="container-fluid">
    <!-- nawigacja   -->
    <div class="nawigacja row">
        <span class="wybor_tabel col-12">Wybierz tabelę:</span>
        <div class="col-12 white-line"></div>
        <div class="nawigacja col-12">

            <div class="nawigacja2 row">
                <div class="col-6"><a href="../../../../xampp/htdocs/Projekt4_WWW/Menu_albumy.html" class="col-12 btn btn-outline-light">Płyty (albumy)</a></div>
                <div class="col-6"><a href="../../../../xampp/htdocs/Projekt4_WWW/Menu_zespoly.html" class="col-12 btn btn-outline-light">Zespoły Muzyczne</a></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="CRUD_albumy col-4">
            <form method="post" action="FPDF/wyslij.php">
                <div class="form-group">
                    <label for="col-12 exampleTextarea">E-mail</label>
                    <input class="col-12 form-control" placeholder="stachelek11@gmail.com" type="text" name="email">
                    <input class="col-12 btn btn-outline-light submit" type="submit" value="Wyślij">
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
