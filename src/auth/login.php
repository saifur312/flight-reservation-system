<?php
// include "./../inc/header.php";
require_once(__DIR__ . '/../../config.php');
//require_once(__DIR__ . '/../db/database.php');
include_once __DIR__ . '/../service/Session.php';
include "../service/User.php";

//Session::checkSession();
$loginMessege = null;
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  //echo "Yaaah login posted";
  $userLogin = $user->userLogin($_POST);

  if ($userLogin != null) {
    $username = Session::get('username');
    if ($username == 'admin')
      header("Location: ../../src/admin.php");
    else
      header("Location: ../../src/index.php");
  }
  else{
    $loginMessege = 'Invalid Username or password ';
  }
}

?>

<?php include "../inc/header.php"; ?>


<body class="text-center">
  <!-- navbar -->
  <div id="navbar" class="container-fluid">
    <?php
    include "../inc/navbar.php";
    ?>
  </div>

  <section class="container text-center mb-4">
    <div class="row card mt-4  ">
      <div class="row col-lg-12 mt-4 card-body">
        <div class="col-lg-6 mt-4">
          <span>
            <img src="../../public/images/logo.png" class="logo" />
          </span>
          <h2>Login to safely fly with us</h2>
        </div>
        <div class="col-lg-5 mt-4">

          <?php 
            if($loginMessege != null){
              echo <<<HTML
              <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
                $loginMessege
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                </button>
              </div>
              HTML;
          }
          ?>
          <form action="" method="post" class="mt-4 ">
            <div class="row align-items-center mb-4">
              <div class="col-4">
                <label for="username" class="col-form-label">Username</label>
              </div>
              <div class="col-8">
                <input type="text" name="username" class="form-control-lg" inputmode="text">
              </div>
            </div>
            <div class="row align-items-center mb-4">
              <div class="col-4">
                <label for="password" class="col-form-label">Password</label>
              </div>
              <div class="col-8">
                <input type="text" name="password" class="form-control-lg">
              </div>
            </div>
            <div class="row align-items-center justify-content-end mb-4">
              <input type="submit" class="col-6 btn btn-lg btn-outline-primary" name="login" value="login" />
              <!-- <input type="reset" class="btn btn-lg btn-outline-danger" value="Cancel" /> -->
            </div>
          </form>
        </div>
      </div>
  </section>

  <?php
  include "./../inc/footer.php";
  ?>

</body>

</html>