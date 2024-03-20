<?php 
  include './../config.php';
  include './db/database.php';
?>

<?php
$db = new Database();
$query = 'SELECT * FROM user';
$read = $db->read($query);
?>

<?php 
  while ($row = $read->fetch_assoc()) {
    echo $row['id'];
    echo $row['username'];
    echo $row['password'];
    echo $row['role'];
  }

?>