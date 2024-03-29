<?php
require('../../inc/header.php');
include __DIR__ . "/../../service/Airport.php";

$airport = new Airport();
$airports = $airport->fetchAirports();

?>

<section class="mt-4">

  <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/airport/add-airport.php">Add New</a>
  <table class="table mt-4">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Code</th>
        <th scope="col">Country</th>
        <th scope="col">City</th>
        <th scope="col">Contact</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($airports) {
        $count = 1;
        while ($airport = $airports->fetch_assoc()) {
      ?>
          <tr>
            <td>
              <?php
              echo $count;
              ?>
            </td>
            <td> <?php echo $airport['id']; ?> </td>
            <td> <?php echo $airport['name']; ?> </td>
            <td> <?php echo $airport['code']; ?> </td>
            <td> <?php echo $airport['country']; ?> </td>
            <td> <?php echo $airport['city']; ?> </td>
            <td> <?php echo $airport['contact']; ?> </td>
            <td> <a href="update-airport.php?id=<?php echo urlencode($airport['id']); ?>">
                Edit</td>
            <td> <a href="update-airport.php?id=<?php echo urlencode($airport['id']); ?>">
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