<?php
include_once __DIR__ . "/../db/database.php";

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

    $userId = $formData['userId'];
    $firstName = $formData['firstName'];
    $lastName = $formData['lastName'];
    $nationality = $formData['nationality'];
    $passport = $formData['passport'];
    $email = $formData['email'];
    $contact = $formData['contact'];

    $insertQuery = "INSERT into passenger(user_id, first_name, last_name, nationality, passport, email, contact) values ('$userId', '$firstName', '$lastName', '$nationality', '$passport', '$email', '$contact')";


    $savedData = $this->db->create($insertQuery);

    // if ($savedData) {
    //   header("refresh:2; url=passengers.php");
    //   echo "
    //   <div class='alert alert-success alert-dismissible fade show' role='alert'> 
    //     Passenger purchase successful..!! 
    //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    //     </button>
    //   </div>";
    //   exit();
    // } else {
    //   echo "
    //   <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
    //     Fail to purchase passenger...!! Plz fill up all fields carefully.
    //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    //     </button>
    //   </div>";
    // }
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
