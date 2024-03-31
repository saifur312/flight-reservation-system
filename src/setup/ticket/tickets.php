<?php
require('../../inc/header.php');
include __DIR__ . "/../../service/Ticket.php";

$ticket = new Ticket();
$tickets = $ticket->fetchTickets();

//print_r($tickets->fetch_assoc());

?>

<section class="mt-4">

  <!-- <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/ticket/add-ticket.php">Add New</a> -->
  <table class="table mt-4">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Ticket Id</th>
        <th scope="col">Flight Id</th>
        <th scope="col">User Id</th>
        <th scope="col">Adult</th>
        <th scope="col">Child</th>
        <th scope="col">Seat No</th>
        <th scope="col">Amount</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($tickets) {
        $count = 1;
        while ($ticket = $tickets->fetch_assoc()) {
      ?>
          <tr>
            <th>
              <?php
              echo $count;
              ?>
            </th>
            <th> <?php echo $ticket['id']; ?> </th>
            <td> <?php echo $ticket['flight_id']; ?> </td>
            <td> <?php echo $ticket['user_id']; ?> </td>
            <td> <?php echo $ticket['adult']; ?> </td>
            <td> <?php echo $ticket['child']; ?> </td>
            <td> <?php echo $ticket['seat_no']; ?> </td>
            <td> <?php echo $ticket['amount']; ?> </td>
            <td>
              <a href="ticket-details.php?id=<?php echo urlencode($ticket['id']); ?>">
                More
            </td>
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