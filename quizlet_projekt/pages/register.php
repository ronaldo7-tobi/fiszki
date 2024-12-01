<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>

    <!--Stylesheets -->
    <link rel="stylesheet" href="../styles/basic_body_styles.css">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <link rel="stylesheet" href="../styles/button_styles.css">
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
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Zarejestruj">
            <p>Jeśli posiadasz konto: <a href="login.php"> Zaloguj się</a></p>
            <button onclick="window.location.href='index.php';">Strona główna</button>
        </form>
    </section>

    <?php
        include '../core/fx_register.php';

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Pobranie danych z formularza
            $email = $_POST['email'];
            $login = $_POST['login'];
            $password = $_POST['password'];

            register($email, $login, $password);
        }
    ?>
</body>
</html>