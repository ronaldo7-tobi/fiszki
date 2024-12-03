<?php 
    // Funkcja do wyświetlania paczek
    function show_packs($user_id) {
        include '../config/db_connection.php';

        // Połączenie z bazą danych
        $conn = connectToDatabase();
        
        $query = "SELECT `nazwa_paczki` FROM `paczki` WHERE `user_id` = '$user_id'";
        $result = mysqli_query($conn, $query);

        // Wyświetlanie paczek
        if (mysqli_num_rows($result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row['nazwa_paczki'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nie masz jeszcze żadnych paczek.</p>";
        }
    }
?>