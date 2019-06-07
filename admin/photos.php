<!-- Header -->
              <?php include 'includes/header.php' ?>
              <?php 
                  if(!$session->is_signed_in()){
                    redirect('login.php');
                  } 

                  $photos = Photo::find_all();
                  
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
                      Photos
                      </h1>
                      <div class="col-md-12">
                        <?php if(!empty($photos)) { ?>
                        <table class="table table-hover">
                            <tr>
                                <td>Photo</td>
                                <td>Id</td>
                                <td>File name</td>
                                <td>Title</td>
                                <td>Size</td>
                                <td>Comment</td>
                                <?php
                                foreach ($photos as $photo) {?>
                                    <tr>
                                        <td>
                                            <img src ="<?php echo $photo->picture_path() ?>" class='cls-image img-fluid'>
                                            <div class="picture_link mt-2">
                                                <a class='delete' href="delete_photo.php/?id=<?php echo $photo->photo_id ?>">Delete</a>
                                                <a href="edit_photo.php?id=<?php echo $photo->photo_id ?>">Edit</a>
                                                <a href="../photo.php?id=<?php echo $photo->photo_id ?>">View</a>
                                            </div>
                                        </td>
                                        <td><?php echo $photo->photo_id ?></td>
                                        <td><?php echo $photo->filename ?></td>
                                        <td><?php echo $photo->title ?></td>
                                        <td><?php echo $photo->size ?></td>
                                        <?php $comments = Comment::find_the_comment($photo->photo_id)?>
                                        <td><a href="comment_photo.php?id=<?php echo $photo->photo_id ?>"><?php echo count($comments); ?></a></td>
                                    </tr>
                                
                                <?php }
                                ?>
                            </tr>
                        </table>
                      <?php }else{
                        echo "<div class='alert alert-danger'>No pictures even this moment</div>";
                      } ?>
                      </div>
                  </div>
              </div>

        </div>    

<!-- Footer-->
              <?php include 'includes/footer.php' ?>  