<?php

/* 
  include config.php and database.php file 
  */
include "./../inc/header.php";

/* if include not working then do this */
//require(__DIR__ . '/../inc/header.php');
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../db/database.php');

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
  if ($username == '' || $pass == '' || $role == '')
    echo "<h3 style='color:red'>Fields should not be empty..!!! </h3>";
  else {

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
}

?>


<!-- 
  write some html code to show table 
-->
<section class="container text-center">
  <div class="row justify-content-center">
    <form action="" method="post" class="col-6 mt-4">
      <div class="row align-items-center mb-4">
        <div class="col-4">
          <label for="username" class="col-form-label">Username</label>
        </div>
        <div class="col-8">
          <input type="text" name="username" class="form-control-lg" placeholder="name/email" inputmode="text">
        </div>
      </div>
      <div class="row align-items-center mb-4">
        <div class="col-4">
          <label for="password" class="col-form-label">Password</label>
        </div>
        <div class="col-8">
          <input type="text" name="password" class="form-control-lg" placeholder="8 or more characters">
        </div>
      </div>
      <div class="row align-items-center mb-4">
        <div class="col-4">
          <label for="role" class="col-form-label">Role</label>
        </div>
        <div class="col-8">
          <input type="text" name="role" class="form-control-lg">
        </div>
      </div>
      <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
      <input type="submit" class="btn btn-lg btn-primary" name="submit" value="submit" />
      <input type="reset" class="btn btn-lg btn-danger" value="Cancel" />
    </form>
  </div>
</section>

<?php
require(__DIR__ . '/../inc/footer.php');
?>