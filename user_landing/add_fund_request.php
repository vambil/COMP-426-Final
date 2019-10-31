<?php
  session_start();

  //get user row from dependent username
  function getUserRow($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM users WHERE username = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_array($result);
  }

  function getDependentRow($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM dependents WHERE username = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_array($result);
  }

  $dependent_u_name = $_GET['dependent_u_name'];
  $dependent_row = getDependentRow($dependent_u_name);

  //add fund to the account
  $conn = new mysqli('localhost', 'root', '', 'registration_storage');

  $sql = "INSERT INTO request (dependent_u_name, parent_u_name, amount, stores) VALUES 
                            ('$dependent_u_name','$dependent_row[parent_u_name]','$_POST[amount]','$_POST[store]')";


  mysqli_query($conn, $sql);
  echo mysqli_error($conn);

  header("Location: dependent.php");