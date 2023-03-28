<?php
include 'connection.php';

$book_id = $_GET['id'];

$sql = "DELETE FROM books WHERE book_id = $book_id";
$result = $connection->query($sql);

header("Location: index.php");
exit();
