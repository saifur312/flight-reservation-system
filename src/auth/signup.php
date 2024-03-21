<?php

/* 
  include config.php and database.php file 
  */

// include '/../../config.php';
// include '/../db/database.php';

/* if include not working then do this */
require(__DIR__ . '/../inc/header.php');
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../db/database.php');

//require_once(__DIR__ . '/../libs/bootstrap-5.3.3-dist/bootstrap.css');

?>



<?php
/** 
 * create an obj of Database class to access its members
 * and store it into variable $db 
 */
$db = new Database();

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($db->connection, $_POST['username']);
  $pass = mysqli_real_escape_string($db->connection, $_POST['password']);
  $role = mysqli_real_escape_string($db->connection, $_POST['role']);

  //echo $username . "  " . $pass . "   " . $role;

  /** 
   * writing insert query that we want to execute 
   */

  /** 
   * If we write put values without quote '' inside query 
   * then it will show following error
   * Fatal error: Uncaught mysqli_sql_exception: 
   * Unknown column 'first_column_value' in 'field list' 
   *** 
   * $insertQuery = "INSERT INTO user(username, password, role) 
   * VALUES($username, $pass, $role)"; 
   */

  $insertQuery = "INSERT INTO user(username, password, role) 
    VALUES('$username', '$pass', '$role')";


  /** 
   * call insert() method to execute query and stores the result into var
   */
  $insertedData = $db->create($insertQuery);
}

?>

<?php
/* if ($data) {
  while ($row = $data->fetch_assoc()) {
    echo $row['id'];
    echo $row['username'];
    echo $row['password'];
    echo $row['role'];
  }
} else echo "<h3 style='color: red'> No data available in the table..!! <br> Insert data into table </h3>"; */

?>

<!-- 
  write some html code to show table 
-->
<section>
  <form action="" method="post">
    <div class="row align-items-center mb-4">
      <div class="col-auto">
        <label for="username" class="col-form-label">Username</label>
      </div>
      <div class="col-auto">
        <input type="text" name="username" class="form-control-lg" placeholder="name/email">
      </div>
      <!-- <div class="col-auto">
        <span name="usernameHelpInline" class="form-text">
          name/email.
        </span>
      </div> -->
    </div>
    <div class="row align-items-center mb-4">
      <div class="col-auto">
        <label for="password" class="col-form-label">Password</label>
      </div>
      <div class="col-auto">
        <input type="text" name="password" class="form-control-lg" placeholder="8 or more characters">
      </div>
    </div>
    <div class="row align-items-center mb-4">
      <div class="col-auto">
        <label for="role" class="col-form-label">Role</label>
      </div>
      <div class="col-auto">
        <input type="text" name="role" class="form-control-lg">
      </div>
    </div>
    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
    <input type="submit" class="btn btn-primary" name="submit" value="submit" />
  </form>
</section>

<?php
require(__DIR__ . '/../inc/footer.php');
?>



<!-- root 
 -public 
 -src 
   -auth 
     -signup.php
 -config.php -->