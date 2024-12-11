<?php
function getUserPacks($conn, $userId) {
    $query = "SELECT * FROM paczki WHERE user_id = $userId AND is_archived = 0";
    return mysqli_query($conn, $query);
}

function getRandomWord($conn, $packId) {
    $query = "SELECT * FROM slowa WHERE id_paczki = $packId ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $query);
    return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
}

function checkUserAnswer($userAnswer, $correctAnswer) {
    return strtolower(trim($userAnswer)) === strtolower($correctAnswer);
}