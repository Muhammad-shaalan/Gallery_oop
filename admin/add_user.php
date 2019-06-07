<!-- Header -->
              <?php include 'includes/header.php' ?>
              <?php 
                  if(!$session->is_signed_in()){
                    redirect('login.php');
                  } 
                ?>

                <?php
                    $msg = "";
                   if (isset($_POST['create'])) {
                     $user = new User();
                          $user->username         = $_POST['username'];
                          $user->password          = $_POST['password'];
                          $user->first_name         = $_POST['first_name'];
                          $user->last_name         = $_POST['last_name'];
                          $user->set_file($_FILES['user_image']);
                          
                           if ($user->save_user()) {
                              $msg = 'Successfully Upload';
                              $session->message("User {$user->username} has been added");
                               redirect("user.php");
                          }else{
                              $msg = join('<br>', $user->errors);
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
                  <div class="">
                      <h1 class="page-header">
                      users
                      <small>Subheading</small>
                      </h1>
                  </div>
                 <form action="add_user.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                      <?php echo $msg; ?>
                      <div class="col-md-6 offset-md-3 mx-auto">
                            <div class="form-group">
                                <input type="file" name="user_image">
                            </div>
                            <div class="form-group">
                               <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="create" class="btn btn-primary float-right">
                            </div>
                      </div>
                     
                    </div> <!-- //END OF ROW -->
                 </form>
            </div>    
        </div>
<!-- Footer-->
              <?php include 'includes/footer.php' ?>  