      // Функція для відображення фреймів відповідно до вибраного жанру
      function showGenreBooks(genre) {
        const booksByGenre = {
            drama: [
                { title: "Драма 1", genre: "Драма", image: "path/to/drama1.jpg" },
                { title: "Драма 2", genre: "Драма", image: "path/to/drama2.jpg" },
                { title: "Драма 3", genre: "Драма", image: "path/to/drama3.jpg" },
                { title: "Драма 4", genre: "Драма", image: "path/to/drama4.jpg" },
                { title: "Драма 5", genre: "Драма", image: "path/to/drama5.jpg" }
            ],
            romance: [
                { title: "Роман 1", genre: "Роман", image: "path/to/romance1.jpg" },
                { title: "Роман 2", genre: "Роман", image: "path/to/romance2.jpg" },
                { title: "Роман 3", genre: "Роман", image: "path/to/romance3.jpg" },
                { title: "Роман 4", genre: "Роман", image: "path/to/romance4.jpg" },
                { title: "Роман 5", genre: "Роман", image: "path/to/romance5.jpg" }
            ],
            mystery: [
                { title: "Містика 1", genre: "Містика", image: "path/to/mystery1.jpg" },
                { title: "Містика 2", genre: "Містика", image: "path/to/mystery2.jpg" },
                { title: "Містика 3", genre: "Містика", image: "path/to/mystery3.jpg" },
                { title: "Містика 4", genre: "Містика", image: "path/to/mystery4.jpg" },
                { title: "Містика 5", genre: "Містика", image: "path/to/mystery5.jpg" }
            ],
            fantasy: [
                { title: "Фентезі 1", genre: "Фентезі", image: "path/to/fantasy1.jpg" },
                { title: "Фентезі 2", genre: "Фентезі", image: "path/to/fantasy2.jpg" },
                { title: "Фентезі 3", genre: "Фентезі", image: "path/to/fantasy3.jpg" },
                { title: "Фентезі 4", genre: "Фентезі", image: "path/to/fantasy4.jpg" },
                { title: "Фентезі 5", genre: "Фентезі", image: "path/to/fantasy5.jpg" }
            ],
            scienceFiction: [
                { title: "Наукова фантастика 1", genre: "Наукова фантастика", image: "path/to/sf1.jpg" },
                { title: "Наукова фантастика 2", genre: "Наукова фантастика", image: "path/to/sf2.jpg" },
                { title: "Наукова фантастика 3", genre: "Наукова фантастика", image: "path/to/sf3.jpg" },
                { title: "Наукова фантастика 4", genre: "Наукова фантастика", image: "path/to/sf4.jpg" },
                { title: "Наукова фантастика 5", genre: "Наукова фантастика", image: "path/to/sf5.jpg" }
            ]
        };
    
        // Отримуємо контейнер для фреймів
        const framesContainer = document.getElementById("frames-container");
        framesContainer.innerHTML = ""; // Очищаємо поточний контент
    
        // Додаємо фрейми для вибраного жанру
        booksByGenre[genre].forEach(book => {
            const frame = document.createElement("div");
            frame.classList.add("frame");
            frame.innerHTML = `
                <img src="${book.image}" alt="${book.title}" class="book-image" />
                <div class="book">${book.title}</div>
                <div class="title">${book.title}</div>
                <button class="order-btn">Замовити</button>
            `;
            framesContainer.appendChild(frame);
        });
    }