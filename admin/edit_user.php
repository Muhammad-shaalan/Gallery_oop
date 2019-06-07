<!-- Header -->
              <?php include 'includes/header.php' ?>
              <?php include 'includes/modal.php' ?>
              <?php 
                  if(!$session->is_signed_in()){
                    redirect('login.php');
                  } 
                ?>

                <?php
                if (empty($_GET['id'])) {
                  redirect("user.php");
                }else{
                  $user = User::find_by_id($_GET['id']);
                   if (isset($_POST['update'])) {
                      if($user){
                            $user->username        = $_POST['username'];
                            $user->password        = $_POST['password'];
                            $user->first_name       = $_POST['first_name'];
                            $user->last_name       = $_POST['last_name'];
                            if (empty($_FILES['user_image'])) {
                                $user->save();
                                $session->message("User {$user->username} has been updated");
                                redirect("user.php");
                            }else{
                                $user->set_file($_FILES['user_image']);
                                //$user->save_user();
                                $user->save();
                                redirect("user.php");
                                $session->message("User {$user->username} has been updated");
                            }
                      }
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
                      Edit
                      <small>user</small>
                      </h1>
                  </div>
                  <div class="row">
                      <div class="col-md-6 user-img-box">
                        <!-- Button trigger modal -->
                          <a href="" data-toggle="modal" data-target="#exampleModalCenter">
                              <img src="<?php echo $user->image_path_and_plasceholder()?>"
                                       class="mx-auto d-block mb-5 img-fluid user-img-edit">
                          </a>
                      </div>
                      <div class="col-md-6">
                            <form action="" method="POST" enctype="multipart/form-data" class="ml-4 d-block">
                                <div class="form-group">
                                    <input type="file" name="user_image">
                                </div>
                                <div class="form-group">
                                   <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" class="form-control" value="<?php echo $user->password ?>">
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
                                </div>
                                <div class="float-left">
                                          <a href="delete_user.php?id=<?php echo $user->id ?>" class="btn btn-danger" id="user-id">Delete</a>
                                      </div>
                                      <div class="float-right">
                                          <input type="submit" name="update" class="btn btn-primary" value="Update">
                                      </div>
                          </form>
                      </div> 
                  </div>
            </div>    
        </div>

<!-- Footer-->
              <?php include 'includes/footer.php' ?>  