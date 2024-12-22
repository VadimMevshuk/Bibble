<?php
session_start();
$host = "localhost";
$dbname = "library";
$username = "root";
$password = "9876543210";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = ''; 
$message_class = ''; // Клас для повідомлення

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $message = "Користувач з таким емейлом вже існує!";
        $message_class = 'error-message'; // Помилка
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
        $message = "Реєстрація успішна! Тепер ви можете увійти.";
        $message_class = 'success-message'; // Успіх
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="Reg.css">
</head>
<body>

<div class="auth-box">
<h2>Реєстрація</h2>
    <form action="Reg.php" method="POST">
        <div class="form-group">
            <label for="name">Ім'я</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="email">Емейл</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit" class="auth-btn">Зареєструватись</button>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo $message_class; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
    </form>
    <a href="http://localhost/%D0%9E%D0%BD%D0%BB%D0%B0%D0%B9%D0%BD%20%D0%91%D1%96%D0%B1%D0%BB%D1%96%D0%BE%D1%82%D0%B5%D0%BA%D0%B0/%D0%9F%D0%B5%D1%80%D1%88%D0%B0%20%D1%81%D1%82%D0%BE%D1%80%D1%96%D0%BD%D0%BA%D0%B0.php">
        <button type="submit" class="auth-btn">Головна</button>
    </a>
    <a href="http://localhost/%D0%9E%D0%BD%D0%BB%D0%B0%D0%B9%D0%BD%20%D0%91%D1%96%D0%B1%D0%BB%D1%96%D0%BE%D1%82%D0%B5%D0%BA%D0%B0/Reg-Log/Log.php" class="switch-link">Вже є аккаунт? Увійти</a>
</div>

</body>
</html>
