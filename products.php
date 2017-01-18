<?php
$sqlConnection = null;
include_once 'ajax/config.php';
$sqlConnection = connectToDatabase();
if ($sqlConnection != null) {
    $sqlQuery = "SELECT * FROM Products WHERE ProductCat = 'FP';";
//    $result = sqlsrv_query($sqlConnection,$sqlQuery);
    try {
        $result = $sqlConnection->prepare($sqlQuery);
        $result->execute();
        $rs = $result->fetchAll(PDO::FETCH_ASSOC);
//      print_r($rs);
//      print_r($result->rowCount());
    } catch (PDOExeption $e) {
        echo $e->getMessage();
    }
}
?>

<html>
    <head>
        <link rel='stylesheet' type='text/css' href='jQuery/jquery-ui.min.css'>
        <script src="jQuery/jquery.min.js"></script>
        <script src="jQuery/jquery-ui.min.js"></script>
        <script src="jQuery/unslider-min.js"></script>
        <script src="jQuery/unslider.js"></script>
        <script src="jQuery/bootstrap.min.js"></script>
        <script src="jQuery/bootstrapglyph.min.js"></script>
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.min.css'>
        <link rel='stylesheet' type='text/css' href='css/unslider.css'>
        <link rel='stylesheet' type='text/css' href='css/unslider-dots.css'>
        <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='css/bootstrapglyph.min.css'>


        <script type="text/javascript">
            $(document).ready(function () {
                $('#editDialog').dialog({
                    resizable: false,
                    autoOpen: false,
                    maxWidth: 600,
                    maxHeight: 500,
                    width: 600,
                    height: 500,
                    modal: true,
                })
            })



            function toLoginPage() {
                document.location.href = 'login.php';
            }

            !function ($) {

                "use strict"; // jshint ;_;


                /* MAGNIFY PUBLIC CLASS DEFINITION
                 * =============================== */

                var Magnify = function (element, options) {
                    this.init('magnify', element, options)
                }

                Magnify.prototype = {

                    constructor: Magnify

                    , init: function (type, element, options) {
                        var event = 'mousemove'
                                , eventOut = 'mouseleave';

                        this.type = type
                        this.$element = $(element)
                        this.options = this.getOptions(options)
                        this.nativeWidth = 0
                        this.nativeHeight = 0

                        this.$element.wrap('<div class="magnify" \>');
                        this.$element.parent('.magnify').append('<div class="magnify-large" \>');
                        this.$element.siblings(".magnify-large").css("background", "url('" + this.$element.attr("src") + "') no-repeat");

                        this.$element.parent('.magnify').on(event + '.' + this.type, $.proxy(this.check, this));
                        this.$element.parent('.magnify').on(eventOut + '.' + this.type, $.proxy(this.check, this));
                    }

                    , getOptions: function (options) {
                        options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

                        if (options.delay && typeof options.delay == 'number') {
                            options.delay = {
                                show: options.delay
                                , hide: options.delay
                            }
                        }

                        return options
                    }

                    , check: function (e) {
                        var container = $(e.currentTarget);
                        var self = container.children('img');
                        var mag = container.children(".magnify-large");

                        // Get the native dimensions of the image
                        if (!this.nativeWidth && !this.nativeHeight) {
                            var image = new Image();
                            image.src = self.attr("src");

                            this.nativeWidth = image.width;
                            this.nativeHeight = image.height;

                        } else {

                            var magnifyOffset = container.offset();
                            var mx = e.pageX - magnifyOffset.left;
                            var my = e.pageY - magnifyOffset.top;

                            if (mx < container.width() && my < container.height() && mx > 0 && my > 0) {
                                mag.fadeIn(100);
                            } else {
                                mag.fadeOut(100);
                            }

                            if (mag.is(":visible"))
                            {
                                var rx = Math.round(mx / container.width() * this.nativeWidth - mag.width() / 2) * -1;
                                var ry = Math.round(my / container.height() * this.nativeHeight - mag.height() / 2) * -1;
                                var bgp = rx + "px " + ry + "px";

                                var px = mx - mag.width() / 2;
                                var py = my - mag.height() / 2;

                                mag.css({left: px, top: py, backgroundPosition: bgp});
                            }
                        }

                    }
                }


                /* MAGNIFY PLUGIN DEFINITION
                 * ========================= */

                $.fn.magnify = function (option) {
                    return this.each(function () {
                        var $this = $(this)
                                , data = $this.data('magnify')
                                , options = typeof option == 'object' && option
                        if (!data)
                            $this.data('tooltip', (data = new Magnify(this, options)))
                        if (typeof option == 'string')
                            data[option]()
                    })
                }

                $.fn.magnify.Constructor = Magnify

                $.fn.magnify.defaults = {
                    delay: 0
                }


                /* MAGNIFY DATA-API
                 * ================ */

                $(window).on('load', function () {
                    $('[data-toggle="magnify"]').each(function () {
                        var $mag = $(this);
                        $mag.magnify()
                    })
                })

            }(window.jQuery); //Magnify Plugin

            function deleteData(ProductId) {
                $('#sdtIdFrm').val(ProductId);
                document.forms['frmDelete'].submit();
            }

            function editData(ProductId) {
                $('#editDialog').dialog('open');
            

                $.ajax({
                    url: 'ajax/products_ajax.php',
                    cache: false,
                    type: 'POST',
                    
                    data: {
                        'request': 'getProduct',
                        'ProductId': ProductId
                    },
                    dataType: 'json',
                    success: function (data)
                    {
                        $('#ProductCodeDlg').val(data.ProductCode);
                        $('#ProductDescShortDlg').val(data.ProductDescShort);
                        $('#ProductDescLongDlg').val(data.ProductDescLong);
                        $('#ProductEANDlg').val(data.ProductEAN);
                        $('#ProductCatDlg').val(data.ProductCat);
                        $('#CostDlg').val(data.Cost);
                        $('#RRPDlg').val(data.RRP);
                        $('#WeightDlg').val(data.Weight);
                        $('#sdtIdFrm2').val(ProductId);
//                        $('#sdtIdFrm3').val(ProductId);


                    },
                    error: function (data)
                    {
                        alert('error in calling ajax page');
                    }
                });
            }

            function updateProduct() {
                var getProductCode = $('#ProductCodeDlg').val();
                var getProductDescShort = $('#ProductDescShortDlg').val();
                var getProductDescLong = $('#ProductDescLongDlg').val();
                var getProductEAN = $('#ProductEANDlg').val();
                var getProductCat = $('#ProductCatDlg').val();
                var getCost = $('#CostDlg').val();
                var getRRP = $('#RRPDlg').val();
                var getWeight = $('#WeightDlg').val();
                var getProductId = $('#sdtIdFrm2').val();

                $.ajax({
                    url: 'ajax/products_ajax.php',
                    cache: false,
                    type: 'POST',
                    //async:false,
                    data: {
                        'request': 'updateProduct',
                        'ProductId': getProductId,
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
                        document.forms['imageUploadFrm'].submit();
                        //document.location.reload();

                    },
                    error: function (data)
                    {
                        alert('error in calling ajax page');
                    }
                });
            }

            function viewProduct(prodId) {
                $('#ProductId').val(prodId);
                //alert(prodId);
                document.forms['productIdFrm'].submit();
                
            }

        </script>

        <style>


            .homeHeader {
                width: 75%;
                margin: 0 auto;
                margin-top: 25px;
            }

            .video-center {
                width: 560px; /* you have to have a size or this method doesn't work */
                height: 315px; /* think about making these max-width instead - might give you some more responsiveness */

                position: relative; /* positions out of the flow, but according to the nearest parent */
                top: 0; right: 0; /* confuse it i guess */
                bottom: 0; left: 0;
                margin: auto; /* make em equal */
            }

            .mag {
                width:250px;
                margin: 0 auto;
                float: none;
            } 

            .mag img {
                max-width: 100%;
            }



            .magnify {
                position: relative;
                cursor: none
            }

            .magnify-large {
                position: absolute;
                display: none;
                width: 175px;
                height: 175px;

                -webkit-box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
                -moz-box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
                box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);

                -webkit-border-radius: 100%;
                -moz-border-radius: 100%;
                border-radius: 100%
            }

            .navbar-brand {
                padding: 0px;
            }
            .navbar-brand>img {
                height: 100%;
                padding: 2px;
                width: auto;
            }


            #studentTable{
                width: 100%;
                font-size:17px;
                color: black;
                border-collapse: collapse;

                box-shadow:
                    -1px -1px 10px rgba(0, 0, 0, 0.2),  
                    1px -1px 10px rgba(0, 0, 0, 0.2),
                    -1px 1px 10px rgba(0, 0, 0, 0.2),
                    1px 1px 10px rgba(0, 0, 0, 0.2);


            }

            tr:nth-child(even) {
                background-color: #cccccc;
            }

            tr:nth-child(odd) {
                background-color: #999999;
            }

            td#fmt {
                border: 1px solid black;
                padding: 3px;
                margin: 0;
                cell-padding: 0px;
            }

        </style>
    </head>




    <body>
        <?php
