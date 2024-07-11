<?php require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
else if(isset($_SESSION['username']) and $_SESSION['role'] =='author'){
    header('Location: index.php');
}

if(isset($_GET['edit'])){
    $edit_id=$_GET['edit'];
    $edit_query = "SELECT * FROM users WHERE id = '$edit_id'";
    $edit_query_run = mysqli_query($con,$edit_query);
    if(mysqli_num_rows($edit_query_run) > 0){
        $edit_row = mysqli_fetch_array($edit_query_run);
        $e_first_name = $edit_row['first_name'];
        $e_last_name = $edit_row['last_name'];
        $e_role = $edit_row['role'];
        $e_image = $edit_row['image'];
        $e_datails = $edit_row['datails'];
    }
    else{
        header('location: index.php');
    }
}
else{
    header('location: index.php');
}
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
                    <h1 style="color: #2A9FC1;"><i class="fa fa-user"></i> Edit user <small>Edit user datails</small></h1><hr>
                    <ol class="breadcrumb">
                      <li><a href="index.html"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                      <li><i class="fa fa-user"></i> Edit user</li>

                    </ol>
                    <?php 
                    if(isset($_POST['submit'])){
                        $first_name=mysqli_real_escape_string($con,$_POST['first-name']);
                        $datails=mysqli_real_escape_string($con,$_POST['datails']);
                        $last_name=mysqli_real_escape_string($con,$_POST['last-name']);
                        $password=mysqli_real_escape_string($con,$_POST['password']);
                        $role=$_POST['role'];
                        $image=$_FILES['image']['name'];
                        $image_tmp=$_FILES['image']['tmp_name'];
                        if(empty($image)){
                            $image=$e_image;
                        }
                        $salt_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                        $salt_run = mysqli_query($con,$salt_query);
                        $salt_row = mysqli_fetch_array($salt_run);
                        $salt = $salt_row['salt'];
                        $insert_password=crypt($password,$salt);
                        
                        if(empty($first_name) or empty($last_name) or empty($image))
                        {
                            $error="All (*) feilds are Required";
                        }
                        
                        else
                        {
                            $update_query = "UPDATE `cms`.`users` SET `first_name` = '$first_name',`last_name` = '$last_name',`image` = '$image',`role` = '$role',`datails` = '$datails'";
                             if(isset($image)){
                                mysqli_query($con,"UPDATE `cms`.`posts` SET `author_image` = '$image' WHERE author_image = '$e_image '");
                            }
                            if(isset($password)){
                                $update_query .= ",`password` = '$insert_password'";
                            }
                            $update_query .=" WHERE `users`.`id` =$edit_id";
                            if(mysqli_query($con,$update_query)){
                                $msg="User has been updated";
                                header("refresh=1;url=edit-user.php?edit=$edit_id");
                                if(!empty($image)){
                                    if(move_uploaded_file($image_tmp,"img/$image")){
                                        copy("img/$image","../img/$image");
                                    }
                                }
                            }
                            else
                            {
                                $error="User has not been updated";
                            }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-8">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="first-name">First Name:*</label>
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
                                    <input type="text" id="first-name" name="first-name" placeholder="First name" class="form-control" value="<?php  echo $e_first_name;?>">
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last Name:*</label>
                                    <input type="text" id="last-name" name="last-name" placeholder="Last name" class="form-control"  value="<?php  echo $e_last_name;?>">
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="password">Password:*</label>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="role">role:*</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="author" <?php if($e_role=='author') echo"selected";?>>Author</option>
                                        <option value="admin" <?php if($e_role=='admin') echo"selected";?>>Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Profile picture:*</label>
                                    <input type="file" name="image" id="image"> 
                                </div>
                                <div class="form-group">
                                    <label for="datails">Datails:*</label>
                                    <textarea name="datails" id="datails" cols="30" rows="10" class="form-control"><?php echo $e_datails;?></textarea>
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit" value="Update user">
                            </form>
                        </div>
                        <div class="col-md-4">
                            <?php
                                
                                    echo"<center><h4>Profile picture</h4></center>\n";
                                    echo"<img src='img/$e_image' width='100%'>";

                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
<?php require_once('inc/footer.php');?>