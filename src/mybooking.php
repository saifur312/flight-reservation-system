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


$b = new Booking();
//fetch bookings of the user
$bookings = $b->fetchBookingByUserId($userId);
//print_r($bookings->fetch_assoc());
//fetch flights
$f = new Flight();

// while ($booking = $bookings->fetch_assoc()) {
//   $flightData = $f->fetchFlight($booking['flight_id'])->fetch_assoc();
//   if ($flightData) {
//     print_r($flightData);
//     $flights[] = $flightData; // Append the fetched data to the flights array
//   }
// }

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
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmBooking'])) {

//   $passenger = new Passenger();
//   $savedData = $passenger->savePassenger($_POST);
//   if ($savedData) {
//     echo "
//       <div class='alert alert-success alert-dismissible fade show' role='alert'> 
//         Ticket booked successful..!! 
//         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
//         </button>
//       </div>";
//     header("refresh:3; url=payment.php");
//     exit();
//   } else {
//     echo "
//       <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
//         Fail to book tikect..!! Plz fill up all fields carefully.
//         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
//         </button>
//       </div>";
//   }
// }

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
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">SL</th>
              <th scope="col">Flight No</th>
              <th scope="col">From</th>
              <th scope="col">To</th>
              <th scope="col" colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($bookings) {
              $count = 1;
              //while ($flight = $flights->fetch_assoc()) {
              while ($booking = $bookings->fetch_assoc()) {
                $flight = $f->fetchFlight($booking['flight_id'])->fetch_assoc();
                if ($flight) {
            ?>
                  <tr>
                    <td>
                      <?php
                      echo $count;
                      ?>
                    </td>
                    <td> <?php echo $flight['id']; ?> </td>
                    <td> <?php echo $flight['source']; ?> </td>
                    <td> <?php echo $flight['destination']; ?> </td>
                    <td> <a href="payment.php?flightId=<?php echo urlencode($flight['id']); ?>">
                        Pay now</td>
                    <td> <a href="update-airline.php?id=<?php echo urlencode($flight['id']); ?>">
                        Cancel</td>
                  </tr>
            <?php
                  $count++;
                }
              }
            }
            ?>
          </tbody>
        </table>
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