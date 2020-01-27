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
                <form method="post" action="save_albumy.php">
                    <div class="form-group">
                        <label for="col-12 exampleTextarea">ID Zespolu</label>
                        <input class="col-12 form-control" placeholder="liczba od 0 do 999..." type="number" name="zespolID"
                            <?php if (isset($_SESSION['zespolID'])) echo 'value="' . $_SESSION['zespolID'] . '"'; unset($_SESSION['zespolID'])?>>
                        <?php
                        if (isset($_SESSION['zespolIDError'])) {
                            echo '<span class="text-danger">' . $_SESSION['zespolIDError'] . '</span><br>';
                            unset($_SESSION['zespolIDError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">ID Płyty</label>
                        <input class="col-12 form-control" placeholder="liczba od 0 do 999..." type="number" name="plytaID"
                            <?php if (isset($_SESSION['plytaID'])) echo 'value="' . $_SESSION['plytaID'] . '"'; unset($_SESSION['plytaID'])?>>
                        <?php
                        if (isset($_SESSION['plytaIDError'])) {
                            echo '<span class="text-danger">' . $_SESSION['plytaIDError'] . '</span><br>';
                            unset($_SESSION['plytaIDError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Rok wydania albumu</label>
                        <input class="col-12 form-control" placeholder="liczba od 1000 do 2020" type="number" name="rok"
                            <?php if (isset($_SESSION['rok'])) echo 'value="' . $_SESSION['rok'] . '"'; unset($_SESSION['rok'])?>>
                        <?php
                        if (isset($_SESSION['rokError'])) {
                            echo '<span class="text-danger">' . $_SESSION['rokError'] . '</span><br>';
                            unset($_SESSION['rokError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Nazwa płyty</label>
                        <input class="col-12 form-control" placeholder="wszystkie znaki dozwolone" type="text" name="nazwa_plyty"
                            <?php if (isset($_SESSION['nazwa_plyty'])) echo 'value="' . $_SESSION['nazwa_plyty'] . '"'; unset($_SESSION['nazwa_plyty'])?>>
                        <?php
                        if (isset($_SESSION['nazwa_plytyError'])) {
                            echo '<span class="text-danger">' . $_SESSION['nazwa_plytyError'] . '</span><br>';
                            unset($_SESSION['nazwa_plytyError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Liczba utworów na płycie</label>
                        <input class="col-12 form-control" type="number" placeholder="Liczba od 1 do 99" name="liczba_utworow"
                            <?php if (isset($_SESSION['liczba_utworow'])) echo 'value="' . $_SESSION['liczba_utworow'] . '"'; unset($_SESSION['liczba_utworow'])?>>
                        <?php
                        if (isset($_SESSION['liczba_utworowError'])) {
                            echo '<span class="text-danger">' . $_SESSION['liczba_utworowError'] . '</span><br>';
                            unset($_SESSION['liczba_utworowError']);
                        }
                        ?>
                        <label for="col-12 exampleTextarea">Liczba sprzedanych albumów</label>
                        <input class="col-12 form-control" type="number" placeholder="Liczba od 1 do 9 999 999" name="liczba_albumow"
                            <?php if (isset($_SESSION['liczba_albumow'])) echo 'value="' . $_SESSION['liczba_albumow'] . '"'; unset($_SESSION['liczba_albumow'])?>>
                        <?php
                        if (isset($_SESSION['liczba_albumowError'])) {
                            echo '<span class="text-danger">' . $_SESSION['liczba_albumowError'] . '</span><br>';
                            unset($_SESSION['liczba_albumowError']);
                        }
                        ?>
                        <input class="col-12 btn btn-outline-light submit" type="submit" value="Dodaj album.">
                    </div>
                </form>
            </article>
        </div>
    </div>
</main>
</body>
</html>