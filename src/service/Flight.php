<?php
include_once __DIR__ . "/../db/database.php";

class Flight
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }



  public function saveFlight($formData)
  {
    // print_r('Data submit success ');
    //print_r($formData);

    $source = $formData['source'];
    $destination = $formData['destination'];
    $departure = $formData['departure'];
    $arrival = $formData['arrival'];
    $airline = $formData['airline'];
    $price = $formData['price'];

    $insertQuery = "INSERT into flight(source, destination, departure, arrival, price, airline) values ('$source', '$destination', '$departure', '$arrival', '$price', '$airline')";

    $savedData = $this->db->create($insertQuery);

    if ($savedData) {
      header("refresh:2; url=flights.php");
      echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Flight saved successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
      exit();
    } else {
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        Fail to save flight...!! Plz fill up all fields carefully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    }
  }

  public function fetchFlights()
  {
    $selectQuery = "select * from flight";
    $flights = $this->db->select($selectQuery);
    if ($flights)
      return $flights;
    else
      return array(); //return empty array
  }

  public function fetchFlight($id)
  {
    $selectQuery = "select * from flight where id=$id";
    $flight = $this->db->select($selectQuery)->fetch_assoc();
    if ($flight)
      return $flight;
    else
      return null;
  }

  public function filterFlights($src, $dst, $dep, $ret)
  {
    //echo $src, $dst, $dep, $ret;
    /** search by source, destination, departure and arrival/return */
    // $selectQuery = "SELECT * FROM flight WHERE 
    //   source LIKE '$src' AND 
    //   destination LIKE '$dst' AND 
    //   departure >= '$dep' AND 
    //   arrival <= '$ret' ";

    $selectQuery = "SELECT * FROM flight WHERE 
      source LIKE '$src' AND 
      destination LIKE '$dst' AND 
      Date(departure) = '$dep'";


    $flights = $this->db->select($selectQuery);
    //print_r($flights->fetch_assoc());
    if ($flights)
      return $flights;
    else
      return false;
  }

  // public function updateFlight($formData)
  // {
  //   $id = $formData['id'];
  //   $name = $formData['name'];
  //   $code = $formData['code'];
  //   $country = $formData['country'];
  //   $city = $formData['city'];
  //   $contact = $formData['contact'];

  //   $updateQuery = "UPDATE flight SET 
  //     name = '$name', 
  //     code = '$code', 
  //     country = '$country', 
  //     city = '$city', 
  //     contact = '$contact'
  //     WHERE id = $id";

  //   $updatedData = $this->db->create($updateQuery);

  //   if ($updatedData) {
  //     //header("Location: flights.php");
  //     header("refresh:2; url=flights.php");
  //     echo "
  //     <div class='alert alert-success alert-dismissible fade show' role='alert'> 
  //       Flight updated successfully..!! 
  //       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
  //       </button>
  //     </div>";
  //     exit();
  //   } else {
  //     echo "
  //     <div class='alert alert-danger alert-dismissible fade show' role='alert'> 
  //       Fail to update flight...!! Plz fill up all fields carefully.
  //       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
  //       </button>
  //     </div>";
  //   }
  // }

  public function deleteFlight($id)
  {
    $deleteQuery = "DELETE FROM flight where id= $id";

    $this->db->delete($deleteQuery);

    //header("Location: flights.php");
    header("refresh:2; url=flights.php");
    echo "
      <div class='alert alert-success alert-dismissible fade show' role='alert'> 
        Flight deleted successfully..!! 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    exit();
  }
}
