<?php 
    function register($email, $login, $password){
        include '../config/db_connection.php';

        // Połączenie z bazą danych
        $conn = connectToDatabase();

        // Sprawdzenie, czy użytkownik o takim samym loginie już istnieje
        $query_check = "SELECT * FROM users WHERE login = '$login'";
        $result_check = mysqli_query($conn, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Jeśli użytkownik o takim loginie już istnieje
            echo "<p>Błąd: Użytkownik o takim loginie już istnieje. Wybierz inny login.</p>";
        } else {
            // Jeśli login jest wolny, kontynuujemy rejestrację
            // Wstawianie danych do tabeli
            $query = "INSERT INTO users (login, password, is_admin, email) VALUES ('$login', '$password', 0, '$email')";
            $result = mysqli_query($conn, $query);

            // Sprawdzenie, czy zapytanie się powiodło
            if ($result) {
                echo "<p>Rejestracja przebiegła pomyślnie! <a href='index.php'>Przejdź do strony głównej</a></p>";
            } else {
                echo "<p>Wystąpił błąd podczas rejestracji. Spróbuj ponownie później.</p>";
            }
        }

        // Zamknięcie połączenia
        mysqli_close($conn);
    }
?>
