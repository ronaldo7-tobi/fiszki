<!DOCTYPE html>
<html lang="en">
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

        .message.error {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <header>
        <h1>Fiszki by Tobiasz & Daniel</h1>
        <h3>Współpraca szachowo-edukacyjna</h3>
    </header>

    <?php
    $localhost = 'localhost';
    $dbname = 'fiszki';
    $username = 'root';
    $password = '';

    $conn = mysqli_connect($localhost, $username, $password, $dbname);

    if (!$conn) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }
    
    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userAnswer = trim($_POST['user_answer']);
        $correctAnswer = $_POST['correct_answer'];

        if (strtolower($userAnswer) === strtolower($correctAnswer)) {
            $message = "<p class='message'>Brawo! Dobra odpowiedź!</p>";
        } else {
            $message = "<p class='message error'>Źle! Poprawna odpowiedź to: <strong>$correctAnswer</strong>.</p>";
        }
    }

    $query = "SELECT * FROM words ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $polishWord = $row['polski'];
        $correctAnswer = $row['angielski'];
    } else {
        echo "<p>Brak pytań w bazie danych.</p>";
        exit;
    }

    mysqli_close($conn);
    ?>

    <section>
        <div class="question-box">
            <p><strong>Pytanie:</strong> Jak po angielsku jest słowo <strong><?php echo $polishWord; ?></strong>?</p>
            <form method="POST">
                <input type="text" name="user_answer" placeholder="Twoja odpowiedź" required>
                <input type="hidden" name="correct_answer" value="<?php echo $correctAnswer; ?>"><br>
                <button type="submit">Sprawdź</button>
            </form>
        </div>
    </section>

    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>
</body>
</html>
