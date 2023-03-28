<?php
include("connection.php");

$book_id = $_GET['id'];
$sql = "SELECT * FROM books WHERE book_id = $book_id";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $author = $row['author'];
    $description = $row['description'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./pages.css">
    <title>Uredi knjigu</title>
</head>

<body>

    <div class="container mt-4 ">

        <h2 class="text-center">Uredi knjigu</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <form class="justify-content-center align-items-center mt-5" method="post" action="update_edit_books.php">
                <div class="form-group">
                    <input class="form-control" type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                    <label>Title:</label>
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="title" value="<?php echo $title; ?>"><br>
                    <label>Author:</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="author" value="<?php echo $author; ?>"><br>
                    <label>Description:</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="description"><?php echo $description; ?></textarea><br>
                    <div class="row d-flex justify-content-center align-items-center">
                        <button class="btn btn-primary mt-5 btnn" type="submit" name="submit" value="Save">Sačuvaj</button>
                    </div>
                </div>

            </form>

        </div>


    </div>
</body>

</html>