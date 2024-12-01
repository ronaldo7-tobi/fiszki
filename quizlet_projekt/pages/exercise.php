<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizlet - ćwiczenia</title>

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
</body>
</html>