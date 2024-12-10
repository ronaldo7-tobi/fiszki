<?php 
    // Funkcja do dodawania słówek
    function add_words($conn, $id_paczki) {
        $polish_words = $_POST['polish'];
        $english_words = $_POST['english'];

        for ($i = 0; $i < count($polish_words); $i++) {
            $polish = $polish_words[$i];
            $english = $english_words[$i];

            // Wstawienie słówek do tabeli 'slowa'
            $query2 = "INSERT INTO `slowa` (id_paczki, polski, angielski) VALUES('$id_paczki', '$polish', '$english')";
            $result2 = mysqli_query($conn, $query2);
        }
    }
?>