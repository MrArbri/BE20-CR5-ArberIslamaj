<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$pass = "";
$dbName = "BE20_CR5_animal_adoption_ArberIslamaj";

$conn = mysqli_connect($host, $user, $pass, $dbName);

if (!$conn) {
    die("Connection failed");
}
