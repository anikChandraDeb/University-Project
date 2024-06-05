<?php
$session_role1=$_SESSION['role'];
$get_comment="SELECT * FROM comments WHERE status = 'pending'";
$get_run=mysqli_query($con,$get_comment);
$num_of_row=mysqli_num_rows($get_run);
?>
 <div class="list-group">
  <a href="index.php" class="list-group-item active">
      <i class="fa fa-tachometer"></i> Deshboard
  </a>
  <a href="posts.php" class="list-group-item">
   
    <i class="fa fa-file-text-o"></i> Donate Blood
  </a>
  <a href="media.php" class="list-group-item">
   
    <i class="fa fa-database"></i> Patient/hospital picture
  </a>
  <?php
     if($session_role1 == 'admin'){
     ?>
  <a href="comments.php" class="list-group-item">
   <?php 
     if($num_of_row > 0)
     echo"<span class='badge'>$num_of_row</span>";
    ?>
    
    <i class="fa fa-comment"></i> Reply blood comment
  </a>
  <a href="categories.php" class="list-group-item">
   
    <i class="fa fa-folder"></i> Add blood group
  </a>
  <a href="users.php" class="list-group-item">
   
    <i class="fa fa-user"></i> Donor/User
  </a>
  <?php }?>
</div>