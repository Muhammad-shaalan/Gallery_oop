<!-- Header -->
              <?php include 'includes/header.php' ?>
              <?php 
                  if(!$session->is_signed_in()){
                    redirect('login.php');
                  } 
                ?>

                <?php
                if (empty($_GET['id'])) {
                  redirect("photos.php");
                }else{
                  $photo = Photo::find_by_id($_GET['id']);
                   if (isset($_POST['update'])) {
                    if($photo){
                      $photo->title                   = $_POST['title'];
                      $photo->caption             = $_POST['caption'];
                      $photo->alternate_text   = $_POST['alternate_text'];
                      $photo->description       = $_POST['description'];
                      $photo->save();
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
                      Photos
                      <small>Subheading</small>
                      </h1>
                  </div>
                 <form action="" method="post" class="ml-4 d-block">
                  <div class="row">
                      <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" value="<?php echo $photo->title ?>">
                            </div>
                            <div class="form-group">
                                <a href="#" class="text-center  d-block"><img src="<?php echo $photo->picture_path() ?>" class="cls-image img-thumbnail mx-auto d-block mb-5 img-fluid user-img-edit"></a>
                            </div>
                            <div class="form-group">
                                <label>Caption</label>
                                <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption ?>">
                            </div>
                            <div class="form-group">
                                <label>Alternate Text</label>
                                <input type="text" name="alternate_text" class="form-control" value="<?php echo $photo->alternate_text ?>">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $photo->description ?>
                                </textarea> 
                            </div>
                      </div>
                      <div class="col-md-5">
                          <div class="photo-info-box mx-auto d-block">
                              <div class="info-box-header">
                                  <h4>Save<i class="fas fa-angle-down  float-right"></i></h4>
                              </div>
                              <div class="inside">
                                  <div class="box-inner">
                                      <p class="text">
                                          <i class="far fa-calendar-alt"></i> <span>Upload on April 22, 2030 @ 2:46</span>
                                      </p>
                                      <p class="text">
                                           Photo id: <span class="data"><?php echo $photo->photo_id ?></span>
                                      </p>
                                      <p class="text">
                                           Filename: <span class="data"><?php echo $photo->filename ?></span>
                                      </p>
                                      <p class="text">
                                           File size: <span class="data"><?php echo $photo->size ?></span>
                                      </p>
                                      <p class="text">
                                           File type: <span class="data"><?php echo $photo->type ?></span>
                                      </p>
                                  </div>
                                  <div class="info-box-footer">
                                      <div class="info-box-delete float-left">
                                          <a href="delete_photo.php?id=<?php echo $photo->photo_id ?>" class="btn btn-danger">Delete</a>
                                      </div>
                                      <div class="info-box-update float-right">
                                          <input type="submit" name="update" class="btn btn-primary" value="Update">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>   <!-- CLASS_MD_4 -->
                    </div> <!-- //END OF ROW -->
                 </form>
            </div>    
        </div>

<!-- Footer-->
              <?php include 'includes/footer.php' ?>  