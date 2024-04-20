<?php

include_once __DIR__ . '../../config.php';
include "./service/Airport.php";
include "./service/Airline.php";
include "./service/Flight.php";

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$showflights = false;

$flight = new Flight();

if (isset($_GET['source'])) {
  // Retrieve the data from the query string
  $src = $_GET['source'];
  $dst = $_GET['destination'];
  $dep = $_GET['departure'];
  $arv = $_GET['arrival'];

  //echo "$src + $dst + $dep + $arv";
  $flights = $flight->filterFlights($src, $dst, $dep, $arv);

  if ($flights) {
    $showflights = true;
  }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $flights = $flight->filterFlights(
    $_POST['source'],
    $_POST['destination'],
    $_POST['departure'],
    $_POST['arrival']
  );

  if ($flights)
    $showflights = true;
}

?>

<?php include "./inc/header.php"; ?>

<body class="text-center">
  <section class="text-center">
    <!-- navbar -->
    <div id="navbar" class="container-fluid">
      <?php include "./inc/navbar.php"; ?>
    </div>

  </section>


  <!-- Flights -->
  <div class="container justify-content-center mt-4">
    <div class="row text-center">
      <div class="col-lg-9">
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
                  <div class="col-md-6">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" readonly>
                  </div>
                  <div class="col-md-6">
                    <label for="bkashNumber" class="form-label">Bkash Number</label>
                    <input type="number" class="form-control" id="bkashNumber" name="bkashNumber">
                  </div>
                  <div class="col-md-6">
                    <label for="code" class="form-label">Verification Code</label>
                    <input type="number" class="form-control" id="code" name="code">
                  </div>
                  <div class="col-md-6">
                    <label for="pin" class="form-label">PIN</label>
                    <input type="number" class="form-control" id="pin" name="pin">
                  </div>
                  <div class="col-md-6">
                    <label for="contact" class="form-label">Contact No</label>
                    <input type="text" class="form-control" id="contact" name="contact">
                  </div>
                  <div class="col-12">
                    <input type="submit" class="btn btn-lg btn-warning" name="submit" value="Submit" />
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