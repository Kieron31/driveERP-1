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
        <script src="js/tinymce/tinymce.min.js"></script>
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.min.css'>
        <link rel='stylesheet' type='text/css' href='css/unslider.css'>
        <link rel='stylesheet' type='text/css' href='css/unslider-dots.css'>
        <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='css/bootstrapglyph.min.css'>


        <script type="text/javascript">
            function addProduct() {
                var getProductCode = $('#ProductCodeDlg').val();
                var getProductDescShort = $('#ProductDescShortDlg').val();
                var getProductDescLong = tinyMCE.activeEditor.getContent();
                var getProductEAN = $('#ProductEANDlg').val();
                var getProductCat = $('#ProductCatDlg').val();
                var getCost = $('#CostDlg').val();
                var getRRP = $('#RRPDlg').val();
                var getWeight = $('#WeightDlg').val();
                



                $.ajax({
                    url: 'ajax/products_ajax.php',
                    cache: false,
                    type: 'POST',
                    //async:false,
                    data: {
                        'request': 'addProduct',
                        'ProductCode': getProductCode,
                        'ProductDescShort': getProductDescShort,
                        'ProductDescLong': getProductDescLong,
                        'ProductEAN': getProductEAN,
                        'ProductCat': getProductCat,
                        'Cost': getCost,
                        'RRP': getRRP,
                        'Weight': getWeight,
                    },
                    dataType: 'json',
                    success: function (data)
                    {

                        alert("Added Entry")
//                       document.location.reload();
//                        if (data.validLogin == 1) {
//                            $('#errDiv').hide();
//                            $('#errDiv2').show();
                        document.location.href = 'productsAdd.php';
//                            
//                        } else {
//                            $('#errDiv').show();
//                        }
//                      
                    },
                    error: function (data)
                    {
                        alert('error in calling ajax page');
                    }
                });


            }

            function back() {
                window.open("www.YouTube.co.uk", "_self")
            }

            tinymce.init({
                selector: '#mytextarea'
            });
        </script>

        <style>
            .form-control {
                width: 250px;
            }

            .navbar-brand {
                padding: 0px;
            }
            .navbar-brand>img {
                height: 100%;
                padding: 2px;
                width: auto;
            }


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
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="images/Logo.png" alt="Monster Energy">
                        </a>
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

        <div class="jumbotron" style='margin-bottom:0px; margin-top: 25px; background-color: whitesmoke;'>
            <div class="container">
                <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px; display: none;" id="errDiv">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Login Failed!</strong> Please enter your username and password again.
                </div>

                <div class="alert alert-success alert-dismissible" role="alert" style="margin-top: 20px; display: none;" id="errDiv2">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Login Successful!</strong> Please wait as the page loads.
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 emailForm">
                        <h1 style="font-size: 40px;"> Add Product: </h1>
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Product Code:</label>
                                <input type="text" name="productCode" class="form-control" id="ProductCodeDlg" placeholder="Product Code"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Short Description:</label>
                                <input type="text" name="productDescShort" class="form-control" id="ProductDescShortDlg" placeholder="Short Description"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Long Description:</label>
                                <textarea id='mytextarea' type="text" name="productDescLong" class="form-control" style="height: 100px;" id="ProductDescLongDlg" placeholder="Long Description"/></textarea>
                            </div>
                            <div class="form-group">
                                <label for="password">EAN Code:</label>
                                <input type="text" name="productDescShort" class="form-control" id="ProductEANDlg" placeholder="EAN (If applies)"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Product Category:</label>
                                <select name="productCat" class="form-control" id="ProductCatDlg" placeholder="Product Category">
                                    <option value='RM'>Raw Material</option>
                                    <option value='FP'>Finished Product</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Cost To Manufacture (Per Piece):</label>
                                <input type="text" name="productDescShort" class="form-control" id="CostDlg" placeholder="Cost to manufacture"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Retail Recommended Price (Per Piece - '0' if non-applicable):</label>
                                <input type="text" name="productDescShort" class="form-control" id="RRPDlg" placeholder="RRP"/>
                            </div>
                            <div class="form-group">
                                <label for="password"> Product Weight (KG) (Per Piece - '0' if non-applicable):</label>
                                <input type="text" name="productDescShort" class="form-control" id="WeightDlg" placeholder="Weight (KG)"/>
                            </div>

                            <input type="button" style="width: 250px;" class="btn btn-success btn-lg" value="Add Product" onclick="addProduct()">
                            <!--                        <button style="width: 250px; margin-top: 15px;" class="btn btn-warning btn-lg" value="Back" onclick="back()">Back</button>-->
                        </form>

                        <form name="imageUploadFrm" method="post" action ="imageUpload.php" enctype="multipart/form-data">
                            <div class="form-group">

                                <label for="imageUpload"> Image:</label>
                                <input type="file" name="productImage">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Upload Image">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>