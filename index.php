<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra Fiszki - Wybór</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 20px;
            margin: 0;
        }
        
        header h1 {
            font-size: 3rem;
            color: #444;
            margin-bottom: 1rem;
        }
        
        .menu-box {
            width: 80%;
            max-width: 500px;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            margin: 20px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        label {
            font-size: 1.4rem;
            color: #333;
            display: block;
            margin-bottom: 10px;
        }
        
        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 1.3rem;
            margin-top: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
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
    </style>
</head>
<body>
    <header>
        <h1>Gra Fiszki</h1>
    </header>

    <div class="menu-box">
        <form action="fiszki.php" method="GET">
            <label for="word_count">Ile słówek chcesz wylosować?</label>
            <input type="number" id="word_count" name="word_count" min="1" max="100" required>
            <button type="submit">Rozpocznij Grę</button>
        </form>
    </div>
</body>
</html>
