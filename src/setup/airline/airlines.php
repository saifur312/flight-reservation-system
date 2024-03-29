<?php
require('../../inc/header.php');
include __DIR__ . "/../../service/Airline.php";

$airline = new Airline();
$airlines = $airline->fetchAirlines();

?>

<section class="mt-4">

  <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/airline/add-airline.php">Add New</a>
  <table class="table mt-4">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Total Seats</th>
        <th scope="col">Contact</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($airlines) {
        $count = 1;
        while ($airline = $airlines->fetch_assoc()) {
      ?>
          <tr>
            <td>
              <?php
              echo $count;
              ?>
            </td>
            <td> <?php echo $airline['id']; ?> </td>
            <td> <?php echo $airline['name']; ?> </td>
            <td> <?php echo $airline['seats']; ?> </td>
            <td> <?php echo $airline['contact']; ?> </td>
            <td> <a href="update-airline.php?id=<?php echo urlencode($airline['id']); ?>">
                Edit</td>
            <td> <a href="update-airline.php?id=<?php echo urlencode($airline['id']); ?>">
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
require('../../inc/footer.php');
?>