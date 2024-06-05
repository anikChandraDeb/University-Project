<?php require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}

$session_username=$_SESSION['username'];
?>
  <body style="margin-top: 60px;">
   <div id="wrapper">
       <?php require_once('inc/header.php');
       
       if(isset($_GET['del'])){
        $del_id=$_GET['del'];
        if($_SESSION['role'] =='admin'){
            $del_check_query ="SELECT * FROM posts WHERE id = '$del_id'";
            $del_check_run = mysqli_query($con,$del_check_query);
        }
        else if($_SESSION['role'] =='author'){
            $del_check_query ="SELECT * FROM posts WHERE id = '$del_id' and author = '$session_username'";
            $del_check_run = mysqli_query($con,$del_check_query);
        }
        if(mysqli_num_rows($del_check_run) > 0){
            $del_query = "DELETE FROM `cms`.`posts` WHERE `posts`.`id` = $del_id";
            if(mysqli_query($con,$del_query)){
                $msg="Post has been deleted";
            }
            else
            {
                $error = "Post has not been deleted";
            }
            
        }
        else
        {
            header('location: index.php');
        }
        }
       if(isset($_POST['checkboxes'])){
           foreach($_POST['checkboxes'] as $user_id){
               $bulk_option =$_POST['bulk-options'];
               if($bulk_option == 'delete'){
                   $bulk_del_query="DELETE FROM `cms`.`posts` WHERE `posts`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_del_query)){
                       $msg="Post has been deleted";
                   }
                   else
                   {
                       $error = "Post has not been deleted";
                   }
               }
               else if($bulk_option == 'publish'){
                   $bulk_author_query = "UPDATE `cms`.`posts` SET `status` = 'publish' WHERE `posts`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_author_query)){
                       $msg="Post is now a publish";
                   }
                   else{
                       $error="Post is not convert a publish";
                   }
                    
               }
               else if($bulk_option == 'draft'){
                   $bulk_admin_query = "UPDATE `cms`.`posts` SET `status` = 'draft' WHERE `posts`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_admin_query)){
                       $msg="Post is now a draft";
                   }
                   else{
                       $error="Post is not convert a draft";
                   }

               }
           }
       }
       ?>
        <div class="container-fluid body-section">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('inc/sidebar.php');?>
                </div>
                <div class="col-md-9">
                    <h1 style="color: #2A9FC1;"><i class="fa fa-file"></i> Blood Posts <small>View all blood posts</small></h1><hr>
                    <ol class="breadcrumb">
                      <li><a href="index.php"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                      <li><i class="fa fa-file"></i> All blood posts</li>

                    </ol>
                    <?php
                        if(isset($_GET['reply'])){
                            $reply_id = $_GET['reply'];
                            
                            
                                if(isset($_POST['reply'])){
                                    $comment_data = $_POST['comment'];
                                    if(empty($comment_data)){
                                        $comment_error="Must fill this feilds";
                                    }
                                    else{
                                        $get_user_data ="SELECT * FROM users WHERE username ='$session_username'";
                                        $get_user_run =mysqli_query($con,$get_user_data);
                                        $get_user_row=mysqli_fetch_array($get_user_run);
                                        $date=time();
                                        $first_name=$get_user_row['first_name'];
                                        $last_name=$get_user_row['last_name'];
                                        $full_name="$first_name $last_name";
                                        $email=$get_user_row['email'];
                                        $image=$get_user_row['image'];
                                        
                                        $insert_comment_query ="INSERT INTO comments (date,name,username,post_id,email,image,comment,status,reply_username) VALUES('$date','$full_name','$session_username','$reply_id','$email','$image','$comment_data','approve',null)";
                                        if(mysqli_query($con,$insert_comment_query)){
                                            $comment_msg="Comment has been submitted";
                                            header('location: posts.php');
                                        }
                                        else{
                                            $comment_error="Comment has not been submitted";
                                        }
                                    
                                }
                                }
                           
                    ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="comment">Comment:*</label>
                                    <?php 
                                    if(isset($comment_error))
                                    {
                                        echo"<span class='pull-right' style='color:red;'>$comment_error</span>";
                                    }
                                    else if(isset($comment_msg))
                                    {
                                        echo"<span class='pull-right' style='color:green;'>$comment_msg</span>";
                                    }
                                    ?>
                                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" placeholder="Your reply comment write here..."></textarea>
                                </div>
                                <input type="submit" name="reply" class="btn btn-primary" value="Comment Reply">
                                
                            </form>
                        </div>
                    </div>
                    <hr>
                     
                      
                    <?php 
                        
                        }
                        if($_SESSION['role'] == 'admin'){
                            $query="SELECT * FROM posts ORDER BY id DESC";
                            $run = mysqli_query($con,$query);
                        }
                        else if($_SESSION['role'] == 'author'){
                            $query="SELECT * FROM posts WHERE author = '$session_username' ORDER BY id DESC";
                            $run = mysqli_query($con,$query);
                        }
                        if(mysqli_num_rows($run) > 0)
                        {
                            
                        
                    ?>
                    <center>
                        <h2></h2>
                    </center>
                    <?php
                        if(isset($comment_msg)){
                            echo"<span class='pull-right' style='color:red;'>$comment_msg</span>";
                        }
                        if(isset($error))
                        {
                            echo"<span class='pull-right' style='color:red;'>$error</span>";
                        }
                        else if(isset($msg))
                        {
                            echo"<span class='pull-right' style='color:green;'>$msg</span>";
                        }
                    ?>
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <select name="bulk-options" id="" class="form-control">
                                                <option value="delete">Delete</option>
                                                <option value="publish">Publish</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="submit" value="Apply" class="btn btn-success">
                                        <a href="add-post.php" class="btn btn-primary">Add Blood post</a>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox"d id="selectallboxes"></th>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Blood Title</th>
                                <th>Author</th>
                                <th>Image</th>
                                
                                <th>Group</th>
                                <th>Views</th>
                                <th>Status</th>
                                <th>Reply</th>
                                <th>Edit</th>
                                <th>Del</th>
                        
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                            while($row=mysqli_fetch_array($run))
                            {
                                $id=$row['id'];
                                $title=$row['title'];
                                $author=$row['author'];
                                $views=$row['views'];
                                $image=$row['image'];
                                $categories=$row['categories'];
                                $date=$row['date'];
                                $status=$row['status'];
                                $date=getdate($date);
                                $day=$date['mday'];
                                $month=substr($date['month'],0,3);
                                $year=$date['year'];
                            ?>
                            <tr>
                               <th><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></th>
                                <td><?php echo $id;?></td>
                                <td><?php echo"$day $month $year";?></td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $author;?></td>
                                <td><img src="media/<?php echo $image;?>" alt="profile-picture" width="30px"></td>
                                <td><?php echo $categories;?></td>
                                <td><?php echo $views;?></td>
                                <td>
                                    <span style="color:
                                        
                                    <?php 
                                    if($status=='publish')
                                        echo'green';
                                    else if($status=='draft')
                                        echo'red';
                                    ?>"><?php echo ucfirst($status);?></span>
                                </td>
                                <td><a href="posts.php?reply=<?php echo $id;?>"><i class="fa fa-reply"></i></a></td>
                                <td><a href="edit-post.php?edit=<?php echo $id;?>"><i class="fa fa-pencil"></i></a></td>
                                <td><a href="posts.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php 
                        }
                        else
                        {
                            echo"<center>
                        <h2>No users available now</h2>
                    </center>";
                        }
                    ?>
                    </form>
                </div>
            </div>
        </div>
<?php require_once('inc/footer.php');?>