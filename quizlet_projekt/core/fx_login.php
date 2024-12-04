<?php 
// Funkcja logowania użytkownika
function loginUser($login, $password) {
    include '../config/db_connection.php';
    
    // Połączenie z bazą danych
    $conn = connectToDatabase();

    // Zapytanie do bazy danych
    $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Sprawdzenie, czy użytkownik istnieje
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Zamykanie połączenia z bazą
        mysqli_close($conn);

        return $user; // Zwrócenie danych użytkownika
    }

    // Zamykanie połączenia z bazą
    mysqli_close($conn);

    return false; // Brak użytkownika
}
?>