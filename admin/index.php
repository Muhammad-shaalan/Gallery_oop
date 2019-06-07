<!-- Header -->
              <?php include 'includes/header.php' ?>
              <?php 
                  if(!$session->is_signed_in()){
                    redirect('login.php');
                  } 
              ?>
      
          
              <!-- Top Nav -->
              <?php include 'includes/top_nav.php' ?>

              
        <div class="row">
              <!-- Side-bar Nav -->
              <?php include 'includes/sidebar.php' ?>

               <!-- Wrapper Nav -->
              <div class="page-wrapper col-md-10">
                  <div class="">
                        <h1 class="page-header">
                        Admin
                        <small>Dashboard</small>
                        </h1>
                        <div class="row mx-auto">
                            <div class="col-lg-3 col-md-6 col-12">
                                  <div class="card border-primary mb-3 mx-auto" style="max-width: 18rem;">
                                        <div class="card-body text-white  bg-primary">
                                              <div class="row">
                                                    <div class="col-4">
                                                          <i class="fa fa-users fa-3x"></i>
                                                    </div>
                                                    <div class="col-8 text-right">
                                                          <div class="card-text-num"><?php echo $session->count; ?></div>
                                                          <div class="card-text">New Views</div>
                                                    </div>
                                              </div>
                                        </div>
                                        <div class="card-footer bg-gray border-primary text-primary">
                                            <span>View Details</span>
                                            <span class="float-right"><i class="fas fa-arrow-circle-right"></i></span>
                                        </div>
                                  </div><!-- //End Card -->
                            </div>  <!-- End Of Col -->

                            <div class="col-lg-3 col-md-6">
                                  <div class="card border-success mb-3 mx-auto" style="max-width: 18rem;">
                                        <div class="card-body text-white  bg-success">
                                              <div class="row">
                                                    <div class="col-4">
                                                          <i class="far fa-image fa-3x"></i>
                                                    </div>
                                                    <div class="col-8 text-right">
                                                          <div class="card-text-num"><?php echo Photo::count_all(); ?></div>
                                                          <div class="card-text">Photos</div>
                                                    </div>
                                              </div>
                                        </div>
                                        <a href="photos.php">
                                            <div class="card-footer bg-gray border-success text-success">
                                                <span>Total Photos In Gallery</span>
                                                <span class="float-right"><i class="fas fa-arrow-circle-right"></i></span>
                                            </div>
                                        </a>

                                  </div><!-- //End Card -->
                            </div>  <!-- End Of Col -->

                            <div class="col-lg-3 col-md-6">
                                  <div class="card border-warning mb-3 mx-auto" style="max-width: 18rem;">
                                        <div class="card-body text-white  bg-warning">
                                              <div class="row">
                                                    <div class="col-4">
                                                          <i class="fa fa-user fa-3x"></i>
                                                    </div>
                                                    <div class="col-8 text-right">
                                                          <div class="card-text-num"><?php echo User::count_all(); ?></div>
                                                          <div class="card-text">Users</div>
                                                    </div>
                                              </div>
                                        </div>
                                        <a href="user.php">
                                            <div class="card-footer bg-gray border-warning text-warning">
                                                <span>Total Users</span>
                                                <span class="float-right"><i class="fas fa-arrow-circle-right"></i></span>
                                            </div>
                                        </a>    
                                  </div><!-- //End Card -->
                            </div>  <!-- End Of Col -->

                            <div class="col-lg-3 col-md-6">
                                  <div class="card border-danger mb-3 mx-auto" style="max-width: 18rem;">
                                        <div class="card-body text-white  bg-danger">
                                              <div class="row">
                                                    <div class="col-4">
                                                          <i class="fa fa-life-ring fa-3x"></i>
                                                    </div>
                                                    <div class="col-8 text-right">
                                                          <div class="card-text-num"><?php echo Comment::count_all(); ?></div>
                                                          <div class="card-text">Comments</div>
                                                    </div>
                                              </div>
                                        </div>
                                        <a href="comments.php">
                                            <div class="card-footer bg-gray border-danger text-danger">
                                                <span>Total Comments</span>
                                                <span class="float-right"><i class="fas fa-arrow-circle-right"></i></span>
                                            </div>
                                        </a>
                                  </div><!-- //End Card -->
                            </div>  <!-- End Of Col -->

                        </div>  <!-- //End Of Row -->

                        <div class="row">
                            <div id="piechart" style="width: 900px; height: 500px;"></div>
                        </div>
                        
                        
                    
                  </div>
              </div>
        </div>    

<!-- Footer-->
              <?php include 'includes/footer.php' ?>  