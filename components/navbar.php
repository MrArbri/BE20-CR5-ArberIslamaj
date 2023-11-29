<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "
    <nav class='navbar navbar-expand-lg bg-warning border'>
      <div class='container-fluid'>

        <a class='navbar-brand fw-bold' href='./animals/allAnimals.php'>PETS WORLD</a>

        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup'     aria-controls='navbarNavAltMarkup'aria-expanded='false'    aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
          <div class='navbar-nav'>
          
            <a class='nav-link active fw-bold' aria-current='page' 
            href='./index.php'>Home</a>
      ";
if (isset($_SESSION["user"])) {
  echo " <li class='nav-item'>
      <a class='nav-link active fw-bold' href='./adopted.php'>My pets</a>
  </li>";
}

if (isset($_SESSION["user"]) || isset($_SESSION["adm"])) {
  echo " <li class='nav-item'>
              <a class='nav-link active fw-bold' href='./users/logout.php'>Logout</a>
          </li>
          <li class='nav-item'>
              <a class='nav-link active fw-bold' href='./users/update.php'>Update user</a>
          </li>
       ";
} else {
  echo "<li class='nav-item'>
              <a class='nav-link active fw-bold' href='./users/register.php'>Register</a>
          </li>
          <li class='nav-item'>
              <a class='nav-link active fw-bold' href='./users/login.php'>Login</a>
          </li>";
}
if (isset($_SESSION["adm"])) {
  echo "<li class='nav-item'>
              <a class='nav-link active fw-bold' href='./animals/create.php'>Create</a>
          </li>
          <li class='nav-item'>
              <a class='nav-link active fw-bold' href='./users/dashboard.php'>User Dashboard</a>
          </li>
          <li class='nav-item'>
              <a class='nav-link active fw-bold' href='./animals/animals_dashboard.php'>
              Animals Dashboard</a>
          </li>";
}
echo "    <li class='nav-item'>
              <a class='nav-link active fw-bold' href='./animals/seniors.php'>Seniors</a>
          </li>
          </li>
          </div>
        ";

if (isset($_SESSION["user"]) || isset($_SESSION["adm"])) {

  $userId = $_SESSION["user"] ?? $_SESSION["adm"];
  $sql = "SELECT `firstName`, `picture` FROM `users` WHERE `userID` = ?";

  $statement = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($statement, "i", $userId);
  mysqli_stmt_execute($statement);

  $result = mysqli_stmt_get_result($statement);

  if ($result) {
    $row = mysqli_fetch_assoc($result);

    echo "
        <li class='nav-item ms-auto list-unstyled'>
          <span class='me-2 fw-bold'>{$row['firstName']}</span>
  
          <img src='assets/{$row['picture']}' class='card-img-top object-fit-cover' 
          style='height: 2.5rem; width: 2.5rem; border-radius: 50%' alt='User Picture'>
          
        </li>";
  }

  mysqli_stmt_close($statement);
}

echo "</div>
    </div>
  </nav>";
