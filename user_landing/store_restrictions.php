<?php
  session_start();
  
  // echo $dependent_username;
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
  
  //get balance from dependent username
  function getBalance($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM fund WHERE dependent_u_name = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    $balance = 0;

    for ($x = 0; $x < $numRows; $x++) {
        $row = mysqli_fetch_array($result);
        $balance += $row['amount'];
    }
    return $balance;

  }

  function getFundRows($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM fund WHERE dependent_u_name = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    return $result;
  }

  $dependent_username = $_GET['dependent_u_name'];

  $dependent_row = getDependentRow($dependent_username);
  $user_row = getUserRow($dependent_username);
  
//   $conn = new mysqli('localhost', 'root', '', 'registration_storage');
//   $sql ="SELECT * FROM request WHERE id = '$id' ";
  
//   $request = mysqli_query($conn, $sql);
//   $request_row = mysqli_fetch_array($result);
//   echo $request_row['dependent_u_name'];


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--====== Title ======-->
    <title>Safe Wallet</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/formStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<h2>Edit Store Restrictions for <?php echo $user_row['first']. " ".$user_row['last']; ?></h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="edit_store.php?dependent_u_name=<?php echo $dependent_username;?>" method ="POST">
      
        <div class="row">
          <div class="col-50">
          <label>Approved Stores</label>
            <input type="text" id="fname" name="approved" placeholder="Target,Walmart" value ="<?php echo $dependent_row['approved_stores']; ?>">
            <label>Banned Stores</label>
            <input type="text" id="fname" name="banned" placeholder="McDonald's,Dave and Busters" value ="<?php echo $dependent_row['banned_stores']; ?>">
            
            

        
        <input type="submit" value="Submit" class="btn">
      </form>
    </div>
  </div>
</div>

</body>
</html>
