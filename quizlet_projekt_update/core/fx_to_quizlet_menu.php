<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: ../pages/quizlet_menu.php?username=" . $_SESSION['login']);
    exit();    
} else {
    echo "Brak aktywnej sesji. Zaloguj się ponownie.";
    exit();
}
?>
