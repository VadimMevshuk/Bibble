<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книжкова колекція</title>
    <link rel="stylesheet" href="Стилі/Стилі css.css">
    <script src="Скріпти js/script.js"></script>
</head>

<body>
    <div class="menu">
    <a href="http://localhost/%D0%9E%D0%BD%D0%BB%D0%B0%D0%B9%D0%BD%20%D0%91%D1%96%D0%B1%D0%BB%D1%96%D0%BE%D1%82%D0%B5%D0%BA%D0%B0/%D0%A1%D1%82%D0%BE%D1%80%D1%96%D0%BD%D0%BA%D0%B0%20%D0%A2%D1%80%D0%B5%D1%82%D1%8C%D1%8F.php">
  <button type="submit" class="auth-btn">Каталог</button>
</a>
        <button>Інформація</button>
    </div>

    <a href="http://localhost/%D0%9E%D0%BD%D0%BB%D0%B0%D0%B9%D0%BD%20%D0%91%D1%96%D0%B1%D0%BB%D1%96%D0%BE%D1%82%D0%B5%D0%BA%D0%B0/Reg-Log/Reg.php" class="profile-link"> <!-- Встановіть URL сторінки, на яку треба перейти -->
        <div class="profile-icon">
            <img src="Зображення/1.jpg" alt="Профіль" class="icon-img">
        </div>
    </a>

    <div class="library">
        <img src="library.jpg" alt="Бібліотека" class="library-bg">
    </div>

    <!-- Секції (жанри книг) -->
    <div class="sections">
        <button class="section" onclick="showGenreBooks('drama')">Драма</button>
        <button class="section" onclick="showGenreBooks('romance')">Роман</button>
        <button class="section" onclick="showGenreBooks('mystery')">Містика</button>
        <button class="section" onclick="showGenreBooks('fantasy')">Фентезі</button>
        <button class="section" onclick="showGenreBooks('scienceFiction')">Наукова фантастика</button>
    </div>

    <!-- Контейнер для фреймів (книги по жанрам) -->
    <div id="frames-container" class="frames">
        <!-- Фрейми для книг будуть додаватися сюди -->
    </div>

</body>

</html>
