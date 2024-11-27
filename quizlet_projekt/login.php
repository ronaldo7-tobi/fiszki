<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>

    <!--Stylesheets -->
    <link rel="stylesheet" href="styles/basic__body_styles.css">
    <link rel="stylesheet" href="styles/form_styles.css">
    <link rel="stylesheet" href="styles/button_styles.css">
</head>
<body>
    <section class="log_section">
        <h2>Poniżej wprowadź dane logowania</h2>
        <form action="login.php" method="POST">
            <label for="login">Login (nick): </label>
            <input type="text" id="login" name="login" required>

            <label for="password">Hasło: </label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Zaloguj">
            <button onclick="window.location.href='index.php';">Strona główna</button>
        </form>
    </section>

    <?php 
    $localhost = 'localhost';
    $dbname = 'quizlet';
    $db_username = 'root';
    $db_password = '';

    // Połączenie z bazą danych
    $conn = mysqli_connect($localhost, $db_username, $db_password, $dbname);

    // Sprawdzenie, czy formularz został przesłany
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Pobranie danych z formularza
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Zapytanie do bazy danych
        $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        // Sprawdzenie, czy użytkownik istnieje
        if (mysqli_num_rows($result) > 0) {
            // Pobranie nazwy użytkownika
            $user = mysqli_fetch_assoc($result);
            $username = $user['login'];

            // Przekierowanie na stronę menu
            header("Location: quizlet_menu.php?username=$username");
            exit;
        } else {
            echo "<p>Nieprawidłowy login lub hasło. Spróbuj ponownie.</p>";
        }
    }

    // Zamknięcie połączenia z bazą danych
    mysqli_close($conn);
    ?>
</body>
</html>
