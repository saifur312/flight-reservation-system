<?php

/* 
  include config.php and database.php file 
  */
include "./../inc/header.php";
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../db/database.php');

?>



<?php
/** 
 * create an obj of Database class to access its members
 * and store it into variable $db 
 */
$db = new Database();

$id = $_GET['id'];
//echo "id=$id";
$sqlFindUser = "SELECT * FROM user where user.id=$id";
$userData = $db->select($sqlFindUser)->fetch_assoc();
//var_dump($userData);
//echo $userData['name'];
/** 
 * code for when update button is clicked 
 */
if (isset($_POST['update'])) {
  $username = mysqli_real_escape_string($db->connection, $_POST['username']);
  $password = mysqli_real_escape_string($db->connection, $_POST['password']);
  $email = mysqli_real_escape_string($db->connection, $_POST['email']);
  //echo "updated fields: $username  $password  $email";

  if ($username == '' || $password == '' || $email == '')
    echo "<h3 style='color:red'>Fields should not be empty..!!! </h3>";
  else {
    $updateQuery = "UPDATE user SET
     username = '$username', 
     password = '$password', 
     email = '$email'
     WHERE id = $id";

    //echo $updateQuery;
    $updatedData = $db->update($updateQuery);
  }
}

if (isset($_POST['delete'])) {
  $deleteQuery = "DELETE FROM user where id= $id";
  $db->delete($deleteQuery);
  header('Location: users.php');
}

?>


<body>
  <div class="main-container d-flex">
    <?php
    include_once "../inc/sidebar.php";
    ?>
    <div class="content text-center">
      <?php
      include_once "../inc/navbar.php";
      ?>

      <div class="dashboard-content px-3 pt-4">
        <h2 class="fs-5">Update User</h2>

        <section class="container text-center">
          <div class="row justify-content-center">
            <form action="update.php?id=<?php echo urlencode($id); ?>" method="post" class="col-6 mt-4">
              <div class="row align-items-center mb-4">
                <div class="col-4">
                  <label for="username" class="col-form-label">Username</label>
                </div>
                <div class="col-8">
                  <input type="text" name="username" class="form-control-lg" inputmode="text" value="<?php echo $userData['username'] ?>" required>
                </div>
              </div>
              <div class="row align-items-center mb-4">
                <div class="col-4">
                  <label for="password" class="col-form-label">Password</label>
                </div>
                <div class="col-8">
                  <input type="text" name="password" class="form-control-lg" value="<?php echo $userData['password'] ?>" required>
                </div>
              </div>
              <div class="row align-items-center mb-4">
                <div class="col-4">
                  <label for="email" class="col-form-label">Email</label>
                </div>
                <div class="col-8">
                  <input type="email" name="email" class="form-control-lg" value="<?php echo $userData['email'] ?>" required>
                </div>
              </div>

              <input type="submit" class="btn btn-lg btn-success" name="update" value="update" />
              <a href="users.php" class="btn btn-lg btn-warning" >Cancel</a>
              <button type="submit" class="btn btn-lg btn-danger" name="delete" value="delete">Delete</button>
            </form>
          </div>
        </section>

      </div>
    </div>
  </div>

<?php
require(__DIR__ . '/../inc/footer-scripts.php');
?>

</body>

</html>