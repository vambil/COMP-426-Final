<?php
session_start();

function getDependentRow($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM dependents WHERE username = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_array($result);
}
$dependent_row = getDependentRow($_SESSION['username']);

$approved = false;
$amount = $_POST['amount'];
$store = $_POST['store'];
$banned_stores = $dependent_row['banned_stores'];
$approved_stores = $dependent_row['approved_stores'];

$conn = new mysqli('localhost', 'root', '', 'registration_storage');
$sql ="SELECT * FROM fund WHERE dependent_u_name = '$_SESSION[username]' ";
$result = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($result);

$totalpossible=0;

for ($x = 0; $x < $numRows; $x++) {
    
    $fund_row = mysqli_fetch_array($result);
    
    if (strlen($fund_row['stores']) > 0) {

        if ((strpos($fund_row['stores'], $store) > 0)) {

            $totalpossible += $fund_row['amount'];

        }

    } else {
        $totalpossible += $fund_row['amount'];
    }
}

//for loop through each fund

while ($amount > 0 && $totalpossible >= $amount) {

    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM fund WHERE dependent_u_name = '$_SESSION[username]' ";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if (!strpos($banned_stores, $store)) {

        $best_id = -1;
        $best_stores_length = 0;
        $best_stores_amount = 0;

        for ($x = 0; $x < $numRows; $x++) {
            $fund_row = mysqli_fetch_array($result);
            //you can now access elements on the row by using $fund_row['stores'] ['amount'];

            if (strlen($fund_row['stores']) > 0) {

                if ((strpos($fund_row['stores'], $store) > 0)) {

                    if ($best_id == -1) {
                        $best_id = $fund_row['id'];
                        $best_stores_length = substr_count($fund_row['stores'], '),(');
                        $best_stores_amount = $fund_row['amount'];
                    } else if (substr_count($fund_row['stores'], '),(') < $best_stores_length) {
                        $best_id = $fund_row['id'];
                        $best_stores_length = substr_count($fund_row['stores'], '),(');
                        $best_stores_amount = $fund_row['amount'];
                    } else if (substr_count($fund_row['stores'], '),(') == $best_stores_length && $fund_row['amount'] < $best_stores_amount) {
                        $best_id = $fund_row['id'];
                        $best_stores_amount = $fund_row['amount'];
                    }

                }

            } else {
                $best_id = $fund_row['id'];
            }

            if ($best_id >= 0) {

                $conn = new mysqli('localhost', 'root', '', 'registration_storage');
                $sql ="SELECT * FROM fund WHERE id = '$best_id' ";
                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);
        
                $fund_row = mysqli_fetch_array($result);

                $new_expense = $fund_row['expenses']."(".$store.","."$amount".")";

                if ($fund_row['amount']>=$amount){
                    $new_amount = $fund_row['amount'] - $amount;
                    $amount = 0;
                }
                else {
                    $amount = $amount - $fund_row['amount'];
                    $new_amount = 0;
                }
                $sql ="UPDATE fund
                        SET amount = '$new_amount'
                        WHERE id = '$fund_row[id]' ";
                $result = mysqli_query($conn, $sql);

                $sql ="UPDATE fund
                        SET expenses = '$new_expense'
                        WHERE id = '$fund_row[id]' ";
                $result = mysqli_query($conn, $sql);

                $sql ="DELETE FROM fund WHERE amount = '0'";
                $result = mysqli_query($conn, $sql);

                $approved = true;
        
            }


        }
    }
}

if($approved==false) {
    echo '<script> alert("Invalid Payment"); window.location.href=\'dependent.php\'; </script>';
    exit();
}
$sql ="DELETE FROM fund WHERE amount = '0'";
$result = mysqli_query($conn, $sql);


echo $approved;
header("Location: dependent.php");
exit();

?>