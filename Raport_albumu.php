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
        <div class="CRUD_albumy col-4">
            <span>Wszystkie albumy zespolu "Enej"</span><br>
            <a href="FPDF/PDF_albumy_dow.php" class="col-12 btn btn-outline-light">Pobierz</a>
            <a href="FPDF/PDF_albumy.php" target="_blank" class="col-12 btn btn-outline-light">Wyświetl</a>
            <a href="wyslij1.php" class="col-12 btn btn-outline-light">Wyślij</a>
        </div>
    </div>
</main>
</body>
</html>