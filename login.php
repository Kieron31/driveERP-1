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
            function logon() {
                var getUsername = $('#usernameDlg').val();
                var getPassword = $('#passwordDlg').val();
                
                
                $.ajax({
                   url:'ajax/loginAjax.php', 
                   cache:false,
                   type:'POST',
                   //async:false,
                   data: {
                       'request':'logon',
                       'userName':getUsername,
                       'passId':getPassword,
                   },
                   dataType:'json',
                   success: function(data)
                   {
//                       document.location.reload();
                        if (data.validLogin == 1) {
                            $('#errDiv').hide();
                            $('#errDiv2').show();
                            document.location.href='index.php';
                            
                        } else {
                            $('#errDiv').show();
                        }
                      
                   },
                   error : function(data)
                   {
                       alert('error in calling ajax page');
                   }
                });
                
                
            }
        </script>
        
        <style>
            .form-control {
                width: 250px;
            }
            body {
                background-color: whitesmoke;
            }
        </style>
    </head>
    
    
    
    
    <body>
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
                    <h1> Login: </h1>
                    <form method="post">
                        <div class="form-group"
                             <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" id="usernameDlg" placeholder="Username"/>
                        </div>
                        <div class="form-group"
                             <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" id="passwordDlg" placeholder="Password"/>
                        </div>
                        <input type="button" style="width: 250px;" value="Login" class="btn btn-success btn-lg" value="Login" onclick="logon()">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>