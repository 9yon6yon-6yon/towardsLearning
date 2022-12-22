<div class="modal fade " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Write your answer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="process.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Answer</label>
            <input type="text" class="form-control" id="recipient-name" name="answer" required>
            <input type="hidden" name="s_id" value="<?php echo $row['id']; ?>" >
            <input type="hidden" name="st_point" value="<?php echo $row['points']; ?>" >
            <input type="hidden" name="qu_id" value="<?php echo $qu_id; ?>" >
            <input type="hidden" name="qu_point" value="<?php echo $q['ques_points']; ?>" >
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Explanation</label>
            <textarea class="form-control" id="message-text" name="solution" style="height: 300px;" required></textarea>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Attach Images</label>
            <input class="form-control" type="file" name="uploadfile">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
        <button type="submit" class="btn btn-primary" name="ans-post">POST</button>
              </div>
        </form>
      </div>
      
    </div>
  </div>
</div>