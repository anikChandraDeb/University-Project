<?php require_once('inc/top.php');?>
  <body>
    <?php require_once('inc/header.php');
      $number_of_posts=3;
      if(isset($_GET['page']))
      {
          $page_id=$_GET['page'];
      }
      else
      {
          $page_id=1;
      }
      if(isset($_GET['cat']))
      {
          $cat_id=$_GET['cat'];
          $cat_query="SELECT * FROM categories WHERE id=$cat_id";
          $cat_run=mysqli_query($con,$cat_query);
          $cat_row=mysqli_fetch_array($cat_run);
          $cat_name=$cat_row['category'];
      }
      
      if(isset($_POST['search'])){
          $search=$_POST['search-title'];
          $all_posts_query="SELECT * FROM posts WHERE status='publish'";
          $all_posts_query .=" and tags LIKE '%$search%'";
          $all_posts_run=mysqli_query($con,$all_posts_query);
          $all_posts=mysqli_num_rows($all_posts_run);
          $total_pages=ceil($all_posts/$number_of_posts);
          $posts_start_from=($page_id-1)*$number_of_posts;
      }   
      else
      {
          $all_posts_query="SELECT * FROM posts WHERE status='publish'";
          if(isset($cat_name))
          {
          $all_posts_query .=" and categories = '$cat_name'";
          }
          $all_posts_run=mysqli_query($con,$all_posts_query);
          $all_posts=mysqli_num_rows($all_posts_run);
          $total_pages=ceil($all_posts/$number_of_posts);
          $posts_start_from=($page_id-1)*$number_of_posts;
      }
    ?>
    <section>
        <div class="container">
           <?php 
                    if(isset($_POST['submit'])){
                        $date = time();
                        $first_name=mysqli_real_escape_string($con,$_POST['first-name']);
                        $last_name=mysqli_real_escape_string($con,$_POST['last-name']);
                        $username=mysqli_real_escape_string($con,strtolower($_POST['username']));
                        $username_trim=preg_replace("/'s+'/",'',$username);
                        $email=mysqli_real_escape_string($con,strtolower($_POST['email']));
                        $password=mysqli_real_escape_string($con,$_POST['password']);
                        $age=mysqli_real_escape_string($con,$_POST['age']);
                        $district=mysqli_real_escape_string($con,strtolower($_POST['district']));
                        $phone=mysqli_real_escape_string($con,$_POST['phone']);
                        $role=$_POST['role'];
                        $blood_group=$_POST['blood_group'];
                        $gender=$_POST['gender'];
                        $donor_status=$_POST['status'];
                        $image=$_FILES['image']['name'];
                        $image_tmp=$_FILES['image']['tmp_name'];
                        $check_query="SELECT * FROM users WHERE username ='$username' or email ='$email' or phone ='$phone'";
                        $check_run=mysqli_query($con,$check_query);
                        $salt_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                        $salt_run = mysqli_query($con,$salt_query);
                        $salt_row = mysqli_fetch_array($salt_run);
                        $salt = $salt_row['salt'];
                        $password=crypt($password,$salt);
                        if(empty($first_name) or empty($last_name) or empty($username) or empty($email) or empty($password) or empty($image) or empty($phone) or empty($district) or empty($age))
                        {
                            $error="All (*) feilds are Required";
                        }
                        else if($username != $username_trim)
                        {
                            $error="Don't use spaces in username";
                        }
                        else if(mysqli_num_rows($check_run) > 0)
                        {
                            $error="Username or Email or phone already exist";
                        }
                        else
                        {
                            $insert_query = "INSERT INTO `cms`.`users` (`id` ,`date` ,`first_name` ,`last_name` ,`username` ,`email` ,`image` ,`password` ,`role`,`blood_group`,`phone`,`district`,`age`,`donor_status`,`gender`)VALUES (NULL , '$date', '$first_name', '$last_name', '$username', '$email', '$image', '$password', '$role','$blood_group','$phone','$district','$age','$donor_status','$gender')";
                            if(mysqli_query($con,$insert_query)){
                                $msg="User has been added";
                                $path="img/$image";
                                if(move_uploaded_file($image_tmp,$path)){
                                    copy($path,"admin/$path");
                                }
                                $image_check="SELECT * FROM users ORDER BY id DESC LIMIT 1";
                                $image_run = mysqli_query($con,$image_check);
                                $image_row=mysqli_fetch_array($image_run);
                                $check_image=$image_row['image'];
                                
                                $first_name="";
                                $last_name="";
                                $username="";
                                $email="";
                                $phone="";
                                $age="";
                            }
                            else
                            {
                                $error = "User has not been added";
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
                                    <input type="text" id="first-name" name="first-name" placeholder="First name" class="form-control" value="<?php if(isset($first_name)){ echo $first_name;}?>">
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last Name:*</label>
                                    <input type="text" id="last-name" name="last-name" placeholder="Last name" class="form-control"  value="<?php if(isset($last_name)){ echo $last_name;}?>">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username:*</label>
                                    <input type="text" id="username" name="username" placeholder="Username" class="form-control"  value="<?php if(isset($username)){ echo $username;}?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:*</label>
                                    <input type="text" id="email" name="email" placeholder="Email address" class="form-control"  value="<?php if(isset($email)){ echo $email;}?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone:*</label>
                                    <input type="text" id="phone" name="phone" placeholder="phone number" class="form-control"  value="<?php if(isset($phone)){ echo $phone;}?>">
                                </div>
                                <div class="form-group">
                                    <label for="district">District:*</label>
                                    <input type="text" id="district" name="district" placeholder="Enter district" class="form-control"  value="<?php if(isset($district)){ echo $district;}?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:*</label>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="blood_group">Blood group:*</label>
                                    <select class="form-control" name="blood_group">
                                       <option value="AB+" <?php if($blood_group == 'AB+') echo"selected";?>>AB+</option>
                                       <option value="AB-" <?php if($blood_group == 'AB-') echo"selected";?>>AB-</option>
                                       <option value="A+" <?php if($blood_group == 'A+') echo"selected";?>>A+</option>
                                       <option value="A-" <?php if($blood_group == 'A-') echo"selected";?>>A-</option>
                                       <option value="B+" <?php if($blood_group == 'B+') echo"selected";?>>B+</option>
                                       <option value="B-" <?php if($blood_group == 'B-') echo"selected";?>>B-</option>
                                       <option value="O+" <?php if($blood_group == 'O+') echo"selected";?> >O+</option>
                                       <option value="O-" <?php if($blood_group == 'O-') echo"selected";?> >O-</option>
                                       
                                   </select>
                                </div>
                                <div class="form-group">
                                    <label for="age">Age:*</label>
                                    <input type="text" id="age" name="age" placeholder="Age" class="form-control" value="<?php if(isset($age)){ echo $age;}?>">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:*</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male" <?php if($gender == 'male') echo"selected";?>>Male</option>
                                        <option value="female" <?php if($gender == 'female') echo"selected";?>>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:*</label>
                                    <select name="status" id="status" class="form-control">
                                        
                                        <option value="unready">Unready</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="role">role:*</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="author">User/Author</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Profile picture:*</label>
                                    <input type="file" name="image" id="image"> 
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit" value="Registration"><br><br>
                            </form>
                        </div>
                <div class="col-md-4">
                    <?php require_once('inc/sidebar.php');?>
                </div>
            </div>
        </div>
    </section>
<?php require_once('inc/footer.php');?>