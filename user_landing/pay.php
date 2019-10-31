<?php
  session_start();

//   $id = $_GET['request_id'];
  
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

<h2>Payment Portal</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="pay_insert.php" method ="POST">
      
        <div class="row">
          <div class="col-50">
            <label>Amount</label>
            <input type="text" id="fname" name="amount" placeholder="37.55">
            <label for="email"> Store</label>
            <input type="text" id="email" name="store" placeholder="Walmart">
            

        
        <input type="submit" value="Submit Transaction" class="btn">
      </form>
    </div>
  </div>
</div>

</body>
</html>
