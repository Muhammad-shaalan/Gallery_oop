<!-- Header -->
              <?php include 'includes/header.php' ?>
              <?php 
                  if(!$session->is_signed_in()){
                    redirect('login.php');
                  } 

                  $msg = "";
                  if (isset($_FILES['file'])) {
                    $photo = new photo();
                    $photo->title = $_POST['title'];
                    $photo->set_file($_FILES['file']);
                    if ($photo->save()) {
                      $msg = 'Successfully Upload';
                    }else{
                      $msg = join('<br>', $photo->errors);
                    }
                  }
              ?>

          
              <!-- Top Nav -->
              <?php include 'includes/top_nav.php' ?>

              

        <div class="row">
              <!-- Side-bar Nav -->
              <?php include 'includes/sidebar.php' ?>

               <!-- Wrapper Nav -->
              <div class="page-wrapper col-md-10">
                  <div class="row">                  
                      <div class="col-md-12">
                            <h1 class="page-header">
                          Upload
                          </h1>
                          <?php echo $msg;   ?>
                          <div class="col-md-6">
                            <form action="upload.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                      <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                      <input type="file" name="file" class="btn btn-primary">
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary">
                            </form>
                          </div>
                      </div>        
                  </div>      <!-- //End Of Row -->
                  <div class="row">
                      <div class="col-md-12">
                            <form action="upload.php" class="dropzone"></form>
                      </div>
                  </div>
              </div>

          </div>    <!-- //End Of Row -->
  
          

<!-- Footer-->
              <?php include 'includes/footer.php' ?>  