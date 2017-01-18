<?php

$ProductId = $_POST['ProductId'];

$sqlConnection = null;
include_once 'ajax/config.php';
$sqlConnection = connectToDatabase();
if ($sqlConnection != null) {
    $sqlQuery = "DELETE FROM Products WHERE ProductId = $ProductId";
    //$result = sqlsrv_query($sqlConnection,$sqlQuery);
    echo $sqlQuery;
    try {
        $result = $sqlConnection->prepare($sqlQuery);
        $result->execute();
        $rs = $result->fetchAll();
        //   print_r($rs);
//    print_r($result->rowCount());
    } catch (PDOExeption $e) {
        echo $e->getMessage();
    }
}

header('Location: products.php');

?>