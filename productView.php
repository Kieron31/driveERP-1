<?php
$sqlConnection = null;
include_once 'ajax/config.php';
$sqlConnection = connectToDatabase();
$ProductId = $_POST['ProductId'];
$sqlQuery = "SELECT * FROM Products WHERE ProductId = $ProductId";
        
if (trim($ProductId) != "") {
    //got one
    try {
            $result = $sqlConnection->prepare($sqlQuery);
            $result->execute();
            $rs = $result->fetchAll();
            foreach ($rs as $dataSet) {
                    $ProductCode=$dataSet['ProductCode'];
                    $ProductDescShort=$dataSet['ProductDescShort'];
                    $ProductDescLong=$dataSet['ProductDescLong'];
                    $ProductEAN=$dataSet['ProductEAN'];
                    $ProductCat=$dataSet['ProductCat'];
                    $Cost=$dataSet['Cost'];
                    $RRP=$dataSet['RRP'];
                    $Weight=$dataSet['Weight'];
                    $Image=$dataSet['ProductImagePath'];
            }
            //   print_r($rs);
//    print_r($result->rowCount());
        } catch (PDOExeption $e) {
            $errFlg = 1;
            $errMsg = $e->getMessage();
        }
        
} else {
    //no id
    $errMsg = "No Product Found!";
    $errFlag = 1;
}
?>


<!Doctype html>
<html>
    <head>
        <script src="jQuery/jquery-min.js"></script>
        <script src="jQuery/jquery-ui.min.js"></script>
        <link rel='stylesheet' type='text/css' href='jQuery/jquery-ui.min.css'>
        <script src="jquery/jquery.min.js"></script>
        <script src="jquery/jquery-ui.min.js"></script>
        <script src="jquery/unslider-min.js"></script>
        <script src="jquery/unslider.js"></script>
        <script src="jquery/bootstrap.min.js"></script>
        <script src="jquery/bootstrapglyph.min.js"></script>
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.min.css'>
        <link rel='stylesheet' type='text/css' href='css/unslider.css'>
        <link rel='stylesheet' type='text/css' href='css/unslider-dots.css'>
        <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='css/bootstrapglyph.min.css'>


        <script type="text/javascript">

        </script>

        <style>

        </style>
    </head>




    <body>

        <div class="menubar">
            <nav class="navbar navbar-inverse navbar-static-top" style="margin-bottom:0px;">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
<!--                        </button>
                        <a class="navbar-brand"  href="index.php"><img src="images/Logo.png" style="width:80px;" alt="Monster Energy">
                        </a>-->
                    </div>
                    <div id="navbar3" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="products.php">Products</a></li>
                            <li><a href="customerOrder.php">New Order</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="login.php">Logout</a></li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
                <!--/.container-fluid -->
            </nav>
        </div>

         <?php
            if ($errFlag == 1) {
                echo $errMsg;
            } else{
         ?>

        <div class="jumbotron" style="margin-bottom:0px; background-image: url('images/dark_geometric.png');">
            <div class="container" style="color: white;">
                <hr>
                <img style='float: left; border-radius: 3px; margin-right: 25px; margin-bottom: 15px;' src='<?php echo $Image ?>'>
                <p style='font-size: 30px;'><?php echo $ProductDescShort ?></p>
                <p>RRP: &#163;<?php echo $RRP ?></p>
                <p id="RRPText"></p>
                <hr>
                <p><?php echo htmlspecialchars_decode($ProductDescLong) ?></p>
            </div>
        </div>
            <?php } ?>
        
        <div class="jumbotron" style="background-image: url('images/grey_wash_wall.png'); margin-bottom:0px;">
            <div class='homeHeader' style='margin-top:5px;'>
                <div class="container">

                    <div class="row">
                        <span><p><img src='images/HomeIcon.png' width="20px">  Monster Energy Company, 1 Monster Way, Corona, CA, 92879, USA</p>
                        <p><img src='images/PhoneIcon.png' width="20px">  855-488-1212</p>
                        <p><img src='images/EnvelopeIcon.png' width="20px">  info@monsterenergy.com</p></span>

                    </div>



                </div> 
            </div>
    </body>
</html>