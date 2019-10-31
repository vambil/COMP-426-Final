<?php
  session_start();
  
  function getUserRow($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM users WHERE username = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_array($result);
  }

  $id = $_GET['request_id'];
  
  $conn = new mysqli('localhost', 'root', '', 'registration_storage');
  //delete request
  $sql = "DELETE FROM request WHERE id = '$id' ";
  mysqli_query($conn, $sql);

  header("Location: parent.php");