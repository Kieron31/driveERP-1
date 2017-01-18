<?php

$errFlg = 0;
$errMsg = "";
$jsonVal = new stdClass();
$request = $_POST['request'];
$userName = $_POST['userName'];
$passId = $_POST['passId'];


$sqlConnection = null;
include_once 'config.php';
$sqlConnection = connectToDatabase();



if ($request == "logon") {
    $validLogin = 0;
    if ($sqlConnection != null) {
        $sqlQuery = "SELECT * FROM ID_table WHERE username = '$userName' AND password = '$passId';";
//        echo $sqlQuery;
//    $result = sqlsrv_query($sqlConnection,$sqlQuery);
        try {
            $result = $sqlConnection->prepare($sqlQuery);
            $result->execute();
            $rs = $result->fetchAll();
//            print_r($rs);
            if ($rs != null) {
                $validLogin = 1;
            }
            //   print_r($rs);
//    print_r($result->rowCount());
        } catch (PDOExeption $e) {
            $errFlg = 1;
            $errMsg = $e->getMessage();
        }
    }
    $jsonVal->errMsg=$errMsg;
    $jsonVal->validLogin=$validLogin;
}

echo json_encode($jsonVal);
?>