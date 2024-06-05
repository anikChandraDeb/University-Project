<?php 
require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$session_username = $_SESSION['username'];
$session_author_image = $_SESSION['author_image'];
$session_role = $_SESSION['role'];
if(isset($_GET['edit'])){
    $edit_id=$_GET['edit'];
    if($session_role == 'admin'){
        $get_query = "SELECT * FROM posts WHERE id ='$edit_id'";
        $get_run = mysqli_query($con,$get_query);
    }
    else if($session_role == 'author'){
        $get_query = "SELECT * FROM posts WHERE id ='$edit_id' and author ='$session_username'";
        $get_run = mysqli_query($con,$get_query);
    }
    if(mysqli_num_rows($get_run) > 0){
        $get_row =mysqli_fetch_array($get_run);
        $title=$get_row['title'];
        $post_data=$get_row['post_data'];
        $tags=$get_row['tags'];
        $image=$get_row['image'];
        $status=$get_row['status'];
        $categories=$get_row['categories'];
    }
    else{
        header('location: posts.php');
    }
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
                    <h1 style="color: #2A9FC1;"><i class="fa fa-pencil"></i> Edit post <small>Edit post details</small></h1><hr>
                    <ol class="breadcrumb">
                    <li><a href="index.html"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                    <li><i class="fa fa-plus-square"></i> Edit post</li>
                    </ol>
                    <?php
                    if(isset($_POST['update'])){
                        $up_title = mysqli_real_escape_string($con,$_POST['title']);
                        $up_post_data = mysqli_real_escape_string($con,$_POST['post-data']);
                        $up_categories = $_POST['categories'];
                        $up_status = $_POST['status'];
                        $up_tags = mysqli_real_escape_string($con,$_POST['tags']);
                        $up_image = $_FILES['image']['name'];
                        $up_tmp_name = $_FILES['image']['tmp_name'];
                        if(empty($up_image)){
                            $up_image=$image;
                        }
                        if(empty($up_title) or empty($up_post_data) or empty($up_image) or empty($up_tags)){
                           $error = "All (*) feilds are required"; 
                        }
                        else{
                            $update_query ="UPDATE `cms`.`posts` SET `title` = '$up_title',`image` = '$up_image',`categories` = '$up_categories',`tags` = '$up_tags',`post_data` = '$up_post_data',`status` = '$up_status' WHERE `posts`.`id` ='$edit_id'";
                            if(mysqli_query($con,$update_query)){
                                $msg="Post has been updated";
                                $path = "media/$up_image";
                                header("location: edit-post.php?edit=$edit_id");
                                if(!empty($up_image)){
                                    if(move_uploaded_file($up_tmp_name,$path)){
                                    copy($path,"../$path");
                                }
                                }
                                $up_title="";
                                $up_post_data="";
                                $up_categories="";
                                $up_status="";
                                $up_tags="";
                                
                            }
                            else{
                                $error ="Post has not been updated";
                            }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title:*</label>
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
                                    <input type="text" name="title" value="<?php if(isset($title)) echo $title;?>" class="form-control" placeholder="Type post title here...">
                                </div>
                                <div class="form-group">
                                    <a href="media.php" class="btn btn-primary">Add media</a>
                                </div>
                                <div class="form-group">
                                    <textarea name="post-data" id="textarea" rows="10" class="form-control" placeholder="Write your post here...."><?php if(isset($post_data)) echo $post_data;?></textarea>
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
                                        <label for="categories">Categories:*</label>
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
                                <input type="submit" class="btn btn-primary" value="Update post" name="update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php require_once('inc/footer.php');?>