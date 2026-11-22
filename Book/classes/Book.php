<?php
require_once __DIR__ . '/../config/Database.php';

class Book extends Database {

    public function __construct() {
        parent::__construct(); // Call parent constructor (Database)
        $this->connect();      // Establish connection automatically
    }

    // Function to add a new book to the database
    public function addBook($book, $author, $genre, $isbn, $b_name) {
        $stmt = $this->conn->prepare("INSERT INTO book (book, author, genre, isbn, b_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $book, $author, $genre, $isbn, $b_name);
        return $stmt->execute();
    }

    // Function to get all books from the database
    public function getAllBooks() {
        $stmt = $this->conn->prepare("SELECT * FROM book");
        $stmt->execute();
        return $stmt->get_result();
    }

    // Function to get a single book by ID
    public function getBookById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM book WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Function to update a book's information
    public function updateBook($id, $book, $author, $genre, $isbn, $b_name) {
        $stmt = $this->conn->prepare("UPDATE book SET book = ?, author = ?, genre = ?, isbn = ?, b_name = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $book, $author, $genre, $isbn, $b_name, $id);
        return $stmt->execute();
    }

    // Function to delete a book from the database
    public function deleteBook($id) {
        $stmt = $this->conn->prepare("DELETE FROM book WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
