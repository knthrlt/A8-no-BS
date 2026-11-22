<?php
include_once __DIR__ . '/../classes/Book.php';
$books = new Book();

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    if ($books->deleteBook($id)) {
        header("Location: book.php?message=Book deleted successfully");
        exit();
    } else {
        echo "Error deleting book.";
    }
} else {
    echo "Invalid book ID.";
}
?>
