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
$passenger = new Passenger();

$savedPassengers = $passenger->fetchPassengers();


// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
//   //echo "Yaaah login posted";
//   $userLogin = $user->userLogin($_POST);
//   // if ($userLogin) {
//   //   header("Location: booking.php");
//   // }
// }

$loginMessage = null;  // Initialize the login message
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $userLogin = $user->userLogin($_POST);
  // if ($userLogin) {
  //   header("Location: booking.php");
  //   exit;
  // } else {
  //   $loginMessage = "Invalid username or password.";
  // }
  if($userLogin == null)
    $loginMessage = "Invalid username or password.";

}



$ap = new Airport();
//$airports = $ap->fetchAirports();

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

  //print_r($_POST);
  // $_POST["passengerId"] = 1000;
  // print_r($_POST);

  //$passenger = new Passenger();
  $savedData = $passenger->savePassenger($_POST);
  if ($savedData) {
    //print_r($savedData);
    echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Ticket booked successful..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    header("refresh:1; url=mybookings.php");
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

<style>
  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #000;
    background-color: #b0caf1;
  }

  .nav-pills .nav-link {
    border-radius: 0;
  }
</style>


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
                <?php
                echo $ap->getCode($flight['source']);
                echo " - ";
                echo $ap->getCode($flight['destination']);
                ?>
              </button>
            </h2>
            <div id="flush-collapseFlightDetails1" class="accordion-collapse collapse show" aria-labelledby="flush-FlightDetails1" data-bs-parent="#accordionFlightDetails1">
              <div class="accordion-body">

                <div class="row align-items-center">
                  <div class="col-lg-8">
                    <div class="row text-start align-items-center">
                      <div class="col-lg-3">
                        <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="80%" />
                      </div>
                      <div class="col-lg-8">
                        <p>
                          <?php
                          echo $flight['airline'];
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 text-end">
                    <p>Economy</p>
                  </div>
                </div>

                <hr />

                <div class="row ">
                  <div class="col-lg-5 text-start">
                    <p>
                      <?php
                      echo date('h:i A', strtotime($flight['departure']));
                      echo "<br/>";
                      echo date('l, d M, Y', strtotime($flight['departure']));
                      echo "<br/>";
                      echo $ap->getCode($flight['source']);
                      ?>
                    </p>
                  </div>
                  <div class="col-lg-2">
                    <img src="../public/images/arrow-right.svg" style="width: 100px; height: 40%; opacity: .5" alt="Right Arrow">
                    <p>
                      <?php
                      $duration = $flight['duration'];
                      // Calculate days, hours, and minutes
                      $days = intdiv($duration, 24 * 60);
                      $hours = intdiv($duration % (24 * 60), 60);
                      $minutes = $duration % 60;

                      echo $days . "d " . $hours . "h " . $minutes . "m";
                      ?>
                    </p>


                  </div>
                  <div class="col-lg-5 text-end">
                    <p>
                      <?php
                      echo date('h:i A', strtotime($flight['arrival']));
                      echo "<br/>";
                      echo date('l, d M, Y', strtotime($flight['arrival']));
                      echo "<br/>";
                      echo $ap->getCode($flight['destination']);
                      ?>
                    </p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="accordion accordion-flush mt-4" id="accordionFlightDetails2">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-FlightDetails2">
              <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFlightDetails2" aria-expanded="true" aria-controls="flush-collapseFlightDetails2">
                Flight Details
              </button>
            </h2>
            <div id="flush-collapseFlightDetails2" class="accordion-collapse collapse show" aria-labelledby="flush-FlightDetails2" data-bs-parent="#accordionFlightDetails2">
              <div class="accordion-body">
                <div class="col-lg-12">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-baggage-tab" data-bs-toggle="pill" data-bs-target="#pills-baggage" type="button" role="tab" aria-controls="pills-baggage" aria-selected="true">Baggage</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-fare-tab" data-bs-toggle="pill" data-bs-target="#pills-fare" type="button" role="tab" aria-controls="pills-fare" aria-selected="false">Fare</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-policy-tab" data-bs-toggle="pill" data-bs-target="#pills-policy" type="button" role="tab" aria-controls="pills-policy" aria-selected="false">Policy</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-baggage" role="tabpanel" aria-labelledby="pills-baggage-tab" tabindex="0">
                      <table class="col-lg-12 table table-borderless text-start">
                        <tr>
                          <th> Flight</th>
                          <th> Cabin</th>
                          <th> Check-in</th>
                        </tr>
                        <tr>
                          <td>
                            <p>
                              <?php
                              echo $ap->getCode($flight['source']);
                              echo " - ";
                              echo $ap->getCode($flight['destination']);
                              ?>
                            </p>
                          </td>
                          <td> 7 kg</td>
                          <td> 20 kg</td>
                        </tr>
                      </table>

                    </div>

                    <div class="tab-pane fade" id="pills-fare" role="tabpanel" aria-labelledby="pills-fare-tab" tabindex="0">
                      <table class="col-lg-12 table table-borderless text-start">
                        <tr>
                          <th> Fare Summary</th>
                          <th> Base Fare</th>
                          <th> Tax</th>
                        </tr>
                        <tr>
                          <td> Adult X 1 </td>
                          <td>
                            <?php
                            echo $flight['price'];
                            ?>
                          </td>
                          <td>
                            <?php
                            echo $flight['price'] * 0.1;
                            /** 10% tax */
                            ?>
                          </td>
                        </tr>
                      </table>
                    </div>

                    <div class="tab-pane fade" id="pills-policy" role="tabpanel" aria-labelledby="pills-policy-tab" tabindex="0">
                      <div class="d-block p-2 bg-info text-white">
                        <?php
                        echo $ap->getCode($flight['source']);
                        echo " - ";
                        echo $ap->getCode($flight['destination']);
                        ?>
                      </div>
                      <div class='row text-start mt-4'>
                        <p>Tax & Amount</p>
                        <hr />
                        <p> Tax = 10% of Base Fair </p>
                        <p> Total Amount = Base Amount + Tax</p>
                        <p> Cancellation</p>
                        <hr />
                        <p> Cancellation Fee = Airline's Fee + ARS Fee
                          Refund Amount = Paid Amount - Cancellation Fee</p>
                      </div>



                    </div>
                  </div>
                </div>
              </div>
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

                <div class="row col-lg-12 text-start mt-2 mb-4">
                  <div class="col-4 text-start">
                    <label for="source" class="col-form-label">Select from saved Passengers </label>
                  </div>
                  <div class="col-6 text-start">
                    <select class="form-select form-select-lg mb-3 select2" aria-label=".form-select-lg" name="passengers" onchange="fillPassengerData()" required>
                      <option>Select One</option>
                      <?php
                      if ($savedPassengers) {
                        while ($passenger = $savedPassengers->fetch_assoc()) {
                          echo <<<HTML
                            <option 
                              value="{$passenger['id']}"
                              data-passengerId="{$passenger['id']}"
                              data-firstname="{$passenger['first_name']}"
                              data-lastname="{$passenger['last_name']}"
                              data-passport="{$passenger['passport']}"
                              data-nationality="{$passenger['nationality']}"
                              data-email="{$passenger['email']}"
                              data-contact="{$passenger['contact']}"
                            >
                              {$passenger['first_name']} {$passenger['last_name']} - {$passenger['passport']}
                            </option>
                          HTML;
                        }
                      }
                      ?>
                    </select>

                  </div>
                </div>

                <div class="col-lg-12 text-start">
                  <form action="" method="post" class="row g-3">

                    <input type="hidden" class="form-control" id="userId" name="userId" value="<?php echo $userId ?>" required>
                    <input type="hidden" class="form-control" id="flightId" name="flightId" value="<?php echo $flight['id'] ?>" required>
                    <input type="hidden" class="form-control" id="passengerId" name="passengerId" required>
                    <div class="col-md-12" >
                      <label for="firstName" class="form-label">First Name</label>
                      <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
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
                              <!-- <a href="#" class="btn btn-warning col-lg-8" data-bs-toggle="modal" data-bs-target="#loginModal">Login to Continue</a> -->
                              <a href="#" class="btn btn-warning col-lg-8" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="storeFormData()">Login to Continue</a>

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
        <div class="col-lg-12" style="background-color: #ffffff; padding: 12px;">
          <div id="timer" class="text-start" style="background-color: #ECF3FE; padding-left: 16px;">
            <i class="bi bi-clock-fill h2"></i>
            <span class="fs-1" id="time" style="padding-left: 16px;">
              15:00
            </span>
            <p style="padding-left: 70px; margin: 0px;"> min sec </p>
          </div>
        </div>

        <div class="card mt-4 ">
          <div class="card-header text-start">
            <div class="row text-start align-items-center">
              <div class="col-lg-3">
                <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="80%" />
              </div>
              <div class="col-lg-8">
                Flight
                <h6>
                  <?php
                  echo $ap->getCode($flight['source']);
                  echo " - ";
                  echo $ap->getCode($flight['destination']);
                  ?>
                </h6>
              </div>
            </div>
          </div>


          <div class="accordion accordion-flush mt-4" id="accordionFareSummary">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingFareSummary">
                <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFareSummary" aria-expanded="true" aria-controls="flush-collapseFareSummary">
                  Fare Summary
                </button>
              </h2>
              <div id="flush-collapseFareSummary" class="accordion-collapse collapse show" aria-labelledby="flush-headingFareSummary" data-bs-parent="#accordionFareSummarys">
                <div class="accordion-body">
                  <div class="col-lg-12 text-start">
                    <table class="col-lg-12 table table-borderless">
                      <tr>
                        <th> Summary</th>
                        <th> Fare</th>
                        <th> Tax</th>
                      </tr>
                      <tr>
                        <td> Adult X 1 </td>
                        <td>
                          <?php
                          echo $flight['price'];
                          ?>
                        </td>
                        <td>
                          <?php
                          echo $flight['price'] * 0.1;
                          /** 10% tax */
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">
            <img src="<?php echo ROOT_URL; ?>../public/images/logo.png" width="100px" height="80px">
          </h5>
          <h4>Login to Book Ticket</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if ($loginMessage != null): ?>
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
              <?php echo $loginMessage; ?>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          <?php endif; ?>
        
          <form action="" method="post" class="row g-3">
            <div class="col-md-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control" id="password" name="password">
            </div>
            <div class="col-12">
              <input type="submit" class="btn btn-lg btn-warning" name="login" value="Login" />
                      
              <input type="submit" class="btn btn-lg btn-primary" name="signup" value="signup" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!--Timeout Modal -->
  <div class="modal fade" id="timeoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0E70A4; color: #ffffff">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            Session Expired
          </h1>
        </div>
        <div class="modal-body text-center">
          <h4><i class="bi bi-alarm-fill" style="font-size: 25px; color: navy;"></i></h4>
          <h3> Sorry, your session has expired</h3>
          <a href="index.php" class="btn btn-lg btn-primary mt-3">Search Again</a>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php include "./inc/footer.php"; ?>
  <script>
    function fillPassengerData() {
      var select = document.querySelector('[name="passengers"]');
      var selectedOption = select.options[select.selectedIndex];
      
      // Get data attributes from the selected option
      var passengerId = selectedOption.getAttribute('data-passengerId');
      var firstName = selectedOption.getAttribute('data-firstname');
      var lastName = selectedOption.getAttribute('data-lastname');
      var passport = selectedOption.getAttribute('data-passport');
      var nationality = selectedOption.getAttribute('data-nationality');
      var email = selectedOption.getAttribute('data-email');
      var contact = selectedOption.getAttribute('data-contact');

      // Populate the form fields
      document.getElementById('passengerId').value = passengerId;
      document.getElementById('firstName').value = firstName;
      document.getElementById('lastName').value = lastName;
      document.getElementById('passport').value = passport;
      document.getElementById('nationality').value = nationality;
      document.getElementById('email').value = email;
      document.getElementById('contact').value = contact;
    }
    </script>


  <script>
    function storeFormData() {
      // Store form data in localStorage
      localStorage.setItem('passengerId', document.getElementById('passengerId').value);
      localStorage.setItem('firstName', document.getElementById('firstName').value);
      localStorage.setItem('lastName', document.getElementById('lastName').value);
      localStorage.setItem('nationality', document.getElementById('nationality').value);
      localStorage.setItem('passport', document.getElementById('passport').value);
      localStorage.setItem('email', document.getElementById('email').value);
      localStorage.setItem('contact', document.getElementById('contact').value);
      localStorage.setItem('adult', document.getElementById('adult').value);
      localStorage.setItem('child', document.getElementById('child').value);
      localStorage.setItem('class', document.getElementById('class').value);
        // You can continue with other fields as needed
    }
  </script>


  <script>
  window.onload = function() {
    <?php if ($loginMessage != null): ?>
      // Show the modal again if there was a login error
      var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
      loginModal.show();
    <?php endif; ?>

    
    // Check if stored data exists and repopulate form fields
    if (localStorage.getItem('firstName')) {
        document.getElementById('passengerId').value = localStorage.getItem('passengerId');
        document.getElementById('firstName').value = localStorage.getItem('firstName');
        document.getElementById('lastName').value = localStorage.getItem('lastName');
        document.getElementById('nationality').value = localStorage.getItem('nationality');
        document.getElementById('passport').value = localStorage.getItem('passport');
        document.getElementById('email').value = localStorage.getItem('email');
        document.getElementById('contact').value = localStorage.getItem('contact');
        document.getElementById('adult').value = localStorage.getItem('adult');
        document.getElementById('child').value = localStorage.getItem('child');
        document.getElementById('class').value = localStorage.getItem('class');
        // Continue with other fields
    }
  };
</script>


  <script>
    //countdown timer
    var totalSeconds = 15 * 60; // 15 minutes in seconds
    var timerInterval = setInterval(function() {
      totalSeconds -= 1;
      var minutes = Math.floor(totalSeconds / 60);
      var seconds = totalSeconds % 60;
      document.getElementById('time').textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

      if (totalSeconds <= 0) {
        clearInterval(timerInterval);
        document.body.classList.add('modal-open'); // Add class to body to simulate the modal background
        var myModal = new bootstrap.Modal(document.getElementById('timeoutModal'));
        myModal.show();
      }
    }, 1000); // Run the function every 1 second
  </script>
</body>


</html>