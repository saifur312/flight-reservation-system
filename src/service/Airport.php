<?php
include_once __DIR__ . "/../db/database.php";
//include "../setup/airport/airports.php";

class Airport
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }



  public function saveAirport($formData)
  {
    // print_r('Data submit success ');
    // print_r($formData);

    $name = $formData['name'];
    $code = $formData['code'];
    $country = $formData['country'];
    $city = $formData['city'];
    $contact = $formData['contact'];

    $insertQuery = "INSERT into airport(name, code, country, city, contact) values ('$name', '$code', '$country', '$city', '$contact')";

    $savedData = $this->db->create($insertQuery);

    if ($savedData) {
      header("refresh:2; url=airports.php");
      echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Airport saved successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
      exit();
    } else {
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Fail to save airport...!! Plz fill up all fields carefully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    }
  }

  public function fetchAirports()
  {
    $selectQuery = "select * from airport";
    $airports = $this->db->select($selectQuery);
    if ($airports)
      return $airports;
    else
      return array(); //return empty array
  }

  public function fetchAirport($id)
  {
    $selectQuery = "select * from airport where id=$id";
    $airport = $this->db->select($selectQuery);
    if ($airport)
      return $airport->fetch_assoc();
    else
      return null;
  }

  public function updateAirport($formData)
  {
    // print_r('Data submit success ');
    //print_r($formData);
    $id = $formData['id'];
    $name = $formData['name'];
    $code = $formData['code'];
    $country = $formData['country'];
    $city = $formData['city'];
    $contact = $formData['contact'];

    $updateQuery = "UPDATE airport SET 
      name = '$name', 
      code = '$code', 
      country = '$country', 
      city = '$city', 
      contact = '$contact'
      WHERE id = $id";

    $updatedData = $this->db->create($updateQuery);

    if ($updatedData) {
      //header("Location: airports.php");
      header("refresh:2; url=airports.php");
      echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Airport updated successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
      exit();
    } else {
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Fail to update airport...!! Plz fill up all fields carefully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    }
  }

  public function deleteAirport($id)
  {
    $deleteQuery = "DELETE FROM airport where id= $id";

    $this->db->delete($deleteQuery);

    //header("Location: airports.php");
    header("refresh:2; url=airports.php");
    echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Airport deleted successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    exit();
  }

  public function getCode($airportName)
  {
    $sqlQuery = "SELECT a.code FROM airport a WHERE a.name = '$airportName'";
    $code = $this->db->connection->query($sqlQuery) or
      die($this->db->connection->error . __LINE__);
    if ($code) {
      $code = $code->fetch_assoc();
      //print_r($code);
      //print_r($code['code']);
      return $code['code'];
    } else return null;
  }
}
