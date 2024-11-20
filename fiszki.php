<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra Fiszki</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 20px;
            margin: 0;
        }

        header h1, header h3 {
            margin: 0;
            line-height: 1.2;
            color: #444;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        header h3 {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 20px;
        }

        .question-box {
            width: 80%;
            max-width: 700px;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            margin: 20px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .question-box p {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #333;
        }

        .question-box input[type='text'] {
            width: 90%;
            max-width: 500px;
            padding: 10px;
            font-size: 1.3rem;
            margin-top: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .question-box input[type='text']:focus {
            border-color: #f39c12;
            box-shadow: 0 0 8px rgba(243, 156, 18, 0.6);
            outline: none;
        }

        button {
            width: 200px;
            height: 50px;
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 15px;
            background: linear-gradient(135deg, #f39c12, #d35400);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        button:active {
            transform: scale(0.95);
            transform: translateY(5%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .message {
            margin-top: 20px;
            font-size: 1.6rem;
            font-weight: bold;
            color: #27ae60;
        }
        .message.good {
            color:#27ae60;
        }

        .message.error {
            color: #e74c3c;
        }
        .result {
            font-size: 1.4rem;
            padding: 8px;
            margin: 5px;
            border-radius: 8px;
            display: inline-block;
        }

        .correct {
            color: #27ae60;
        }

        .incorrect {
            color: #e74c3c;
        }

        .summary {
            margin-top: 20px;
            font-size: 1.6rem;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Fiszki by Tobiasz & Daniel</h1>
        <h3>Współpraca szachowo-edukacyjna</h3>
    </header>

    <?php
    // Połączenie z bazą danych
    $localhost = 'localhost';
    $dbname = 'fiszki';
    $username = 'root';
    $password = '';

    $conn = mysqli_connect($localhost, $username, $password, $dbname);

    if (!$conn) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }
    
    // Obsługiwanie polskich znaków
    mysqli_set_charset($conn, 'utf8mb4');

    // Pobranie liczby słówek do odgadnięcia
    $wordCount = isset($_GET['word_count']) ? (int)$_GET['word_count'] : 1;
    $currentQuestion = isset($_GET['current_question']) ? (int)$_GET['current_question'] : 1;
    $message = "";

    // Inicjalizacja tablicy na wyniki, jeśli jeszcze jej nie ma
    if (!isset($_SESSION['results'])) {
        $_SESSION['results'] = [];
    }

    // Inicjalizacja tablicy na wybrane słówka, jeśli jeszcze jej nie ma
    if (!isset($_SESSION['selected_words'])) {
        $_SESSION['selected_words'] = [];
    }

    // Obsługa odpowiedzi użytkownika
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userAnswer = trim($_POST['user_answer']);
        $correctAnswer = $_POST['correct_answer'];
        $polishWord = $_POST['polish_word'];

        // Sprawdzenie odpowiedzi użytkownika i zapis do wyników
        if (strtolower($userAnswer) === strtolower($correctAnswer)) {
            $message = "<p class='message good'>Brawo! Dobra odpowiedź!</p>";
            $_SESSION['results'][] = ['polish' => $polishWord, 'english' => $correctAnswer, 'userAnswer' => $userAnswer, 'correct' => true];
        } else {
            $message = "<p class='message error'>Źle! Poprawna odpowiedź to: <strong>$correctAnswer</strong>.</p>";
            $_SESSION['results'][] = ['polish' => $polishWord, 'english' => $correctAnswer, 'userAnswer' => $userAnswer, 'correct' => false];
        }

        // Przejście do kolejnego pytania
        $currentQuestion++;
        if ($currentQuestion > $wordCount) {
            // Podsumowanie wyników i zakończenie gry
            $correctAnswers = array_filter($_SESSION['results'], fn($result) => $result['correct']);
            $score = count($correctAnswers);
            $total = count($_SESSION['results']);
            ?>

            <section class="summary">
                <h2>Podsumowanie wyników</h2>
                <p>Twoje wyniki:</p>
                <ul>
                    <?php foreach ($_SESSION['results'] as $result): ?>
                        <li class="result <?php echo $result['correct'] ? 'correct' : 'incorrect'; ?>">
                            <strong><?php echo $result['polish']; ?></strong> &ndash; <strong><?php echo $result['english']; ?></strong><br>
                            Twoja odpowiedź: <?php echo $result['userAnswer']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="summary">Zdobyłeś <strong><?php echo $score; ?></strong>/<strong><?php echo $total; ?></strong> punktów. <br>Wynik w procentach: <?php echo $score/$total * 100 ?>% </p>
                <button onclick="window.location.href='index.php'">Wróć do menu</button>
            </section>

            <?php
            // Czyszczenie wyników po zakończeniu gry
            unset($_SESSION['results']);
            unset($_SESSION['selected_words']);
            exit;
        }
    }

    // Zapytanie o wszystkie słówka
    $query = "SELECT * FROM words";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $words = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Usuwamy już wybrane słówka
        $remainingWords = array_filter($words, function($word) {
            return !in_array($word['id'], $_SESSION['selected_words']);
        });

        if (count($remainingWords) > 0) {
            // Losowanie słówka
            $randomKey = array_rand($remainingWords);
            $selectedWord = $remainingWords[$randomKey];
            $_SESSION['selected_words'][] = $selectedWord['id'];

            $polishWord = $selectedWord['polski'];
            $correctAnswer = $selectedWord['angielski'];
        } else {
            echo "<p>Brak dostępnych słówek do wyświetlenia.</p>";
            exit;
        }

    } else {
        echo "<p>Brak pytań w bazie danych.</p>";
        exit;
    }

    mysqli_close($conn);
    ?>

    <section>
        <div class="question-box">
            <?php
            // Wyświetlenie wiadomości o poprawności poprzedniej odpowiedzi
            if (!empty($message)) {
                echo $message;
            }
            ?>
            <p><strong>Pytanie <?php echo $currentQuestion; ?> z <?php echo $wordCount; ?>:</strong> Jak po angielsku jest słowo <strong><?php echo $polishWord; ?></strong>?</p>
            <form method="POST" action="fiszki.php?word_count=<?php echo $wordCount; ?>&current_question=<?php echo $currentQuestion; ?>">
                <input type="text" name="user_answer" placeholder="Twoja odpowiedź" required>
                <input type="hidden" name="correct_answer" value="<?php echo $correctAnswer; ?>">
                <input type="hidden" name="polish_word" value="<?php echo $polishWord; ?>"><br>
                <button type="submit">Sprawdź</button>
            </form>
        </div>
    </section>
</body>
</html>




