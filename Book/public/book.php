<?php
include_once __DIR__ . '/../classes/Book.php';

$books = new Book();
$message = '';

if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book'], $_POST['author'], $_POST['genre'], $_POST['isbn'], $_POST['b_name'])) {
    $book = $_POST['book'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $b_name = $_POST['b_name'];

    if ($books->addBook($book, $author, $genre, $isbn, $b_name)) {
        $message = "Book added successfully!";
    } else {
        $message = "Error adding book.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Books</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1 class="text-center mb-4">Library Management System</h1>
            <p class="text-center">Book Page</p>

            <div class="nav-links">
                <a href="index.php" class="btn btn-primary">Dashboard</a>
                <a href="book.php" class="btn btn-primary">Books</a>
            </div>
        </div>

        <div class="two-col mt-4">
            <div class="card">
                <?php if ($message !== ''): ?>
                    <div class="alert"><?php echo $message; ?></div>
                <?php endif; ?>

                <h2 class="text-center mb-4">Add New Book</h2>
                <form method="POST" action="book.php" data-confirm="Submit new book record?">
                    <div class="form-group">
                        <label for="bookTitle">Book</label>
                        <input type="text" id="bookTitle" name="book" placeholder="Enter name of the book" required>
                    </div>
                    <div class="form-group">
                        <label for="bookAuthor">Author</label>
                        <input type="text" id="bookAuthor" name="author" placeholder="Enter name of the author" required>
                    </div>
                    <div class="form-group">
                        <label for="bookGenre">Genre</label>
                        <input type="text" id="bookGenre" name="genre" placeholder="Enter the book genre">
                    </div>
                    <div class="form-group">
                        <label for="bookIsbn">ISBN</label>
                        <input type="text" id="bookIsbn" name="isbn" placeholder="Enter ISBN">
                    </div>
                    <div class="form-group">
                        <label for="borrowerName">Borrower Name</label>
                        <input type="text" id="borrowerName" name="b_name" placeholder="Enter borrower name">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>

            <div class="card">
                <h2 class="text-center mb-4">Book List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>ISBN</th>
                            <th>Borrower Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $bookList = $books->getAllBooks();
                        while ($row = $bookList->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['book']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['isbn']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_name']) . "</td>";
                            echo "<td>
                                <a href='edit_book.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a> 
                                <a href='delete_book.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this book?\");'>Delete</a>
                            </td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>
