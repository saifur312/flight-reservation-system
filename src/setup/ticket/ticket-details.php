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
$flight = $f->fetchFlight($flightId)->fetch_assoc();
//print_r($flight);

/** get User Info */
$u = new User();
$user = $u->fetchUser($ticket['user_id']);
//print_r($user);


$departure_time = date('Y-m-d h:i A', strtotime($flight['departure']));
$arrival_time = date('Y-m-d h:i A', strtotime($flight['arrival']));
$purchase_date = date('Y-m-d h:i A', strtotime($ticket['created_on']));
?>

<section class="row justify-content-center" id="printSection">

  <!-- <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/ticket/add-ticket.php">Add New</a> -->
  <div class="col-lg-12 card mt-4">
    <table class="table text-start ">
      <?php
      echo <<<HTML
      <tr>
        <th colspan="8"> Flight Details</th>
      </tr>
      <tr>
        <td> From </td>
        <th> {$flight['source']} </th>
        <td> To </td>
        <th> {$flight['destination']} </th>
        <td> Departure </td>
        <th> {$departure_time} </th>
        <td> Arrival </td>
        <th> {$arrival_time} </th>
      </tr>
      <tr>
        <td> Flight ID </td>
        <th> {$flight['id']} </th>
        <td> Unit Price </td>
        <th> {$flight['price']} </th>
        <td> Unit Price </td>
        <th> {$flight['airline']} </th>
      </tr>
      <tr>
        <th colspan="8"> Passenger Details</th>
      </tr>
      <tr>
        <td> First Name </td>
        <th> {$user['first_name']} </th>
        <td> Last Name </td>
        <th> {$user['last_name']} </th>
        <td> Email </td>
        <th> {$user['email']} </th>
        <td> Passport </td>
        <th> {$user['passport']} </th>
      </tr>
      <tr>
        <td> Contact </td>
        <th> {$user['contact']} </th>
        <td> Address </td>
        <th> {$user['address']} </th>
      </tr>
      <tr>
        <th colspan="8"> Payment Details</th>
      </tr>
      <tr>
        <td> Purchase Date </td>
        <th> {$purchase_date} </th>
      </tr>
    HTML;
      ?>
    </table>
  </div>

</section>

<button type="button" class="btn btn-lg btn-outline-primary" onclick="printDiv()">Print</button>

<?php
require('../../inc/footer.php');
?>