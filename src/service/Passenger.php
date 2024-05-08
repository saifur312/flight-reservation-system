<?php
include_once __DIR__ . "/../db/database.php";
include_once __DIR__ . "/../service/Booking.php";
include_once __DIR__ . "/../service/Ticket.php";
// include "./Booking.php";

class Passenger
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }


  public function savePassenger($formData)
  {
    //print_r($formData);
    $passengerId = $formData['passengerId'];
    $flightId = $formData['flightId'];
    $userId = $formData['userId'];
    $firstName = $formData['firstName'];
    $lastName = $formData['lastName'];
    $nationality = $formData['nationality'];
    $passport = $formData['passport'];
    $email = $formData['email'];
    $contact = $formData['contact'];
    
    $savedPassenger = array();

    if (empty($passengerId)) {
      // Handle the case where $passengerId is empty or null
      $insertQuery = "INSERT into passenger(user_id, first_name, last_name, nationality, passport, email, contact) 
                      values ('$userId', '$firstName', '$lastName', '$nationality', '$passport', '$email', '$contact')";
      $savedPassengerId = $this->db->create($insertQuery);

    if ($savedPassengerId) {
      // Retrieve the last inserted ID
      //$passengerId = $this->db->connection->insert_id;
      $savedPassenger = $this->fetchPassenger($savedPassengerId)->fetch_assoc();
      // print_r($savedPassenger);
      // print_r($savedPassenger['id']);
      // insert data into booking table

      //add passenger Id into $formData
      $formData["passengerId"] = $savedPassenger['id'];

      // $booking = new Booking();
      // $bookingData = array(
      //   "userId" => $userId,
      //   "flightId" => $flightId,
      //   "passengerId" => $savedPassenger['id']
      // );
      // //print_r($bookingData);
      // $savedBooking = $booking->saveBooking($bookingData);
      // return array_merge($savedPassenger, $savedBooking);

      
    } 
    } else {
        $passengerId = (int) $passengerId; // Now it's an integer
        //var_dump($passengerId); // Outputs: int(1)
        //update passenger Id String into int
        $formData["passengerId"] = $passengerId;
    }
    //save ticket
    $ticket = new Ticket();
    $savedTicket = $ticket->saveTicket($formData);

    return array_merge($savedPassenger, $savedTicket);

  }

  public function fetchPassengers()
  {
    $selectQuery = "select * from passenger";
    $passengers = $this->db->select($selectQuery);
    if ($passengers)
      return $passengers;
    else
      return array(); //return empty array
  }

  public function fetchPassenger($id)
  {
    $selectQuery = "select * from passenger where id=$id";
    $passenger = $this->db->select($selectQuery);
    if ($passenger)
      return $passenger;
    else
      return null;
  }

  public function fetchPassengerByUserId($userId)
  {
    $selectQuery = "select * from passenger where user_id=$userId";
    $passenger = $this->db->select($selectQuery);
    if ($passenger)
      return $passenger;
    else
      return null;
  }


  public function updatePassenger($formData)
  {
    //print_r($formData);
    $id = $formData['id'];
    $userId = $formData['userId'];
    $firstName = $formData['firstName'];
    $lastName = $formData['lastName'];
    $nationality = $formData['nationality'];
    $passport = $formData['passport'];
    $email = $formData['email'];
    $contact = $formData['contact'];

    $updateQuery = "UPDATE passenger SET 
      user_id = '$userId', 
      first_name = '$firstName', 
      last_name = '$lastName', 
      nationality = '$nationality', 
      passport = '$passport',
      email = '$email',
      contact = '$contact'
      WHERE id = $id";

    $updatedData = $this->db->create($updateQuery);

    // if ($updatedData) {
    //   header("refresh:2; url=passengers.php");
    //   echo "
    //   <div class='alert alert-success alert-dismissible fade show' role='alert'> 
    //     Passenger updated successfully..!! 
    //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    //     </button>
    //   </div>";
    //   exit();
    // } else {
    //   echo "
    //   <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
    //     Fail to update passenger...!! Plz fill up all fields carefully.
    //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    //     </button>
    //   </div>";
    // }
  }

  // public function deletePassenger($id)
  // {
  //   $deleteQuery = "DELETE FROM passenger where id= $id";

  //   $this->db->delete($deleteQuery);

  //   header("refresh:2; url=passengers.php");
  //   echo "
  //     <div class='alert alert-success alert-dismissible fade show' role='alert'> 
  //       Passenger deleted successfully..!! 
  //       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
  //       </button>
  //     </div>";
  //   exit();
  // }
}
