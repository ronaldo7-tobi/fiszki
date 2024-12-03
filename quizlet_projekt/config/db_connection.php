<?php
function connectToDatabase() {
    $localhost = 'localhost';
    $dbname = 'quizlet';
    $db_username = 'root';
    $db_password = '';

    // Połączenie z bazą danych
    $conn = mysqli_connect($localhost, $db_username, $db_password, $dbname);

    return $conn; // Zwróć połączenie
}
?>
