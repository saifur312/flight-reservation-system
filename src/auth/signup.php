<?php

/* 
  include config.php and database.php file 
  */
//include "./../inc/header.php";

/* if include not working then do this */
//require(__DIR__ . '/../inc/header.php');
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../db/database.php');
require_once(__DIR__ . '/../service/User.php');

?>



<?php

/** 
 * If we write put values without quote '' inside query 
 * then it will show following error
 * Fatal error: Uncaught mysqli_sql_exception: 
 * Unknown column 'first_column_value' in 'field list' 
 *** 
 * $insertQuery = "INSERT INTO user(username, password, role) 
 * VALUES($username, $pass, $role)"; 
 */
/** 
 * create an obj of Database class to access its members
 * and store it into variable $db 
 */
$db = new Database();
$user = new User();
$validateMessage = null;

if (isset($_POST['submit'])) {
  $validateMessage = $user->validateSignupForm($_POST);
  //echo $validateMessage;
  if($validateMessage != null){
    //echo "<h3 style='color:red'> $validateMessage </h3>";
  }
  else {
    $insertedData = $user->userSignup($_POST);
    //var_dump($insertedData);
    if ($insertedData) {
      echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Registration successful..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
      header("refresh:4; url=login.php");
    }
  }
}

?>


<!-- 
  write some html code to show table 
-->

<?php include "../inc/header.php"; ?>

<body>
  <!-- navbar -->
  <div id="navbar" class="container-fluid">
    <?php
    include "../inc/navbar.php";
    ?>
  </div>
  <section class="container text-center mb-4">
    <div class="row justify-content-center ">
      <div class="card col-lg-6 mt-4">
        <form action="" method="post" class="mt-4 card-body row">
          <?php 
          if($validateMessage != null){
            echo <<<HTML
            <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
              $validateMessage
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
              </button>
            </div>
            HTML;
        }
          ?>

            <div class="row align-items-center mb-4">
              <div class="col-4">
                <label for="username" class="col-form-label">Username</label>
              </div>
              <div class="col-8">
                <input type="text" name="username" class="form-control-lg" placeholder="name/email" inputmode="text" required>
              </div>
            </div>

            <div class="row align-items-center mb-4">
              <div class="col-4">
                <label for="username" class="col-form-label">Email</label>
              </div>
              <div class="col-8">
                <input type="email" name="email" class="form-control-lg" placeholder="email" inputmode="text" required>
              </div>
            </div>

            <div class="row align-items-center mb-4">
              <div class="col-4">
                <label for="password" class="col-form-label">Password</label>
              </div>
              <div class="col-8">
                <input type="text" id="password" name="password" class="form-control-lg" placeholder="8 or more characters" required>
              </div>
            </div>

            <div class="row align-items-center mb-4">
              <div class="col-4">
                <label for="password" class="col-form-label">Confirm Password</label>
              </div>
              <div class="col-8">
                <input type="text" id="confirmPassword" name="confirmPassword" class="form-control-lg" placeholder="8 or more characters" required>
              </div>
            </div>

            <div class="col-lg-12 mt-4">
              <input type="submit" class="btn btn-lg btn-outline-primary col-lg-4" name="submit" value="submit" />
              <input type="reset" class="btn btn-lg btn-outline-danger col-lg-4" value="Cancel" />
            </div>


          <!-- <div class="col-lg-6">
          <div class="row align-items-center mb-4">
            <div class="col-4">
              <label for="username" class="col-form-label">First Name</label>
            </div>
            <div class="col-8">
              <input type="text" name="username" class="form-control-lg" placeholder="name/email" inputmode="text">
            </div>
          </div>

          <div class="row align-items-center mb-4">
            <div class="col-4">
              <label for="password" class="col-form-label">Last Name</label>
            </div>
            <div class="col-8">
              <input type="text" name="password" class="form-control-lg" placeholder="8 or more characters">
            </div>
          </div>

          <div class="row align-items-center mb-4">
            <div class="col-4">
              <label for="role" class="col-form-label">Passport</label>
            </div>
            <div class="col-8">
              <input type="text" name="role" class="form-control-lg">
            </div>
          </div>

          <div class="row align-items-center mb-4">
            <div class="col-4">
              <label for="password" class="col-form-label">Contact</label>
            </div>
            <div class="col-8">
              <input type="text" name="password" class="form-control-lg" placeholder="8 or more characters">
            </div>
          </div>

          <div class="row align-items-center mb-4">
            <div class="col-4">
              <label for="role" class="col-form-label">Address</label>
            </div>
            <div class="col-8">
              <input type="text" name="role" class="form-control-lg">
            </div>
          </div>

        </div> -->
        </form>
      </div>
    </div>
  </section>

  <?php
  require(__DIR__ . '/../inc/footer.php');
  ?>

</body>

</html>