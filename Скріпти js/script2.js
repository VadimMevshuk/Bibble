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