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
                            <?php echo menu('Blog') ?>
                            
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
                <span>Our Blog Page</span>
                <ol class="breadcrumb">
                    <li><a href="home">Home</a></li>
                    <li class="active">Blog</li>
                </ol>
                    </div>
                </div>
            </div>
        </section>
        <!--page title end-->


        <!-- Grid News -->
        <section class="section-padding grid-news-hover grid-blog">
            <div class="container">

              <div class="row">
                <div id="blogGrid">
                  
                  <!-- blog one start -->
                    <?php
                    if (isset($blog) and $blog != FALSE) {
                        foreach ($blog as $value) {
                            ?>
                            <div class="col-xs-12 col-sm-6 col-md-4 blog-grid-item">
                                <article class="post-wrapper">
                                    <div class="thumb-wrapper waves-effect waves-block waves-light">
                                        <a href="<?php echo 'blogView/' . $value->id ?>"><img src="<?php echo $value->imgUrl ?>" class="img-responsive"
                                                                alt=""></a>

                                        <div class="post-date">
                                            <?php echo $value->day?><span><?php echo $value->month?></span>
                                        </div>
                                    </div>
                                    <!-- .post-thumb -->

                                    <div class="blog-content">
                                        <div class="hover-overlay light-blue"></div>
                                        <header class="entry-header-wrapper">
                                            <div class="entry-header">
                                                <h2 class="entry-title pcut"><a href="<?php echo 'blogView/' . $value->id ?>"><?php echo $value->heading ?></a></h2>
                                            </div>
                                            <!-- /.entry-header -->
                                        </header>
                                        <!-- /.entry-header-wrapper -->
                                        <div class="entry-content">
                                            <p class="pcut"> <?php echo $value->content ?></p>
                                        </div>
                                        <!-- .entry-content -->
                                    </div>
                                    <!-- /.blog-content -->

                                </article>
                                <!-- /.post-wrapper -->
                            </div><!-- /.col-md-4 -->
                        <?php
                        }
                    }?>
                  <!-- blog one end -->


                </div><!-- /#blogGrid -->
              </div><!-- /.row -->
<!--              <ul class="pagination post-pagination text-center mt-50">-->
<!--                <li><a href="#." class="waves-effect waves-light"><i class="fa fa-angle-left"></i></a></li>-->
<!--                <li><span class="current waves-effect waves-light">1</span></li>-->
<!--                <li><a href="#." class="waves-effect waves-light">2</a></li>-->
<!--                <li><a href="#." class="waves-effect waves-light"><i class="fa fa-angle-right"></i></a></li>-->
<!--              </ul>-->


            </div><!-- /.container -->
        </section>
        <!-- Grid News End -->


