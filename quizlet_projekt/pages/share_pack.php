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
<form method="POST" action="share_package.php">
    <p>Komu chcesz udostpenic paczke slowek?</p>
    <select name="users">
    <?php
        //Pobieranie uzytkownikow po id z bazy danych
        $sql = "SELECT id,login FROM users WHERE id != $user_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
         if ($result && mysqli_num_rows($result) > 0) {
            while ($row){
                echo "<option value=". $row['id'] . ">" . $row['login'] . "</option>";
        }

    ?>
    </select>
    
    <p>Jaka paczke chcesz udostepnic?</p>
    <select name="packs">
    <?php
        //Pobieranie paczek, ktore naleza do uzytkownika
        $sql2 = "SELECT nazwa_paczki FROM paczki WHERE user_id='$user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2)
        if ($result2 && mysqli_num_rows($result2) > 0) {
            while ($row2){
                echo "<option value=". $row2['id'] . ">" . $row2['nazwa_paczki'] . "</option>";
        }
    ?>
    </select>
    <button type="submit">Udostępnij</button>
</form>
</body>
</html>
