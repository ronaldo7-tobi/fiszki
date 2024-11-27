<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizlet - menu</title>

    <!--Stylesheets -->
    <link rel="stylesheet" href="styles/basic__body_styles.css">
    <link rel="stylesheet" href="styles/nav_styles.css">
    <link rel="stylesheet" href="styles/button_styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="quizlet_menu.php?username=<?php echo urlencode($username); ?>">Menu</a></li>
            <li><a href="logout.php">Wyloguj się</a></li>
        </ul>
    </nav>

    <header>
        <?php
        // Pobranie nazwy użytkownika z parametrów URL
        $username = htmlspecialchars($_GET['username']);
        echo "<h1>Witaj w naszym serwisie, $username!</h1>";
        ?>
    </header>

    <section class="menu">
        <div class="packs_cockpit">
            <h3>Twoje paczki: </h3>
        </div>

        <div class="add_package">
            <button onclick="window.location.href='create_pack.php';">Dodaj nową paczkę</button>
        </div>

        <div class="exercise">
            <button>Przejdź do ćwiczeń</button>
        </div>
    </section>
</body>
</html>