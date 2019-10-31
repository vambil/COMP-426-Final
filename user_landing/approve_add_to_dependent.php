<?php
  session_start();

  function storesStringToDisplay($stores){
    $stores = substr($stores, 1, strlen($stores)-2);
    $keywords = preg_split("/[)][,][(]/", $stores);
    $out = '';
    
    for ($e = 0; $e < count($keywords); $e += 1) {
        $out .= $keywords[$e];
        if ($e < count($keywords) - 1) {
            $out .= ", ";
        }
    }
    
    if ($out == '') {
        $out = 'Any store';
    }
    
    return $out;
}
function inputToStoresString($stores){
    $stores = '(' . $stores . ')';
    $keywords = preg_split("/[;]+[\s]*/", $stores);
    $out = '';

    for ($e = 0; $e < count($keywords); $e += 1) {
        $out .= $keywords[$e];
        if ($e < count($keywords) - 1) {
            $out .= "),(";
        }
    }
    
    return $out;
}
function expensesStringToDisplay($expenses){
    $expenses = substr($expenses, 1, strlen($expenses)-2);
    
    $keywords = preg_split("/[,]/", $expenses);
    $out = '';
    
    for ($e = 0; $e < count($keywords); $e += 1) {
        $out .= $keywords[$e];
        if ($e < count($keywords) - 1) {
            $out .= ": $";
        }
    }
    
    $keywords = preg_split("/[)][(]/", $out);
    $out = '';
    
    for ($e = 0; $e < count($keywords); $e += 1) {
        $out .= $keywords[$e];
        if ($e < count($keywords) - 1) {
            $out .= ", ";
        }
    }
    
    return $out;
}

  $dependent_u_name = $_GET['dependent_u_name'];
  $stores = inputToStoresString($_POST['store']);

  //add fund to the account
  $conn = new mysqli('localhost', 'root', '', 'registration_storage');
  $sql = "INSERT INTO fund (fund_name, dependent_u_name, amount, stores) VALUES ('$_POST[fund_name]', 
  '$dependent_u_name', '$_POST[amount]', '$stores')";
  mysqli_query($conn, $sql);

  header("Location: parent.php");