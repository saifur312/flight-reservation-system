<?php
include "../../inc/header.php";

if (isset($_POST['submit'])) {
}

?>

<section class="container text-center">
  <div class="row justify-content-center ">
    <div class="col-6 card mt-4">
      <form action="" method="post" class="mt-4 card-body">
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="name" class="col-form-label">Name</label>
          </div>
          <div class="col-8">
            <input type="text" name="name" class="form-control-lg" placeholder="Chittagong Int. Airport" inputmode="text">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="code" class="col-form-label">Code</label>
          </div>
          <div class="col-8">
            <input type="text" name="code" class="form-control-lg" placeholder="CHI">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="country" class="col-form-label">Country</label>
          </div>
          <div class="col-8">
            <input type="text" name="country" class="form-control-lg" placeholder="Bangladesh">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="city" class="col-form-label">City</label>
          </div>
          <div class="col-8">
            <input type="text" name="city" class="form-control-lg" placeholder="Chittagong">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="contact" class="col-form-label">Help Line</label>
          </div>
          <div class="col-8">
            <input type="text" name="contact" class="form-control-lg" placeholder="+880146774">
          </div>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
        <input type="submit" class="btn btn-lg btn-outline-primary" name="submit" value="submit" />
        <input type="reset" class="btn btn-lg btn-outline-danger" value="Cancel" />
      </form>
    </div>
  </div>
</section>

<?php
require('../../inc/footer.php');
?>