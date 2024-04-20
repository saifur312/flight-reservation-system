<?php
include_once __DIR__ . "/../db/database.php";

class Booking
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }


  public function saveBooking($formData)
  {
    //print_r($formData);

    $userId = $formData['userId'];
    $flightId = $formData['flightId'];
    $passengerId = $formData['passengerId'];

    $insertQuery = "INSERT into booking(flight_id, user_id, passenger_id) 
                      values ('$flightId', '$userId', '$passengerId')";

    $savedData = $this->db->create($insertQuery);

    if ($savedData) {
      // Retrieve the last inserted ID
      //$bookingId = $this->db->connection->insert_id;
      $savedBooking = $this->fetchBooking($savedData)->fetch_assoc();
      return $savedBooking;
    } else {
      return null;
    }
  }

  public function fetchBookings()
  {
    $selectQuery = "select * from booking";
    $bookings = $this->db->select($selectQuery);
    if ($bookings)
      return $bookings;
    else
      return array(); //return empty array
  }

  public function fetchBooking($id)
  {
    $selectQuery = "select * from booking where id=$id";
    $booking = $this->db->select($selectQuery);
    if ($booking)
      return $booking;
    else
      return null;
  }

  public function fetchBookingByUserId($userId)
  {
    $selectQuery = "select * from booking where user_id=$userId";
    $booking = $this->db->select($selectQuery);
    if ($booking)
      return $booking;
    else
      return null;
  }


  public function updateBooking($formData)
  {
    //print_r($formData);

    $id = $formData['id'];
    $userId = $formData['userId'];
    $flightId = $formData['flightId'];
    $passengerId = $formData['passengerId'];

    $updateQuery = "UPDATE booking SET 
      user_id = '$userId', 
      flight_id = '$flightId', 
      passenger_id = '$passengerId'
      WHERE id = $id";

    $updatedData = $this->db->create($updateQuery);

    // if ($updatedData) {
    //   header("refresh:2; url=bookings.php");
    //   echo "
    //   <div class='alert alert-success alert-dismissible fade show' role='alert'> 
    //     Booking updated successfully..!! 
    //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    //     </button>
    //   </div>";
    //   exit();
    // } else {
    //   echo "
    //   <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
    //     Fail to update booking...!! Plz fill up all fields carefully.
    //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    //     </button>
    //   </div>";
    // }
  }

  // public function deleteBooking($id)
  // {
  //   $deleteQuery = "DELETE FROM booking where id= $id";

  //   $this->db->delete($deleteQuery);

  //   header("refresh:2; url=bookings.php");
  //   echo "
  //     <div class='alert alert-success alert-dismissible fade show' role='alert'> 
  //       Booking deleted successfully..!! 
  //       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
  //       </button>
  //     </div>";
  //   exit();
  // }
}
