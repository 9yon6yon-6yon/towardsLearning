<div class="contain-wrapper">
	<div class="first-small-heading">
		<img src="img/icon_brain_round.png">
		<h3>The Brain: Answerer</h3>
	</div>
	<div class="big-heading">
		<h1>Get Answers for FREE</h1>
		<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">ASK YOUR QUESTION</button>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ask a question about your assignment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="process.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Question description</label>
            <textarea class="form-control" id="message-text" name="details" style="height: 300px;"></textarea>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Attach Necessary Image</label>
            <input class="form-control" type="file" name="uploadfile">
          </div>
          <div class="mb-3">
            <div class="row">
                <div class="col-sm">
                  <label for="recipient-name" class="col-form-label">Set points</label>
                  <input type="text" class="form-control" id="recipient-name" name="point">
                  <input type="hidden" name="s_id" value="<?php echo $row['id']; ?>" >
                  <input type="hidden" name="st_point" value="<?php echo $row['points']; ?>" >
                </div>
                <div class="col-sm">
                  <label for="recipient-name" class="col-form-label">Pick a Subject</label>
                  <select class="form-control" name="subject">
                    <?php
                        try{
                            $dbcon = new PDO("mysql:host=localhost:3306;dbname=towardsLearning;","root","");
                            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $query="SELECT * FROM subjects";
                            
                            try{
                                $sql=$dbcon->query($query);
                                
                                $app_table=$sql->fetchAll();

                                foreach($app_table as $row){ 
                                ?>
                                  <option value="<?php echo $row['s_code'] ?>" ><?php echo $row['Subject_Name'] ?></option>
                                  
                                  <?php
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="5">Data read error ... ...</td>    
                                    </tr>
                                <?php
                            }
                            
                        }
                        catch(PDOException $ex){
                            ?>
                                <tr>
                                    <td colspan="5">Data read error ... ...</td>    
                                </tr>
                            <?php
                        }
                    ?>
                  </select>
                </div>
                
              </div>
            
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
        <button type="submit" class="btn btn-primary" name="post">POST</button>
              </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
</div>