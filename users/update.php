<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: /index.php");
    die();
}

if (isset($_SESSION["adm"])) {
    $id = $_GET["userID"] ?? $_SESSION["adm"];
} else {
    $id = $_SESSION["user"];
}

require_once '../components/db_connect.php';
require_once '../components/clean.php';
require_once '../components/fileUpload.php';

$emailError = "";
$passError = "";

$sql = "SELECT * FROM `users` WHERE userID = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    $firstName = clean($_POST["firstName"]);
    $lastName = clean($_POST["lastName"]);
    $address = clean($_POST["address"]);
    $phone = clean($_POST["phone"]);
    $email = clean($_POST["email"]);
    $pass = clean($_POST["pass"]);
    $picture = fileUpload($_FILES["picture"]);

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
        $passError = "Password cannot be empty.";
    } elseif (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must be at least 6 chars long.";
    }


    if ($error === false) {
        $pass = hash("sha256", $pass);

        if ($_FILES["picture"]["error"] == 4) {
            if ($row["picture"] !== "avatar.png") {
                unlink("../assets/$row[picture]");
            }
            $sql = "UPDATE `users` SET `firstName`='$firstName', `lastName`='$lastName', `address`='$address', `phone`='$phone', `email`='$email',`pass`='$pass', `picture`='$picture[0]' WHERE userID = $id";
        } else {
            $sql = "UPDATE `users` SET `firstName`='$firstName', `lastName`='$lastName', `address`='$address', `phone`='$phone', `email`='$email',`pass`='$pass' WHERE userID = $id";
        }

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "
            <div class='alert alert-success' role='alert'>
                User updated!
            </div>";
            header('refresh: 2; url= /php-my-files/BE20-CR5-ArberIslamaj/index.php');
        } else {
            echo "
                <div class='alert alert-danger' role='alert'>
                    Something went wrong!
                </div>";
        }
    }
}
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

    <div class="container w-75 bg-warning shadow mt-5 mb-5 p-3">
        <fieldset class="text-center">
            <h2>Update</h2>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="table table-dark table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>
                                First name*
                            </th>
                            <td>
                                <input type="text" name="firstName" value="<?= $row['firstName'] ?>" class="form-control" placeholder="Please enter your first name" required>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Last name*

                            </th>
                            <td>
                                <input type="text" name="lastName" value="<?= $row['lastName'] ?>" class="form-control" placeholder="Please enter your last name">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Address*
                            </th>
                            <td>
                                <input type="text" name="address" value="<?= $row['address'] ?>" class="form-control" placeholder="Please enter your address" required>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Phone*
                            </th>
                            <td>
                                <input type="text" name="phone" value="<?= $row['phone'] ?>" class="form-control" placeholder="Please enter your phone number"></input>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                email*
                            </th>
                            <td>
                                <input type="email" name="email" class="form-control" placeholder="Please enter your email" value="<?= $row["email"] ?? ""; ?>" required>
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

                        <tr>
                            <th>
                                Picture
                            </th>
                            <td>
                                <label class="form-label">
                                    <input type="file" name="picture" class="form-control">
                                </label>

                            </td>
                        </tr>

                    </tbody>
                </table>

                <input type="submit" name="update" value="Update" class="btn btn-primary">

            </form>
        </fieldset>
    </div>

    <?php require_once '../components/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>