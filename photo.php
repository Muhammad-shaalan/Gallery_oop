<?php
  require_once ("admin/includes/init.php");

  if(empty($_GET['id'])){
    redirect("index.php");
  }
  $photo = Photo::find_by_id($_GET['id']);
  
  if (isset($_POST['submit'])) {
      $author    = trim($_POST['author']);
      $body      = trim($_POST['body']);

      $new_comment = Comment::creat_comment($photo->photo_id, $author, $body);
      if ($new_comment && $new_comment->save_comment()) {
            redirect("photo.php?id={$photo->photo_id}");
      }else{
          $msg = "There was some problem in saving";
          echo "<br>There was some problem in saving";
      }
  }else{
    $author = '';
    $body = '';
  }
  $comments = Comment::find_the_comment($photo->photo_id);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/back.css">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
          <a class="navbar-brand" href="index.php">Gallery</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="navbar-collapse collapse" id="navbarColor02" style="">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                         <a class="nav-link" href="admin">Admin</a>
                    </li>
                </ul>
          </div>
      </nav>       

      <div class="container">
          <div class="row">
              <div class="col-md-12">
                   <div class="page-wrapper col-md-10">
                        <h1 class="page-header">
                          <?php echo $photo->title; ?>
                        </h1>
                        <a class="mb-2 d-block">By: Muhammad Shaalan</a><br>
                        <img src="admin/<?php echo $photo->picture_path();?>">
                        <p class="lead"><?php echo $photo->caption; ?></p>
                        <p class="lead"><?php echo $photo->description; ?></p>
                        <hr>
                        <div class="form">
                            <h5>Leave a comment</h5>
                            <form method="POST">
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" name="author" class="form-control">
                                </div>
                                <div class="form-group">
                                    <textarea rows="3" class="form-control" name="body"></textarea>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary">
                            </form>
                        </div>
                  <!-- Comment -->
                      <?php
                      foreach ($comments as $comment){
                      ?>
                      <div class="media mt-3">
                          <img class="mr-3" src="http://placehold.it/65x65" alt="Generic placeholder image">
                          <div class="media-body">
                              <h5 class="mt-0"><?php echo $comment->author ?></h5>
                              <?php echo $comment->body ?>
                          </div>
                      </div>
                    <?php } ?>
                 </div>
              </div>
          </div>   <!-- End Of Row -->   
      </div> <!-- End OF Container -->
      <hr>
       <!-- Start Footer -->
    <footer class="p-2 text-center" style="background-color:#343a40; color:#fff">Created By <strong><a href="http://shaalan.epizy.com/M-Shaalan-v1" target="_blank">M.Shaalan</a></strong> 2018</footer>
    <!-- End Footer -->
  </body>
</html>
