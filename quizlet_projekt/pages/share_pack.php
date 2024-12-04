<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    include '../config/db_connection.php';
    session_start();
    $conn = connectToDatabase();
    $user_id = $_SESSION['id']; // Pobranie identyfikatora użytkownika z sesji

?>
    <p>Komu chcesz udostpenic paczke slowek?</p>
    <?php
        //Pobieranie uzytkownikow po id z bazy danych
        $sql = "SELECT id,login FROM users";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        foreach ($row as $id){
            echo $id;
        }
    ?>
    <p>Jaka paczke chcesz udostepnic?</p>
    <?php
        //Pobieranie paczek, ktore naleza do uzytkownika
        $sql2 = "SELECT nazwa_paczki FROM paczki WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        foreach ($row as $pack){
            echo $pack;
        }

    ?>
</body>
</html>
