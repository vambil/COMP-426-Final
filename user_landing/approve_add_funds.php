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
  $sql ="SELECT * FROM request WHERE id = '$id' ";
  
  $result = mysqli_query($conn, $sql);
  $request_row = mysqli_fetch_array($result);
  $user_row = getUserRow($request_row['dependent_u_name']);

  //add fund to the account

  $sql = "INSERT INTO fund (fund_name, dependent_u_name, amount, stores) VALUES ('$_POST[fund_name]', 
  '$request_row[dependent_u_name]', '$$_POST[amount]', '$_POST[stores]')";
  mysqli_query($conn, $sql);

  //delete request
  $sql = "DELETE FROM request WHERE id = '$id' ";
  mysqli_query($conn, $sql);

  // header("Location: parent.php");