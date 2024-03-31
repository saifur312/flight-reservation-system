<?php
include "../../inc/header.php";
include "../../service/Airport.php";
include "../../service/Airline.php";
include "../../service/Flight.php";
include "../../service/User.php";
include "../../service/Ticket.php";

// $ap = new Airport();
// $airports = $ap->fetchAirports();

// $al = new Airline();
// $airlines = $al->fetchAirlines();

$flight = new Flight();
$flightInfo = $flight->fetchFlight($_GET['id']);

if (!$flightInfo) {
  header("refresh:3; url=flights.php");
  echo
  "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
    Sorry... :( No Flight found..!!!.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    </button>
  </div>";
  exit(); // Make sure to stop script execution after redirection
} else
  $flightInfo = $flightInfo->fetch_assoc();

/** Save ticket details */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $ticket = new Ticket();
  $ticket->saveTicket($_POST);
  //print_r($_POST);
}


if (isset($_POST['delete'])) {
  // echo <<<HTML
  //   <h1> </h1>
  // HTML;
  $flight->deleteFlight($_POST['id']);
}

/** get user details */
$userId = Session::get('id');
$u = new User();
$user = $u->fetchUser($userId)
//print_r($user);

?>

<section class="container text-center">
  <form action="" method="post" class="row justify-content-center ">
    <!-- <div class="col-6 card mt-4">
      <div class="mt-4 card-body">
        <input type="hidden" name="id" value="<?php echo $flightInfo['id'] ?>" />
        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="source" class="col-form-label-sm">Departure Airport </label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="source" value="{$airport['name']}" required>
              <option>Select One</option>
              <?php
              if ($airports) {
                while ($airport = $airports->fetch_assoc()) {
                  $selected = '';
                  if ($flightInfo['source'] == $airport['name'])
                    $selected = 'selected';
                  echo <<<HTML
                    <option value="{$airport['name']}" {$selected}>{$airport['name']}
                      &nbsp; ({$airport['code']})</option>
                  HTML;
                }
                // Reset internal pointer of result set
                $airports->data_seek(0);
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="destination" class="col-form-label-sm">Arrival Airport</label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="destination" required>
              <option>Select One</option>
              <?php
              if ($airports) {
                while ($airport = $airports->fetch_assoc()) {
                  $selected = '';
                  if ($flightInfo['destination'] == $airport['name'])
                    $selected = 'selected';
                  echo <<<HTML
                    <option value="{$airport['name']}" {$selected}>{$airport['name']}
                      &nbsp; ({$airport['code']})</option>
                  HTML;
                }
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="departure" class="col-form-label-sm">Departure</label>
          </div>
          <div class="col-8 text-start">
            <input type="datetime-local" name="departure" class="form-control-lg" min="29/03/2024" max="10/04/2024" value="<?php echo $flightInfo['departure'] ?>">
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="arrival" class="col-form-label-sm">Arrival</label>
          </div>
          <div class="col-8 text-start">
            <input type="datetime-local" name="arrival" class="form-control-lg" min="29/03/2024" max="10/04/2024" value="<?php echo $flightInfo['arrival'] ?>">
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="airline" class="col-form-label-sm">Airline </label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="airline" selected="<?php echo $flightInfo['airline'] ?>" required>
              <option>Select One</option>
              <?php
              if ($airlines) {
                $selected = '';
                while ($airline = $airlines->fetch_assoc()) {
                  if ($flightInfo['airline'] == $airline['name'])
                    $selected = 'selected';
                  echo <<<HTML
                    <option value="{$airline['name']}" {$selected}>{$airline['name']}</option>
                  HTML;
                }
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="price" class="col-form-label-sm">Price</label>
          </div>
          <div class="col-8 text-start">
            <input type="number" name="price" class="form-control-lg" value="<?php echo $flightInfo['price'] ?>">
          </div>
        </div>
      </div>
    </div>
    <div class="col-6 card mt-4"> User Info
      <?php
      $username = Session::get('username');
      $id = Session::get('id');
      if (isset($username)) {
        echo $username;
        echo $id;
      }
      ?>
    </div> -->

    <div class="col-6 card mt-2 mb-2">
      <h4> Flight Details</h4>
      <input type="hidden" name="flightId" value="<?php echo $flightInfo['id'] ?>" />
      <input type="hidden" name="userId" value="<?php echo $user['id'] ?>" />

      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">From</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="source" class="form-control form-control-sm" value="<?php echo $flightInfo['source'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">To</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="destination" class="form-control form-control-sm" value="<?php echo $flightInfo['destination'] ?>" disabled>
        </div>
      </div>


      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Departure</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="departure" class="form-control form-control-sm" value="<?php echo $flightInfo['departure'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Arrival</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="arrival" class="form-control form-control-sm" value="<?php echo $flightInfo['arrival'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Airline</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="arrival" class="form-control form-control-sm" value="<?php echo $flightInfo['airline'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2 mb-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Unit Price</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="arrival" class="form-control form-control-sm" value="<?php echo $flightInfo['price'] ?>" disabled>
        </div>
      </div>

    </div>

    <div class="col-6 card mt-2 mb-2">
      <h4> Personal Information</h4>
      <!-- <div class="row justify-content-center mb-4 ">
        <table class="table mt-4 text-start table-borderless">
          <tr>
            <td>From</td>
            <th><?php echo $flightInfo['source'] ?> </th>
          </tr>
          <tr>
            <td>To</td>
            <th><?php echo $flightInfo['destination'] ?> </th>
          </tr>
          <tr>
            <td>Departure</td>
            <th><?php echo $flightInfo['departure'] ?> </th>
          </tr>
          <tr>
            <td>Arrival</td>
            <th><?php echo $flightInfo['arrival'] ?> </th>
          </tr>
          <tr>
            <td>Airline</td>
            <th><?php echo $flightInfo['airline'] ?> </th>
          </tr>
          <tr>
            <td>Unit Price</td>
            <th><?php echo $flightInfo['price'] ?> </th>
          </tr>
        </table>
      </div> -->
      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">First Name</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="source" class="form-control form-control-sm" value="<?php echo $flightInfo['source'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Last Name</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="destination" class="form-control form-control-sm" value="<?php echo $flightInfo['destination'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2 mb-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Email</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="arrival" class="form-control form-control-sm" value="<?php echo $flightInfo['airline'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Passport</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="departure" class="form-control form-control-sm" value="<?php echo $flightInfo['departure'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Contact</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="arrival" class="form-control form-control-sm" value="<?php echo $flightInfo['arrival'] ?>" disabled>
        </div>
      </div>

      <div class="row justify-content-center mt-2 mb-2">
        <div class="col-3 text-start">
          <label for="price" class="col-form-label-sm">Address</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="arrival" class="form-control form-control-sm" value="<?php echo $flightInfo['airline'] ?>" disabled>
        </div>
      </div>
    </div>

    <div class="col-12 card mt-2 mb-2">

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
          <label for="seatNo" class="col-form-label-sm">Seat</label>
        </div>
        <div class="col-2 text-start">
          <input type="text" name="seatNo" class="form-control form-control-sm">
        </div>
      </div>

      <div class="row justify-content-center mt-4">
        <div class="col-3 text-start">
          <label for="amount" class="col-form-label-sm">Total Amount</label>
        </div>
        <div class="col-6 text-start">
          <input type="text" name="amount" class="form-control form-control-sm" value="<?php echo $flightInfo['price'] ?>" readonly>
        </div>
      </div>

      <div class="row justify-content-center mt-2">
        <input type="submit" class="btn btn-lg btn-outline-primary col-lg-3 m-4" name="submit" value="Confirm & Buy" />
        <input type="reset" class="btn btn-lg btn-outline-danger col-lg-3 m-4" value="Cancel" />
      </div>

    </div>

    <!-- <div class="row justify-content-center ">
      <input type="submit" class="btn btn-lg btn-outline-primary col-lg-3 m-4" name="submit" value="submit" />
      <input type="reset" class="btn btn-lg btn-outline-danger col-lg-3 m-4" value="Cancel" />
    </div> -->
  </form>
</section>

<?php
require('../../inc/footer.php');
?>