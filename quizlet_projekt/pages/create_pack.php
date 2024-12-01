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
        
        <!-- Do poprawy -->
        <p>Test użytkownika: <?php echo $user['login']; ?></p>
        <button onclick="window.location.href = 'quizlet_menu.php?username=<?php echo $user['login']; ?>';">Wróć do menu</button>
        
    </section>

    <?php
        include '../config/db_connection.php';

        session_start();

        // Połączenie z bazą danych
        $conn = connectToDatabase();

        // Funkcja do dodawania paczki
        function add_pack($conn) {
            $pack_name = $_POST['pack_name'];
            $number_of_words = $_POST['number_of_words'];
            $user_id = $_SESSION['id']; // Pobranie identyfikatora użytkownika z sesji

            // Dodanie paczki do bazy danych
            $query = "INSERT INTO `paczki` (user_id, nazwa_paczki) VALUES ('$user_id', '$pack_name')";
            $result = mysqli_query($conn, $query);            

            // Pobranie ID ostatnio dodanego pakietu
            return mysqli_insert_id($conn); // Zwracamy ID paczki
        }

        // Funkcja do dodawania słówek
        function add_words($conn, $id_paczki) {
            $polish_words = $_POST['polish'];
            $english_words = $_POST['english'];

            for ($i = 0; $i < count($polish_words); $i++) {
                $polish = $polish_words[$i];
                $english = $english_words[$i];

                // Wstawienie słówek do tabeli 'slowa'
                $query2 = "INSERT INTO `slowa` (id_paczki, polski, angielski) VALUES('$id_paczki', '$polish', '$english')";
                $result2 = mysqli_query($conn, $query2);
            }
        }

        // Jeżeli formularz dla paczki został wysłany
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pack_name']) && isset($_POST['number_of_words'])) {
            // Dodaj paczkę do bazy danych
            $id_paczki = add_pack($conn);

            // Generowanie formularza do dodawania słówek
            echo '<form method="POST" action="create_pack.php">';
            echo '<input type="hidden" name="id_paczki" value="' . $id_paczki . '">'; // Przekazujemy id paczki jako ukryte pole
            for ($i = 0; $i < $_POST['number_of_words']; $i++) {
                echo '<label>Polskie słowo ' . ($i + 1) . ':</label>';
                echo '<input type="text" name="polish[]" required>';

                echo '<label>Angielskie słowo ' . ($i + 1) . ':</label>';
                echo '<input type="text" name="english[]" required>';
            }
            echo '<input type="submit" value="Zapisz słówka">';
            echo '</form>';
        }

        // Jeżeli formularz dla słówek został wysłany
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['polish']) && isset($_POST['english']) && isset($_POST['id_paczki'])) {
            // Dodaj słówka do paczki o podanym id
            add_words($conn, $_POST['id_paczki']);
            echo "Słówka zostały zapisane do paczki.";

            // Dodanie przekierowania po zapisaniu słówek
            header("Location: quizlet_menu.php?username=" . $_SESSION['login']);
            exit();
        }
    ?>
</body>
</html>
