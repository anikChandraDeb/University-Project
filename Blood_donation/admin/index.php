<?php 
require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$comment_tag_query ="SELECT * FROM comments WHERE status = 'pending'";
$posts_tag_query ="SELECT * FROM posts";
$users_tag_query ="SELECT * FROM users";
$categories_tag_query ="SELECT * FROM categories";

$com_tag_run =mysqli_query($con,$comment_tag_query);
$user_tag_run =mysqli_query($con,$users_tag_query);
$post_tag_run =mysqli_query($con,$posts_tag_query);
$cat_tag_run =mysqli_query($con,$categories_tag_query);

$com_row =mysqli_num_rows($com_tag_run);
$user_row =mysqli_num_rows($user_tag_run);
$post_row =mysqli_num_rows($post_tag_run);
$cat_row =mysqli_num_rows($cat_tag_run);
?>
  <body style="margin-top: 60px;">
   <div id="wrapper">
       <?php require_once('inc/header.php');?>
        <div class="container-fluid body-section">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('inc/sidebar.php');?>
                </div>
                <div class="col-md-9">
                    <h1 style="color: #2A9FC1;"><i class="fa fa-tachometer"></i> Deshboard <small>statistics overview</small></h1><hr>
                    <ol class="breadcrumb">
                      <li><i class="fa fa-tachometer"></i> Deshboard</li>

                    </ol>
                    <div class="row tag-boxes">
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $com_row?></div>
                                            <div class="text-right">New Blood comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all blood comments</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $post_row?></div>
                                            <div class="text-right">All blood post</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all blood post</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $user_row?></div>
                                            <?php
                                            if($session_role1 == 'admin'){
                                                echo"<div class='text-right'>All donor/users</div>";
                                            }
                                            else if($session_role1=='author'){
                                                echo"<div class='text-right'>All users</div>";
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all donor/user</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-folder-open fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $cat_row?></div>
                                            <div class="text-right">All Blood group</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all blood group</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><hr>
                    <h3>New donor/users</h3>
                    <?php
                    $user_query ="SELECT * FROM users ORDER BY id DESC LIMIT 5";
                    $user_run = mysqli_query($con,$user_query);
                    if(mysqli_num_rows($user_run) > 0){
                    ?>
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Donor/user</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            while($user_row= mysqli_fetch_array($user_run)){
                                $user_id = $user_row['id'];
                                $user_name=$user_row['first_name'];
                                $user_name .=' ';
                                $user_name .= $user_row['last_name'];
                                $user_username = $user_row['username'];
                                $user_role = $user_row['role'];
                                $user_date = getdate($user_row['date']);
                                $u_day = $user_date['mday'];
                                $u_month = $user_date['month'];
                                $u_year = $user_date['year'];
                            ?>
                            <tr>
                                <td><?php echo $user_id;?></td>
                                <td><?php echo"$u_day $u_month $u_year";?></td>
                                <td><?php echo $user_name;?></td>
                                <td><?php echo $user_username;?></td>
                                <td>
                                   <?php 
                                    if($user_role == 'admin')
                                        echo"Donor";
                                    else if($user_role == 'author')
                                        echo"User";
                                    ?>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php
                    }
                    else
                        echo"<center><h4>No user available.</h4></center>";
                    ?>
                    <a href="users.php" class="btn btn-primary">View all donor/users</a><hr>
                    <h3>New Blood post</h3>
                    <?php
                    $post_query ="SELECT * FROM posts ORDER BY id DESC LIMIT 5";
                    $post_run = mysqli_query($con,$post_query);
                    if(mysqli_num_rows($post_run) > 0){
                    ?>
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Blood Post title</th>
                                <th>Blood group</th>
                                <th>views</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            while($post_row= mysqli_fetch_array($post_run)){
                                $post_id = $post_row['id'];
                                $post_title = $post_row['title'];
                                $post_categories = $post_row['categories'];
                                $post_views = $post_row['views'];
                                $post_date = getdate($post_row['date']);
                                $p_day = $post_date['mday'];
                                $p_month = $post_date['month'];
                                $p_year = $post_date['year'];
                            ?>
                            <tr>
                                <td><?php echo $post_id;?></td>
                                <td><?php echo"$p_day $p_month $p_year";?></td>
                                <td><?php echo $post_title;?></td>
                                <td><?php echo $post_categories;?></td>
                                <td><i class="fa fa-eye"></i> <?php echo $post_views;?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php
                    
                    }
                    ?>
                    <a href="posts.php" class="btn btn-primary">View all blood post</a>
                </div>
            </div>
        </div>
<?php require_once('inc/footer.php');?>