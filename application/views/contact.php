        <!--header start-->
        <header id="header" class="tt-nav nav-border-bottom">
            <div class="header-sticky light-header ">
                <div class="container">
                    <div class="search-wrapper">
                        <div class="search-trigger pull-right">
                            <div class='search-btn'></div>
                            <i class="material-icons">&#xE8B6;</i>
                        </div>
                        <!-- Modal Search Form -->
                        <i class="search-close material-icons">&#xE5CD;</i>
                        <div class="search-form-wrapper">
                            <form action="#" class="white-form">
                                <div class="input-field">
                                    <input type="text" name="search" id="search">
                                    <label for="search" class="">Search Here...</label>
                                </div>
                                <button class="btn pink search-button waves-effect waves-light" type="submit"><i class="material-icons">&#xE8B6;</i></button>  
                            </form>
                        </div>
                    </div><!-- /.search-wrapper -->

                    <div id="materialize-menu" class="menuzord">
                        <!--logo start-->
                        <a href="home" class="logo-brand">
                            <img src="<?php echo public_url()?>assets/img/logo.png" alt="" >
                        </a>
                        <!--logo end-->
                        <!--mega menu start-->
                        <ul class="menuzord-menu pull-right">
                            <!-- <li class="active"><a href="index.html">Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="service.html">Our Services</a></li>
                            <li><a href="gallery.html">Moments</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Contact Us</a></li> -->
                            <?php echo menu('Contact') ?>
                            
                        </ul>
                        <!--mega menu end-->
                    </div>
                </div>
            </div>
        </header>
        <!--header end-->


        <!--page title start-->
        <section class="page-title pattern-bg ptb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Contact Us</h2>
                        <span>24*7 Hours Services</span>
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Contact Us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!--page title end-->

        
        <!-- contact-form-section -->
        <section id="getintouch" class="section-padding">
          
          <div class="container">

              <div class="text-center mb-80">
                  <h2 class="section-title text-uppercase">Get in touch</h2>
                  <p class="section-sub">24-7 Technical Support from Kuwait. An online support to help your problems go away.A 24 hour, reliable service to help solve problems your face with any of our services.We are just a phone call or message us away.</p>
              </div>

            <div class="row mb-80">
                <div class="col-md-8">
                    <form name="contact-form" id="contactForm" action="contact-request" method="POST">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-field">
                            <input type="text" name="name" class="validate" id="name" required="">
                            <label for="name">Name</label>
                          </div>

                        </div><!-- /.col-md-6 -->

                        <div class="col-md-6">
                          <div class="input-field">
                            <label class="sr-only" for="email">Email</label>
                            <input id="email" type="email" name="email" class="validate" required="">
                            <label for="email" data-error="wrong" data-success="right">Email</label>
                          </div>
                        </div><!-- /.col-md-6 -->
                      </div><!-- /.row -->

                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-field">
                            <input id="phone" type="tel" name="phone" class="validate" >
                            <label for="phone">Phone Number</label>
                          </div>
                        </div><!-- /.col-md-6 -->

                        <div class="col-md-6">
                          <div class="input-field">
                            <input id="website" type="text" name="website" class="validate" >
                            <label for="website">Your Website</label>
                          </div>
                        </div><!-- /.col-md-6 -->
                      </div><!-- /.row -->

                      <div class="input-field">
                        <textarea name="message" id="message" class="materialize-textarea" ></textarea>
                        <label for="message">Message</label>
                      </div>

                      <button type="submit" name="submit" class="waves-effect waves-light btn submit-button pink mt-30">Send Message</button>
                    </form>
                </div><!-- /.col-md-8 -->

                <div class="col-md-4 contact-info">

                    <address>
                      <i class="material-icons brand-color">&#xE55F;</i>
                      <div class="address">
                        Block 4, Street 5 Jleeb Al-Shuyoukh,<br>
                        Abbassiya, Kuwait Police Station Road, <br>
                        Behind BEC & Lulu Exchange,<br> Near Orma Jewellery

                        <hr>
                      </div>

                      <i class="material-icons brand-color">&#xE61C;</i>
                      <div class="phone">
                        <p>Fax: 24 34 43 18<br>
                          Telephone: 24 31 07 83 <br> Mobile: 99 53 01 77 <br> Whatsapp: 99 53 01 77 <strong>,</strong>   <span class="ml-10">99 25 38 41</span></p>
                      </div>

                      <i class="material-icons brand-color">&#xE0E1;</i>
                      <div class="mail">
                        <p><a href="mailto:classickwt@gmail.com">classickwt@gmail.com</a><br>
                        <a href="mailto:classicpluskwt@gmail.com">classicpluskwt@gmail.com</a> <br>
                        <a href="mailto:classickuwait1@gmail.com">classickuwait1@gmail.com</a></p>
                      </div>
                    </address>

                </div><!-- /.col-md-4 -->
            </div><!-- /.row -->
          </div>
        </section>
        <!-- contact-form-section End -->


        <!-- map-section -->
        <div id="myMap" class="height-450"></div>
        <!-- /.map-section -->
