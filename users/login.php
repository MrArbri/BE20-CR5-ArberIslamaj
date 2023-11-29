<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["user"]) || (isset($_SESSION["adm"]))) {
    header("Location: ./user/login.php");
}

require_once '../components/db_connect.php';
require_once "../components/clean.php";

$emailError = "";
$passError = "";

if (isset($_POST["login"])) {
    $email = clean($_POST["email"]);
    $pass = clean($_POST["pass"]);
    $error = false;

    if (empty($email)) {
        $error = true;
        $emailError = "Email cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Email has the wrong format.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter the password.";
    }

    if (!$error) {
        $pass = hash("sha256", $pass);

        $sql = "SELECT * FROM `users` WHERE email = '$email' AND pass = '$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row["source"] === "user") {
                $_SESSION["user"] = $row["userID"];
                header("Location: ./index.php");
            } elseif ($row["source"] === "adm") {
                $_SESSION["adm"] = $row["userID"];
                header("Location: ./animals/animals_dashboard.php");
            }
        } else {
            echo "  <div class='alert alert-danger' role='alert'>
                        Wrong username or password!
                    </div>";
        }
    }
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets world</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }
    </style>

</head>

<body>
    <?php require_once '../components/navbar.php' ?>

    <div class="container w-50 bg-warning shadow mt-5 mb-5 p-3">
        <form action="" method="post">
            <fieldset class="text-center">
                <h2>Login</h2>
                <table class="table table-dark table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>
                                Email address*
                            </th>
                            <td>
                                <input type="email" name="email" class="form-control" value="<?= $email ?? ""; ?>" placeholder="Please enter your email" required>
                                <span><?= $emailError; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Password*
                            </th>
                            <td>
                                <input type="password" name="pass" class="form-control" placeholder="Please enter your password" required>
                                <span><?= $passError; ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" name="login" value="Login" class="btn btn-primary">
        </form>
        </fieldset>
    </div>

    <?php require_once '../components/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>