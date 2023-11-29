<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

unset($_SESSION["user"]);
unset($_SESSION["adm"]);

session_unset();
session_destroy();

header("Location: ./users/login.php");
