<?php

//include __DIR__ . '/inc/header.php';

include "./inc/header.php";
//include __DIR__ . "/service/Session.php";
//Session::init();
//Session::checkSession();
include "./service/Airport.php";

$loginmsg = Session::get('loginmsg');
$username = Session::get('username');
if (isset($loginmsg)) {
  echo $loginmsg;
}
Session::set('loginmsg', NULL);

//echo "<h2>Welcome $username </h2>";

$ap = new Airport();
$airports = $ap->fetchAirports();

?>


<section class="container text-center">
  <div class="row justify-content-center ">
    <div class="col-6 card mt-4">
      <form action="" method="post" class="mt-4 card-body">
        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="username" class="col-form-label">Departure Airport </label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="departure" required>
              <option>Select One</option>
              <?php
              if ($airports) {
                while ($airport = $airports->fetch_assoc()) {
                  echo <<<HTML
                    <option value="{$airport['id']}">{$airport['name']}</option>
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
            <label for="arrival" class="col-form-label">Arrival Airport</label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="arrival" required>
              <option>Select One</option>
              <?php
              if ($airports) {
                while ($airport = $airports->fetch_assoc()) {
                  echo <<<HTML
                    <option value="{$airport['id']}">{$airport['name']}</option>
                  HTML;
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="role" class="col-form-label">Departure</label>
          </div>
          <div class="col-8 text-start">
            <input type="date" name="role" class="form-control-lg" min="29/03/2024" max="10/04/2024">
          </div>
        </div>
        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="role" class="col-form-label">Return</label>
          </div>
          <div class="col-8 text-start">
            <input type="date" name="role" class="form-control-lg" min="29/03/2024" max="10/04/2024">
          </div>
        </div>
        <div class="row justify-content-center mb-4">
          <div class="col-4 text-start">
            <label for="role" class="col-form-label">Class</label>
          </div>
          <div class="col-8 text-start">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="arrival" required>
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
            <input type="text" name="role" class="form-control-lg">
          </div>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
        <input type="submit" class="btn btn-lg btn-outline-primary" name="search" value="search Flights" />
        <input type="reset" class="btn btn-lg btn-outline-danger" value="Cancel" />
      </form>
    </div>
  </div>
</section>

<?php include "./inc/footer.php"; ?>