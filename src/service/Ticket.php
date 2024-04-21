<?php
include_once __DIR__ . "/../db/database.php";

class Ticket
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function bookTicket($formData)
  {
    header("refresh:1; url=payment.php");
    echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Ticket booked successful..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
  }


  public function saveTicket($formData)
  {
    //print_r($formData);

    $flightId = $formData['flightId'];
    $userId = $formData['userId'];
    $passengerId = $formData['passengerId'];
    $adult = $formData['adult'];
    $child = $formData['child'];
    $class = $formData['class'];
    //$seatNo = $formData['seatNo'];
    $amount = $formData['amount'];

    // $insertQuery = "INSERT into ticket(flight_id, user_id, adult, child, class, seat_no, amount, created_on) values ('$flightId', '$userId', '$adult', '$child', '$class', '', '$amount', NOW())";

    $insertQuery = "INSERT into ticket(flight_id, user_id, passenger_id, adult, child, class, amount) values ('$flightId', '$userId', '$passengerId', '$adult', '$child', '$class', '$amount')";


    $savedTicketId = $this->db->create($insertQuery);

    if ($savedTicketId) {
      $savedTicket = $this->fetchTicket($savedTicketId)->fetch_assoc();
      return $savedTicket;
    } else {
      return null;
    }
  }

  public function fetchTickets()
  {
    $selectQuery = "select * from ticket";
    $tickets = $this->db->select($selectQuery);
    if ($tickets)
      return $tickets;
    else
      return array(); //return empty array
  }

  public function fetchTicket($id)
  {
    $selectQuery = "select * from ticket where id=$id";
    $ticket = $this->db->select($selectQuery);
    if ($ticket)
      return $ticket;
    else
      return null;
  }

  public function fetchBookinsByUserId($userId)
  {
    $selectQuery = "
    SELECT * FROM ticket WHERE user_id= $userId AND paid=false AND active=true AND hold=true";
    $tickets = $this->db->select($selectQuery);
    if ($tickets)
      return $tickets;
    else
      return null;
  }

  public function fetchTicketsByUserId($userId)
  {
    $selectQuery = "
    SELECT * FROM ticket WHERE user_id= $userId AND paid=true AND active=true AND hold=false";
    $tickets = $this->db->select($selectQuery);
    if ($tickets)
      return $tickets;
    else
      return null;
  }

  // public function filterTickets($src, $dst, $dep, $ret)
  // {

  //   $selectQuery = "SELECT * FROM ticket WHERE 
  //     flightId LIKE '$src' AND 
  //     userId LIKE '$dst' AND 
  //     Date(adult) = '$dep'";

  //   $tickets = $this->db->select($selectQuery);
  //   //print_r($tickets);
  //   if ($tickets)
  //     return $tickets;
  //   else
  //     return false;
  // }

  public function updateTicket($formData)
  {
    print_r($formData);
    $id = $formData['id'];
    $payment_id = $formData['payment_id'];
    $paid = $formData['paid'];
    $hold = $formData['hold'];
    $adult = $formData['adult'];
    $active = $formData['active'];
    $class = $formData['class'];
    //$seatNo = $formData['seatNo'];
    $amount = $formData['amount'];

    $updateQuery = "UPDATE ticket SET 
      adult = '$adult', 
      class = '$class',
      amount = '$amount',
      paid = '$paid',
      hold = '$hold', 
      payment_id = '$payment_id', 
      active = '$active'
      WHERE id = $id";

    // UPDATE ticket SET 
    // adult = 1, 
    // class = 'Economy',
    // amount = 0,
    // paid = true,
    // hold = 0, 
    // payment_id = 5, 
    // active = 1
    // WHERE id = 10001;

    $updatedData = $this->db->update($updateQuery);
    if ($updatedData) {
      return $updatedData;
    }
    // if ($updatedData) {
    //   header("refresh:2; url=tickets.php");
    //   echo "
    //   <div class='alert alert-success alert-dismissible fade show' role='alert'> 
    //     Ticket updated successfully..!! 
    //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    //     </button>
    //   </div>";
    //   exit();
    // } else {
    //   echo "
    //   <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
    //     Fail to update ticket...!! Plz fill up all fields carefully.
    //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    //     </button>
    //   </div>";
    // }
  }

  public function deleteTicket($id)
  {
    $deleteQuery = "DELETE FROM ticket where id= $id";

    $this->db->delete($deleteQuery);

    //header("Location: tickets.php");
    header("refresh:2; url=tickets.php");
    echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Ticket deleted successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    exit();
  }
}
