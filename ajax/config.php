<?php
//connect


function connectToDatabase()
{
    $dbName = "ERP";
    $sqlUser = "Krilium";
    $sqlPassword = "FooBar";
    $host = "DESKTOP-TN3M0V0";
    
    $conn = new PDO('sqlsrv: Server = DESKTOP-TN3M0V0; Database = ERP; ConnectionPooling=0', $sqlUser, $sqlPassword);
//    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    
    if($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    return $conn;
}
?>