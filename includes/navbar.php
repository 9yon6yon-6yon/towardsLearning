

<?php include ('includes/session.php'); ?>

<div>

  <div class="topnav">
    <div class="wrapo">
      <div class="flexes">
        <div class="img-search">
         <a class="navbar-brand" href="#">
            <img src="img/logo.png" height="100" width="100%" alt="" loading="lazy"
              style="margin-top: 2px" />
          </a>
          
          <div class="search-container">
            <form>
              <input type="text" placeholder="Search.." name="search" id="input" 
                               autocomplete="off">
              <div class="result"></div>
            </form>
          </div>
        </div>
        <div class="links">
          <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-right: 20px;border-radius: 30px !important;">Ask Question</button>
          <a href="dashboard.php">Dashboard</a>
          <a class="nav-link d-sm-flex align-items-sm-center" href="#">
          <img src="./uploads/<?php echo $row['img']; ?>"class="rounded-circle" height="24" width="24" alt=""
            loading="lazy" style="border: 2px solid #6c63dd;" />
          <span class="d-none d-sm-block ms-1"><?php echo $row['username']; ?></span>
          </a>
          <div class="dropdown">
              <a class="dropbtn" href="#" style=" color: #6c63dd">
                <i class="fas fa-user-cog fa-lg"></i>
              </a>

              <div class="dropdown-content">
                <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                <a class="dropdown-item" href="user-profile.php">Profile</a>
                <a class="dropdown-item" href="appointment.php">Hire Teachers</a>
                <a class="dropdown-item" href="editprofile.php">Edit Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>


 <?php include ('includes/modal.php'); ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-container input[type="text"]').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("process.php", {term: inputVal}).done(function(data){
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-container").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>



