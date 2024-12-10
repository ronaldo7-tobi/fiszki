<?php 
    // Funkcja do wyświetlania paczek z opcją archiwizacji i odarchiwizowania
    function show_packs_with_archive($user_id) {
        include '../config/db_connection.php';

        // Połączenie z bazą danych
        $conn = connectToDatabase();
        
        // Obsługa żądania archiwizacji lub odarchiwizowania
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['archive_pack_id'])) {
                $pack_id = intval($_POST['archive_pack_id']);
                $update_query = "UPDATE `paczki` SET `is_archived` = 1 WHERE `id_paczki` = '$pack_id' AND `user_id` = '$user_id'";
                mysqli_query($conn, $update_query);
            }

            if (isset($_POST['unarchive_pack_id'])) {
                $pack_id = intval($_POST['unarchive_pack_id']);
                $update_query = "UPDATE `paczki` SET `is_archived` = 0 WHERE `id_paczki` = '$pack_id' AND `user_id` = '$user_id'";
                mysqli_query($conn, $update_query);
            }
        }

        // Pobieranie paczek użytkownika
        $query = "SELECT `id_paczki`, `nazwa_paczki`, `is_archived` FROM `paczki` WHERE `user_id` = '$user_id'";
        $result = mysqli_query($conn, $query);

        // Wyświetlanie paczek
        if (mysqli_num_rows($result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                $pack_name = $row['nazwa_paczki'];
                $is_archived = $row['is_archived'] == 1;

                echo "<li>";
                echo $pack_name;
                if ($is_archived) {
                    echo " (zarchiwizowana)";
                    echo "
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='unarchive_pack_id' value='" . $row['id_paczki'] . "'>
                            <input type='submit' class='button_archive' value='Odarchiwizuj'>
                        </form>";
                } else {
                    echo "
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='archive_pack_id' value='" . $row['id_paczki'] . "'>
                            <input type='submit' class='button_archive' value='Archiwizuj'>
                        </form>";
                }
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nie masz jeszcze żadnych paczek.</p>";
        }
    }
?>
