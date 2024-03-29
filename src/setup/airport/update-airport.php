<?php

include "../../inc/header.php";
include '../../service/Airport.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$airportId = $_GET['id'];
$airport = new Airport();

$airportData = $airport->fetchAirport($airportId);

if (!$airportData) {
  /* ths will Redirect immediately so we msg won't show. */
  // header("Location: airports.php"); 
  // So Redirect after 3 seconds, if you 
  header("refresh:3; url=airports.php");
  echo
  "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
    Sorry... :( No airport found..!!!.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    </button>
  </div>";
  exit(); // Make sure to stop script execution after redirection
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  //print_r($_POST);
  $airport->updateAirport($_POST);
}


if (isset($_POST['delete'])) {
  // echo <<<HTML
  //   <h1> </h1>
  // HTML;
  $airport->deleteAirport($_POST['id']);
}

?>

<section class="container text-center">
  <div class="row justify-content-center ">
    <div class="col-6 card mt-4">
      <form action="update-airport.php?id=<?php echo urlencode($airportId); ?>" method="post" class="mt-4 card-body">

        <input type="hidden" name="id" value="<?php echo $airportData['id'] ?>" />

        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="name" class="col-form-label">Name</label>
          </div>
          <div class="col-8">
            <input type="text" name="name" class="form-control-lg" value="<?php echo $airportData['name'] ?>" required inputmode="text" />
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="code" class="col-form-label">Code</label>
          </div>
          <div class="col-8">
            <input type="text" name="code" class="form-control-lg" value="<?php echo $airportData['code'] ?>" required inputmode="text">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="country" class="col-form-label">Country</label>
          </div>
          <div class="col-8">
            <input type="text" name="country" class="form-control-lg" value="<?php echo $airportData['country'] ?>" required inputmode="text">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="city" class="col-form-label">City</label>
          </div>
          <div class="col-8">
            <input type="text" name="city" class="form-control-lg" value="<?php echo $airportData['city'] ?>" required inputmode="text">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="contact" class="col-form-label">Help Line</label>
          </div>
          <div class="col-8">
            <input type="text" name="contact" class="form-control-lg" value="<?php echo $airportData['contact'] ?>" required inputmode="text">
          </div>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
        <input type="submit" class="btn btn-lg btn-outline-primary" name="update" value="update" />
        <input type="reset" class="btn btn-lg btn-outline-danger" value="cancel" />
        <button type="submit" class="btn btn-lg btn-danger" name="delete" value="delete">Delete</button>
      </form>
    </div>
  </div>
</section>

<?php
require('../../inc/footer.php');
?>