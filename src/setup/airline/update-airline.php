<?php

include "../../inc/header.php";
include '../../service/Airline.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$airlineId = $_GET['id'];
$airline = new Airline();

$airlineData = $airline->fetchAirline($airlineId);

if (!$airlineData) {
  header("refresh:3; url=airlines.php");
  echo
  "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
    Sorry... :( No airline found..!!!.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    </button>
  </div>";
  exit(); // Make sure to stop script execution after redirection
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  //print_r($_POST);
  $airline->updateAirline($_POST);
}


if (isset($_POST['delete'])) {
  // echo <<<HTML
  //   <h1> </h1>
  // HTML;
  $airline->deleteAirline($_POST['id']);
}

?>

<section class="container text-center">
  <div class="row justify-content-center ">
    <div class="col-6 card mt-4">
      <form action="update-airline.php?id=<?php echo urlencode($airlineId); ?>" method="post" class="mt-4 card-body">

        <input type="hidden" name="id" value="<?php echo $airlineData['id'] ?>" />

        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="name" class="col-form-label">Name</label>
          </div>
          <div class="col-8">
            <input type="text" name="name" class="form-control-lg" value="<?php echo $airlineData['name'] ?>" required inputmode="text" />
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="code" class="col-form-label">Total Seats</label>
          </div>
          <div class="col-8">
            <input type="text" name="seats" class="form-control-lg" value="<?php echo $airlineData['seats'] ?>" required inputmode="text">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="contact" class="col-form-label">Contact</label>
          </div>
          <div class="col-8">
            <input type="text" name="contact" class="form-control-lg" value="<?php echo $airlineData['contact'] ?>" required inputmode="text">
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