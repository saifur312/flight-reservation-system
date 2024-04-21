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
  print_r($_POST);

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
    header("refresh:3; url=mybooking.php");
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
        <div class="accordion accordion-flush" id="accordionFlightDetails1">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-FlightDetails1">
              <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFlightDetails1" aria-expanded="true" aria-controls="flush-collapseFlightDetails1">
                DAC-COX
              </button>
            </h2>
            <div id="flush-collapseFlightDetails1" class="accordion-collapse collapse show" aria-labelledby="flush-FlightDetails1" data-bs-parent="#accordionFlightDetails1">
              <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
            </div>
          </div>
        </div>

        <h4> Select a Payment method</h4>
        <!-- Payment Methods -->
        <div class="row col-lg-12 text-start mt-4">
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

        <!-- Modal -->
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


  <?php include "./inc/footer.php"; ?>
</body>


</html>