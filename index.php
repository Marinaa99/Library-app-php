<?php

session_start();
include("connection.php");
include("functions.php");


$user = login_exists($connection);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lista knjiga</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./pages.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mt-2">LISTA KNJIGA</h1>
                <a href="add_books.php" class="btn btn-primary mt-5">Dodaj novu knjigu</a>
                <div class="row">
                    <div class="col-md-6 mb-3">

                        <label for="search-input" class="form-label"></label>

                        <input type="text" class="form-control input" id="search-input" placeholder="Unesi pojam za pretragu">

                    </div>
                </div>

                <?php

                $sortable_columns = array('title');

                $sort_column = isset($_GET['sort_column']) && in_array($_GET['sort_column'], $sortable_columns) ? $_GET['sort_column'] : 'title';
                $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

                $asc_link = "?column=$sort_column&order=asc";
                $desc_link = "?column=$sort_column&order=desc";



                $sql = "SELECT * FROM books  ORDER BY $sort_column $sort_order";
                $result = $connection->query($sql);

                $search_term = isset($_GET['search']) ? $_GET['search'] : '';
                if ($search_term) {
                    $sql .= " WHERE title LIKE '%$search_term%' OR author LIKE '%$search_term%'";
                }

                if ($result->num_rows > 0) {
                    echo "<table class='table'>";
                    echo "<thead class='thead-dark'>
               <tr>
                   <th><a href='$asc_link'>Naslov &#x25B2;</a><a href='$desc_link'> &#x25BC;</a></th>
                   <th>Autor</th>
                   <th>Opis</th>
                   <th>Dostupnost</th>
                   <th>Akcije</th>
               </tr>
             </thead>";
                    echo "<tbody>";


                    while ($row = $result->fetch_assoc()) {
                        $checked_available = $row['available'] ? 'checked' : '';
                        $checked_borrowed = $row['borrowed'] ? 'checked' : '';
                        echo "<tr class='book-row'>
                <td>" . $row["title"] . "</td>
                <td>" . $row["author"] . "</td>
                <td>" . $row["description"] . "</td>
                <td>
                <form class='available-form'>
                <label>
                  <input type='radio' name='availability_" . $row['book_id'] . "' value='available' " . $checked_available . " data-book-id='" . $row['book_id'] . "'> Dostupno
                </label>
                <br>
                <label>
                  <input type='radio' name='availability_" . $row['book_id'] . "' value='borrowed' " . $checked_borrowed . " data-book-id='" . $row['book_id'] . "'> Posuđeno
                </label>
              </form>
                </td>
                <td>
                  <a href='edit_books.php?id=" . $row["book_id"] . "' class='btn btn-primary btn-sm'>Uredi</a>
                  <a href='delete_books.php?id=" . $row["book_id"] . "' class='btn btn-danger btn-sm'>Obriši</a>
                </td>
              </tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
                ?>
            </div>
            <script>
                $(document).ready(function() {
                    $('.available-form input[type="radio"]').change(function(event) {
                        event.preventDefault();
                        var book_id = $(this).data('book-id');
                        var available = $('input[name="availability_' + book_id + '"][value="available"]').is(':checked') ? 1 : 0;
                        var borrowed = $('input[name="availability_' + book_id + '"][value="borrowed"]').is(':checked') ? 1 : 0;
                        $.ajax({
                            type: "POST",
                            url: "availability_books.php",
                            data: {
                                book_id: book_id,
                                available: available,
                                borrowed: borrowed
                            },
                            success: function(data) {
                                console.log("Data updated: " + data);
                            },
                            error: function() {
                                console.log("tttt")
                            },
                            timeout: 5000
                        });
                    });
                });

                $(document).ready(function() {
                    $('#search-input').keyup(function() {
                        var searchText = $(this).val().toLowerCase();
                        $('.book-row').each(function() {
                            var title = $(this).find('td:first').text().toLowerCase();
                            var author = $(this).find('td:nth-child(2)').text().toLowerCase();
                            if (title.indexOf(searchText) != -1 || author.indexOf(searchText) != -1) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    });
                });
            </script>



</body>

</html>