<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../components/db_connect.php';

$cards = "";

if (isset($_GET["petID"]) && !empty($_GET["petID"])) {
    $petID = $_GET["petID"];
    $sql = "SELECT * FROM `animals` LEFT JOIN `adoption` ON animals.petID = adoption.fk_user WHERE `petID` = $petID";

    $result = mysqli_query($conn, $sql);

    $cards = "";

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $status = ($row["fk_user"] !== NULL) ? "Adopted" : "Available";

            $cards .= "
        <div id='background' class='container'>
            <div class='card mb-3' style='max-width: 540px;'>
                <div class='row g-0'>
                    <div class='col-md-4'>
                        <img src='../assets/{$row["picture"]}' class='img-fluid rounded-start' alt='Pet'>
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row["name"]}</h5>
                            <p class='card-text'>Age: {$row["age"]} years old</p>
                            <p class='card-text'>Location: {$row["location"]}</p>
                            <p class='card-text'>Size: {$row["size"]}</p>
                            <p class='card-text'>Vaccinated: {$row["vaccinated"]}</p>
                            <p class='card-text'>Breed: {$row["breed"]}</p>
                            <p class='card-text'>Status: $status</p>
                            <p class='card-text'>Description: {$row["description"]}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        } else {
            $cards = "No data found for petID: $petID";
        }
    } else {
        $cards = "Error executing the query.";
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

        #background {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <?php require_once '../components/navbar.php' ?>

    <div class="container bg-warning shadow mt-5 pt-5 pb-4">
        <?= $cards ?>
    </div>


    <?php require_once '../components/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>