<?php 
    // Funkcja do dodawania paczki
    function add_pack($conn) {
        $pack_name = $_POST['pack_name'];
        $number_of_words = $_POST['number_of_words'];
        $user_id = $_SESSION['id']; // Pobranie identyfikatora użytkownika z sesji

        // Dodanie paczki do bazy danych
        $query = "INSERT INTO `paczki` (user_id, nazwa_paczki) VALUES ('$user_id', '$pack_name')";
        $result = mysqli_query($conn, $query);            

        // Pobranie ID ostatnio dodanego pakietu
        return mysqli_insert_id($conn); // Zwracamy ID paczki
    }
?>