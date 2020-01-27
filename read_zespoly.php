<?php
session_start();
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
            <form method="post" action="R_zespolu.php">
                <label for="col-12 exampleTextarea">Podaj zespół do wczytania</label>
                <input class="col-12 form-control" placeholder="indeks zespołu" type="number" name="wczytaj_zespolID"
                    <?php if (isset($_SESSION['podanyID_zespolu'])) echo 'value="' . $_SESSION['podanyID_zespolu'] . '"'; unset($_SESSION['podanyID_zespolu'])?>>
                <?php
                if (isset($_SESSION['Errorlog_zespolu'])) {
                    echo '<span class="text-danger">' . $_SESSION['Errorlog_zespolu'] . '</span><br>';
                    unset($_SESSION['Errorlog_zespolu']);
                }
                ?>
                <input class="col-12 btn btn-outline-light submit" type="submit" value="Wyświetl zespół">
            </form>
        </div>
    </div>

</main>
</body>
</html>