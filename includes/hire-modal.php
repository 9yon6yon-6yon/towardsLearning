<div class="modal fade " id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Write A Message: </h5>
        <input type="text" class="form-control" name="answer" required>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="process.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pick a time</label>
            <input type="datetime-local" class="form-control" name="answer" required>
            <input type="hidden" name="s_id" value="<?php echo $row['id']; ?>" >
            <input type="text" name="st_point" value="<?php echo $t['id']; ?>" >
          </div>
          <p id="demo"> </p>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
        <button type="submit" class="btn btn-primary" name="ans-post">POST</button>
              </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

