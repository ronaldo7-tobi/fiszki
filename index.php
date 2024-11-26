<?php
session_start();

// Konfiguracja bazy danych
$host = 'localhost';
$dbname = 'quizlet';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Obsługa logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        header('Location: index.php');
        exit;
    } else {
        $message = "Nieprawidłowy login lub hasło.";
    }
}

// Wylogowanie
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Tworzenie nowej paczki
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_pack') {
    $packName = trim($_POST['pack_name']);
    $userId = $_SESSION['user_id'];

    $query = "INSERT INTO paczki (user_id, nazwa_paczki) VALUES ('$userId', '$packName')";
    if (mysqli_query($conn, $query)) {
        $message = "Paczka została utworzona!";
    } else {
        $message = "Błąd przy tworzeniu paczki.";
    }
}

// Dodawanie słówek do paczki
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_word') {
    $polski = trim($_POST['polski']); // Pobranie polskiego słowa
    $angielski = trim($_POST['angielski']); // Pobranie angielskiego tłumaczenia
    $idPaczki = intval($_POST['id_paczki']); // Bezpieczne pobranie ID paczki

    // Dodanie słówka do tabeli `slowa`
    $query = "INSERT INTO slowa (id_paczki, polski, angielski) VALUES ('$idPaczki', '$polski', '$angielski')";
    if (mysqli_query($conn, $query)) {
        $message = "Słówko zostało dodane!";
    } else {
        $message = "Błąd przy dodawaniu słówka: " . mysqli_error($conn);
    }
}

// Pobranie dostępnych paczek dla użytkownika
$packs = [];
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM paczki WHERE user_id = '$userId'"; // Używamy `user_id` zamiast `id_users`
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $packs[] = $row;
    }
}
?>

<!-- Interfejs -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fiszki</title>
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
<?php if (!isset($_SESSION['user_id'])): ?>
    <form method="POST">
        <input type="hidden" name="action" value="login">
        <label>Login: <input type="text" name="login" required></label><br>
        <label>Hasło: <input type="password" name="password" required></label><br>
        <button type="submit">Zaloguj</button>
    </form>
<?php else: ?>
    <p>Witaj, <?php echo $_SESSION['login']; ?>! <a href="?logout=1">Wyloguj się</a></p>
    
    <h2>Tworzenie paczki słówek</h2>
    <form method="POST">
        <input type="hidden" name="action" value="create_pack">
        <label>Nazwa paczki: <input type="text" name="pack_name" required></label><br>
        <button type="submit">Utwórz paczkę</button>
    </form>

    <h2>Dodawanie słówek</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add_word">
        <label>Polskie słowo: <input type="text" name="polski" required></label><br>
        <label>Angielskie słowo: <input type="text" name="angielski" required></label><br>
        <label>Wybierz paczkę:
            <select name="id_paczki">
                <?php foreach ($packs as $pack): ?>
                    <option value="<?php echo $pack['id_paczki']; ?>"><?php echo $pack['nazwa_paczki']; ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <button type="submit">Dodaj słówko</button>
    </form>

    <h2>Nauka</h2>
    <form method="POST">
        <input type="hidden" name="action" value="check_answer">
        <label>Twoja odpowiedź: <input type="text" name="user_answer" required></label>
        <input type="hidden" name="correct_answer" value="<?php echo $correctAnswer ?? ''; ?>">
        <button type="submit">Sprawdź</button>
    </form>
<?php endif; ?>

<?php if (isset($message)) echo "<p>$message</p>"; ?>
</body>
</html>

