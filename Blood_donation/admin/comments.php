<?php require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
else if(isset($_SESSION['username']) and $_SESSION['role'] =='author'){
    header('Location: index.php');
}
$session_username=$_SESSION['username'];
?>
  <body style="margin-top: 60px;">
   <div id="wrapper">
       <?php require_once('inc/header.php');
       
       if(isset($_GET['del'])){
        $del_id=$_GET['del'];
        $del_check_query ="SELECT * FROM comments WHERE id = '$del_id'";
        $del_check_run = mysqli_query($con,$del_check_query);
        if(mysqli_num_rows($del_check_run) > 0){
            $del_query = "DELETE FROM `cms`.`comments` WHERE `comments`.`id` = $del_id";
            if(isset($_SESSION['username']) and $_SESSION['role'] == 'admin'){
                if(mysqli_query($con,$del_query)){
                    $msg="Comment has been deleted";
                }
                else
                {
                    $error = "Comment has not been deleted";
                }
            }
        }
        else
        {
            header('location: index.php');
        }
        }
       
       if(isset($_GET['approve'])){
        $approve_id=$_GET['approve'];
        $approve_check_query ="SELECT * FROM comments WHERE id = '$approve_id'";
        $approve_check_run = mysqli_query($con,$approve_check_query);
        if(mysqli_num_rows($approve_check_run) > 0){
            $approve_query = "UPDATE `cms`.`comments` SET `status` = 'approve' WHERE `comments`.`id` = $approve_id";
            if(isset($_SESSION['username']) and $_SESSION['role'] == 'admin'){
                if(mysqli_query($con,$approve_query)){
                    $msg="Comment has been approve";
                }
                else
                {
                    $error = "Comment has not been approve";
                }
            }
        }
        else
        {
            header('location: index.php');
        }
        }
       
       if(isset($_GET['pending'])){
        $pending_id=$_GET['pending'];
        $pending_check_query ="SELECT * FROM comments WHERE id = '$pending_id'";
        $pending_check_run = mysqli_query($con,$pending_check_query);
        if(mysqli_num_rows($pending_check_run) > 0){
            $pending_query = "UPDATE `cms`.`comments` SET `status` = 'pending' WHERE `comments`.`id` = $pending_id";
            if(isset($_SESSION['username']) and $_SESSION['role'] == 'admin'){
                if(mysqli_query($con,$pending_query)){
                    $msg="Comment has been pending";
                }
                else
                {
                    $error = "Comment has not been pending";
                }
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
                   $bulk_del_query="DELETE FROM `cms`.`comments` WHERE `comments`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_del_query)){
                       $msg="Comments has been deleted";
                   }
                   else
                   {
                       $error = "Comments has not been deleted";
                   }
               }
               else if($bulk_option == 'approve'){
                   $bulk_author_query = "UPDATE `cms`.`comments` SET `status` = 'approve' WHERE `comments`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_author_query)){
                       $msg="Comments is now a approve";
                   }
                   else{
                       $error="Comments is not convert a approve";
                   }
                    
               }
               else if($bulk_option == 'pending'){
                   $bulk_admin_query = "UPDATE `cms`.`comments` SET `status` = 'pending' WHERE `comments`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_admin_query)){
                       $msg="Comments is now a pending";
                   }
                   else{
                       $error="Comments is not convert a pending";
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
                    <h1 style="color: #2A9FC1;"><i class="fa fa-comment"></i> Comments <small>View all comments</small></h1><hr>
                    <ol class="breadcrumb">
                      <li><a href="index.php"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                      <li><i class="fa fa-comment"></i> Comments</li>

                    </ol>
                    <?php
                        if(isset($_GET['reply'])){
                            $reply_id = $_GET['reply'];
                            $reply_check ="SELECT * FROM comments WHERE post_id = '$reply_id'";
                            $reply_check_run = mysqli_query($con,$reply_check);
                            if(mysqli_num_rows($reply_check_run) > 0){
                                $reply_row=mysqli_fetch_array($reply_check_run);
                                $reply_username=$reply_row['username'];
                                $reply_title=$reply_row['post_title'];
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
                                        
                                        $insert_comment_query ="INSERT INTO comments (date,name,username,post_id,email,image,comment,status,reply_username,post_title) VALUES('$date','$full_name','$session_username','$reply_id','$email','$image','$comment_data','approve','$reply_username','$reply_title')";
                                        
                                        if(mysqli_query($con,$insert_comment_query)){
                                            $comment_msg="Comment has been submitted";
                                            header('location: comments.php');
                                            header('location: comments.php');
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
                        }
                        $query="SELECT * FROM comments ORDER BY id DESC";
                        $run = mysqli_query($con,$query);
                        if(mysqli_num_rows($run))
                        {
                            
                        
                    ?>
                    <center>
                        <h2></h2>
                    </center>
                    <?php 
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
                                                <option value="approve">Approve</option>
                                                <option value="pending">Unapprove</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="submit" value="Apply" class="btn btn-success">
                                       
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
                                <th>P_title</th>
                                
                                <th>Username</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Reply</th>
                                <th>Del</th>
                        
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                            while($row=mysqli_fetch_array($run))
                            {
                                $id=$row['id'];
                                $username=$row['username'];
                                $post_id=$row['post_id'];
                                $status=$row['status'];
                                $comment=$row['comment'];
                                $date=$row['date'];
                                $date=getdate($date);
                                $day=$date['mday'];
                                $month=substr($date['month'],0,3);
                                $year=$date['year'];
                                $post_title=$row['post_title'];
                            ?>
                            <tr>
                               <th><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></th>
                                <td><?php echo $id;?></td>
                                <td><?php echo"$day $month $year";?></td>
                                <td><?php echo $post_title;?></td>
                                <td><?php echo $username;?></td>
                                <td><?php echo $comment;?></td>
                                <td>
                                    <span style="color:
                                        
                                    <?php 
                                    if($status=='approve')
                                        echo'green';
                                    else if($status=='pending')
                                        echo'red';
                                    ?>"><?php echo $status;?></span>
                                </td>
                                <!-- 
                                <td>
                                    <?php 
                                    if($status=='approve')
                                        echo"<span style='color:green;'>$status</span>";
                                    else if($status=='pending')
                                        echo"<span style='color:red;'>$status</span>";
                                    ?>
                                </td>
                                -->
                                <td><a href="comments.php?approve=<?php echo $id;?>">Approve</a></td>
                                <td><a href="comments.php?pending=<?php echo $id;?>">Unapprove</a></td>
                                <td><a href="comments.php?reply=<?php echo $post_id;?>"><i class="fa fa-reply"></i></a></td>
                                <td><a href="comments.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
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