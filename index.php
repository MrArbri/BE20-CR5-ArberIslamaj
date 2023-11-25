<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'components/db_connect.php';

if (isset($_SESSION["user"]) && isset($_POST["adopt"])) {
    $date = date("y-m-d");
    $sql = "INSERT INTO `adoption`(`fk_user`, `fk_animal`, `date`) 
    VALUES ($_SESSION[user],$_POST[pet],'$date')";
    if (mysqli_query($conn, $sql)) {
        echo "
        <div class='alert alert-success' role='alert'>
        Congratulations pet adopted successfully!
        </div>";
    } else {
        echo "
        <div class='alert alert-danger' role='alert'>
        Pet not adopted!
        </div>";
    }
}

$sql = "SELECT * FROM `animals` LEFT JOIN `adoption` ON fk_user = petID WHERE petID NOT IN (SELECT fk_animal FROM `adoption`)";
$result = mysqli_query($conn, $sql);

$cards = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // $status = ($row["fk_user"] !== NULL) ? "Adopted" : "Available";
        $cards .= "
        <div class='p-2 pb-5'>
            <div class='container'>
                <div class='card' style='
                    position: relative;
                    margin: 0 auto;
                    border: none;
                    box-shadow: 0 1.5rem 3rem rgba(0, 0, 0, 0.5);
                    display: flex;
                    flex-wrap: wrap;
                    flex-direction: row;
                    border-radius: 0;'>
                    <img src='../assets/$row[picture]' class='card-img-top object-fit-cover' style='height: 12rem' alt='Pet'>
                    <div class='card-body'>
                        <h5 class='card-title'>$row[name]</h5>
                        <p class='card-text'>Age: $row[age] years old</p>
                        <p class='card-text'>Status: $row[status] </p>
                        <a href='animals/details.php?petID=$row[petID]' class='btn btn-primary'>Details</a>";

        if (isset($_SESSION["user"])) {
            $cards .= "
                        <form action='' method='post'>
                            <input type='hidden' name='pet' value='$row[petID]'>
                            <input class='btn btn-warning' type='submit' value='Adopt' name='adopt'>
                        </form>
                         ";
        }

        $cards .= "</div>
                </div>
            </div>
        </div>
        ";
    }
} else {
    $cards = "No data found.";
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
    <?php require_once 'components/navbar.php' ?>

    <div class="container pt-5">
        <div class="row row-cols-1 row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
            <?= $cards ?>
        </div>
    </div>

    <?php require_once 'components/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>