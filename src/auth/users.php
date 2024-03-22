<?php

/**
 * include config.php and database.php file 
 */

// include '/../../config.php';
// include '/../db/database.php';

/* if include not working then do this */
require(__DIR__ . '/../inc/header.php');
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../db/database.php');

?>



<?php
/** 
 * create an obj of Database class to access its members
 *  and store it into varaiable $db 
 */
$db = new Database();

/** 
 * write query that we want to execute here we write select query 
 */
$query = 'SELECT * FROM user';

/** 
 * call read() method to execute query and stores the result into var
 */
$data = $db->select($query);
//echo "<h3> $data </h3>";
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
  <table class="table">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Id</th>
        <th scope="col">Username</th>
        <th scope="col">Password</th>
        <th scope="col">Role</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($data) {
        $count = 1;
        while ($row = $data->fetch_assoc()) {
      ?>
          <tr>
            <th>
              <?php
              /* echo array_search(
                $row,
                array_keys($data->fetch_assoc())
              ); */
              echo $count;
              ?>
            </th>
            <th> <?php echo $row['id']; ?> </th>
            <td> <?php echo $row['username']; ?> </td>
            <td> <?php echo $row['password']; ?> </td>
            <td> <?php echo $row['role']; ?> </td>
            <td> <a href="update.php?id=<?php echo urlencode($row['id']); ?>">
                Edit</td>
            <td> <a href="update.php?id=<?php echo urlencode($row['id']); ?>">
                Delete</td>
          </tr>
      <?php
          $count++;
        }
      }
      ?>
    </tbody>
  </table>
</section>

<?php
require(__DIR__ . '/../inc/footer.php');
?>