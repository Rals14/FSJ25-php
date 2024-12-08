<?php

class Library{

    private $books;

    function __construct(){
        $this->books = [];
    }

    public function addBook($book){
        $this->books[] = $book;
    }

    public function getBooks(){
        return $this->books;
    }

    public function getBooksCount(){
        return count($this->books);
    }

    public function getBookById($id){
        foreach($this->books as $book){
            if($book->getId() == $id){
                return $book;
            }
        }
    }

    public function getBookByAuthor($author){
        foreach($this->books as $book){
            if($book->getAuthor() == $author){
                return $book;
            }
        }
    }

    public function getBookByCategory($category){
        foreach($this->books as $book){
            if($book->getCategory() == $category){
                return $book;
            }
        }
    }

    public function loanABook($id){
        $book = $this->getBookById($id);
        
        if ($book === null) {
            return false;
        }
    
        if($book->getStatus() == "Available"){
            $book->setStatus("Loaned");
            return true;
        } 
        
        return false;
    }
    
    public function returnABook($id){
        $book = $this->getBookById($id);
        
        if ($book === null) {
            return false;
        }
    
        if($book->getStatus() == "Loaned"){
            $book->setStatus("Available");
            return true;
        } 
        
        return false;
    }

    //function to delete a book
    public function deleteBook($id) {
        foreach ($this->books as $key => $book) {
            if ($book->getId() == $id) {
                unset($this->books[$key]);
                return "The book '" . $book->getTitle() . "' has been deleted";
            }
        }
        return "The book with ID " . $id . " was not found";
    }

    public function searchBooks($query) {
        $results = [];
        foreach ($this->books as $book) {
            if (stripos($book->getTitle(), $query) !== false ||
                stripos($book->getAuthor(), $query) !== false ||
                stripos($book->getCategory(), $query) !== false) {
                $results[] = $book;
            }
        }
        return $results;
    }
    
}

?>