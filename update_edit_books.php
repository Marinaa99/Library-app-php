<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $book_id = $_POST['book_id'];
  $title = $_POST['title'];
  $author = $_POST['author'];
  $description = $_POST['description'];

  $stmt = $connection->prepare("UPDATE books SET title=?, author=?, description=? WHERE book_id=?");

  $stmt->bind_param("sssi", $title, $author, $description, $book_id);

  if ($stmt->execute()) {
    header("Location: index.php?");
    exit();
  } else {
    header("Location: edit_book.php?id=$book_id&error=Error updating book. Please try again.");
    exit();
  }
} else {
  header("Location: index.php");
  exit();
}
