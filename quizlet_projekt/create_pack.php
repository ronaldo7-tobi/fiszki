<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <!--Stylesheets -->
     <link rel="stylesheet" href="styles/basic_body_styles.css">
    <link rel="stylesheet" href="styles/nav_styles.css">
</head>
<body>
    <section>
        <form method="POST" action="create_pack.php">
            <label for="pack_name">Nazwa pakietu: </label>
            <input type="text" id="pack_name" name="pack_name" required>

            <label>Liczba słówek do pakietu</label>
            <input type="number" id="number_of_words" name="number_of_words" required>

            <input type="submit" value="Zapisz">
        </form>
    </section>

    <?php
        session_start();
        $localhost = 'localhost';
        $dbname = 'quizlet';
        $db_username = 'root';
        $db_password = '';

        // Połączenie z bazą danych
        $conn = mysqli_connect($localhost, $db_username, $db_password, $dbname);

        function adding_words($conn) {
            $pack_name = $_POST['pack_name'];
            $number_of_words = $_POST['number_of_words'];
            //$user_id = $_SESSION['id']; // Pobranie identyfikatora użytkownika z sesji

            // Dodanie pakietu do bazy danych
            $query = "INSERT INTO `paczki` (nazwa_paczki) VALUES ('$pack_name')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Błąd zapytania SQL: " . mysqli_error($conn));
            }

            // Generowanie formularza do dodawania słówek
            echo '<form method="POST" action="create_pack.php">';
            for ($i = 0; $i < $number_of_words; $i++) {
                echo '<label>Polskie słowo ' . ($i + 1) . ':</label>';
                echo '<input type="text" name="polish" required>';

                echo '<label>Angielskie słowo ' . ($i + 1) . ':</label>';
                echo '<input type="text" name="english" required>';
            }
            echo '<input type="submit" value="Zapisz słówka">';
            echo '</form>';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            adding_words($conn);
        }

        
        ?>
</body>
</html>