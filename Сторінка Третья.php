<?php

$servername = "localhost";
$username = "root"; 
$password = "9876543210"; 
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}


$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фільтрація книг</title>
    <link rel="stylesheet" href="Стилі/Третья сторінка css.css">

  
</head>
<body>
    <div class="sidebar">
    <a href="http://localhost/%D0%9E%D0%BD%D0%BB%D0%B0%D0%B9%D0%BD%20%D0%91%D1%96%D0%B1%D0%BB%D1%96%D0%BE%D1%82%D0%B5%D0%BA%D0%B0/%D0%9F%D0%B5%D1%80%D1%88%D0%B0%20%D1%81%D1%82%D0%BE%D1%80%D1%96%D0%BD%D0%BA%D0%B0.php">
    <button class="btn" data-filter="all">Головна</button></a>

        <button class="btn" data-filter="all">Усі книги</button>
        <button class="btn" data-filter="free">Безкоштовні книги</button>
        <button class="btn" data-filter="paid">Платні книги</button>
        <button class="btn" data-filter="title">Пошук за назвою</button> 
        
    </div>

    <div class="content">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="book <?php echo $row['type']; ?>" data-genre="<?php echo strtolower($row['genre']); ?>" data-title="<?php echo strtolower($row['title']); ?>">
                    <img src="<?php echo htmlspecialchars($row['cover_image']); ?>" alt="Обкладинка книги">
                    <div class="book-details">
                        <div class="book-title"><?php echo htmlspecialchars($row['title']); ?></div>
                        <div class="book-meta">
                            Тип: <?php echo ucfirst($row['type']); ?> | Жанр: <?php echo htmlspecialchars($row['genre']); ?> | Дата: <?php echo $row['release_date']; ?>
                        </div>
                        <div class="book-description"><?php echo htmlspecialchars($row['description']); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Немає книг для відображення.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>
    <script>
    const buttons = document.querySelectorAll('.btn');
    const books = document.querySelectorAll('.book');
    let titleFilter = null; 
    let typeFilter = null;  


    const getTitle = () => {
        titleFilter = prompt("Введіть назву для пошуку:");
    };

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');


            if (filter === 'all') {
                titleFilter = null;
                typeFilter = null;
            }

          
            if (filter === 'title') {
                getTitle(); 
            } else if (filter === 'free') {
                typeFilter = 'free'; 
            } else if (filter === 'paid') {
                typeFilter = 'paid'; 
            }

            books.forEach(book => {
                let titleMatch = true;
                let typeMatch = true;

            
                if (titleFilter && !book.getAttribute('data-title').toLowerCase().includes(titleFilter.toLowerCase())) {
                    titleMatch = false;
                }

         
                if (typeFilter && book.classList.contains(typeFilter) === false) {
                    typeMatch = false;
                }

              
                if (titleMatch && typeMatch) {
                    book.style.display = 'flex';
                } else {
                    book.style.display = 'none';
                }
            });
        });
    });
</script>
</body>
</html>
