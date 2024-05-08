<?php
include_once __DIR__ . "/../db/database.php";
//include_once "./Session.php";
class User
{
  private $db;
  //constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  public function userSignup($formData){
    // var_dump($formData);
    $username = mysqli_real_escape_string($this->db->connection, $formData['username']);
    $email = mysqli_real_escape_string($this->db->connection, $formData['email']);
    $pass = mysqli_real_escape_string($this->db->connection, $formData['password']);

    $insertQuery = "INSERT INTO user(username, password, email) 
                      VALUES('$username', '$pass', '$email')";

    $insertedUserId = $this->db->create($insertQuery);

    if ($insertedUserId) {
      $savedUser = $this->fetchUser($insertedUserId);
      return $savedUser;
    }
    else
      return null;
  }

  public function validateSignupForm($formData){
    $username = mysqli_real_escape_string($this->db->connection, $formData['username']);
    $email = mysqli_real_escape_string($this->db->connection, $formData['email']);
    $pass = mysqli_real_escape_string($this->db->connection, $formData['password']);
    $confirmPass = mysqli_real_escape_string($this->db->connection, $formData['confirmPassword']);
  
    $message = null;

    // Check for empty fields
    if ($username == '' || $pass == '' || $email == '') {
      //echo "<h3 style='color:red'>Fields should not be empty..!!! </h3>";
      $message = 'Fields should not be empty..!!!';
    }
  
    // Check if passwords match
    if ($pass != $confirmPass) {
      //echo "<h3 style='color:red'>Password does not match..!!! </h3>";
      $message = 'Password does not match..!!! ';
    }
  
    // Check for password length
    if (strlen($pass) < 8) {
      //echo "<h3 style='color:red'>Password must be at least 8 characters long..!!! </h3>";
      $message = 'Password must be at least 8 characters long..!!! ';
    }
  
    // Check for the presence of special characters
    if (!preg_match('/^[a-zA-Z0-9]*$/', $pass)) {
      //echo "<h3 style='color:red'>Password should not contain special characters..!!! </h3>";
      $message = 'Password should not contain special characters..!!!';
    }

    return $message;
  }


  public function userLogin($formData)
  {
    $username = $formData['username'];
    $password = $formData['password'];
    //print_r($formData);
    $user = $this->checkUserCredentials($username, $password);
    if ($user) {
      //print_r($user['username']);
      Session::init();
      Session::set("login", true);
      Session::set("id", $user['id']);
      Session::set("username", $user['username']);
      //Session::set("role", $user['role']);
      Session::set("loginmsg", "<div class='alert alert-success alert-dismissible fade show' role='alert'> Login Success..!! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");

      // Session::set("loginmsg", "<div class='alert alert-success alert-dismissible fade show' role='alert '> Login Success..!! </div>");

      //header("Location: ../../src/index.php");
      //exit;
      return $user;
    } else {
      //echo "<div class='alert alert-danger alert-dismissible fade show' role='alert '> Invalid Username or password </div>";
      //Session::set("loginmsg", "<div class='alert alert-danger alert-dismissible fade show' role='alert '> Invalid Username or password </div>");
      return $user;
    }
  }

  public function checkUserCredentials($username, $password)
  {
    $sql = "SELECT * FROM user where username='$username' and password='$password'";
    //$userData = $this->db->select($sql)->fetch_assoc();
    $userData = $this->db->select($sql);
    if ($userData) {
      $userData = $userData->fetch_assoc();
      return $userData;
    } else {

      return false;
    }
  }

  public function fetchUser($id)
  {
    $selectQuery = "select * from user where id=$id";
    $user = $this->db->select($selectQuery)->fetch_assoc();
    if ($user)
      return $user;
    else
      return null;
  }
}
