<?php
include __DIR__ . "/../db/database.php";

class Airline
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function saveAirline($formData)
  {
    // print_r('Data submit success ');
    // print_r($formData);

    $name = $formData['name'];
    $seats = $formData['seats'];
    $contact = $formData['contact'];

    $insertQuery = "INSERT into airline(name, seats, contact) values ('$name', '$seats', '$contact')";

    $savedData = $this->db->create($insertQuery);

    if ($savedData) {
      header("refresh:2; url=airlines.php");
      echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Airline saved successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
      exit();
    } else {
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Fail to save airline...!! Plz fill up all fields carefully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    }
  }

  public function fetchAirlines()
  {
    $selectQuery = "select * from airline";
    $airlines = $this->db->select($selectQuery);
    if ($airlines)
      return $airlines;
    else
      return array(); //return empty array
  }

  public function fetchAirline($id)
  {
    $selectQuery = "select * from airline where id=$id";
    $airline = $this->db->select($selectQuery)->fetch_assoc();
    if ($airline)
      return $airline;
    else
      return null;
  }

  public function updateAirline($formData)
  {
    // print_r('Data submit success ');
    //print_r($formData);
    $id = $formData['id'];
    $name = $formData['name'];
    $seats = $formData['seats'];
    $contact = $formData['contact'];

    $updateQuery = "UPDATE airline SET 
      name = '$name', 
      seats = '$seats', 
      contact = '$contact'
      WHERE id = $id";

    $updatedData = $this->db->create($updateQuery);

    if ($updatedData) {
      //header("Location: airlines.php");
      header("refresh:2; url=airlines.php");
      echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Airline updated successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
      exit();
    } else {
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Fail to update airline...!! Plz fill up all fields carefully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    }
  }

  public function deleteAirline($id)
  {
    $deleteQuery = "DELETE FROM airline where id= $id";

    $this->db->delete($deleteQuery);

    //header("Location: airlines.php");
    header("refresh:2; url=airlines.php");
    echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Airline deleted successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    exit();
  }
}
