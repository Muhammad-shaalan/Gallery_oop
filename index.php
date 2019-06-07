<?php include 'includes/header.php'; ?>
<?php 
  
  $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
  $items_per_page = 4;
  $items_total_count = Photo::count_all();

  $paginate = new Paginate($page, $items_per_page, $items_total_count);

  $sql = "SELECT * FROM photos LIMIT {$items_per_page} OFFSET {$paginate->offset()}";

  
    $photos = Photo::find_this_query($sql);

?>
          <div class="container">
            <div class="row">
                <?php foreach ($photos as $photo) { ?>
                  <div class="col-6 col-md-3">
                      <a href="photo.php?id=<?php echo $photo->photo_id ?>">
                          <img src="admin/<?php echo $photo->picture_path();?>" class="img-responsive">
                      </a>
                  </div>
                <?php } ?>
            </div>  <!-- //End Of Row -->
           

            <div class="">
              <div class="text-center">
                  <ul class="pagination">
                    
                    <?php 

                      if ($paginate->page_total() > 1) {
                            
                            if ($paginate->has_previous()) {
                                echo "<li class='page-item float-right'><a href='index.php?page={$paginate->previous()}'  class='page-link'>Previous</a></li>";
                            }

                            for($i = 1; $i <= $paginate->page_total(); $i++){
                                echo "<li class='page-item'><a href='index.php?page={$i}' class='page-link'>{$i}</a></li>";
                            }

                            if ($paginate->has_next()) {
                                echo "<li class='page-item mr-auto'><a href='index.php?page={$paginate->next()}'  class='page-link'>Next</a></li>";
                            }
                      }
                    ?>
                    </ul>
              </div>
            </div> <!-- //End Of Row -->

        </div>  <!-- //End Of Container -->

  <!-- Start Footer -->
<footer class="footer">Created By <strong><a href="http://shaalan.epizy.com/M-Shaalan-v1" target="_blank">M.Shaalan</a></strong> 2018</footer>
<!-- End Footer -->
  </body>
</html>
