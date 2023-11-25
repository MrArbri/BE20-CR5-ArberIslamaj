<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../users/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: /php-my-files/BE20-CR5-ArberIslamaj/index.php");
}

require_once '../components/db_connect.php';
require_once '../components/fileUpload.php';

$options = "";

$sql = "SELECT adoption.id, users.firstName, users.lastName FROM `adoption` JOIN `users` ON adoption.fk_user = users.userID";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['id']}'>{$row['firstName']} {$row['lastName']}</option>";
}

if (isset($_POST["create"])) {
    $name = $_POST["name"];
    $fk_user = $_POST["fk_user"];
    $picture = fileUpload($_FILES["picture"], "animals", $fk_user);
    $location = $_POST["location"];
    $description = htmlspecialchars($_POST["description"]);
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccinated = $_POST["vaccinated"];
    $breed = $_POST["breed"];
    $status = $_POST["status"];
    $owner = ($_POST["fk_user"] != 0) ? $_POST["fk_user"] : 'NULL';

    $sql = "INSERT INTO `animals`(`name`, `picture`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`) 
     VALUES ('$name','$picture[0]','$location','$description','$size',$age,'$vaccinated','$breed','$status')";


    if (mysqli_query($conn, $sql)) {
        echo "
            <div class='alert alert-success' role='alert'>
                New animal created!
            </div>";

        // header('refresh: 2; url= /php-my-files/BE20-CR5-ArberIslamaj/animals/animals_dashboard.php');
    } else {
        echo "
            <div class='alert alert-danger' role='alert'>
                Something went wrong!
            </div>";
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

    <div class="container w-75 bg-warning shadow mt-5 mb-5 p-3">
        <fieldset class="">
            <h2>Add Pet</h2>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="table table-dark table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>
                                Name*
                            </th>
                            <td>
                                <input type="text" name="name" class="form-control" placeholder="Please enter the pet name" required>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Image
                            </th>
                            <td>
                                <input type="file" name="picture" class="form-control" placeholder="Please upload an image">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Location*
                            </th>
                            <td>
                                <input type="text" name="location" class="form-control" placeholder="Please enter the location" required>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Description*
                            </th>
                            <td>
                                <textarea type="text" name="description" class="form-control" placeholder="Please enter the description"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Size*
                            </th>
                            <td>
                                <select type="select" name="size" class="form-select" aria-label="Default select example" placeholder="Please select the size" required>
                                    <option value="" selected>select pet size ...</option>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Age*
                            </th>
                            <td>
                                <input class="form-control" type="text" name="age" placeholder="Please enter the age" required>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Vaccinated*
                            </th>
                            <td>
                                <input class="form-check-input" name="vaccinated" value="Yes" type="radio" required checked>
                                <label class="form-check-label" for="yesRadio">Yes</label>

                                <input class="form-check-input" name="vaccinated" value="no" type="radio" required>
                                <label class="form-check-label" for="noRadio">No</label>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Breed*
                            </th>
                            <td>
                                <input class="form-control" type="text" name="breed" placeholder="Please enter the breed" required>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Status*
                            </th>
                            <td>
                                <input class="form-check-input" name="status" value="available" type="radio" required checked>
                                <label class="form-check-label" for="availableRadio">Available</label>

                                <input class="form-check-input" name="status" value="adopted" type="radio" required>
                                <label class="form-check-label" for="adoptedRadio">Adopted</label>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Owner*
                            </th>
                            <td>
                                <select name="fk_user" class="form-control">
                                    <option value="0">Owner</option>
                                    <?= $options; ?>
                                </select>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <input type="submit" value="Create" name="create" class="btn btn-primary">

            </form>
        </fieldset>
    </div>

    <?php require_once '../components/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>