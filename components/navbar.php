<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "
    <nav class='navbar navbar-expand-lg bg-warning border'>
      <div class='container-fluid'>

        <a class='navbar-brand fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/animals/allAnimals.php'>PETS WORLD</a>

        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup'     aria-controls='navbarNavAltMarkup'aria-expanded='false'    aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
          <div class='navbar-nav'>
          
            <a class='nav-link active fw-bold' aria-current='page' 
            href='/php-my-files/BE20-CR5-ArberIslamaj/index.php'>Home</a>
      ";
if (isset($_SESSION["user"])) {
  echo " <li class='nav-item'>
      <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/adopted.php'>My pets</a>
  </li>";
}

if (isset($_SESSION["user"]) || isset($_SESSION["adm"])) {
  echo " <li class='nav-item'>
              <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/users/logout.php'>Logout</a>
          </li>
          <li class='nav-item'>
              <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/users/update.php'>Update user</a>
          </li>
       ";
} else {
  echo "<li class='nav-item'>
              <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/users/register.php'>Register</a>
          </li>
          <li class='nav-item'>
              <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/users/login.php'>Login</a>
          </li>";
}
if (isset($_SESSION["adm"])) {
  echo "<li class='nav-item'>
              <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/animals/create.php'>Create</a>
          </li>
          <li class='nav-item'>
              <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/users/dashboard.php'>User Dashboard</a>
          </li>
          <li class='nav-item'>
              <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/animals/animals_dashboard.php'>
              Animals Dashboard</a>
          </li>";
}
echo "    <li class='nav-item'>
              <a class='nav-link active fw-bold' href='/php-my-files/BE20-CR5-ArberIslamaj/animals/seniors.php'>Seniors</a>
          </li>
          </div>
        </div>
      </div>
    </nav>
";
