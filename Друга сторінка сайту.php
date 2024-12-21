<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Стилі/Стилі css 2.css">
    <title>Реєстрація</title>
</head>
<body>

<div class="auth-container">
    <div class="auth-box">
        <h2>Реєстрація</h2>
        <form action="auth.php" method="POST">
            <div class="form-group">
                <label for="email">Емейл</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group" id="name-group">
                <label for="first-name">Ім'я</label>
                <input type="text" id="first-name" name="first-name" required>
            </div>
            <div class="form-group" id="last-name-group">
                <label for="last-name">Прізвище</label>
                <input type="text" id="last-name" name="last-name" required>
            </div>
            <button type="submit" class="auth-btn">Підтвердити</button>
        </form>
    </div>
</div>

</body>
</html>


<?php
session_start();
$host = "localhost";
$dbname = "library";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Для реєстрації
        if (isset($_POST['first-name']) && isset($_POST['last-name'])) {
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];

            // Перевірка на існуючий емейл
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $existing_user = $stmt->fetch();

            if ($existing_user) {
                echo "Користувач з таким емейлом вже існує!";
            } else {
                // Додавання нового користувача
                $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
                $stmt->execute([$first_name, $last_name, $email, password_hash($password, PASSWORD_DEFAULT)]);

                echo "Реєстрація успішна! Тепер ви можете увійти.";
            }
        }
    }
}
?>
