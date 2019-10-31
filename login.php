<?php
session_start();
//create connection
$conn = new mysqli('localhost', 'root', '', 'registration_storage');

if($conn) {
    echo '<h1>Connected to MySQL</h1>';
} else {
    echo '<h1>not to MySQL</h1>';
    echo mysqli_connect_error();
}

// echo "reached";
// if(isset($_POST['submit'])){
  
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

//   echo $username;

    // $sql ="SELECT * FROM users WHERE user_email = '$email'";
    // $result = mysqli_num_rows(mysqli_query($conn, $sql));
    // $row = mysqli_fetch_assoc($result);

    $sql ="SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    // echo $resultCheck;
    

    if($resultCheck != 1){ //check if user has been taken
      echo '<script> alert("Error, user not found"); window.location.href=\'index.html\'; </script>';
      exit();
    }

    if($row = mysqli_fetch_assoc($result)){
        //De hash PASSWORD
        

        $hashedPasswordCheck = password_verify($password, $row['password']);
        if($hashedPasswordCheck == false){
        //   echo '<script> alert("Error, incorrect username or password"); window.location.href=\'index.html\'; </script>';
          echo '<script> alert("Error, incorrect username or password");  </script>';

          exit();
        }
        elseif ($hashedPasswordCheck == true) {
          //password is correct! Log the user in
    
          //echo $row['user_id'];
            $_SESSION['first'] = $row['first'];
            $_SESSION['last'] = $row['last'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['type'] = $row['type'];
            $_SESSION['phone'] = $row['phone'];
           
            $type = $row['type'];
    
          echo "Welcome ". $username;
        }
    }

    if($type == "P"){
      header("Location: user_landing/parent.php");
      exit();
    }
    else{
        header("Location: user_landing/dependent.php");
        exit();
    }
