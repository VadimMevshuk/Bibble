<?php
session_start();

// Параметри підключення до бази даних
$host = "localhost";
$dbname = "library";
$username = "root";
$password = "9876543210";

try {
    // Підключення до бази даних
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Перевірка, чи користувач увійшов у систему
    if (!isset($_SESSION['user_id'])) {
        header("Location: Log.php"); // Перенаправлення на сторінку входу
        exit;
    }

    // Отримання інформації про користувача
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT name, email, created_at FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Користувача не знайдено.";
        exit;
    }
} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профіль користувача</title>
    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
        background: linear-gradient(to right, #b3e0ff, #e6f7ff);
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start; 
        padding-top: 20px; 

        .auth-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin: 0 auto;
        }

        .auth-box:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        .auth-box h2 {
            text-align: center;
            color: #6a3d90;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            color: #5a2e5f;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #b39ddb;
            border-radius: 6px;
            margin-top: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .auth-btn {
            width: 100%;
            background-color: #b39ddb;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 8px 0;
        }

        .auth-btn:hover {
            background-color: #7a42a1;
            transform: scale(1.05);
        }

        @media screen and (max-width: 480px) {
            .auth-box {
                width: 90%;
                padding: 20px;
            }

            .auth-box h2 {
                font-size: 1.2rem;
            }

            .form-group input {
                font-size: 0.9rem;
            }

            .auth-btn {
                font-size: 0.9rem;
            }
        }

        .switch-link {
            display: inline-block;
            width: 100%;
            background-color: #b39ddb;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-decoration: none;
            margin-top: 10px;
        }

        .switch-link:hover {
            background-color: #7a42a1;
            transform: scale(1.05);
        }

        .auth-box .switch-link {
            display: block;
            width: 100%;
            text-align: center;
            margin: 20px auto;
        }

        .auth-btn, .switch-link {
        width: 30%;
        display: inline-block;
        box-sizing: border-box;
        margin-left: 0; /* Забираємо можливий відступ */
        float: left; /* Зсуваємо кнопку вліво */
    }


        .message {
            color: #f44336;  /* Червоний для помилки */
            font-size: 14px;
            margin-top: 10px;
        }

        .message.success {
            color: #4CAF50;  /* Зелений для успіху */
        }

        .profile-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
        }

        .profile-header h1 {
            font-size: 1.8rem;
            color: #5a2e5f;
        }

        .profile-info p {
            font-size: 1rem;
            color: #333;
            margin: 10px 0;
        }

        .profile-info span {
            font-weight: bold;
            color: #6a3d90;
        }
        .auth-btn, .switch-link {
    width: 30%;
    display: inline-block;
    box-sizing: border-box;
    margin-left: 0;
    float: left;
    margin-top: 20px; /* Відступ зверху 20px */
}

    </style>
</head>
<body>
<div class="profile-container">
    <div class="profile-header">
        <h1>Профіль користувача</h1>
    </div>
    <div class="profile-info">
        <p><span>Ім'я:</span> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><span>Емейл:</span> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><span>Дата реєстрації:</span> <?php echo htmlspecialchars($user['created_at']); ?></p>
    </div>
    <a href="//localhost/%D0%9E%D0%BD%D0%BB%D0%B0%D0%B9%D0%BD%20%D0%91%D1%96%D0%B1%D0%BB%D1%96%D0%BE%D1%82%D0%B5%D0%BA%D0%B0/Reg-Log/Log.php">
        <button class="auth-btn">Вийти</button>
    </a>
</div>
</body>
</html>
