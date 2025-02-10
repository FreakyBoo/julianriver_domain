<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
$host = "localhost";
$user = "julian";
$password = "Julian2007!";
$database = "nettbutikk";
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Tilkobling mislyktes: " . mysqli_connect_error());
}
?>