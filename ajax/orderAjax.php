<?php

$errFlg = 0;
$errMsg = "";
$jsonVal = new stdClass();
$request = $_POST['request'];
$customerSearch = $_POST['customerSearch'];



$sqlConnection = null;
include_once 'config.php';
$sqlConnection = connectToDatabase();


if ($request == "customerSearch") {
    if ($sqlConnection != null) {
        
      //echo $sqlQuery;
//    $result = sqlsrv_query($sqlConnection,$sqlQuery);
        try {
            $sqlQuery = "SELECT * FROM Customers WHERE CustomerName LIKE '%$customerSearch%';";
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