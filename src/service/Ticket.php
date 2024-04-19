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
    $adult = $formData['adult'];
    $child = $formData['child'];
    $class = $formData['class'];
    $seatNo = $formData['seatNo'];
    $amount = $formData['amount'];

    // $insertQuery = "INSERT into ticket(flight_id, user_id, adult, child, class, seat_no, amount, created_on) values ('$flightId', '$userId', '$adult', '$child', '$class', '', '$amount', NOW())";

    $insertQuery = "INSERT into ticket(flight_id, user_id, adult, child, class, seat_no, amount) values ('$flightId', '$userId', '$adult', '$child', '$class', '$seatNo', '$amount')";


    $savedData = $this->db->create($insertQuery);

    if ($savedData) {
      header("refresh:2; url=tickets.php");
      echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Ticket purchase successful..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
      exit();
    } else {
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Fail to purchase ticket...!! Plz fill up all fields carefully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
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
    //print_r($formData);
    $id = $formData['id'];
    $flightId = $formData['flightId'];
    $userId = $formData['userId'];
    $adult = $formData['adult'];
    $child = $formData['child'];
    $class = $formData['class'];
    $seatNo = $formData['seatNo'];
    $amount = $formData['amount'];

    $updateQuery = "UPDATE ticket SET 
      flightId = '$flightId', 
      userId = '$userId', 
      adult = '$adult', 
      child = '$child', 
      class = '$class',
      seatNo = '$seatNo',
      amount = '$amount'
      WHERE id = $id";

    $updatedData = $this->db->create($updateQuery);

    if ($updatedData) {
      header("refresh:2; url=tickets.php");
      echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Ticket updated successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
      exit();
    } else {
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Fail to update ticket...!! Plz fill up all fields carefully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    }
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
