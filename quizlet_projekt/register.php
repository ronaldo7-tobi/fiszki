<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>

    <!--Stylesheets -->
    <link rel="stylesheet" href="styles/basic__body_styles.css">
    <link rel="stylesheet" href="styles/form_styles.css">
    <link rel="stylesheet" href="styles/button_styles.css">
</head>
<header>
    <h1> By korzystać z naszego serwisu zarejestruj się lub zaloguj poniżej.
</header>
<body>
    <section class="reg_section"> 
        <h2>Rejestracja</h2>
        <form action="register.php" method="POST">
            <label for="email">Adres e-mail: </label>
            <input type="text" id="email" name="email" required>

            <label for="login">Login (nick): </label>
            <input type="text" id="login" name="login" required>

            <label for="passsword">Hasło: </label>
            <input type="text" id="password" name="password" required>

            <input type="submit" value="Zarejestruj">
            <p>Jeśli posiadasz konto: <a href="login.php"> Zaloguj się</a></p>
            <button>Strona główna</button>
        </form>
    </section>

    <?php
        $localhost = 'localhost';
        $dbname = 'quizlet';
        $db_username = 'root';
        $db_password = '';

        // Połączenie z bazą danych
        $conn = mysqli_connect($localhost, $db_username, $db_password, $dbname);

        // Pobranie danych z formularza
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Wstawianie danych do tabeli
        $query = "INSERT INTO users (login, password, is_admin, email) VALUES ('$login', '$password', 0, '$email')";
        $result = mysqli_query($conn, $query);

        // Sprawdzenie, czy zapytanie się powiodło
        if ($result) {
            echo "<p>Rejestracja przebiegła pomyślnie! <a href='index.php'>Przejdź do strony głównej</a></p>";
        } else {
            echo "<p>Wystąpił błąd podczas rejestracji. Spróbuj ponownie później.</p>";
        }

        mysqli_close($conn);
    ?>

</body>
</html>