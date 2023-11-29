<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../users/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ./index.php");
}

require_once '../components/db_connect.php';

if (isset($_GET["petID"]) && !empty($_GET["petID"])) {
    $id = $_GET["petID"];

    $sql = "SELECT * FROM `animals` WHERE `petID` = $id";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    if ($row["picture"] !== "pet.png") {
        unlink("../assets/$row[picture]");
    }

    $sql = "DELETE FROM `animals` WHERE `petID` = $id";
    mysqli_query($conn, $sql);

    header("Location: ./animals/animals_dashboard.php");
} else {
    mysqli_close($conn);
    header("Location: ./index.php");
}
