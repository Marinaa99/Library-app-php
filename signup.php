<?php

session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $user_name = $_POST['user_name'];
  $password = $_POST['password'];
  if (!empty($user_name && !empty($password))) {

    $user_id = random_num(20);
    $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
    mysqli_query($connection, $query);

    header("Location: login.php");
    die;
  } else {
    echo "Please enter information";
  }
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="./login.css">

</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4 offset-md-4 mt-5">
        <div class="card">

          <div class="card-body">
            <div class="card-header">
              <h3 class="mb-0 text-center">SINGUP</h3>
            </div>
            <form class="form" role="form" autocomplete="off" method="POST">
              <div class="mb-5"></div>
              <div class="form-group">
                <input type="text" class="form-control form-control-lg rounded-0" name="user_name" type="user_name" required="" placeholder="Username">
              </div>
              <div class="form-group">

                <input type="password" class="form-control form-control-lg rounded-0" name="password" type="password" required="" placeholder="Password">
              </div>
              <div class="mt-5 text-center">
                <div class="row btnrow">

                  <button type="submit" value="Signup" class="btn btn-lg btn-block button">SIGNUP</button>
                </div>
                <div class="row mt-3 accrow">

                  <a href="login.php">Login</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>