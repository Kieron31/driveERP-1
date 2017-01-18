<?php

$errFlg = 0;
$errMsg = "";
$jsonVal = new stdClass();
$request = $_POST['request'];
$searchName = $_POST['searchName'];
$ID = $_POST['ID'];
$datepicker = $_POST['datepicker'];
$email = $_POST['email'];
$telephonenumber = $_POST['telephonenumber'];
$currency = $_POST['currency'];



$sqlConnection = null;
include_once 'config.php';
$sqlConnection = connectToDatabase();


if ($request == "getId") {
    if ($sqlConnection != null) {
        
      //echo $sqlQuery;
//    $result = sqlsrv_query($sqlConnection,$sqlQuery);
        try {
            $sqlQuery = "SELECT CustomerId FROM customers WHERE CustomerName = '$searchName'";
            $result = $sqlConnection->prepare($sqlQuery);
            
            $result->execute();
            $rs = $result->fetchAll();
            
            $jsonVal->dataResult = $rs;
            //   print_r($rs);
//    print_r($result->rowCount());
        } catch (PDOExeption $e) {
            $errFlg = 1;
            $errMsg = $e->getMessage();
        }
    }
    $jsonVal->errMsg=$errMsg;
}
if ($request == "SubmitOrderHeader") {
    if ($sqlConnection != null) {
        
      //echo $sqlQuery;
//    $result = sqlsrv_query($sqlConnection,$sqlQuery);
        try {
            $sqlQuery = "INSERT INTO OrderHeader (CustomerId, DueDate, Email, TelNo, Currency) VALUES ('$ID', '$datepicker', '$email', '$telephonenumber', '$currency');";
            $result = $sqlConnection->prepare($sqlQuery);
            
            $result->execute();
            $rs = $result->fetchAll();
            
            $jsonVal->dataResult = $rs;
            //   print_r($rs);
//    print_r($result->rowCount());
        } catch (PDOExeption $e) {
            $errFlg = 1;
            $errMsg = $e->getMessage();
        }
    }
    $jsonVal->errMsg=$errMsg;
}
echo json_encode($jsonVal);
?>