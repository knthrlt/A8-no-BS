<?php
include_once __DIR__ . '/../classes/Book.php';
$books = new Book();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['book'], $_POST['author'], $_POST['genre'], $_POST['isbn'], $_POST['b_name'])) {
    $id = $_POST['id'];
    $book = $_POST['book'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $b_name = $_POST['b_name'];

    if ($books->updateBook($id, $book, $author, $genre, $isbn, $b_name)) {
        header("Location: book.php?message=Book updated successfully");
        exit();
    } else {
        header("Location: book.php?message=Error updating book");
        exit();
    }
}

$bookData = $books->getBookById(isset($_GET['id']) ? $_GET['id'] : null);
if ($bookData) {
    $id = $bookData['id'];
    $book = $bookData['book'];
    $author = $bookData['author'];
    $genre = $bookData['genre'];
    $isbn = $bookData['isbn'];
    $b_name = $bookData['b_name'];
} else {
    $id = '';
    $book = '';
    $author = '';
    $genre = '';
    $isbn = '';
    $b_name = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - Library Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4">Edit Book</h2>
            <form method="POST" action="edit_book.php">
                <div class="form-group">
                    <label for="bookTitle">Book</label>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <input type="text" id="bookTitle" name="book" value="<?php echo htmlspecialchars($book); ?>" placeholder="Enter name of the book" required>
                </div>
                <div class="form-group">
                    <label for="bookAuthor">Author</label>
                    <input type="text" id="bookAuthor" name="author" value="<?php echo htmlspecialchars($author); ?>" placeholder="Enter name of the author" required>
                </div>
                <div class="form-group">
                    <label for="bookGenre">Genre</label>
                    <input type="text" id="bookGenre" name="genre" value="<?php echo htmlspecialchars($genre); ?>" placeholder="Enter the book genre">
                </div>
                <div class="form-group">
                    <label for="bookIsbn">ISBN</label>
                    <input type="text" id="bookIsbn" name="isbn" value="<?php echo htmlspecialchars($isbn); ?>" placeholder="Enter ISBN">
                </div>
                <div class="form-group">
                    <label for="borrowerName">Borrower Name</label>
                    <input type="text" id="borrowerName" name="b_name" value="<?php echo htmlspecialchars($b_name); ?>" placeholder="Enter borrower name">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="book.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    <script src="../assets/js/script.js"></script>
</body>
</html>
