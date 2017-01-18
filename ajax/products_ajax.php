<?php

$errFlg = 0;
$errMsg = "";
$jsonVal = new stdClass();
$ProductCode = $_POST['ProductCode'];
$ProductDescShort = $_POST['ProductDescShort'];
$ProductDescLong = $_POST['ProductDescLong'];
$ProductDescLong = htmlspecialchars($ProductDescLong, ENT_QUOTES);
$ProductEAN = $_POST['ProductEAN'];
$ProductCat = $_POST['ProductCat'];
$Cost = $_POST['Cost'];
$RRP = $_POST['RRP'];
$Weight = $_POST['Weight'];
$request = $_POST['request'];
$ProductId = $_POST['ProductId'];



$sqlConnection = null;
include_once 'config.php';
$sqlConnection = connectToDatabase();


if ($request == "updateProduct") {
    if ($sqlConnection != null) {
        $sqlQuery = "UPDATE Products SET ProductCode='$ProductCode', ProductDescShort='$ProductDescShort', ProductDescLong='$ProductDescLong', ProductEAN='$ProductEAN', ProductCat='$ProductCat', Cost=$Cost, RRP=$RRP, Weight=$Weight WHERE ProductId=$ProductId;";
      //echo $sqlQuery;
//    $result = sqlsrv_query($sqlConnection,$sqlQuery);
        try {
            $result = $sqlConnection->prepare($sqlQuery);
            $result->execute();
            $rs = $result->fetchAll();
            //   print_r($rs);
//    print_r($result->rowCount());
        } catch (PDOExeption $e) {
            $errFlg = 1;
            $errMsg = $e->getMessage();
        }
    }
    $jsonVal->errMsg=$errMsg;
}


if ($request == "addProduct") {
//    $validLogin = 0;
    if ($sqlConnection != null) {
        if ($RRP == '') {
            $RRP == "null";
        }
        $sqlQuery = "INSERT INTO Products (ProductCode, ProductDescShort, ProductDescLong, ProductEAN, ProductCat, Cost, RRP, Weight) VALUES ('$ProductCode', '$ProductDescShort', '$ProductDescLong', '$ProductEAN', '$ProductCat', $Cost, '$RRP', $Weight);";
        //echo $sqlQuery;
        //$result = sqlsrv_query($sqlConnection, $sqlQuery);
        try {
            $result = $sqlConnection->prepare($sqlQuery);
            $result->execute();
            $rs = $result->fetchAll();
            //print_r($rs);
//            if ($rs != null) {
//                $validLogin = 1;
//            }
            //   print_r($rs);
//    print_r($result->rowCount());
        } catch (PDOExeption $e) {
            $errFlg = 1;
            $errMsg = $e->getMessage();
        }
    }
    $jsonVal->errMsg = $errMsg;
//    $jsonVal->validLogin=$validLogin;de
}

if ($request == "getProduct") {
    if ($sqlConnection != null) {
//        $sqlQuery = "SELECT * FROM Products WHERE ProductId = $ProductId";
//        $result = sqlsrv_query($sqlConnection,$sqlQuery);
//        print_r($result);
        try {
            $sqlQuery = "SELECT * FROM Products WHERE ProductId = $ProductId";
            $result = $sqlConnection->prepare($sqlQuery);
            $result->execute();
            $rs = $result->fetchAll();
            foreach ($rs as $dataSet) {
                    $jsonVal->ProductCode=$dataSet['ProductCode'];
                    $jsonVal->ProductDescShort=$dataSet['ProductDescShort'];
                    $jsonVal->ProductDescLong=$dataSet['ProductDescLong'];
                    $jsonVal->ProductEAN=$dataSet['ProductEAN'];
                    $jsonVal->ProductCat=$dataSet['ProductCat'];
                    $jsonVal->Cost=$dataSet['Cost'];
                    $jsonVal->RRP=$dataSet['RRP'];
                    $jsonVal->Weight=$dataSet['Weight'];
                    $jsonVal->ProductId=$dataSet['ProductId'];
                }
                
                //print_r($rs);
        } catch (PDOExeption $e) {
            $errFlg = 1;
            $errMsg = $e->getMessage();
        }
    }
    $jsonVal->errMsg=$errMsg;
}
echo json_encode($jsonVal);
?>