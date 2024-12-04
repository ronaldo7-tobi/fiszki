<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra Fiszki</title>

    <!--Stylesheets -->
    <link rel="stylesheet" href="../styles/basic_body_styles.css">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <link rel="stylesheet" href="../styles/button_styles.css">
</head>
<body>
    <header>
        <h1>Fiszki by Tobiasz & Marcelina</h1>
        <h3>Wybierz pakiet do nauki</h3>
    </header>

    <?php
    include '../config/db_connection.php';
    session_start();

    $conn = connectToDatabase();
    $message = "";
    $polishWord = "";
    $correctAnswer = "";
    $selectedPack = "";

    // Pobranie pakietów użytkownika
    $userId = $_SESSION['id']; 
    $query = "SELECT * FROM paczki WHERE user_id = $userId";
    $packsResult = mysqli_query($conn, $query);
    $packsAvailable = $packsResult && mysqli_num_rows($packsResult) > 0;

    // Obsługa formularza wyboru pakietu
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_pack'])) {
        $selectedPack = $_POST['selected_pack'];
        $query = "SELECT * FROM slowa WHERE id_paczki = $selectedPack ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $polishWord = $row['polski'];
            $correctAnswer = $row['angielski'];
        } else {
            $message = "<p>Brak słówek w tym pakiecie.</p>";
        }
    }

    // Obsługa sprawdzania odpowiedzi
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_answer'], $_POST['correct_answer'], $_POST['selected_pack'])) {
        $selectedPack = $_POST['selected_pack'];
        $userAnswer = trim($_POST['user_answer']);
        $correctAnswer = $_POST['correct_answer'];

        if (strtolower($userAnswer) === strtolower($correctAnswer)) {
            $message = "<p class='message'><span class='green'>Brawo!</span> Dobra odpowiedź!</p>";
        } else {
            $message = "<p class='message'><span class='red_error'>Źle!</span> Poprawna odpowiedź to: <strong>$correctAnswer</strong>.</p>";
        }

        // Pobierz nowe słowo z tego samego pakietu
        $query = "SELECT * FROM slowa WHERE id_paczki = $selectedPack ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $polishWord = $row['polski'];
            $correctAnswer = $row['angielski'];
        } else {
            $message .= "<p>Brak kolejnych słówek w tym pakiecie.</p>";
        }
    }

    mysqli_close($conn);
    ?>

    <section>
        <?php if (!$packsAvailable): ?>
            <h3>Brak pakietów do nauki. Dodaj pakiety w menu głównym.</h3>
        <?php else: ?>
            <form method="POST">
                <label for="selected_pack">Wybierz pakiet do nauki:</label>
                <select name="selected_pack" id="selected_pack" required>
                    <?php while ($row = mysqli_fetch_assoc($packsResult)): ?>
                        <option value="<?php echo $row['id_paczki']; ?>">
                            <?php echo htmlspecialchars($row['nazwa_paczki']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit">Ćwicz</button>
            </form>
        <?php endif; ?>
    </section>

    <?php if (!empty($polishWord)): ?>
        <section>
            <?php echo $message; ?>
            <div class="question-box">
                <p class="question"><strong>Pytanie:</strong> Jak po angielsku jest słowo <strong><?php echo $polishWord; ?></strong>?</p>
                <form method="POST">
                    <input type="text" name="user_answer" placeholder="Twoja odpowiedź" required>
                    <input type="hidden" name="correct_answer" value="<?php echo $correctAnswer; ?>">
                    <input type="hidden" name="selected_pack" value="<?php echo $selectedPack; ?>">
                    <button type="submit">Sprawdź</button>
                </form>
            </div>
        </section>
        
        <!-- Do poprawy -->
        <button onclick="window.location.href = 'quizlet_menu.php?username=<?php echo $user['login']; ?>';">Wróć do menu</button>
    <?php endif; ?>
</body>
</html>
