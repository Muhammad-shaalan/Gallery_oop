<?php

  $photos = Photo::find_all();

?>

<!-- START MODAL -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-9">
                <div class="row">
                  <?php foreach ($photos as $photo) : ?>
                    <div class="col-md-3">
                        <a role='check-box' area-hidden='false'>
                            <img src="<?php echo $photo->picture_path()?>" class='modal-photo' data="<?php echo $photo->photo_id ?>">
                        </a>
                    </div>  
                <?php endforeach; ?>
                </div>
              </div>
          
              <div class="col-md-3">
                  <div id="modal-sidebar"></div>
              </div>
            </div> <!-- //End Of Row -->  
      </div>
      <form class="modal-footer" method="post" action="">
        <input type="submit" id="set-user-image" class="btn btn-primary" disabled="true" name="x">
      </form>
    </div>
  </div>
</div>
<!-- END MODAL -->