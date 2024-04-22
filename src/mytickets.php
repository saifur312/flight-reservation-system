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
include_once "./service/Booking.php";
include_once "./service/Ticket.php";

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$b = new Ticket();
//fetch tickets of the user
$tickets = $b->fetchTicketsByUserId($userId);
//fetch flights
$f = new Flight();
// login
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $userLogin = $user->userLogin($_POST);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelTicket'])) {
  var_dump($_POST);
  $t = new Ticket();
  $savedTicket = $t->fetchTicket($_POST['ticketId'])->fetch_assoc();
  $savedTicket['active'] = false;
  $t->updateTicket($savedTicket);

  header("refresh:1; url=myticekts.php");
  exit();
}

?>

<style>
  .nocontent {
    width: 100%;
    min-height: 40vh;
    text-align: center;
    vertical-align: center;
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
      <div class="row col-lg-12">
        <script>
          // Define the timers object outside the loop
          var timers = {};
        </script>

        <?php

        if (!$tickets) {
          echo <<<HTML
                    <section class='row nocontent text-center align-items-center'> 
                      <h4 class="col-lg-12"> No ticket found</h4> 
                      <h4 h4 class="col-lg-12"> 
                        <a href="index.php" class="col-lg-6 btn btn-lg btn-info"> Search Flights</a>
                      </h4> 
                    </section>
                  HTML;
        }
        if ($tickets) {
          $count = 1;
          while ($ticket = $tickets->fetch_assoc()) {
            $flight = $f->fetchFlight($ticket['flight_id'])->fetch_assoc();
            if ($flight) {
              //print_r($ticket['created_on']);
        ?>
              <h4> No ticket found</h4>

              <div class=" card col-lg-9 text-center mt-4 " style=" min-height: 25vh;">
                <div class="card-body row">
                  <div class="col-lg-3">
                    <div class="row align-items-center">
                      <div class="col-lg-4" style="padding: 0;">
                        <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="100%" height="auto" />
                      </div>
                      <div class="col-lg-8">
                        <?php
                        echo $flight['airline'];
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="row">
                      <div class="col-lg-3">
                        <p>
                          <?php echo
                          date('h:i A', strtotime($flight['departure']));
                          ?>
                        </p>
                        <p>
                          <?php
                          echo $ap->getCode($flight['source']);
                          ?>
                        </p>
                      </div>
                      <div class="col-lg-3">
                        <img src="<?php echo ROOT_URL; ?>../public/images/arrow2.png" width="100%" height="auto" />
                      </div>
                      <div class="col-lg-3">
                        <p>
                          <?php echo
                          date('h:i A', strtotime($flight['arrival']));
                          ?>
                        </p>
                        <p>
                          <?php
                          echo $ap->getCode($flight['destination']);
                          ?>
                        </p>
                      </div>
                      <div class="col-lg-3">
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
                    </div>
                  </div>
                  <!-- Select Flight -->
                  <div class="col-lg-2">
                    <div class="row justify-content-center">
                      <p>
                        <?php echo "Flight  " . $flight['id'];
                        ?>
                      </p>
                      <div class="col-lg-12">
                        <?php echo "BDT  " . $flight['price'];
                        ?>
                      </div>
                      <a href="booking.php?id=<?php echo $flight['id'] ?>" class="btn btn-warning col-lg-8">Select</a>
                    </div>
                  </div>
                  <!-- Flight Details -->
                  <div class="accordion mt-1" id="accordionExample<?php echo $count ?>">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne<?php echo $count ?>">
                        <button class="accordion-button collapsed  text-end" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $count ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $count ?>">
                          Details
                        </button>
                      </h2>
                      <div id="collapseOne<?php echo $count ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo $count ?>" data-bs-parent="#accordionExample<?php echo $count ?>">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <button class="btn btn-primary">
                                <?php
                                echo $ap->getCode($flight['source']);
                                echo " - ";
                                echo $ap->getCode($flight['destination']);
                                ?>
                              </button>
                              <div class="row">
                                <div class="col-lg-8">
                                  <div class="row text-start align-items-center">
                                    <div class="col-lg-4">
                                      <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="100%" />
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
                                  Economy
                                </div>
                                <hr>
                              </div>
                            </div>
                            <!-- Baggage, Fare, Policy -->
                            <div class="col-lg-6">
                              <ul class="nav nav-pills mb-3" id="pills-tab<?php echo $count ?>" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-baggage-tab<?php echo $count ?>" data-bs-toggle="pill" data-bs-target="#pills-baggage<?php echo $count ?>" type="button" role="tab" aria-controls="pills-baggage<?php echo $count ?>" aria-selected="true">Baggage</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-fare-tab<?php echo $count ?>" data-bs-toggle="pill" data-bs-target="#pills-fare<?php echo $count ?>" type="button" role="tab" aria-controls="pills-fare<?php echo $count ?>" aria-selected="false">Fare</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-policy-tab<?php echo $count ?>" data-bs-toggle="pill" data-bs-target="#pills-policy<?php echo $count ?>" type="button" role="tab" aria-controls="pills-policy<?php echo $count ?>" aria-selected="false">Policy</button>
                                </li>
                              </ul>
                              <div class="tab-content" id="pills-tabContent<?php echo $count ?>">
                                <div class="tab-pane fade show active" id="pills-baggage<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-baggage-tab<?php echo $count ?>" tabindex="0">
                                  Baggage
                                </div>
                                <div class="tab-pane fade" id="pills-fare<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-fare-tab<?php echo $count ?>" tabindex="0">Fare</div>
                                <div class="tab-pane fade" id="pills-policy<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-policy-tab<?php echo $count ?>" tabindex="0">Policy</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php
              date_default_timezone_set('Asia/Dhaka'); // Replace with local time zone

              $createdDateTime = new DateTime($flight['departure']);
              $currentTime = new DateTime(); // Current server time
              $endTime = clone $createdDateTime;
              $endTime->modify('+30 minutes');
              $remainingSeconds = $currentTime > $endTime ? 0 : $endTime->getTimestamp() - $currentTime->getTimestamp();

              // var_dump("currentTime: " . $currentTime->format('Y-m-d H:i:s') . ", endTime: " . $endTime->format('Y-m-d H:i:s') . ", remainingSeconds: " . $remainingSeconds);


              // Unique ID for each timer
              $timerId = "timer" . $ticket['id'];
              $timeId = "time" . $ticket['id'];
              ?>

              <script>
                // Add the remaining time to the timers object within the loop
                timers['<?php echo $timerId; ?>'] = <?php echo $remainingSeconds; ?>;
              </script>

              <div class="col-lg-3 mt-4">
                <div class="col-lg-12" style="background-color: #ffffff; padding: 12px;">
                  <div class="text-start" style="background-color: #ECF3FE; padding-left: 16px;">
                    <i class="bi bi-clock-fill h2"></i>
                    <span class="fs-1" id="<?php echo $timerId; ?>" style="padding-left: 16px;">
                      <!-- This will be populated by JavaScript -->
                    </span>
                    <p style="padding-left: 90px; margin: 0px;"> h min sec </p>
                  </div>
                </div>
              </div>

        <?php
              $count++;
            }
          }
        }
        ?>
      </div>

    </div>
  </div>


  <!-- footer -->
  <?php include "./inc/footer.php"; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Create an object to keep track of the interval IDs for each timer
      var intervalIDs = {};

      for (const [timerId, totalSeconds] of Object.entries(timers)) {
        // Assign the interval ID to the corresponding timerId
        intervalIDs[timerId] = setInterval(function() {
          var currentTime = timers[timerId];
          console.log("timerId ", timerId, "  currentTime ", currentTime);

          if (currentTime > 0) {
            currentTime -= 1;
            timers[timerId] = currentTime; // Update the time in the timers object
            var hours = Math.floor(currentTime / 3600);
            // var minutes = Math.floor(currentTime / 60);
            var minutes = Math.floor((currentTime % 3600) / 60); // Corrected minutes calculation
            var seconds = currentTime % 60;
            document.getElementById(timerId).textContent = hours.toString().padStart(2, '0') + ':' +
              minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
          } else {
            document.getElementById(timerId).textContent = "00:00:00";
            clearInterval(intervalIDs[timerId]); // Stop the interval for this timer
            // You can also delete the timerId from the intervalIDs object if you wish
            // delete intervalIDs[timerId];

            // Here you can show the modal if necessary
            // Make sure to reference the correct modal for each timer if they are different
          }
        }, 1000, timerId); // Pass timerId to the interval function
      }
    });
  </script>


</body>


</html>