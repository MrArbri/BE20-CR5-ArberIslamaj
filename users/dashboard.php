<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../users/login.php");
}

if (!isset($_SESSION["adm"])) {
    header("Location: /php-my-files/BE20-CR5-ArberIslamaj/index.php");
}

require_once '../components/db_connect.php';

$data = "";

$sql = "SELECT * FROM `users` WHERE `source` != 'adm'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data .= "
                <tr>
                    <th scope='row'>$row[userID]</th>
                    <td>$row[email]</td>
                    <td>$row[picture]</td>
                    <td><a href='/php-my-files/BE20-CR5-ArberIslamaj/users/update.php?userID=$row[userID]' class='btn btn-warning'>Update</a></td>
                </tr>
            ";
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
            <h2>User Dashboard</h2>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">email</th>
                        <th scope="col">Profile picture</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $data; ?>
                </tbody>
            </table>
        </fieldset>
    </div>

    <?php require_once '../components/footer.php' ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>