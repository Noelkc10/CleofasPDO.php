<?php
// Database connection settings
$host = 'localhost'; // Database host
$db = 'library'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Task 1: Insert a new book
    $stmt = $pdo->prepare("INSERT INTO books (title, author, published_year, genre) VALUES (:title, :author, :published_year, :genre)");
    $stmt->execute([
        ':title' => 'The Great Gatsby',
        ':author' => 'F. Scott Fitzgerald',
        ':published_year' => 1925,
        ':genre' => 'Novel'
    ]);

    // Task 2: Retrieve all books
    $stmt = $pdo->query("SELECT * FROM books");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Books in the library:\n";
    foreach ($books as $book) {
        echo "ID: {$book['id']}, Title: {$book['title']}, Author: {$book['author']}, Year: {$book['published_year']}, Genre: {$book['genre']}\n";
    }

    // Task 3: Update a book's details
    $stmt = $pdo->prepare("UPDATE books SET title = :title WHERE id = :id");
    $stmt->execute([
        ':title' => 'The Great Gatsby - Updated',
        ':id' => 1 // Assuming you want to update the book with ID 1
    ]);

    // Task 4: Delete a book
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
    $stmt->execute([':id' => 1]); // Assuming you want to delete the book with ID 1

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
