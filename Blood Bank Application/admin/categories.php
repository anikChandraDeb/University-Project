<?php require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
else if(isset($_SESSION['username']) and $_SESSION['role'] =='author'){
    header('Location: index.php');
}

if(isset($_GET['edit'])){
    $edit_id=$_GET['edit'];
}

if(isset($_GET['del'])){
    $del_id=$_GET['del'];
    if(isset($_SESSION['username']) and $_SESSION['role'] == 'admin'){
        $del_query = "DELETE FROM categories WHERE id = '$del_id'";
        if(mysqli_query($con,$del_query)){
            $del_msg="Category has been deleted";
        }
        else
        {
            $del_error = "Category has not been deleted";
        }
    }
}

if(isset($_POST['submit'])){
    $cat_name =mysqli_real_escape_string($con,strtolower($_POST['cat-name']));
    
    if(empty($cat_name)){
        $error="Fill this feild";
    }
    else{
        $check_query = "SELECT * FROM categories WHERE category = '$cat_name'";
        $check_run = mysqli_query($con,$check_query);
        if(mysqli_num_rows($check_run) > 0)
        {
            $error = "Category already exist";
        }
        else
        {
            $insert_query = "INSERT INTO `cms`.`categories` (category)VALUES ('$cat_name')";
            if(mysqli_query($con,$insert_query)){
                $msg="Category has been added";
            }
            else
            {
                $error = "Category has not been added";
            }
        }
    }
}

if(isset($_POST['update'])){
    $cat_name =mysqli_real_escape_string($con,strtolower($_POST['cat-name']));
    
    if(empty($cat_name)){
        $up_error="Fill this feild";
    }
    else{
        $check_query = "SELECT * FROM categories WHERE category = '$cat_name'";
        $check_run = mysqli_query($con,$check_query);
        if(mysqli_num_rows($check_run) > 0)
        {
            $up_error = "Category already exist";
        }
        else
        {
            $update_query = "UPDATE `cms`.`categories` SET `category` = '$cat_name' WHERE `categories`.`id` =$edit_id";
            if(mysqli_query($con,$update_query)){
                $up_msg="Category has been updated";
            }
            else
            {
                $up_error = "Category has not been updated";
            }
        }
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
                    <h1 style="color: #2A9FC1;"><i class="fa fa-folder-open"></i> Blood group <small>Different Blood group</small></h1><hr>
                    <ol class="breadcrumb">
                      <li><a href="index.php"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                      <li><i class="fa fa-folder-open"></i> Blood group</li>

                    </ol>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="category">Blood group Name:*</label>
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
                                    <input type="text" class="form-control" placeholder="Category name" name="cat-name">
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Blood group">
                            </form>
                            <?php
                            if(isset($_GET['edit'])){
                                $edit_check_query ="SELECT * FROM categories WHERE id = '$edit_id'";
                                $edit_check_run = mysqli_query($con,$edit_check_query);
                                if(mysqli_num_rows($edit_check_run) > 0){
                                    $edit_row=mysqli_fetch_array($edit_check_run);
                                    $up_category = $edit_row['category'];
                                
                            ?>
                            <hr>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="category">Update blood group Name:</label>
                                    <?php 
                                    if(isset($up_error))
                                    {
                                        echo"<span class='pull-right' style='color:red;'>$up_error</span>";
                                    }
                                    else if(isset($up_msg))
                                    {
                                        echo"<span class='pull-right' style='color:green;'>$up_msg</span>";
                                    }
                                    ?>
                                    <input type="text" class="form-control" value="<?php echo $up_category;?>" placeholder="Blood group name" name="cat-name">
                                </div>
                                <input type="submit" class="btn btn-primary" name="update" value="Update Blood group">
                            </form>
                            <?php
                            }
                            }
                            ?>
                        </div>
                        <div class="col-md-6">
                           <?php
                            $get_query = "SELECT * FROM categories ORDER BY id DESC";
                            $get_run = mysqli_query($con,$get_query);
                            if(mysqli_num_rows($get_run) > 0){
                            if(isset($del_error))
                            {
                                echo"<span class='pull-right' style='color:red;'>$del_error</span>";
                            }
                            else if(isset($del_msg))
                            {
                                echo"<span class='pull-right' style='color:green;'>$del_msg</span>";
                            }
                            ?>
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr #</th>
                                        <th>Category name</th>
                                        
                                        <th>Edit</th>
                                        <th>Del</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                    while($get_row = mysqli_fetch_array($get_run)){
                                        $category_id = $get_row['id'];
                                        $category_name = $get_row['category'];
                                        
                                   
                                    ?>
                                    <tr>
                                        <td><?php echo $category_id;?></td>
                                        <td><?php echo ucfirst($category_name);?></td>
                                        
                                        <td><a href="categories.php?edit=<?php echo $category_id;?>"><i class="fa fa-pencil"></i></a></td>
                                        <td><a href="categories.php?del=<?php echo $category_id;?>"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <?php
                            }
                            else
                            {
                                echo"Category not found";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center">
            Copyright &copy; by <a href="https://web.facebook.com/anikdeb.prem">Anik deb</a>
                All right reserve from 2016-2018.
  <?php require_once('inc/footer.php');?>