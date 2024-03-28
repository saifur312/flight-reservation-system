<?php
require('../../inc/header.php');


?>

<section class="mt-4">

  <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/flight/add-flight.php">Add New</a>
  <table class="table mt-4">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Code</th>
        <th scope="col">Country</th>
        <th scope="col">City</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <!-- <tbody>
      <?php
      if ($data) {
        $count = 1;
        while ($row = $data->fetch_assoc()) {
      ?>
          <tr>
            <th>
              <?php
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
    </tbody> -->
  </table>
</section>

<?php
require('../../inc/footer.php');
?>