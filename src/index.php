<?php

//include __DIR__ . '/inc/header.php';

include "./inc/header.php";
//include __DIR__ . "/service/Session.php";
//Session::init();
//Session::checkSession();
include "./service/Airport.php";
include "./service/Airline.php";
include "./service/Flight.php";

$loginmsg = Session::get('loginmsg');
$username = Session::get('username');
if (isset($loginmsg)) {
  echo $loginmsg;
}
Session::set('loginmsg', NULL);

//echo "<h2>Welcome $username </h2>";

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$showflights = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
  $flight = new Flight();
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


<section class="container text-center">
  <div class="row justify-content-center ">
    <div class="col-lg-6 card mt-4">
      <form action="" method="post" class="mt-4 card-body">

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="source" class="col-form-label">Departure Airport </label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="source" required>
              <option>Select One</option>
              <?php
              if ($airports) {
                while ($airport = $airports->fetch_assoc()) {
                  echo <<<HTML
                    <option value="{$airport['name']}">{$airport['name']}</option>
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
            <label for="destination" class="col-form-label">Arrival Airport</label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="destination" required>
              <option>Select One</option>
              <?php
              if ($airports) {
                while ($airport = $airports->fetch_assoc()) {
                  echo <<<HTML
                    <option value="{$airport['name']}">{$airport['name']}</option>
                  HTML;
                }
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="departure" class="col-form-label">Departure</label>
          </div>
          <div class="col-8 text-start">
            <input type="date" name="departure" class="form-control-lg" min="2024-03-29" max="2024-04-29">
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="arrival" class="col-form-label">Return</label>
          </div>
          <div class="col-8 text-start">
            <input type="date" name="arrival" class="form-control-lg" min="29/03/2024" max="10/04/2024">
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="airline" class="col-form-label">Airline </label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="airline" required>
              <option>Select One</option>
              <?php
              if ($airlines) {
                while ($airline = $airlines->fetch_assoc()) {
                  echo <<<HTML
                    <option value="{$airline['name']}">{$airline['name']}</option>
                  HTML;
                }
                // Reset internal pointer of result set
                //$airline->data_seek(0);
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="role" class="col-form-label">Class</label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="class" required>
              <option>First Class</option>
              <option>Economy</option>
              <option>Business</option>
            </select>
          </div>
        </div>
        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="role" class="col-form-label">No. of Passengers</label>
          </div>
          <div class="col-8 text-start">
            <input type="number" name="total" class="form-control-lg">
          </div>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
        <input type="submit" class="btn btn-lg btn-outline-primary" name="search" value="search Flights" />
        <input type="reset" class="btn btn-lg btn-outline-danger" value="Cancel" />
      </form>
    </div>

    <?php
    if ($showflights) {
    ?>
      <table class="table col-lg-6 mt-4">
        <thead>
          <tr>
            <th scope="col">SL</th>
            <th scope="col">Id</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Departure</th>
            <th scope="col">Arrival</th>
            <th scope="col">Price</th>
            <th scope="col">Airline</th>
            <th scope="col" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 1;
          // Reset the internal pointer of the result set to the beginning
          //$flights->data_seek(0);
          while ($flight = $flights->fetch_assoc()) {
          ?>
            <tr>
              <th>
                <?php
                echo $count;
                ?>
              </th>
              <th> <?php echo $flight['id']; ?> </th>
              <td> <?php echo $flight['source']; ?> </td>
              <td> <?php echo $flight['destination']; ?> </td>
              <td> <?php echo date('Y-m-d h:i A', strtotime($flight['departure'])); ?> </td>
              <td> <?php echo date('Y-m-d h:i A', strtotime($flight['arrival'])); ?> </td>
              <td> <?php echo $flight['price']; ?> </td>
              <td> <?php echo $flight['airline']; ?> </td>
              <td> <a class="btn btn-success" href="./setup/ticket/buy-ticket.php?id=<?php echo urlencode($flight['id']); ?>">
                  Buy
              </td>
            </tr>
          <?php
            $count++;
          }
          ?>
        </tbody>
      </table>
    <?php
    }
    ?>
  </div>
</section>

<?php include "./inc/footer.php"; ?>