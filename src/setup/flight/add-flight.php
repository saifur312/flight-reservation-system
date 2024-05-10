<?php
include "../../inc/header.php";
include "../../service/Airport.php";
include "../../service/Airline.php";
include "../../service/Flight.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  //print_r($_POST);
  $flight = new Flight();
  $flight->saveFlight($_POST);


  // $flight->filterFlights(
  //   $formData['source'],
  //   $formData['destination'],
  //   $formData['departure'],
  //   $formData['arrival']
  // );


}

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

?>

<body>
  <div class="main-container d-flex">
    <?php
    include_once "../../inc/sidebar.php";
    ?>
    <div class="content text-center mb-4">
      <?php
      include_once "../../inc/navbar.php";
      ?>

      <div class="dashboard-content px-3 pt-4 pb-4">
        <h2 class="fs-5">Add Flight</h2>

        <section class="container text-center">
          <div class="row justify-content-center ">
            <div class="col-6 card mt-4">
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
                          <option value="{$airport['name']}">{$airport['name']}
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
                          echo <<<HTML
                          <option value="{$airport['name']}">{$airport['name']}
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
                    <input type="datetime-local" name="departure" class="form-control-lg" min="29/03/2024" max="10/04/2024">
                  </div>
                </div>

                <div class="row justify-content-center mb-4">
                  <div class="col-4 text-start">
                    <label for="arrival" class="col-form-label">Arrival</label>
                  </div>
                  <div class="col-8 text-start">
                    <input type="datetime-local" name="arrival" class="form-control-lg" min="29/03/2024" max="10/04/2024">
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
                    <label for="airline" class="col-form-label">Class </label>
                  </div>
                  <div class="col-8 text-start">
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="class" required>
                      <option>Economy</option>
                      <option>Business</option>
                    </select>
                  </div>
                </div>

                <div class="row justify-content-center mb-4">
                  <div class="col-4 text-start">
                    <label for="price" class="col-form-label">Price</label>
                  </div>
                  <div class="col-8 text-start">
                    <input type="number" name="price" class="form-control-lg">
                  </div>
                </div>
                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                <input type="submit" class="btn btn-lg btn-outline-primary" name="submit" value="submit" />
                <input type="reset" class="btn btn-lg btn-outline-danger" value="Cancel" />
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <?php
  require('../../inc/footer-scripts.php');
  ?>

</body>

</html>