<?php
$ProductId = $_POST['productId'];


$target_dir = 'uploads/';
$target_fileName = $target_dir . basename($_FILES['productImage']['name']);
if(move_uploaded_file($_FILES['productImage']['tmp_name'], $target_fileName)) {
    echo 'uploaded';
    
    
    

} else { 
    echo 'error uploading';
}


$sqlConnection = null;
include_once 'ajax/config.php';
$sqlConnection = connectToDatabase();
if ($sqlConnection != null) {
    $sqlQuery = "UPDATE Products SET ProductImagePath = '$target_fileName' WHERE ProductId = $ProductId";
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