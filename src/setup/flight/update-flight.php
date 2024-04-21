<?php
include "../../inc/header.php";
include "../../service/Airport.php";
include "../../service/Airline.php";
include "../../service/Flight.php";

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$flight = new Flight();
$prevFlight = $flight->fetchFlight($_GET['id']);

if (!$prevFlight) {
  header("refresh:3; url=flights.php");
  echo
  "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
    Sorry... :( No Flight found..!!!.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    </button>
  </div>";
  exit(); // Make sure to stop script execution after redirection
} else
  $prevFlight = $prevFlight->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $flight->updateFlight($_POST);
  //print_r($_POST);
}


if (isset($_POST['delete'])) {
  // echo <<<HTML
  //   <h1> </h1>
  // HTML;
  $flight->deleteFlight($_POST['id']);
}

?>

<body class="text-center">
  <!-- navbar -->
  <div id="navbar" class="container-fluid">
    <?php
    include "../../inc/navbar.php";
    ?>
  </div>


  <section class="container text-center">
    <div class="row justify-content-center ">
      <div class="col-6 card mt-4">
        <form action="" method="post" class="mt-4 card-body">
          <input type="hidden" name="id" value="<?php echo $prevFlight['id'] ?>" />
          <div class="row justify-content-center mb-4">
            <div class="col-4 text-start">
              <label for="source" class="col-form-label">Departure Airport </label>
            </div>
            <div class="col-8 text-start">
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="source" value="{$airport['name']}" required>
                <option>Select One</option>
                <?php
                if ($airports) {
                  while ($airport = $airports->fetch_assoc()) {
                    $selected = '';
                    if ($prevFlight['source'] == $airport['name'])
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
              <label for="destination" class="col-form-label">Arrival Airport</label>
            </div>
            <div class="col-8 text-start">
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="destination" required>
                <option>Select One</option>
                <?php
                if ($airports) {
                  while ($airport = $airports->fetch_assoc()) {
                    $selected = '';
                    if ($prevFlight['destination'] == $airport['name'])
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
              <label for="departure" class="col-form-label">Departure</label>
            </div>
            <div class="col-8 text-start">
              <input type="datetime-local" name="departure" class="form-control-lg" min="29/03/2024" max="10/04/2024" value="<?php echo $prevFlight['departure'] ?>">
            </div>
          </div>

          <div class="row justify-content-center mb-4">
            <div class="col-4 text-start">
              <label for="arrival" class="col-form-label">Arrival</label>
            </div>
            <div class="col-8 text-start">
              <input type="datetime-local" name="arrival" class="form-control-lg" min="29/03/2024" max="10/04/2024" value="<?php echo $prevFlight['arrival'] ?>">
            </div>
          </div>

          <div class="row justify-content-center mb-4">
            <div class="col-4 text-start">
              <label for="airline" class="col-form-label">Airline </label>
            </div>
            <div class="col-8 text-start">
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="airline" selected="<?php echo $prevFlight['airline'] ?>" required>
                <option>Select One</option>
                <?php
                if ($airlines) {
                  $selected = '';
                  while ($airline = $airlines->fetch_assoc()) {
                    if ($prevFlight['airline'] == $airline['name'])
                      $selected = 'selected';
                    echo <<<HTML
                    <option value="{$airline['name']}" {$selected}>{$airline['name']}</option>
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
              <label for="price" class="col-form-label">Price</label>
            </div>
            <div class="col-8 text-start">
              <input type="number" name="price" class="form-control-lg" value="<?php echo $prevFlight['price'] ?>">
            </div>
          </div>
          <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
          <input type="submit" class="btn btn-lg btn-outline-primary" name="update" value="update" />
          <input type="reset" class="btn btn-lg btn-outline-danger" value="Cancel" />
          <button type="submit" class="btn btn-lg btn-danger" name="delete" value="delete">Delete</button>
        </form>
      </div>
    </div>
  </section>

  <?php
  require('../../inc/footer.php');
  ?>
</body>

</html>