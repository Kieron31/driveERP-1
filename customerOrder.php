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
            $(function () {
                $("#datepicker").datepicker();
            });

            function getIdAndSubmit() {
                var ID = '0';
                var searchName = $('#customerSearch').val();
                var datepicker = $('#datepicker').val();
                var email = $('#email').val();
                var telephonenumber = $('#telephonenumber').val();
                var currency = $('#currency').val();

                $.ajax({
                    url: 'ajax/OrderAjax.php',
                    cache: false,
                    type: 'POST',
                    //async:false,
                    data: {
                        'request': 'getId',
                        'searchName': searchName,
                    },
                    dataType: 'json',
                    success: function (data)
                    {
                        ID = data.dataResult[0].CustomerId;
                        //alert(ID);

                        $.ajax({
                            url: 'ajax/OrderAjax.php',
                            cache: false,
                            type: 'POST',
                            //async:false,
                            data: {
                                'request': 'SubmitOrderHeader',
                                'ID': ID,
                                'datepicker': datepicker,
                                'email': email,
                                'telephonenumber': telephonenumber,
                                'currency': currency,
                            },
                            dataType: 'json',
                            success: function (data)
                            {
                                location.reload();
                            },
                            error: function (data)
                            {
                                alert('error in calling ajax page');
                            }
                        });

                    },
                    error: function (data)
                    {
                        alert('error in calling ajax page');
                    }
                });



                //alert(ID);

            }

            function toLoginPage() {
                document.location.href = 'login.php';
            }

            function completeCustomer(CustomerName, CustomerId) {
                $('#customerSearch').val(CustomerName);
                $('#searchResults').html("");
                $('#searchResults').hide();
            }

            function searchUpdate() {
                var customerSearch = $('#customerSearch').val();
                var len = customerSearch.length;
                var outputData = "";
                if (len < 3) {
                    $('#searchResults').html("");
                    $('#searchResults').hide();
                    return;
                }

                $.ajax({
                    url: 'ajax/CustomerAjax.php',
                    cache: false,
                    type: 'POST',
                    //async:false,
                    data: {
                        'request': 'customerSearch',
                        'customerSearch': customerSearch,
                    },
                    dataType: 'json',
                    success: function (data)
                    {
                        $('#searchResults').show();
                        outputData = outputData + "<table>";
                        for (i = 0; i < data.dataResult.length; i++) {
                            outputData = outputData + "<tr> <td style='width:100%;' onclick='completeCustomer(\"" + data.dataResult[i].CustomerName + "\", \"" + data.dataResult[i].CustomerId + "\")' >" + data.dataResult[i].CustomerName + "</td> </tr>";
                        }
                        //alert(data.dataResult[0].CustomerName);
                        //document.location.reload();

                        outputData = outputData + "</table>";
                        $('#searchResults').html(outputData);

                    },
                    error: function (data)
                    {
                        alert('error in calling ajax page');
                    }
                });
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
                            <li><a href="products.php">Products</a></li>
                            <li class="active"><a href="customerOrder.php">New Order</a></li>
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

                <div style="margin:0 auto;text-align: center;">
                    <p style="color:white;">Store Location:</p>
                    <input  onkeyup="searchUpdate();"id="customerSearch" type="text"placeholder="Please enter the location of the store..."size="50">
                </div>

                <div id="searchResults" style="background-color: whitesmoke; border-radius: 2px; padding: 5px;display:none;">

                </div>

                <div style="margin:0 auto;margin-top: 5px;text-align: center;">
                    <p style="color:white;">Due Date:</p>
                    <input type="text" id="datepicker" placeholder="Enter date the item is due..."size="50">
                </div>
                <div style="margin:0 auto;margin-top: 5px;text-align: center;">
                    <p style="color:white;">Email:</p>
                    <input type="email" id="email" placeholder="Enter your email..."size="50">
                </div>
                <div style="margin:0 auto;margin-top: 5px;text-align: center;">
                    <p style="color:white;">Telephone number:</p>
                    <input type="text" id="telephonenumber" placeholder="Enter your telephone number..."size="50">
                </div>
                <div style="margin:0 auto;margin-top: 5px;text-align: center;">
                    <p style="color:white;">Currency:</p>
                    <input type="text" id="currency" value="GBP" disabled="true" size="50">
                </div>
                <div style="margin:0 auto;margin-top: 35px;text-align: center;">
                    <input type="button" id="SubmitButton" value="Continue" onclick="getIdAndSubmit()">
                </div>



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
            </div>
    </body>
</html>