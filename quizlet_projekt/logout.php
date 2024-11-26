<?php
session_start();

// Zakończ sesję
session_unset();
session_destroy();

// Przekieruj na stronę logowania
header("Location: login.php");
exit;
?>
