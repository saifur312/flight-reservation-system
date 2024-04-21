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
$userId = Session::get('id');

/* declare root_url as var to use it inside heredoc syntax; */
$root_url = ROOT_URL;
?>



<!-- navbar -->

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

        <?php
        if ($login) {
          if ($username == 'admin') {
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
                  HTML;
          } else {
            echo <<<HTML
                    <li class="nav-item">
                      <a class="nav-link" href="{$root_url}mybookings.php">My Bookings</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{$root_url}mytickets.php">My Tickets</a>
                    </li>
                  HTML;
          }
        }
        ?>
      </ul>

      <ul class="navbar-nav mb-2 mb-lg-0 d-flex">
        <?php
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
    </div>
  </div>
</nav>




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