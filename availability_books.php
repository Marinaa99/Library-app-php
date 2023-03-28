<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $book_id = $_POST['book_id'];
  $available = $_POST['available'];
  $borrowed = $_POST['borrowed'];

  echo "book_id: ";
  var_dump($book_id);
  echo "available: ";
  var_dump($available);
  echo "borrowed: ";
  var_dump($borrowed);
  $sql = "UPDATE books SET available = '$available', borrowed = '$borrowed' WHERE book_id = '$book_id'";

  echo "sql: ";
  var_dump($sql);

  if (!$connection->query($sql)) {
    echo "Error updating record: " . $connection->error;
  }
  echo 'Data updated';
  exit;
}
