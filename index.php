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
            
            function toLoginPage() {
                document.location.href='login.php';
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
            
            .videoWrapper {
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
	height: 0;
}
.videoWrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
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
          <li class="active"><a href="index.php">Home</a></li>
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


        <div class="jumbotron" style="margin-bottom:0px; background-image: url('images/dark_geometric.png');">
            <div class='homeHeader' style="margin-top: 10px;">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Notice:</strong> This site is still under development! Some features may not work as expected.
                </div>
                
                <p style='margin-top: 50px; color: lightgray; font-size: 1.5vw;'>Most companies spend their money on ad agencies, TV commercials, radio spots, and billboards to tell you how good their products are. At Monster we choose none of the above. Instead, we support the scene, our bands, our athletes and our fans. We back athletes so they can make a career out of their passion. We promote concert tours, so our favorite bands can visit your home town. We celebrate with our fans and riders by throwing parties and making the coolest events we can think of a reality.</p>
                <p style='color: lightgray; font-size: 1.5vw;'>At Monster we are all about the things you care about. We all dreamed about being pro athletes, musicians and living the life. We know it takes encouragement and support to make that dream a reality, so we created the Monster Army to back the next generation pros, the future Ricky Carmichael, Jeremy McGrath, Dave Mirra, Danny Kass and Rob Dyrdek's.</p>
                <p style='color: lightgray; font-size: 1.5vw;'>Some companies won't let you have any gear unless you're on the payroll. We're all about our fans rockin' the Monster logo the way they want - on hats, shirts, MX bikes, trucks, gear, or even on themselves. Our idea of a promotion isn't giving away a TV you already got. Our promos offer exclusive VIP access, insane trips hanging with top musicians, athletes, and real gear like dirt bikes, snowboards, BMX bikes, rims and helmets.</p>
                <p style='color: lightgray; font-size: 1.5vw;'>In short, at Monster all our guys walk the walk in action sports, punk rock music, partying, hangin' with the girls, and living life on the edge. Monster is way more than an energy drink. Led by our athletes, musicians, employees, distributors and fans, Monster is...</p>
                <br>
                <p style='color: lightgray; font-size: 1.5vw;'>A lifestyle in a can.</p>


            
                <br>
                
                <hr style="border-color: #999999;">
                <br>
                <div class="videoWrapper">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/S8n8m4PGIZQ" frameborder="0" allowfullscreen></iframe>
                </div>
                <br>
                <hr style="border-color: #999999;">
                <br>

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
                
            </div>
                
        </div>
        <div class="jumbotron" style="background-image: url('images/grunge_wall.png'); margin-bottom:0px;">
            <div class='homeHeader' style='margin-top:10px;'>
                <div class="container">

                    <div class="row">
                        <hr style="border-color: #666666;">
                        <h3>
                            Why choose us? <br>
                        </h3>
                        
                        <p style="font-size: 18px;">
                            Monster Energy won't only give you the energy to get through your adrenaline-fuelled day, it will make sure you don't sugar crash whilst you're riding, skating, skiing, or any other of the extreme sport activities that you may have planned!<br>Don't settle for cheap, low quality energy drinks. Drink Monster, the only energy drink that will get you through your day!
                        </p>
                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="mag">
                                <br>
                                <img data-toggle="magnify" style="border-radius:5px;" src="https://c7.staticflickr.com/4/3491/3768900774_bdf0bd9a3f_z.jpg" alt="">
                            </div>
                        </div><!--/span-->


                        <div class="col-md-4">
                            <div class="mag">
                                <br>
                                <img style="border-radius:5px;" data-toggle="magnify" src="https://c8.staticflickr.com/8/7429/11477883743_07bbd3eb6d_z.jpg">
                            </div>
                        </div><!--/span-->

                        <div class="col-md-4">
                            <div class="mag">
                                <br>
                                <img data-toggle="magnify" style="border-radius:5px;" src="https://c8.staticflickr.com/3/2942/15153406207_d961ac0b31_z.jpg" alt="">
                            </div>
                        </div><!--/span-->


                    </div><!--/row-->
                    <hr style="border-color: #666666;">
                    <br>
                    <br>
                    <br>
                    <small>Creative Commons images:
                        <br>
                        <a href="https://www.flickr.com/photos/ferjas/3768900774/in/photolist-6K3ATQ-iug9Xi-o4bUhE-kXCJmU-pnfVzt-kXBmWn-9anekQ-q1uxuR-kXBXhz-9ADre8-bCkZYz-qHGwFM-rv2TUG-6ys3Bk-pnfSMz-agXtM4-dzpMZD-qEA5ZW-aG9FNV-7Ext43-57TnnG-e5E1Cc-du92ys-a5zJq4-8xA6K7-be4o9R-bWGq12-iLiE4N-kXBhDV-5her4h-bqKLTC-bqKK7w-5FKmMR-o4mJkH-nDDeCc-jeDj9o-62MU8h-6rvdPd-obiT2T-rmR4Lh-ejBdnu-oBJRoH-bXWz11-ozHjJ8-svb1Lc-obiTnx-dZiEni-d9SDKd-bWpkmZ-gCoEhf/">Ferjas Photography on Flickr.com (3 Monster cans)</a>
                        <br>
                        <a href="https://www.flickr.com/photos/111422494@N04/11477883743/in/photolist-iug9Xi-9anekQ-9ADre8-agXtM4-du92ys-dzpMZD-qEA5ZW-7Ext43-a5zJq4-e5E1Cc-kXBhDV-bqKLTC-bqKK7w-o4mJkH-jeDj9o-62MU8h-obiT2T-rmR4Lh-oBJRoH-bXWz11-ozHjJ8-svb1Lc-obiTnx-dZiEni-d9SDKd-8xA6K7-be4o9R-bWGq12-iLiE4N-5her4h-5FKmMR-nDDeCc-bWpkmZ-6rvdPd-ejBdnu-kHVHXg-nS39rs-b3ueXk-o8QTyb-oiuepb-oiuvga-oaKuyv-r3CC86-cZvEDA-nv5zv3-o6VSiQ-dS4Wc5-pKd6e6-b5tx6X-ozM2AW">Kopp Marlo on Flickr.com (Row of Monster cans)</a>
                        <br>
                        <a href="https://www.flickr.com/photos/jeepersmedia/15153406207/in/photolist-p64aJg-azc6zk-eeAUmL-qRwQXy-ech4Rr-6k1wkF-qrHDpR-jsAkDV-7f2FeJ-7NYggd-ftKqio-9zxuNV-eevbLr-ahEi8q-9pUgqy-ftv4Ea-buUiqH-q9sVd5-aFumap-pxCpWw-qgL8SB-ptPVhn-pja6aq-98DMVv-aeqjNm-qAk5dj-6yw9iu-qMa84N-iXetWx-dfL6AG-p9ijuq-95nFxp-rDjDPw-qPx63P-cx4QU5-eVmKWu-nMXLdG-7rjPN8-cmTSXu-q8iuMK-p6RXLB-r6ZFVH-eT2E9i-cxNHzy-6yrWGz-r9Gkrg-qPyRXp-7AjCR6-pNVaHj-6ywgRb">Mike Mozart on Flickr.com (&Uuml;bermonster can)</a>
                    </small>
                        
                    
                   
                    
                    
                </div> <!-- / .container -->

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
        </div>
    </body>
</html>