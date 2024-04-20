<?php

include_once __DIR__ . '../../../config.php';
include_once __DIR__ . '/../service/Session.php';
Session::init();

/* session logout */
if (isset($_GET['action']) && $_GET['action'] == "logout") {
  Session::destroy();
}

/*  get login info and username */
$login = Session::get('login');
$username = Session::get('username');

/* declare root_url as var to use it inside heredoc syntax; */
$root_url = ROOT_URL;
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flight Reservation System</title>

  <!-- Bootstrap css  -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- select2 css -->
  <link href="<?php echo ROOT_URL; ?>libs/select2/select2.min.css" rel="stylesheet" />
  <!-- our customized style -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>inc/custom-style.css">


</head>

<body class="container text-center">
  <!-- <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">
        <img src="<?php echo ROOT_URL; ?>../public/images/logo.png" class="logo-brand" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo ROOT_URL; ?>index.php">Home</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo ROOT_URL; ?>auth/signup.php">signup</a>
          </li> -->
  <?php
  if ($login) {
    echo <<<HTML
              <li class="nav-item">
                <a class="nav-link" href="{$root_url}auth/users.php">users</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{$root_url}setup/airport/airports.php">airport</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{$root_url}setup/airline/airlines.php">airline</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{$root_url}setup/flight/flights.php">Flights</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{$root_url}setup/ticket/tickets.php">Tickets</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{$root_url}index2.php">New Page</a>
              </li>
            HTML;
  }
  ?>

  <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
  </ul>

  <ul class="navbar-nav mb-2 mb-lg-0 d-flex">
    <?php
    //echo $username;
    if ($login) {
      echo <<<HTML
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' role='button' id='navbarDropdown' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><b> $username </b> </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <span class='dropdown-item'>
                    <a class='btn btn-outline-danger' href='?action=logout'>logout</a>
                  </span>
                </div>
              </li>
            HTML;

      // echo "<li class='nav-item'>
      // <a class='btn btn-outline-danger' href='?action=logout'>logout</a></li>";
    } else {
      echo <<<HTML
              <li class="nav-item">
                <a class="nav-link" href="{$root_url}auth/signup.php">
                  <button class="btn btn-outline-primary" type="button">
                    Sign up
                  </button>
                </a>
              </li>
            HTML;

      echo "
            <li class='nav-item'> 
              <a class='nav-link' 
                href=" . ROOT_URL . "auth/login.php>
                  <button class='btn btn-outline-success' type='button'>
                    Login
                  </button> 
              </a>
            </li>";
    }
    ?>
  </ul>

  <!-- <span class="d-flex">
          <?php
          $username = Session::get('username');
          //echo $username;
          if ($username) {
            echo "$username.<a class='btn btn-outline-danger' href='?action=logout'>logout</a>";
          } else {
            echo "<a class='btn btn-outline-success' href=" . ROOT_URL . "auth/login.php>login</a>";
          }
          ?>
        </span> -->

  <!-- <form class="d-flex" role="search">
        </form> -->
  </div>
  </div>
  </nav> -->

  <!-- navbar -->
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg ">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">
          <img src="<?php echo ROOT_URL; ?>../public/images/logo.png" class="logo-brand" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo ROOT_URL; ?>index.php">Home</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>


  <!-- root 


  |--src
  |--auth
  |--db
  |--inc 
    |--header.php
  |--libs
    |--bootstrap-5.3.3-dist
      |--css
        |--boostrap.css
  |--service 
    |--Session.php
|-index.php -->