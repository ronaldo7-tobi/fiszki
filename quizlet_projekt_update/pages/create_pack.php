<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizlet - tworzenie paczek</title>

    <!--Stylesheets -->
    <link rel="stylesheet" href="../styles/basic_body_styles.css">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <link rel="stylesheet" href="../styles/button_styles.css">
</head>
<body>
    <section>
        <form method="POST" action="create_pack.php">
            <label for="pack_name">Nazwa pakietu: </label>
            <input type="text" id="pack_name" name="pack_name" required>

            <label>Liczba słówek do pakietu</label>
            <input type="number" id="number_of_words" name="number_of_words" required> <br><br>

            <input type="submit" value="Zapisz">
        </form>   
    </section>

    <?php
        session_start();

        include '../config/db_connection.php';
        include '../core/fx_add_pack.php';
        include '../core/fx_add_words.php';

        // Połączenie z bazą danych
        $conn = connectToDatabase();

        // Jeżeli formularz dla paczki został wysłany
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pack_name']) && isset($_POST['number_of_words'])) {
            // Dodaj paczkę do bazy danych
            $id_paczki = add_pack($conn);

            // Generowanie formularza do dodawania słówek
            echo '<form method="POST" action="create_pack.php">';
            echo '<input type="hidden" name="id_paczki" value="' . $id_paczki . '">'; // Przekazujemy id paczki jako ukryte pole
            for ($i = 0; $i < $_POST['number_of_words']; $i++) {
                echo '<div class="form_column">';
                echo '<label>Polskie słowo: <input type="text" name="polish[]" required></label>';
                echo '<label>Angielskie słowo: <input type="text" name="english[]" required></label>';
                echo '</div>';
            }
            echo '<input type="submit" value="Zapisz słówka">';
            echo '</form>';
        }

        // Jeżeli formularz dla słówek został wysłany
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['polish']) && isset($_POST['english']) && isset($_POST['id_paczki'])) {
            // Dodaj słówka do paczki o podanym id
            add_words($conn, $_POST['id_paczki']);
            echo "Słówka zostały zapisane do paczki.";

            header("Location: quizlet_menu.php?username=" . $_SESSION['login']);
            exit();
        }
    ?>

    <button onclick="window.location.href = '../core/fx_to_quizlet_menu.php';">Wróć do menu</button>
</body>
</html>
