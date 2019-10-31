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
//   echo $user_row['first'];


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Safe Wallet</title>
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/formStyle.css">
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }
</style>
</head>
<body>

<h2>Add Funds to <?php echo $user_row['first']. " ". $user_row['last'];?></h2>
<!-- <p>Resize the browser window to see the effect. When the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other.</p> -->
<div class="row">
  <div class="col-75">
    <!-- DISPLAY AMOUNT AND ALLOWED STORES -->
    <!-- <table>
  <tr>
    <th>Amount</th>
    <th>Allowed Stores</th>
  </tr>
  <tr>
    <td>$<?php echo $request_row['amount'];?></td>
    <td><?php echo $request_row['stores'];?></td>
  </tr>
</table> -->

  </div>
  
  <div class="col-75">
    <div class="container">
      <form action="approve_add_funds.php?request_id=<?php echo $id;?>" method ="POST">
      
      <label><b>Fund Name </b></label>
      <input type="text" id="fund_name" name="fund_name" placeholder="Entertainment">
      <div class="row">
        <div class="column col-50">
          <label><b>Amount</b></label>
          <p>$<?php echo $request_row['amount'];?></p>
        </div>
        <div class="column col-50">
          <label><b>Allowed Stores</b></label>
          <p><?php echo $request_row['stores'];?></p>
        </div>
      </div>  
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>
</div>

</body>
</html>
