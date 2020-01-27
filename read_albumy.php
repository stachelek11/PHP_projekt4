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
                    <form method="post" action="R_albumy.php">
                        <label for="col-12 exampleTextarea">Podaj album do wczytania</label>
                        <input class="col-12 form-control" placeholder="indeks albumu" type="number" name="wczytaj_albumID"
                            <?php if (isset($_SESSION['podanyID'])) echo 'value="' . $_SESSION['podanyID'] . '"'; unset($_SESSION['podanyID'])?>>
                        <?php
                        if (isset($_SESSION['Errorlog'])) {
                            echo '<span class="text-danger">' . $_SESSION['Errorlog'] . '</span><br>';
                            unset($_SESSION['Errorlog']);
                        }
                        ?>
                        <input class="col-12 btn btn-outline-light submit" type="submit" value="Wyświetl album">
                    </form>
        </div>
    </div>

</main>
</body>
</html>