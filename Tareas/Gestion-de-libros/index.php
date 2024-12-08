<?php

require 'book.php';
require_once 'library.php';

// Iniciar una nueva sesión
session_start();

if (!isset($_SESSION['library_data'])) {
    $_SESSION['library_data'] = [];
}

$library = new Library();
foreach ($_SESSION['library_data'] as $book) {
    $library->addBook($book);
}


if (isset($_POST['createForm'])) {
    if (isset($_POST['title'], $_POST['author'], $_POST['category'], $_POST['status'])) {
        if (!isset($_SESSION['last_id'])) {
            $_SESSION['last_id'] = 0;
        }

        $_SESSION['last_id']++;
        $id = $_SESSION['last_id'];

        $title = $_POST['title'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        
        $book = new Book($id, $title, $author, $category, $status);
        $library->addBook($book);
        
        $_SESSION['library_data'] = $library->getBooks();
        
        header('Location: /FSJ25-php/Tareas/Gestion-de-libros/');
    }
}

function getBookById($id, $library) {
    foreach ($library->getBooks() as $book) {
        if ($book->getId() == $id) {
            return $book;
        }
    }
}

if (isset($_POST['updateForm'])) {
    foreach ($library->getBooks() as $book) {
        if ($book->getId() == $_POST['id']) {
            $book->setTitle($_POST['title']);
            $book->setAuthor($_POST['author']);
            $book->setCategory($_POST['category']);
            $book->setStatus($_POST['status']);
        }
    }

    $_SESSION['library_data'] = $library->getBooks();
    header('Location: /FSJ25-php/Tareas/Gestion-de-libros/');

}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $library->deleteBook($id);

    $_SESSION['library_data'] = $library->getBooks();

    header('Location: /FSJ25-php/Tareas/Gestion-de-libros/');
}

if (isset($_POST['searchForm'])) {
    $query = $_POST['query'];
    $searchResults = $library->searchBooks($query);
}

if (isset($_POST['loanBook'])) {    
    $bookId = $_POST['book_id'];
    $result = $library->loanABook($bookId);
    
    if ($result) {
        $_SESSION['library_data'] = $library->getBooks(); // Actualiza la sesión
    }
    header('Location: /FSJ25-php/Tareas/Gestion-de-libros/');
    exit;
}

if (isset($_POST['returnBook'])) {
    $bookId = $_POST['book_id'];
    $result = $library->returnABook($bookId);
    
    if ($result) {
        $_SESSION['library_data'] = $library->getBooks(); // Actualiza la sesión
    }
    header('Location: /FSJ25-php/Tareas/Gestion-de-libros/');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
    <a href="index.php" class="text-decoration-none" style="color: black;">
        <h1 class="text-center">Library</h1>
    </a>

    <form method="post" class="mb-4">
            <h2>Search for a book</h2>
            <div class="form-group">
                <label for="query">Name, Author or Category:</label>
                <input type="text" name="query" class="form-control" required>
            </div>
            <input type="hidden" name="searchForm" value="1">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if (isset($searchResults)): ?>
            <h2>Search Results</h2>
            <ul class="list-group mb-4">
                <?php foreach ($searchResults as $book): ?>
                    <li class="list-group-item"><?php echo $book->getTitle() . " by " . $book->getAuthor(); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (isset($_GET['edit'])) {
            $bookeditable = getBookById($_GET['edit'], $library);
        ?>

            <h2>Edit Book</h2>
            <form action="index.php" method="POST" class="mb-4">
                <input type="hidden" name="id" value="<?= $bookeditable->getId() ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= $bookeditable->getTitle() ?>" required>
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="author" class="form-control" value="<?= $bookeditable->getAuthor() ?>" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" class="form-control" value="<?= $bookeditable->getCategory() ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="Available" <?= $bookeditable->getStatus() == 'Available' ? 'selected' : '' ?>>Available</option>
                        <option value="Loaned" <?= $bookeditable->getStatus() == 'Loaned' ? 'selected' : '' ?>>Loaned</option>
                    </select>
                </div>
                <button type="submit" name="updateForm" class="btn btn-primary">Update</button>
            </form>

        <?php } else { ?>

            <h2>Create Book</h2>
            <form action="index.php" method="POST" class="mb-4">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title" required>
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="author" class="form-control" placeholder="Author" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" class="form-control" placeholder="Category" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="Available">Available</option>
                        <option value="Loaned">Loaned</option>
                    </select>
                </div>
                <button type="submit" name="createForm" class="btn btn-success">Create</button>
            </form>

        <?php } ?>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Loan/Return</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($library->getBooks() as $book) : ?>
                    <tr>
                        <td><?= $book->getId() ?></td>
                        <td><?= $book->getTitle() ?></td>
                        <td><?= $book->getAuthor() ?></td>
                        <td><?= $book->getCategory() ?></td>
                        <td><?= $book->getStatus() ?></td>
                        <td>
                            <a href="index.php?edit=<?= $book->getId() ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="index.php?delete=<?= $book->getId() ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                        <td>
                        <form action="index.php" method="POST" style="display:inline;">
                        <input type="hidden" name="book_id" value="<?= $book->getId() ?>">
                        <?php if ($book->getStatus() == "Available"): ?>
                            <button type="submit" name="loanBook" class="btn btn-success btn-sm">Loan</button>
                        <?php else: ?>
                            <button type="submit" name="returnBook" class="btn btn-secondary btn-sm">Return</button>
                        <?php endif; ?>
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>