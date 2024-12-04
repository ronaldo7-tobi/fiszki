<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizlet - menu</title>

    <!--Stylesheets -->
    <link rel="stylesheet" href="../styles/basic_body_styles.css">
    <link rel="stylesheet" href="../styles/nav_styles.css">
    <link rel="stylesheet" href="../styles/button_styles.css">
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
        $username = $_GET['username'];
        echo "<h1>Witaj w naszym serwisie, $username!</h1>";
        ?>
    </header>

    <section class="menu">
        <div class="packs_cockpit">
            <h3>Twoje paczki: </h3>
            <?php 
                include '../core/fx_show_packs.php';
                
                session_start();

                $user_id = $_SESSION['id']; // Pobranie identyfikatora użytkownika z sesji

                // Wywołanie funkcji
                show_packs($user_id);
            ?>
        </div>

        <div class="add_package">
            <button onclick="window.location.href='create_pack.php';">Dodaj nową paczkę</button>
        </div>

        <div class="exercise">
            <button onclick="window.location.href='exercise.php';">Przejdź do ćwiczeń</button>
        </div>
        <div class="exercise">
            <button onclick="window.location.hreef='share_pack.php';">Udostępnij paczkę</button>
        </div>
    </section>
</body>
</html>
