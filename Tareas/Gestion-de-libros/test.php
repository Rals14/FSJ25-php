<?php
require 'book.php';
require 'library.php';

// Create library
$library = new Library();

// Create books
$book1 = new book(1, "The Lord of the Rings", "J.R.R. Tolkien", "Fantasy", "available");
$book2 = new book(2, "Harry Potter", "J.K. Rowling", "Fantasy", "available");
$book3 = new book(3, "The Da Vinci Code", "Dan Brown", "Mystery", "available");
$book4 = new book(4, "The Alchemist", "Paulo Coelho", "Adventure", "available");

// Show books
echo "Books:";
echo "\n";
echo $book1->getTitle();
echo "\n";
echo $book2->getTitle();
echo "\n";
echo $book3->getTitle();
echo "\n";
echo $book4->getTitle();
echo "\n";

// Edit books
$book1->editBook("Golden Compass", "Philip Pullman", "Fantasy", "available");
$book2->editBook("The Hobbit", "J.R.R. Tolkien", "Fantasy", "available");
$book3->editBook("Angels and Demons", "Dan Brown", "Mystery", "available");
$book4->editBook("Inferno", "Dan Brown", "Mystery", "available");

//Show books
echo "Books Edited:";
echo "\n";
echo $book1->getTitle();
echo "\n";
echo $book2->getTitle();
echo "\n";
echo $book3->getTitle();
echo "\n";
echo $book4->getTitle();
echo "\n";

// Add books to library
$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);
$library->addBook($book4);

// Show books
echo "Books in library:";
foreach($library->getBooks() as $book){
    echo $book->getTitle();
    echo "\n";
}

// Count books
echo "Number of books in library:";
echo $library->getBooksCount();
echo "\n";


echo "Delete a book from library:";
$library->deleteBook(4);
echo "\n";
echo "Books in library after delete:\n";
foreach($library->getBooks() as $book){
    echo $book->getTitle();
    echo "\n";
}

// Search a book
echo "Search a book by id:\n";
echo $library->getBookById(1)->getTitle();
echo "\n";

echo "Search a book by author:\n";
echo $library->getBookByAuthor("J.R.R. Tolkien")->getTitle();
echo "\n";

echo "Search a book by category:\n";
echo $library->getBookByCategory("Fantasy")->getTitle();
echo "\n";

// Loan a book
echo "Loan a book:\n";
echo $library->loanABook(1);
echo "\n";
echo $library->getBookById(1)->getStatus();
echo "\n";

echo $library->loanABook(1);
echo "\n";
echo $library->getBookById(1)->getStatus();
echo "\n";

// Return a book
echo "Return a book:\n";
echo $library->returnABook(1);
echo "\n";
echo $library->getBookById(1)->getStatus();
echo "\n";

echo $library->returnABook(1);
echo "\n";
echo $library->getBookById(1)->getStatus();
echo "\n";

//search a book
echo "Search a book by title:\n";


?>

