<?php

include_once __DIR__ . '../../config.php';

include_once "./inc/header.php";

include_once "./service/Airport.php";
include_once "./service/Airline.php";
include_once "./service/Flight.php";
include_once "./service/Ticket.php";
include_once "./service/Session.php";
include_once "./service/User.php";
include_once "./service/Passenger.php";

// login
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  //echo "Yaaah login posted";
  $userLogin = $user->userLogin($_POST);
  // if ($userLogin) {
  //   header("Location: booking.php");
  // }
}



$showflights = false;

//fetch flight Id
if (isset($_GET['id'])) {
  $flightID = $_GET['id'];
  //echo "Flight Id $flightID";
  $f = new Flight();
  $flight = $f->fetchFlight($flightID)->fetch_assoc();
  // print_r($flight);
}

/** Save passenger and booking details */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmBooking'])) {

  // print_r($_POST);
  // $_POST["passengerId"] = 1000;
  // print_r($_POST);

  $passenger = new Passenger();
  $savedData = $passenger->savePassenger($_POST);
  if ($savedData) {
    //print_r($savedData);
    echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Ticket booked successful..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    header("refresh:3; url=mybooking.php");
    exit();
  } else {
    echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Fail to book tikect..!! Plz fill up all fields carefully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
  }
}

?>


<body class="text-center">
  <section class="text-center">
    <!-- navbar -->
    <div id="navbar" class="container-fluid">
      <?php include "./inc/navbar.php"; ?>
    </div>

  </section>


  <!-- Flights -->
  <div class="container justify-content-center mt-4">
    <div class="row mb-4">
      <div class="col-lg-9">
        <h4> Review Your Booking</h4>
        <!-- Flight Details -->
        <div class="accordion accordion-flush" id="accordionFlightDetails1">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-FlightDetails1">
              <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFlightDetails1" aria-expanded="true" aria-controls="flush-collapseFlightDetails1">
                DAC-COX
              </button>
            </h2>
            <div id="flush-collapseFlightDetails1" class="accordion-collapse collapse show" aria-labelledby="flush-FlightDetails1" data-bs-parent="#accordionFlightDetails1">
              <div class="accordion-body">Flight Details</div>
            </div>
          </div>
        </div>

        <div class="accordion accordion-flush mt-4" id="accordionFlightDetails1">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-FlightDetails2">
              <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFlightDetails2" aria-expanded="true" aria-controls="flush-collapseFlightDetails2">
                Flight Details
              </button>
            </h2>
            <div id="flush-collapseFlightDetails2" class="accordion-collapse collapse show" aria-labelledby="flush-FlightDetails2" data-bs-parent="#accordionFlightDetails1">
              <div class="accordion-body">Flight Details</div>
            </div>
          </div>
        </div>

        <div class="accordion accordion-flush mt-4" id="accordionTravelerDetails">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTravelerDetails">
              <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTravelerDetails" aria-expanded="true" aria-controls="flush-collapseTravelerDetails">
                Enter Traveler Details
              </button>
            </h2>
            <div id="flush-collapseTravelerDetails" class="accordion-collapse collapse show" aria-labelledby="flush-headingTravelerDetails" data-bs-parent="#accordionTravelerDetails">
              <div class="accordion-body">
                <div class="col-lg-12 text-start">
                  <form action="" method="post" class="row g-3">

                    <input type="hidden" class="form-control" id="userId" name="userId" value="<?php echo $userId ?>" required>

                    <input type="hidden" class="form-control" id="flightId" name="flightId" value="<?php echo $flight['id'] ?>" required>

                    <div class="col-md-6">
                      <label for="firstName" class="form-label">First Name</label>
                      <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="col-md-6">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="col-md-6">
                      <label for="nationality" class="form-label">Nationality</label>
                      <input type="text" class="form-control" id="nationality" name="nationality" required>
                    </div>
                    <div class="col-md-6">
                      <label for="passport" class="form-label">Passport No</label>
                      <input type="text" class="form-control" id="passport" name="passport" required>
                    </div>
                    <div class="col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-6">
                      <label for="contact" class="form-label">Contact No</label>
                      <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>

                    <div class="col-md-12">
                      <div class="row justify-content-center mt-2">
                        <div class="col-1 text-start">
                          <label for="adult" class="col-form-label-sm">Adult(s)</label>
                        </div>
                        <div class="col-2 text-start">
                          <input type="number" min="1" name="adult" class="form-control form-control-sm" value="1">
                        </div>
                        <div class="col-1 text-start">
                          <label for="child" class="col-form-label-sm">Child(s)</label>
                        </div>
                        <div class="col-2 text-start">
                          <input type="number" name="child" class="form-control form-control-sm" value="0">
                        </div>
                        <div class="col-1 text-start">
                          <label for="class" class="col-form-label-sm">Class</label>
                        </div>
                        <div class="col-2 text-start">
                          <select class="form-select form-select-sm " aria-label=".form-select-sm" name="class" required>
                            <option value="First Class">First Class</option>
                            <option value="Economy" selected>Economy</option>
                            <option value="Business">Business</option>
                          </select>
                        </div>
                        <div class="col-1 text-start">
                          <label for="amount" class="col-form-label-sm"> Amount</label>
                        </div>
                        <div class="col-2 text-start">
                          <input type="number" name="amount" class="form-control form-control-sm" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <?php
                      if ($login) {
                        //echo $username;
                        echo <<<HTML
                              <input type="submit" class="btn btn-lg btn-warning" name="confirmBooking" value="Confirm Booking" />
                            HTML;
                      } else {
                        echo <<<HTML
                              <a href="#" class="btn btn-warning col-lg-8" data-bs-toggle="modal" data-bs-target="#exampleModal">Login to Continue</a>
                            HTML;
                      }
                      ?>
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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <img src="<?php echo ROOT_URL; ?>../public/images/logo.png" width="100px" height="80px">
          </h5>
          <h4>Login to Book Ticket</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post" class="row g-3">
            <div class="col-md-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-12">
              <input type="submit" class="btn btn-lg btn-warning" name="login" value="Login" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php include "./inc/footer.php"; ?>

</body>


</html>