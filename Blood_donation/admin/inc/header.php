<?php
$session_role2=$_SESSION['role'];
$session_username2=$_SESSION['username'];
?>
<nav class="navbar navbar-anik  navbar-fixed-top">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

    <span class="caret"></span>
  </button>
  <a class="navbar-brand" href="index.php">
     
      <div class="col-xs-12">Blood donation</div>
  </a>
</div>


<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

  <ul class="nav navbar-nav navbar-right">
    <li><a href="index.php" style="color: #fff;">Welcome: <i class="fa fa-user"></i> <?php echo $session_username2;?></a></li>
    <li class="active"><a href="index.php" style="color: #fff;"><i class="fa fa-tachometer"></i> Deshboard</a></li>
    <li><a href="add-post.php" style="color: #fff;"><i class="fa fa-plus-square"></i> Add blood post</a></li>
    <?php
      if($session_role2 == 'admin'){
      ?>
    <li><a href="add-user.php" style="color: #fff;"><i class="fa fa-user-plus"></i> Add donor/user</a></li>
    <?php }?>
    <li><a href="profile.php" style="color: #fff;"><i class="fa fa-user"></i> Profile</a></li>
    <li><a href="logout.php" style="color: #fff;"><i class="fa fa-power-off"></i> Logout</a></li>
  </ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>