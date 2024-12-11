<?php
    session_start();
    
    include '../config/db_connection.php';
    include '../core/fx_functions_exercise.php';

    $conn = connectToDatabase();
    $message = "";
    $polishWord = "";
    $correctAnswer = "";
    $selectedPack = "";
    $userId = $_SESSION['id'];

    // Pobranie pakietów użytkownika
    $packsResult = getUserPacks($conn, $userId);
    $packsAvailable = $packsResult && mysqli_num_rows($packsResult) > 0;

    // Obsługa formularza wyboru pakietu
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_pack'])) {
        $selectedPack = $_POST['selected_pack'];
        $wordData = getRandomWord($conn, $selectedPack);

        if ($wordData) {
            $polishWord = $wordData['polski'];
            $correctAnswer = $wordData['angielski'];
        } else {
            $message = "<p>Brak słówek w tym pakiecie.</p>";
        }
    }

    // Obsługa sprawdzania odpowiedzi
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_answer'], $_POST['correct_answer'], $_POST['selected_pack'])) {
        $selectedPack = $_POST['selected_pack'];
        $userAnswer = $_POST['user_answer'];
        $correctAnswer = $_POST['correct_answer'];

        if (checkUserAnswer($userAnswer, $correctAnswer)) {
            $message = "<p class='message'><span class='green'>Brawo!</span> Dobra odpowiedź!</p>";
        } else {
            $message = "<p class='message'><span class='red_error'>Źle!</span> Poprawna odpowiedź to: <strong>$correctAnswer</strong>.</p>";
        }

        // Pobierz kolejne słowo
        $wordData = getRandomWord($conn, $selectedPack);
        if ($wordData) {
            $polishWord = $wordData['polski'];
            $correctAnswer = $wordData['angielski'];
        }
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra Fiszki</title>
    <link rel="stylesheet" href="../styles/basic_body_styles.css">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <link rel="stylesheet" href="../styles/button_styles.css">
</head>
<body>
    <header>
        <h1>Fiszki by Tobiasz & Marcelina</h1>
        <h3>Wybierz pakiet do nauki</h3>
    </header>

    <section>
        <?php if (!$packsAvailable): ?>
            <h3>Brak pakietów do nauki. Dodaj pakiety w menu głównym lub przywróć stare.</h3>
        <?php else: ?>
            <form method="POST">
                <label for="selected_pack">Wybierz pakiet do nauki:</label>
                <select name="selected_pack" id="selected_pack" required>
                    <?php while ($row = mysqli_fetch_assoc($packsResult)): ?>
                        <option value="<?php echo $row['id_paczki']; ?>">
                            <?php echo $row['nazwa_paczki']; ?>
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
    <?php endif; ?>
    
    <button onclick="window.location.href = '../core/fx_to_quizlet_menu.php';">Wróć do menu</button>
</body>
</html>