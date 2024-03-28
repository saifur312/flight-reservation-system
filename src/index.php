<?php

//include __DIR__ . '/inc/header.php';

include "./inc/header.php";
//include __DIR__ . "/service/Session.php";
//Session::init();
//Session::checkSession();

$loginmsg = Session::get('loginmsg');
$username = Session::get('username');
if (isset($loginmsg)) {
  echo $loginmsg;
}
Session::set('loginmsg', NULL);

echo "<h2>Welcome $username </h2>";

?>


<section class="container text-center">
  <div class="row justify-content-center ">
    <div class="col-6 card mt-4">
      <form action="" method="post" class="mt-4 card-body">
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="username" class="col-form-label">Departure Airport </label>
          </div>
          <div class="col-8">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg ">
              <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="password" class="col-form-label">Arival Airport</label>
          </div>
          <div class="col-8">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg ">
              <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="role" class="col-form-label">Departure</label>
          </div>
          <div class="col-8">
            <input type="datetime-local" name="role" class="form-control-lg">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="role" class="col-form-label">Return</label>
          </div>
          <div class="col-8">
            <input type="date" name="role" class="form-control-lg">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="role" class="col-form-label">Class</label>
          </div>
          <div class="col-8">
            <input type="text" name="role" class="form-control-lg">
          </div>
        </div>
        <div class="row align-items-center mb-4">
          <div class="col-4">
            <label for="role" class="col-form-label">Passenger</label>
          </div>
          <div class="col-8">
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