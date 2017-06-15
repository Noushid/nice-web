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
                            <?php echo menu('Moments') ?>
                            
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
                <h2>Classic International</h2>
                <span>Life is not made up of minutes, hours, days, weeks, months, or years, but of moments.</span>
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Our Moments</li>
                </ol>
                    </div>
                </div>
            </div>
        </section>
        <!--page title end-->


        <section class="section-padding">
            <div class="text-center mb-50">
                <h2 class="section-title text-uppercase">Our Moments</h2>
                <!-- <p class="section-sub">Quisque non erat mi. Etiam congue et augue sed tempus. Aenean sed ipsum luctus, scelerisque ipsum nec, iaculis justo. Sed at vestibulum purus, sit amet vived at vestibulum purus erra at vestibulum purus diam. Nulla ac nisi rhoncus,</p> -->
            </div>


            <div class="portfolio-container text-center">


                <div class="portfolio col-4 mtb-50">
                    <!-- add "gutter" class for add spacing -->
                    <?php
                    if (isset($gallery) and $gallery != false) {
                        foreach ($gallery as $value) {
                            ?>
                            <div class="portfolio-item">
                                <div class="portfolio-wrapper">
                                    <div class="thumb">
                                        <div class="bg-overlay"></div>
                                        <div class="portfolio-slider" data-direction="vertical">
                                            <ul class="slides">
                                                <?php
                                                foreach ($value->files as $file) { ?>
                                                    <li>
                                                        <a href="<?php echo $file->imgUrl ?>" title="materialize Unique Design">
                                                            <img src="<?php echo $file->imgUrl ?>" alt="">
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="portfolio-intro">
                                            <div class="action-btn">
                                                <a href="#"> <i class="fa fa-search"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- thumb -->
                                </div>
                                <!-- /.portfolio-wrapper -->
                            </div><!-- /.portfolio-item -->
                        <?php
                        }
                    }?>



                </div><!-- /.portfolio -->

            </div><!-- portfolio-container -->
        </section>
