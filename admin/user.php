<!-- Header -->
              <?php include 'includes/header.php' ?>
              <?php 
                  if(!$session->is_signed_in()){
                    redirect('login.php');
                  } 

                  $users = User::find_all();
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
                      Users
                      </h1>
                      <?php if (!empty($session->message)) {?>
                          <div class="alert alert-success">
                              <?php echo $session->message; ?>
                          </div>
                      <?php } ?>
                      
                      <a href="add_user.php"  class="btn btn-primary mb-3">Add User</a>
                      <div class="col-md-12">
                        <?php if (!empty($users)) { ?>
                        <table class="table table-hover">
                            <tr>
                                <td>Id</td>
                                <td>Photo</td>
                                <td>Username</td>
                                <td>First name</td>
                                <td>Last name</td>
                                <?php
                                foreach ($users as $user) {?>
                                    <tr>
                                        <td><?php echo $user->id ?></td>
                                        <td>
                                            <img src ="<?php 
                                            if($user->user_image !==' '){echo $user->image_path_and_plasceholder();} 
                                            else{echo "http://placehold.it/200x200";}

                                            ?>" class='cls-iuser-mage'>
                                        </td>
                                        <td>
                                              <?php echo $user->username ?>
                                                <div class="action_links mt-2">
                                                    <a href="delete_user.php/?id=<?php echo $user->id ?>" class='delete'>Delete</a>
                                                    <a href="edit_user.php?id=<?php echo $user->id ?>">Edit</a>
                                                </div>
                                          </td>
                                        <td><?php echo $user->first_name ?></td>
                                        <td><?php echo $user->last_name ?></td>
                                    </tr>
                                
                                <?php }
                                ?>
                            </tr>
                        </table>
                        <?php }else{
                        echo "<div class='alert alert-danger'>No users even this moment</div>";
                        } ?>
                      </div>
                  </div>
              </div>

        </div>    

<!-- Footer-->
              <?php include 'includes/footer.php' ?>  