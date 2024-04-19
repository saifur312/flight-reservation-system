<?php

include_once __DIR__ . '../../config.php';
include "./service/Airport.php";
include "./service/Airline.php";
include "./service/Flight.php";
include "./service/Ticket.php";

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$showflights = false;

$flight = new Flight();

// if (isset($_GET['source'])) {
//   // Retrieve the data from the query string
//   $src = $_GET['source'];
//   $dst = $_GET['destination'];
//   $dep = $_GET['departure'];
//   $arv = $_GET['arrival'];

//   //echo "$src + $dst + $dep + $arv";
//   $flights = $flight->filterFlights($src, $dst, $dep, $arv);

//   if ($flights) {
//     $showflights = true;
//   }
// }


/** Save ticket details */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {

  $ticket = new Ticket();
  $ticket->bookTicket($_POST);
  //print_r($_POST);
}

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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Noto Sans', sans-serif;
      background-color: #EBF0F4;
    }

    section {
      /* position: relative;
      height: 100vh;
      background-image: url('../public/images/gozayan.png');
      background-size: cover;
      background-position: center; */

      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
    }

    /* 
    section .section-center {
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
    } */

    .navbar {
      background-color: #ffffff;
    }

    .additional {
      min-height: 100vh;
      background-color: #EBF0F4;
    }

    .additional .deals,
    .offers {
      padding-top: 5%;
      padding-bottom: 5%;
    }

    footer {
      height: 75vh;
      background-color: #1C3C6B;
      color: #ffffff;
      padding-top: 5%;
      margin-top: 5%;
    }

    footer .footer-content {
      height: 50vh;
      border-bottom: solid thin #ffffff;
    }

    footer .payment-methods {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    footer .payment-methods li {
      display: inline-block;
      margin: 0 5px 5px 0;
    }

    footer .payment-methods li img {
      max-width: 45px;
      height: auto;
      border-radius: 4%;
    }

    .filter-bar {
      min-height: 40px;
      background-color: #ffffff;
    }
  </style>

</head>

<body class="text-center">
  <section class="text-center">
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

  </section>


  <!-- Flights -->
  <div class="container justify-content-center mt-4">
    <div class="row ">
      <div class="col-lg-9">
        <h4> Review Your Booking</h4>
        <!-- Flight Details -->
        <div class="accordion accordion-flush" id="accordionFlightDetails1">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-FlightDetails1">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFlightDetails1" aria-expanded="false" aria-controls="flush-collapseFlightDetails1">
                DAC-COX
              </button>
            </h2>
            <div id="flush-collapseFlightDetails1" class="accordion-collapse collapse" aria-labelledby="flush-FlightDetails1" data-bs-parent="#accordionFlightDetails1">
              <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
            </div>
          </div>
        </div>

        <div class="accordion accordion-flush mt-4" id="accordionFlightDetails1">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-FlightDetails2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFlightDetails2" aria-expanded="false" aria-controls="flush-collapseFlightDetails2">
                Flight Details
              </button>
            </h2>
            <div id="flush-collapseFlightDetails2" class="accordion-collapse collapse" aria-labelledby="flush-FlightDetails2" data-bs-parent="#accordionFlightDetails1">
              <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
            </div>
          </div>
        </div>

        <div class="accordion accordion-flush mt-4" id="accordionTravelerDetails">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTravelerDetails">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTravelerDetails" aria-expanded="false" aria-controls="flush-collapseTravelerDetails">
                Enter Traveler Details
              </button>
            </h2>
            <div id="flush-collapseTravelerDetails" class="accordion-collapse collapse" aria-labelledby="flush-headingTravelerDetails" data-bs-parent="#accordionTravelerDetails">
              <div class="accordion-body">
                <div class="col-lg-12 text-start">
                  <form action="" method="post" class="row g-3">
                    <div class="col-md-6">
                      <label for="firstName" class="form-label">First Name</label>
                      <input type="text" class="form-control" id="firstName" name="firstName">
                    </div>
                    <div class="col-md-6">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input type="text" class="form-control" id="lastName" name="lastName">
                    </div>
                    <div class="col-md-6">
                      <label for="nationality" class="form-label">Nationality</label>
                      <input type="text" class="form-control" id="nationality" name="nationality">
                    </div>
                    <div class="col-md-6">
                      <label for="passport" class="form-label">Passport No</label>
                      <input type="text" class="form-control" id="passport" name="passport">
                    </div>
                    <div class="col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="col-md-6">
                      <label for="contact" class="form-label">Contact No</label>
                      <input type="text" class="form-control" id="contact" name="contact">
                    </div>
                    <div class="col-12">
                      <input type="submit" class="btn btn-lg btn-warning" name="confirm" value="Confirm" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card mt-4 ">
          <div class="card-header">
            Need Help
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item">Contact</li>
            <li class="list-group-item">Message</li>
            <li class="list-group-item">Email</li>
          </ul>
        </div>
      </div>
    </div>
  </div>



  <!-- footer -->
  <footer>
    <div class="container">
      <div class="row pt-4 footer-content">
        <div class="col-lg-3 text-start">
          <h6> Discover </h6>
        </div>
        <div class="col-lg-3 text-start">
          <h6> Payment Methods </h6>
          <ul class="payment-methods mt-2">
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/bkash.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/nagad.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/rocket.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/visa.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/bkash.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/nagad.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/rocket.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/visa.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/bkash.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/nagad.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/rocket.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/visa.png">
            </li>
          </ul>
        </div>
        <div class="col-lg-3 text-start">
          <h6> Need Help? </h6>
        </div>
        <div class="col-lg-3 text-start">
          <h6> Contact </h6>
        </div>
      </div>

      <div class="row mt-4 text-start">
        <a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">
          <img src="<?php echo ROOT_URL; ?>../public/images/logo.png" class="logo-brand" />
        </a>
      </div>

    </div>
  </footer>


  <!-- jquery js -->
  <script src="<?php echo ROOT_URL; ?>libs/jquery/jquery-3.7.1.js"></script>
  <!-- Popperjs -->
  <script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/popper.min.js"></script>
  <!-- Bootstrap js  -->
  <script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
  <!-- select2 js -->
  <script src="<?php echo ROOT_URL; ?>libs/select2/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>
</body>


</html>