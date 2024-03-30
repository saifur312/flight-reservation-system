<?php
require('../../inc/header.php');
include __DIR__ . "/../../service/Flight.php";

$flight = new Flight();
$flights = $flight->fetchFlights();

// $flights = $flight->filterFlights(
//   'Sylhet Intl. Airport',
//   'Chittagong Int. Airport',
//   '2024-03-30',
//   '2024-04-01'
// );

//print_r($flights->fetch_assoc());

?>

<section class="mt-4">

  <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/flight/add-flight.php">Add New</a>

  <table class="table mt-4">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Id</th>
        <th scope="col">From</th>
        <th scope="col">To</th>
        <th scope="col">Departure</th>
        <th scope="col">Arrival</th>
        <th scope="col">Price</th>
        <th scope="col">Airline</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($flights) {
        $count = 1;
        // Reset the internal pointer of the result set to the beginning
        //$flights->data_seek(0);
        while ($flight = $flights->fetch_assoc()) {
      ?>
          <tr>
            <th>
              <?php
              echo $count;
              ?>
            </th>
            <th> <?php echo $flight['id']; ?> </th>
            <td> <?php echo $flight['source']; ?> </td>
            <td> <?php echo $flight['destination']; ?> </td>
            <td> <?php echo date('Y-m-d h:i A', strtotime($flight['departure'])); ?> </td>
            <td> <?php echo date('Y-m-d h:i A', strtotime($flight['arrival'])); ?> </td>
            <td> <?php echo $flight['price']; ?> </td>
            <td> <?php echo $flight['airline']; ?> </td>
            <td> <a href="update-flight.php?id=<?php echo urlencode($flight['id']); ?>">
                Edit</td>
            <td> <a href="update-flight.php?id=<?php echo urlencode($flight['id']); ?>">
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