<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>

    <!--Stylesheets -->
    <link rel="stylesheet" href="../styles/basic_body_styles.css">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <link rel="stylesheet" href="../styles/button_styles.css">
</head>
<body>
    <section class="log_section">
        <h2>Poniżej wprowadź dane logowania</h2>
        <form action="login.php" method="POST">
            <label for="login">Login (nick): </label>
            <input type="text" id="login" name="login" required>

            <label for="password">Hasło: </label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Zaloguj"><br>
            <button onclick="window.location.href='index.php';">Strona główna</button>
        </form>
    </section>

    <?php 
        include '../core/fx_login.php';
        
        session_start();

        // Obsługa formularza logowania
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $user = loginUser($login, $password); // Wywołanie funkcji logowania

            if ($user) {
                $_SESSION['id'] = $user['id']; // Ustawienie identyfikatora użytkownika w sesji

                // Przekierowanie na stronę menu
                header("Location: quizlet_menu.php?username=" . $user['login']);
                exit;
            } else {
                echo "<p>Nieprawidłowy login lub hasło. Spróbuj ponownie.</p>";
            }
        }
    ?>
</body>
</html>
