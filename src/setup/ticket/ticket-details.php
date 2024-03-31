<?php
require('../../inc/header.php');
include __DIR__ . "/../../service/User.php";
include __DIR__ . "/../../service/Flight.php";
include __DIR__ . "/../../service/Ticket.php";

$ticketId = $_GET['id'];

$t = new Ticket();
$ticket = $t->fetchTicket($ticketId);
$ticket = $ticket->fetch_assoc();

//print_r($ticket->fetch_assoc());

/** get Flight Info */
$f = new Flight();
$flightId = $ticket['flight_id'];
$flight = $f->fetchFlight($flightId);
print_r($flight->fetch_assoc());
/** get User Info */
$u = new User();
$user = $u->fetchUser($ticket['user_id']);
print_r($user);
?>

<section class="mt-4">

  <!-- <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/ticket/add-ticket.php">Add New</a> -->
  <table class="table text-start">
    <tr>
      <th> Flight Details</th>
    </tr>
    <tr>
      <th> Passenger Details</th>
    </tr>
    <tr>
      <th> Payment Details</th>
    </tr>
  </table>

</section>

<?php
require('../../inc/footer.php');
?>