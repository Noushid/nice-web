
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
                            <!-- <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="service.html">Our Services</a></li>
                            <li><a href="gallery.html">Moments</a></li>
                            <li class="active"><a href="blog.html">Blog</a></li>
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
                    <li><a href="index">Blog</a></li>
                    <li class="active">Blog View</li>
                </ol>
                    </div>
                </div>
            </div>
        </section>
        <!--page title end-->


        <!-- blog section start -->
        <section class="blog-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        if (isset($blog) and $blog != FALSE) {
                            ?>
                            <div class="posts-content single-post">

                                <article class="post-wrapper">

                                    <header class="entry-header-wrapper clearfix">

                                        <div class="entry-header">
                                            <h2 class="entry-title"><?php echo $blog[0]->heading ?></h2>

                                            <div class="entry-meta">
                                                <ul class="list-inline">
                                                    <li>
                                                        <i class="fa fa-clock-o"></i><a href="#"><?php echo date('M d, Y',strtotime($blog[0]->date)) ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- .entry-meta -->
                                        </div>

                                    </header>
                                    <!-- /.entry-header-wrapper -->

                                    <div class="thumb-wrapper">
                                        <img src="<?php echo $blog[0]->imgUrl?>"
                                             class="img-responsive" alt="">
                                    </div>
                                    <!-- .post-thumb -->


                                    <div class="entry-content">
                                        <p><?php echo $blog[0]->content ?></p>
                                    </div>
                                    <!-- .entry-content -->

                                </article>
                                <!-- /.post-wrapper -->


                            </div><!-- /.posts-content -->
                        <?php
                        }
                        ?>
                    </div><!-- /.col-md-8 -->

                    <div class="col-md-4">
                      <div class="tt-sidebar-wrapper" role="complementary">
                          <div class="widget widget_search">
                            <form role="search" method="get" class="search-form" >
                              <input type="text" class="form-control" value="" name="s" id="s" placeholder="Write any keywords">
                              <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                          </div><!-- /.widget_search -->


                          <div  class="widget widget_tt_popular_post">
                            <div class="tt-popular-post border-bottom-tab">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tt-popular-post-tab1" data-toggle="tab" aria-expanded="true">Latest</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- latest post tab -->
                                    <div id="tt-popular-post-tab1" class="tab-pane fade active in">
                                        <?php
                                        if (isset($blog_latest) and $blog_latest != FALSE) {
                                            foreach ($blog_latest as $blog) {
                                                ?>
                                                <div class="media">
                                                    <a class="media-left" href="<?php echo base_url() . 'blogView/'.$blog->id ?>">
                                                        <img
                                                            src="<?php echo $blog->imgUrl ?>"
                                                            alt="">
                                                    </a>

                                                    <div class="media-body">
                                                        <h4><a href="<?php echo base_url() . 'blogView/'.$blog->id ?>"><?php echo $blog->heading ?></a></h4>
                                                    </div>
                                                    <!-- /.media-body -->
                                                </div> <!-- /.media -->
                                            <?php
                                            }
                                        }?>
                                    </div>

                                </div><!-- /.tab-content -->
                            </div><!-- /.tt-popular-post -->
                          </div><!-- /.widget_tt_popular_post -->



        
                      </div><!-- /.tt-sidebar-wrapper -->
                    </div><!-- /.col-md-4 -->

                  </div><!-- /.row -->
                  <nav class="single-post-navigation" role="navigation">
                          <div class="row">
                            <!-- Previous Post -->
                            <div class="col-xs-4">
                              <div class="previous-post-link">
                                <a class="waves-effect waves-light" href="#"><i class="fa fa-long-arrow-left"></i>Read Previous Post</a>
                              </div>
                            </div>

                            <!-- Back -->
                            <div class="col-xs-4">
                              <div class="previous-post-link">
                                <a class="waves-effect waves-light" href="blog"><i class="fa fa-home"></i>Back To Blog</a>
                              </div>
                            </div>

                            <!-- Next Post -->
                            <div class="col-xs-4">
                              <div class="next-post-link">
                                <a class="waves-effect waves-light" href="#">Read Next Post<i class="fa fa-long-arrow-right"></i></a>
                              </div>
                            </div>

                          </div> <!-- .row -->
                        </nav>
            </div><!-- /.container -->

                        
        </section>
        <!-- blog section end -->