//        include_once 'include/menu.php';
        ?>

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
                            <li class="active"><a href="products.php">Products</a></li>
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


        <div class="jumbotron" style="margin-bottom:0px; background-image: url('images/dark_geometric.png');">
            <div class='homeHeader' style="margin-top:10px;">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Notice:</strong> This site is still under development! Some features may not work as expected.

                </div>






                <!--                <hr style="border-color: #999999;">-->
                <!--                <div style="margin: 0 auto; width: 80%;position: absolute;">
                                <div class="container">
                                    <div class="col-md-4">
                                        <img src="images/RecordingStudio1.jpg" width='200px;' style='border-radius: 5px;'>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="images/RecordingStudio2.jpg" width='200px;' style='border-radius: 5px;'>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="images/RecordingStudio3.jpg" width='200px;' style='border-radius: 5px;'>
                                    </div>
                                    
                                </div>
                                </div>-->
                <br>
                <a href="productsAdd.php" type="button" class="btn btn-info btn-lg">Add New Product</a>


                <div id='dataTable'>
                    <h1 style='color: white; font-size: 35px; margin-right: 20px;text-shadow:
                        -1px -1px 0 #000,  
                        1px -1px 0 #000,
                        -1px 1px 0 #000,
                        1px 1px 0 #000;'>Product Database:</h1>
                    <table id="studentTable">
                        <th>
                            <td id='fmt'>
                                <h1 style="font-size: 25px; color: black;">Product Name: </h1>
                            </td>
                            <td id='fmt'>
                                <h1 style="font-size: 25px; color: black;">EAN: </h1>
                            </td>
                            <td id='fmt'>
                                <h1 style="font-size: 25px; color: black;">Cost To Company: </h1>
                            </td>
                            <td id='fmt'>
                                <h1 style="font-size: 25px; color: black;">RRP: </h1>
                            </td>
                            <td id='fmt'>
                                <h1 style="font-size: 25px; color: black;">Edit: </h1>
                            </td>
                        </th>
                        <?
                        foreach ($rs as $dataSet) {
                            echo "<tr><td id='fmt'>" . "<img src ='images/DeleteButton.png' style='width: 30px; cursor: pointer;' onclick='deleteData(" .
                            $dataSet['ProductId'] . ")' " . "</td><td id='fmt'>" . $dataSet['ProductDescShort'] . "</td><td id='fmt'>" .
                            $dataSet['ProductEAN'] . "</td><td id='fmt'>" . $dataSet ['Cost'] . "</td><td id='fmt'>" . $dataSet['RRP'] . "</td><td id='fmt'>" .
                            "<img src ='images/EditButton.png' style='width: 30px; cursor: pointer;' onclick='editData(" . $dataSet['ProductId'] . ")' " .
                            "</tr>" . "<td id='fmt'>" . "<input type='button' value='View Product' onclick='viewProduct(" . $dataSet['ProductId'] . ")'>" . "</td></td>";
                        }
                        ?>
                    </table>
                </div>

                <form name='productIdFrm' action='productView.php' method="POST">
                    <input id='ProductId' type='hidden' name='ProductId'>
                </form>



            </div>

        </div>
        <div class="jumbotron" style="background-image: url('images/grey_wash_wall.png'); margin-bottom:0px;">
            <div class='homeHeader' style='margin-top:5px;'>
                <div class="container">

                    <div class="row">
                        <p><img src='images/HomeIcon.png' width="20px">  Monster Energy Company, 1 Monster Way, Corona, CA, 92879, USA</p>
                        <p><img src='images/PhoneIcon.png' width="20px">  855-488-1212</p>
                        <p><img src='images/EnvelopeIcon.png' width="20px"></span>  info@monsterenergy.com</p>

                    </div>



                </div> 
                <form name="frmDelete" method="POST" action="productsDelete.php">
                    <input type="hidden" name="ProductId" id="sdtIdFrm"> 
                </form>

                <div id="editDialog">



                    <h1 style="font-size: 40px;"> Edit Product: </h1>

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
                        <textarea type="text" name="productDescLong" class="form-control" style="height: 100px;" id="ProductDescLongDlg" placeholder="Long Description"/></textarea>
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
                    <form name="imageUploadFrm" method="post" action ="imageUpload.php" enctype="multipart/form-data">
                        <div class="form-group">

                            <label for="imageUpload"> Image:</label>
                            <input type="file" name="productImage">
                        </div>
                        <input type="hidden" name="productId" id="sdtIdFrm3">
                    </form>
                    <input type="button" style="width: 250px;" class="btn btn-success btn-lg" value="Update" id="buttonDlg" onclick="updateProduct()">
                    <input type="hidden" name="productId" id="sdtIdFrm2">

                    <!--                        <button style="width: 250px; margin-top: 15px;" class="btn btn-warning btn-lg" value="Back" onclick="back()">Back</button>-->





                </div>
            </div>
    </body>
</html>