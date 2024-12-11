<?php
// Kod do obsługi udostępniania paczek
session_start();
include '../config/db_connection.php';

$conn = connectToDatabase();
$user_id = $_SESSION['id']; // Pobranie identyfikatora użytkownika z sesji

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_user = intval($_POST['users']); // ID użytkownika do udostępnienia
    $selected_pack = intval($_POST['packs']); // ID paczki

    // Dodanie użytkownika do listy user_id paczki
    $query = "UPDATE `paczki` 
              SET `user_id` = CONCAT(`user_id`, ',', '$selected_user') 
              WHERE `id_paczki` = '$selected_pack' AND FIND_IN_SET('$user_id', `user_id`)";
    mysqli_query($conn, $query);

    echo "<p>Paczka została udostępniona!</p>";
}
?>

<!-- Formularz -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Udostępnianie paczek</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="../styles/basic_body_styles.css">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <link rel="stylesheet" href="../styles/button_styles.css">
</head>
<body>
    <button onclick="window.location.href = '../core/fx_to_quizlet_menu.php';">Wróć do menu</button>
    <form method="POST" action="share_pack.php">
        <p>Komu chcesz udostępnić paczkę słówek?</p>
        <select name="users">
        <?php
            $sql = "SELECT id, login FROM users WHERE id != $user_id";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='". $row['id'] . "'>" . $row['login'] . "</option>";
                }
            }
        ?>
        </select>
        
        <p>Jaką paczkę chcesz udostępnić?</p>
        <select name="packs">
        <?php
            $sql2 = "SELECT id_paczki, nazwa_paczki FROM paczki WHERE FIND_IN_SET('$user_id', user_id)";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2 && mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    echo "<option value='". $row2['id_paczki'] . "'>" . $row2['nazwa_paczki'] . "</option>";
                }
            }
        ?>
        </select>
        <br><button type="submit">Udostępnij</button>
    </form>
</body>
</html>
