<?php require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
else if(isset($_SESSION['username']) and $_SESSION['role'] =='author'){
    header('Location: index.php');
}
?>
  <body style="margin-top: 60px;">
   <div id="wrapper">
       <?php require_once('inc/header.php');
       
       if(isset($_GET['del'])){
        $del_id=$_GET['del'];
        $del_check_query ="SELECT * FROM users WHERE id = '$del_id'";
        $del_check_run = mysqli_query($con,$del_check_query);
        if(mysqli_num_rows($del_check_run) > 0){
            $del_query = "DELETE FROM `cms`.`users` WHERE `users`.`id` = $del_id";
            if(isset($_SESSION['username']) and $_SESSION['role'] == 'admin'){
                if(mysqli_query($con,$del_query)){
                    $msg="User has been deleted";
                }
                else
                {
                    $error = "User has not been deleted";
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
                   $bulk_del_query="DELETE FROM `cms`.`users` WHERE `users`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_del_query)){
                       $msg="User has been deleted";
                   }
                   else
                   {
                       $error = "User has not been deleted";
                   }
               }
               else if($bulk_option == 'author'){
                   $bulk_author_query = "UPDATE `cms`.`users` SET `role` = 'author' WHERE `users`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_author_query)){
                       $msg="User is now a author";
                   }
                   else{
                       $error="User is not convert a author";
                   }
                    
               }
               else if($bulk_option == 'admin'){
                   $bulk_admin_query = "UPDATE `cms`.`users` SET `role` = 'admin' WHERE `users`.`id` = $user_id";
                   if(mysqli_query($con,$bulk_admin_query)){
                       $msg="User is now a admin";
                   }
                   else{
                       $error="User is not convert a admin";
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
                    <h1 style="color: #2A9FC1;"><i class="fa fa-users"></i> Donor/Users <small>View all donor/users</small></h1><hr>
                    <ol class="breadcrumb">
                      <li><a href="index.php"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                      <li><i class="fa fa-users"></i> All donor/users</li>

                    </ol>
                    <?php 
                        $query="SELECT * FROM users ORDER BY id DESC";
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
                                                <option value="author">Change to author</option>
                                                <option value="admin">Change to admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="submit" value="Apply" class="btn btn-success">
                                        <a href="add-user.php" class="btn btn-primary">Add donor/users</a>
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
                                <th>Name</th>
                                <th>Username</th>
                                <!--<th>Email</th>-->
                                <th>Phone</th>
                                <th>BG</th>
                                <th>District</th>
                               
                                <th>Age</th>
                                <th>DS</th>
                                <th>Image</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Del</th>
                        
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                            while($row=mysqli_fetch_array($run))
                            {
                                $id=$row['id'];
                                $first_name=$row['first_name'];
                                $last_name=$row['last_name'];
                                $username=$row['username'];
                                $email=$row['email'];
                                $role=$row['role'];
                                $image=$row['image'];
                                $date=$row['date'];
                                $date=getdate($date);
                                $day=$date['mday'];
                                $month=substr($date['month'],0,3);
                                $year=$date['year'];
                                $blood_group = $row['blood_group'];
                                $phone = $row['phone'];
                                $district = $row['district'];
                                $age = $row['age'];
                                $donor_status = $row['donor_status'];
                                $gender = $row['gender'];
                            ?>
                            <tr>
                               <th><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></th>
                                <td><?php echo $id;?></td>
                                <td><?php echo"$day $month $year";?></td>
                                <td><?php echo"$first_name $last_name";?></td>
                                <td><?php echo $username;?></td>
                                <!--<td>/*<?php echo $email;?>*/</td>-->
                                <td><?php echo $phone;?></td>
                                <td><?php echo $blood_group;?></td>
                                <td><?php echo $district;?></td>
                                <td><?php echo $age;?></td>
                                <td><?php
                                    if($donor_status == 'ready')
                                    echo"<span style='color:green;'>".ucfirst($donor_status)."</span>";
                                    else if($donor_status == 'unready')
                                    echo"<span style='color:red;'>".ucfirst($donor_status)."</span>";
                                    ?>
                                </td>
                                <td><img src="img/<?php echo $image;?>" alt="profile-picture" width="30px"></td>
                                
                                <td><?php if($role == 'admin') echo"Donor"; else if($role == 'author') echo"User";?></td>
                                <td><a href="edit-user.php?edit=<?php echo $id;?>"><i class="fa fa-pencil"></i></a></td>
                                <td><a href="users.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
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