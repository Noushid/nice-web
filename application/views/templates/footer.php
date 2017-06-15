		<!--footer 1 start -->
        <footer class="footer footer-one">
            <div class="primary-footer brand-bg">
                <div class="container">
                    <a href="#top" class="page-scroll btn-floating btn-large pink back-top waves-effect waves-light tt-animate btt" data-section="#top">
                      <i class="material-icons">&#xE316;</i>
                    </a>

                    <div class="row">
                        <div class="col-md-4 widget clearfix">
                            <h2 class="white-text">About Classic International</h2>
                            <p>Classic International is Leading Typing and Translation Service Provider in India and Kuwait. Also We offer Health Insurances And Educational Insurances, etc..</p>

                            <ul class="social-link tt-animate ltr">
                              <li><a href="https://www.facebook.com/ClassicInternational" target="_blank"><i class="fa fa-facebook"></i></a></li>
                              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div><!-- /.col-md-3 -->

                        <div class="col-md-3 widget" style="padding-left: 80px;">
                            <h2 class="white-text">First Look</h2>

                            <ul class="footer-list">
                                <li><a href="about"><i class="fa fa-chevron-right mr-10"></i>About Us</a></li>
                                <li><a href="home#WhatWeDo"><i class="fa fa-chevron-right mr-10"></i>What We Do</a></li>
                                <li><a href="home#appointment"><i class="fa fa-chevron-right mr-10"></i>Make An Appointment</a></li>
                                <li><a href="contact#getintouch"><i class="fa fa-chevron-right mr-10"></i>Contact Us</a></li>
                            </ul>
                        </div><!-- /.col-md-3 -->

                        <div class="col-md-2 widget">
                            <h2 class="white-text">Quick links</h2>

                            <ul class="footer-list">
                                <li><a href="services"><i class="fa fa-chevron-right mr-10"></i>Our Services</a></li>
                                <li><a href="home#latestnews"><i class="fa fa-chevron-right mr-10"></i>Latest News</a></li>
                                <li><a href="blog"><i class="fa fa-chevron-right mr-10"></i>Our Blogs</a></li>
                                <li><a href="contact#getintouch"><i class="fa fa-chevron-right mr-10"></i>Get In Touch</a></li>
                            </ul>
                        </div><!-- /.col-md-3 -->


                        <div class="col-md-3 widget">
                            <h2 class="white-text">Subscribe Me</h2>

                            <form id="subscribeForm" method="post" action="">
                              <div class="form-group clearfix">
                                <label class="sr-only" for="subscribe">Email address</label>
                                <input type="email" class="form-control" id="mail" name="email" placeholder="Email address">
                                <button type="submit" class="tt-animate ltr" id="subscribe"><i class="fa fa-long-arrow-right"></i></button>
                              </div>
                            </form>
                            <div class="col-md-10 hide" id="sub_msg">
                                <div class="alert alert-success">
                                    Subscribed
                                </div>
                            </div>
                            <div class="col-md-10 hide" id="sub_error">
                                <div class="alert alert-success" id="error_content">
                                    Subscription failed!try again later
                                </div>
                            </div>

                            
                            <div class="widget-tags">
                              <a href="moments">Our Moments</a>
                              <a href="login">Admin Login</a>
                            </div><!-- /.widget-tags -->
                        </div><!-- /.col-md-3 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.primary-footer -->

            <div class="secondary-footer brand-bg darken-2">
                <div class="container">
                    <span class="copy-text">Copyright &copy; <span id="year"></span> <a href="home">Classic International info</a> &nbsp;  | &nbsp;  All Rights Reserved &nbsp;  | &nbsp;  Designed  By <a href="http://psybotechnologies.com/">Psybo Technologies</a></span>
                </div><!-- /.container -->
            </div><!-- /.secondary-footer -->
        </footer>
        <!--footer 1 end-->


        <!-- Preloader -->
        <div id="preloader">
          <div class="preloader-position"> 
            <img src="<?php echo public_url()?>assets/img/logo-colored.png" alt="logo" >
            <div class="progress">
              <div class="indeterminate"></div>
            </div>
          </div>
        </div>
        <!-- End Preloader -->

        <!-- Applay Modal Dialog Box
        ===================================== -->
        <div id="applayServices" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title text-center"><i class="fa fa-list fa-fw"></i>Get A Quote  Now</h5>
                    </div>
                    <div class="modal-body">                        
                        <form class="form-horizontal" name="quoteForm" id="quoteForm" method="POST" action="request-quote">

                            <div class="">
                              <div class="col-sm-offset-1 col-md-10">
                                <div class="input-field mt-20">
                                  <input type="text" name="name" class="validate" id="name" required="">
                                  <label for="name">Full Name*</label>
                                </div>
                              </div>

                              <div class="col-sm-offset-1 col-md-10">
                                <div class="input-field mt-20">
                                  <input id="email" type="email" name="email" class="validate" required="">
                                  <label for="email" data-error="wrong" data-success="right">Email Address*</label>
                                </div>
                              </div>

                              <div class="col-sm-offset-1 col-md-10">
                                <div class="input-field mt-20">
                                  <input type="text" name="people" class="validate" id="phone">
                                  <label for="people">Contact Number*</label>
                                </div>
                              </div>

                              <div class="col-sm-offset-1 col-md-10">
                                <div class="input-field mt-20">
                                    <select class="text-capitalize selectpicker form-control required selectbox" name="service" data-style="g-select" data-width="100%">
                                        <option value="0" selected="">Select Service</option>
                                        <option value="Typing Services">Typing Services</option>
                                        <option value="Services for Ministry of Health">Services for Ministry of Health</option>
                                        <option value="Services for Higher & Lower Education">Services for Higher & Lower Education</option>
                                        <option value="Medical Fingerprint Assists Services">Medical Fingerprint Assists Services</option>
                                        <option value="Insurance Services">Insurance Services</option>
                                        <option value="Health Insurance Services">Health Insurance Services</option>
                                        <option value="Education Services">Education Services</option>
                                        <option value="Transportation services">Transportation services </option>
                                        <option value="Pan Card Services">Pan Card Services</option>
                                        <option value="Air Tickets and Related Services">Air Tickets and Related Services</option>
                                        <option value="Courier Services">Courier Services</option>
                                        <option value="Miscellaneous Services">Miscellaneous Services</option>
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-offset-1 col-md-10">
                                <div class="input-field mt-20">
                                  <textarea name="message" id="message" class="materialize-textarea" ></textarea>
                                  <label for="message">Additional note</label>
                                </div>
                              </div>

                            </div><!-- /.row -->

                            <div class="form-group mt40 text-right">
                                <div class="col-sm-10">
                                    <div class="col-sm-8 col-sm-offset-2" id="statusMsg">

                                    </div>
                                    <div class="col-sm-2 pull-right">
                                        <button type="submit" class="waves-effect waves-light btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-gray">
                        <span class="pull-left color-pink"><span><i class="fa fa-phone color-cyan fa-fw ml-10"></i></span>9953 01 77</span>
                        <span class="pull-right color-pink"><span><i class="fa fa-envelope color-cyan fa-fw mr-10"></i></span>classickwt@gmail.com</span>
                    </div>
                </div>
            </div>
        </div> 



        <!-- jQuery -->
        <script src="<?php echo public_url()?>assets/js/jquery-2.1.3.min.js"></script>
        <script src="<?php echo public_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo public_url()?>assets/materialize/js/materialize.min.js"></script>
        <script src="<?php echo public_url()?>assets/js/jquery.easing.min.js"></script>
        <script src="<?php echo public_url()?>assets/js/jquery.sticky.min.js"></script>
        <script src="<?php echo public_url()?>assets/js/smoothscroll.min.js"></script>
        <script src="<?php echo public_url()?>assets/js/imagesloaded.js"></script>
        <script src="<?php echo public_url()?>assets/js/jquery.stellar.min.js"></script>
        <script src="<?php echo public_url()?>assets/js/jquery.inview.min.js"></script>
        <script src="<?php echo public_url()?>assets/js/jquery.shuffle.min.js"></script>
        <script src="<?php echo public_url()?>assets/js/menuzord.js"></script>
        <script src="<?php echo public_url()?>assets/js/bootstrap-tabcollapse.min.js"></script>
        <script src="<?php echo public_url()?>assets/owl.carousel/owl.carousel.js"></script>
        <script src="<?php echo public_url()?>assets/flexSlider/jquery.flexslider-min.js"></script>
        <script src="<?php echo public_url()?>assets/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo public_url()?>assets/js/scripts.js"></script>
        <script src="<?php echo public_url()?>assets/js/masonry.pkgd.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js"></script>

        <!-- RS5.0 Core JS Files -->
        <script src="<?php echo public_url()?>assets/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?php echo public_url()?>assets/revolution/js/jquery.themepunch.revolution.min.js"></script>

        <!-- RS5.0 Init  -->
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery(".materialize-slider").revolution({
                    sliderType: "standard",
                    sliderLayout: "fullscreen",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "on",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        onHoverStop: "off",
                        touch: {
                            touchenabled: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        },
                        arrows: {
                            style: "gyges",
                            enable: true,
                            hide_onmobile: false,
                            hide_onleave: true,
                            tmp: '',
                            left: {
                                h_align: "left",
                                v_align: "center",
                                h_offset: 10,
                                v_offset: 0
                            },
                            right: {
                                h_align: "right",
                                v_align: "center",
                                h_offset: 10,
                                v_offset: 0
                            }
                        }
                    },
                    responsiveLevels: [1240, 1024, 778, 480],
                    gridwidth: [1240, 1024, 778, 480],
                    gridheight: [700, 600, 500, 500],
                    disableProgressBar: "on",
                    parallax: {
                        type: "mouse",
                        origo: "slidercenter",
                        speed: 2000,
                        levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50]
                    }
                });
            });
        </script>


        <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems! The following part can be removed on Server for On Demand Loading) -->
         
        <script type="text/javascript" src="<?php echo public_url()?>assets/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url()?>assets/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url()?>assets/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url()?>assets/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url()?>assets/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url()?>assets/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url()?>assets/revolution/js/extensions/revolution.extension.migration.min.js"></script>
        <script type="text/javascript" src="<?php echo public_url()?>assets/revolution/js/extensions/revolution.extension.parallax.min.js"></script>

        <!-- year scrpt -->
        <script type="text/javascript">
            n =  new Date();
            y = n.getFullYear();
            document.getElementById("year").innerHTML = y;
        </script>

         <!-- Google Map Customization  -->
        <script type="text/javascript">
            jQuery(document).ready(function() {

                //set your google maps parameters
                var $latitude = 29.26708, //Visit http://www.latlong.net/convert-address-to-lat-long.html for generate your Lat. Long.
                    $longitude = 47.941092,
                    $map_zoom = 14 /* ZOOM SETTING */

                //google map custom marker icon 
                var $marker_url = 'assets/img/pin.png';

                //we define here the style of the map
                var style = [{
                    styles: [
                      {
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#212121"
                          }
                        ]
                      },
                      {
                        "elementType": "labels.icon",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#757575"
                          }
                        ]
                      },
                      {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#212121"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#757575"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.country",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#9e9e9e"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.land_parcel",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.locality",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#bdbdbd"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#757575"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#181818"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#616161"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.park",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#1b1b1b"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "geometry.fill",
                        "stylers": [
                          {
                            "color": "#2c2c2c"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#8a8a8a"
                          }
                        ]
                      },
                      {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#373737"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#3c3c3c"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway.controlled_access",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#4e4e4e"
                          }
                        ]
                      },
                      {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#616161"
                          }
                        ]
                      },
                      {
                        "featureType": "transit",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#757575"
                          }
                        ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#000000"
                          }
                        ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#3d3d3d"
                          }
                        ]
                      }
                    ]
                }];

                //set google map options
                var map_options = {
                    center: new google.maps.LatLng($latitude, $longitude),
                    zoom: $map_zoom,
                    panControl: true,
                    zoomControl: true,
                    mapTypeControl: true,
                    streetViewControl: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    styles: style
                }
                //inizialize the map
                var map = new google.maps.Map(document.getElementById('myMap'), map_options);
                //add a custom marker to the map                
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng($latitude, $longitude),
                    map: map,
                    visible: true,
                    icon: $marker_url
                });

                var contentString = '<div id="mapcontent">' + '<p><strong>Classic Typing Centre</strong> <br> Jleeb Al shuyoukh, Abbassiya, Kuwait <br> Mob: 99 530 177</p></div>';
                var infowindow = new google.maps.InfoWindow({
                    maxWidth: 320,
                    content: contentString
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });
            });
        </script>
        <!--Subscribe-->

        
    </body>
  
</html>