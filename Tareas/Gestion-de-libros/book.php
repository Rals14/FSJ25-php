<?php

class Book {
    private $id;
    private $title;
    private $author;
    private $category;
    private $status;

    public function __construct($id, $title, $author, $category, $status) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->status = $status;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setters
    public function setTitle($title) {
        $this->title = $title;
        return $this->title;
    }

    public function setAuthor($author) {
        $this->author = $author;
        return $this->author;
    }

    public function setCategory($category) {
        $this->category = $category;
        return $this->category;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this->status;
    }

    // Function to edit the book
    public function editBook($title, $author, $category, $status) {
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->status = $status;
    }
}

?>