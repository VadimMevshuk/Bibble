<?php
session_start();

$host = "localhost";
$dbname = "library";
$username = "root";
$password = "9876543210";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = ''; // Змінна для повідомлення

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Перевірка на наявність користувача в базі даних
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Перевірка пароля
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $message = "Вхід успішний! Вітаємо, " . htmlspecialchars($user['name']) . ".";

            // Перенаправлення на потрібну сторінку
            header("Location:http://localhost/%D0%9E%D0%BD%D0%BB%D0%B0%D0%B9%D0%BD%20%D0%91%D1%96%D0%B1%D0%BB%D1%96%D0%BE%D1%82%D0%B5%D0%BA%D0%B0/%D0%94%D1%80%D1%83%D0%B3%D0%B0%20%D1%81%D1%82%D0%BE%D1%80%D1%96%D0%BD%D0%BA%D0%B0%20%D1%81%D0%B0%D0%B9%D1%82%D1%83.php");
            exit;
        } else {
            $message = "Неправильний пароль.";
        }
    } else {
        $message = "Користувач із таким емейлом не знайдений.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Log.css">
    <title>Вхід</title>
</head>
<body>
<div class="auth-box">
    <h2>Вхід</h2>
    <form action="Log.php" method="POST">
        <div class="form-group">
            <label for="email">Емейл</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="auth-btn">Увійти</button>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
    </form>
    <a href="http://localhost/Онлайн%20Бібліотека/Перша%20сторінка.php">
        <button class="auth-btn">Головна</button>
    </a>
    <a href="http://localhost/Онлайн%20Бібліотека/Reg-Log/Reg.php" class="switch-link">Немає аккаунту? Реєстрація</a>
</div>
</body>
</html>
