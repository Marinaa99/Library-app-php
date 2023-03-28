<?php


include("connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = $_POST["title"];
	$author = $_POST["author"];
	$description = $_POST["description"];

	if (empty($title) || empty($author)) {
		echo "Title and Author fields are required.";
		exit();
	}

	$sql = "INSERT INTO books (title, author, description, available) VALUES ('$title', '$author', '$description', 'Dostupno')";

	if ($connection->query($sql) === TRUE) {
		header("Location: index.php");
		exit();
	} else {
		echo "Error: " . $sql . "<br>" . $connection->error;
	}
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>Dodaj novu knjigu</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="./pages.css">


</head>

<body>
	<div class="container mt-4 ">
		<h2 class="text-center">Dodaj novu knjigu</h2>
		<div class="row d-flex justify-content-center align-items-center">

			<form class="justify-content-center align-items-center mt-5" action="add_books.php" method="post">
				<div class="form-group">
					<label for="title">Naslov:</label>
					<input type="text" class="form-control" id="title" name="title">
				</div>
				<div class="form-group">
					<label for="author">Autor:</label>
					<input type="text" class="form-control" id="author" name="author">
				</div>
				<div class="form-group">
					<label for="description">Opis:</label>
					<textarea class="form-control" id="description" name="description" rows="5"></textarea>
				</div>
				<div class="row d-flex justify-content-center align-items-center">
					<button type="submit" class="btn btn-primary mt-5 btnn">Dodaj</button>
				</div>
			</form>
		</div>
</body>

</html>