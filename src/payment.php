<?php

include_once __DIR__ . '../../config.php';
include "./inc/header.php";
include "./service/Airport.php";
include "./service/Airline.php";
include "./service/Flight.php";
include "./service/Ticket.php";
include "./service/Payment.php";

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$showflights = false;

$f = new Flight();

if (isset($_GET['ticketId'])) {
  // Retrieve the data from the query string
  $ticketId = $_GET['ticketId'];
  $t = new Ticket();
  $ticket = $t->fetchTicket($ticketId)->fetch_assoc();
  //fetch flight 
  $flight = $f->fetchFlight($ticket['flight_id'])->fetch_assoc();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment'])) {
  //print_r($_POST);

  $p = new Payment();
  $savedPayment = $p->savePayment($_POST);
  if ($savedPayment) {
    //print_r($savedPayment);
    echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Payment successful..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    header("refresh:1; url=mytickets.php");
    exit();
  } else {
    echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Payment Failure..!! Plz fill up all fields carefully.
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
    <div class="row text-center mb-4">
      <div class="col-lg-9">
        <!-- Booking Details -->
        <div class="accordion accordion-flush" id="accordionFlightReview">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-FlightReview">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFlightReview" aria-expanded="true" aria-controls="flush-collapseFlightReview">
                DAC-COX
              </button>
            </h2>
            <div id="flush-collapseFlightReview" class="accordion-collapse collapse show" aria-labelledby="flush-FlightReview" data-bs-parent="#accordionFlightReview">
              <div class="accordion-body">
                <div class="row pt-4">
                  <div class="col-lg-3">
                    <div class="row align-items-center">
                      <div class="col-lg-3" style="padding: 0;">
                        <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="100%" height="auto" />
                      </div>
                      <p class="col-lg-8">
                        <?php
                        echo $flight['airline'];
                        ?>
                      </p>
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
                  <div class="col-lg-2 ">
                    <div class="row justify-content-center">
                      <p>
                        <?php echo "Flight  " . $flight['id'];
                        ?>
                      </p>
                      <h5 class="col-lg-12">
                        <?php echo "BDT  " . $flight['price'];
                        ?>
                      </h5>
                    </div>
                  </div>
                  <!-- Flight Details -->
                  <!-- <div class="accordion mt-4" id="accordionExample<?php echo $count ?>">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne<?php echo $count ?>">
                        <button class="accordion-button collapsed  text-end" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $count ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $count ?>">
                          Details
                        </button>
                      </h2>
                      <div id="collapseOne<?php echo $count ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo $count ?>" data-bs-parent="#accordionExample<?php echo $count ?>">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-lg-6" style="border-right: solid thin #eeeeee;">
                              <p>
                                <?php
                                echo $ap->getCode($flight['source']);
                                echo " - ";
                                echo $ap->getCode($flight['destination']);
                                ?>
                              </p>
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
                                <div class="col-lg-4 text-start">
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
                                <div class="col-lg-4">
                                  <img src="../public/images/arrow-right.svg" style="width: 100px; height: 60%; opacity: .5" alt="Right Arrow">


                                </div>
                                <div class="col-lg-4 text-end">
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
                                  <table class="col-lg-12 table table-borderless">
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

                                  <div class='row rounded-0 alert alert-primary show mt-4' role='alert'>
                                    <div class="col-md-6 text-start"> Total (1 Traveler)</div>
                                    <div class="col-md-6 text-end">
                                      <b>
                                        <?php
                                        $tax = $flight['price'] * 0.1;
                                        echo "BDT " . $flight['price'] + $tax;
                                        ?>
                                      </b>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pills-fare<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-fare-tab<?php echo $count ?>" tabindex="0">

                                  <table class="col-lg-12 table table-borderless">
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
                                        ?>
                                      </td>
                                    </tr>
                                  </table>

                                  <div class='row rounded-0 alert alert-primary show mt-4'>
                                    <div class="col-md-6 text-start"> Total (1 Traveler)</div>
                                    <div class="col-md-6 text-end">
                                      <b>
                                        <?php
                                        $tax = $flight['price'] * 0.1;
                                        echo "BDT " . $flight['price'] + $tax;
                                        ?>
                                      </b>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pills-policy<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-policy-tab<?php echo $count ?>" tabindex="0">
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

                                  <div class='row rounded-0 alert alert-primary show mt-4'>
                                    <div class="col-md-6 text-start"> Total (1 Traveler)</div>
                                    <div class="col-md-6 text-end">
                                      <b>
                                        <?php
                                        $tax = $flight['price'] * 0.1;
                                        echo "BDT " . $flight['price'] + $tax;
                                        ?>
                                      </b>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Payment Methods -->
        <div class="row col-lg-12 text-center mt-4">
          <h4> Select a Payment method</h4>
          <div class="col-lg-3">
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal">
              <img src="<?php echo ROOT_URL; ?>../public/images/bkash.png">
            </button>
          </div>
          <div class="col-lg-3">
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal">
              <img src="<?php echo ROOT_URL; ?>../public/images/nagad.png">
            </button>
          </div>
          <div class="col-lg-3">
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal">
              <img src="<?php echo ROOT_URL; ?>../public/images/rocket.png">
            </button>
          </div>
          <div class="col-lg-3">
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal">
              <img src="<?php echo ROOT_URL; ?>../public/images/visa.png">
            </button>
          </div>
        </div>

        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Launch demo modal
        </button> -->

      </div>

      <div class="col-lg-3">
        <div class="col-lg-12" style="background-color: #ffffff; padding: 12px;">
          <div id="timer" class="text-start" style="background-color: #ECF3FE; padding-left: 16px;">
            <i class="bi bi-clock-fill h2"></i>
            <span class="fs-1" id="time" style="padding-left: 16px;">
              05:00
            </span>
            <p style="padding-left: 70px; margin: 0px;"> min sec </p>
          </div>
        </div>

        <div class="card mt-4 ">
          <div class="card-header text-start" style="background-color: #0E70A4; color: #ffffff;">
            <h6> Need Help ?</h6>
          </div>

          <ul class="list-group list-group-flush text-start mt-4">
            <li class="list-group-item col-md-12" style="border: none">
              <span class="row align-items-center">
                <i class="bi bi-telephone-outbound-fill col-md-2 " style="font-size: 25px; color: orange;"></i>
                <h6 class="col-md-8"> +880-1643833992 </h6>
              </span>
            </li>
            <hr />
            <li class="list-group-item col-md-12" style="border: none">
              <span class="row align-items-center">
                <i class="bi bi-envelope-check col-md-2" style="font-size: 25px; color: orange;"></i>
                <h6 class="col-md-8"> admin@gamil.com </h6>
              </span>
            </li>
            <hr />
            <li class="list-group-item col-md-12" style="border: none">
              <span class="row align-items-center">
                <i class="bi bi-messenger col-md-2" style="font-size: 25px; color: orange;"></i>
                <h6 class="col-md-8"> m.me/admin </h6>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- payment Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <img src="<?php echo ROOT_URL; ?>../public/images/bkash.png" width="100px" height="80px">
          </h5>
          <h4> Pay with bKash</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post" class="row g-3">
            <input type="hidden" class="form-control" id="ticketId" name="ticketId" value="<?php echo $ticket['id']; ?>">
            <input type="hidden" class="form-control" id="method" name="method" value="bKash">
            <div class="row col-md-12">
              <label class="col-md-3 form-label">Ticket No:</label>
              <label class="col-md-3 form-label"><?php echo $ticket['id']; ?></label>
              <label class="col-md-3 form-label">Flight No:</label>
              <label class="col-md-3 form-label"><?php echo $flight['id']; ?></label>
              <label class="col-md-3 form-label">You Pay:</label>
              <label class="col-md-3 form-label"><?php echo $ticket['amount']; ?></label>
              <label class="col-md-3 form-label">Name:</label>
              <label class="col-md-3 form-label"><?php echo $username; ?></label>
            </div>
            <div class="col-md-6">
              <label for="bkashNumber" class="form-label">Bkash Number</label>
              <input type="number" class="form-control" id="accountNo" name="accountNo">
            </div>
            <div class="col-md-6">
              <label for="contact" class="form-label">Contact No</label>
              <input type="text" class="form-control" id="contact" name="contact">
            </div>
            <div class="col-md-6">
              <label for="code" class="form-label">Verification Code</label>
              <input type="number" class="form-control" id="code" name="code">
            </div>
            <div class="col-md-6">
              <label for="pin" class="form-label">PIN</label>
              <input type="number" class="form-control" id="pin" name="pin">
            </div>
            <div class="col-12">
              <input type="submit" class="btn btn-lg btn-warning" name="payment" value="Pay" />
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
          <a href="payment.php?ticketId=<?php echo urlencode($ticket['id']); ?>" class="btn btn-lg btn-info mt-3">Try Again</a>

          <a href="mybookings.php" class="btn btn-lg btn-warning mt-3">Back</a>
        </div>
      </div>
    </div>
  </div>


  <?php include "./inc/footer.php"; ?>


  <script>
    //countdown timer
    var totalSeconds = 5 * 60; // 30 minutes in seconds
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