<!-- Header -->
              <?php include 'includes/header.php' ?>
              <?php 
                  if(!$session->is_signed_in()){
                    redirect('login.php');
                  } 

                  if (empty($_GET['id'])) {
                      redirect("photos.php");
                  }

                  $comments = Comment::find_the_comment($_GET['id']);
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
                      comments
                      <small>One Photo</small>
                      </h1>

                      <?php if (!empty($session->message)) {?>
                          <div class="alert alert-success">
                              <?php echo $session->message; ?>
                          </div>
                      <?php } ?>
                      
                      <div class="col-md-12">
                        <table class="table table-hover">
                            <tr>
                                <td>Id</td>
                                <td>Author</td>
                                <td>Body</td>
                                <?php
                                foreach ($comments as $comment) {?>
                                    <tr>
                                        <td><?php echo $comment->id ?></td>
                                        <td>
                                              <?php echo $comment->author ?>
                                                <div class="action_links">
                                                    <a href="delete_comment_photo.php?id=<?php echo $comment->id ?>">Delete</a>
                                                </div>
                                          </td>
                                        <td><?php echo $comment->body ?></td>
                                    </tr>
                                
                                <?php }
                                ?>
                            </tr>
                        </table>
                      </div>
                  </div>
              </div>

        </div>    

<!-- Footer-->
              <?php include 'includes/footer.php' ?>  