<?php 
require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$session_username = $_SESSION['username'];
$session_author_image = $_SESSION['author_image'];

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
                    <h1 style="color: #2A9FC1;"><i class="fa fa-plus-square"></i> Add Blood post <small>Add new Blood post</small></h1><hr>
                    <ol class="breadcrumb">
                    <li><a href="index.html"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                    <li><i class="fa fa-plus-square"></i> Add Blood post</li>
                    </ol>
                    <?php
                    if(isset($_POST['submit'])){
                        $date = time();
                        $title = mysqli_real_escape_string($con,$_POST['title']);
                        $post_data = mysqli_real_escape_string($con,$_POST['post-data']);
                        $categories = $_POST['categories'];
                        $status = $_POST['status'];
                        $tags = mysqli_real_escape_string($con,$_POST['tags']);
                        $image = $_FILES['image']['name'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                        if(empty($title) or empty($post_data) or empty($image) or empty($tags)){
                           $error = "All (*) feilds are required"; 
                        }
                        else{
                            $insert_query ="INSERT INTO posts (date,title,author,author_image,image,categories,tags,post_data,views,status) VALUES ('$date','$title','$session_username','$session_author_image','$image','$categories','$tags','$post_data','0','$status')";
                            if(mysqli_query($con,$insert_query)){
                                $msg="Post has been added";
                                $path = "media/$image";
                                if(move_uploaded_file($tmp_name,$path)){
                                    copy($path,"../$path");
                                }
                                $title="";
                                $post_data="";
                                $categories="";
                                $status="";
                                $tags="";
                                
                            }
                            else{
                                $error ="Post has not been added";
                            }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Blood post title:*</label>
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
                                    <input type="text" name="title" value="<?php if(isset($title)) echo $title;?>" class="form-control" placeholder="patient name/hospital name/Disease name...">
                                </div>
                                <div class="form-group">
                                    <a href="media.php" class="btn btn-primary">Add media</a>
                                </div>
                                <div class="form-group">
                                    <textarea name="post-data" id="textarea" rows="10" class="form-control" placeholder="Write your patient details here...."><?php if(isset($post_data)) echo $post_data;?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="file">Image:*</label>
                                        <input type="file" name="image">
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="categories">Blood group:*</label>
                                        <select class="form-control" name="categories" id="categories">
                                            <?php
                                            $cat_query =  "SELECT * FROM categories";
                                            $cat_run = mysqli_query($con,$cat_query);
                                            if(mysqli_num_rows($cat_run) > 0){
                                                while($cat_row = mysqli_fetch_array($cat_run)){
                                                    $cat_name =$cat_row['category'];
                                                    echo"<option value='".$cat_name."' ".((isset($categories) and $categories == $cat_name)?'selected':'').">".ucfirst($cat_name)."</option>";
                                            ?>
                                           
                                            <?php
                                            }
                                            }
                                            else{
                                                echo"<center><h5>No category available</h5></center>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="tags">Tags:*</label>
                                        <input type="text"  value="<?php if(isset($tags)) echo $tags;?>" name="tags" class="form-control" placeholder="Write tags here">
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="Status">Status:*</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="publish" <?php if($status == 'publish') echo'selected';?>>Publish</option>
                                            <option value="draft" <?php if($status == 'draft') echo'selected';?>>Draft</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Add Blood post" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php require_once('inc/footer.php');?>