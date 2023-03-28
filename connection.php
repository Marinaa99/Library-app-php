<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "library_db";

if (!$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname)) {

    die("Failed to connect!");
}
