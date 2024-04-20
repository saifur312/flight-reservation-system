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
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert '> Invalid Username or password </div>";
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
