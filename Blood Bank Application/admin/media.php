<?php 
require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
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
                    <h1 style="color: #2A9FC1;"><i class="fa fa-database"></i> Picture <small>Add or view picture files</small></h1><hr>
                    <ol class="breadcrumb">
                     <li><a href="index.php"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                      <li><i class="fa fa-database"></i> Picture</li>

                    </ol>
                    <?php 
                    if(isset($_POST['submit'])){
                        if(count($_FILES['media']['name']) > 0){
                            for($i=0;$i<count($_FILES['media']['name']);$i++){
                                $image=$_FILES['media']['name'][$i];
                                $tmp_name=$_FILES['media']['tmp_name'][$i];
                                $query = "INSERT INTO media (image) VALUES('$image')";
                                if(mysqli_query($con,$query)){
                                    $path = "media/$image";
                                    if(move_uploaded_file($tmp_name,$path)){
                                        copy($path,"../$path");
                                    }
                                }
                            }
                        }
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-4 col-xs-8">
                                <input type="file" name="media[]" required multiple>
                            </div>
                            <div class="col-sm-4 col-xs4">
                                <input type="submit" value="Add  picture any" class="btn btn-primary btn-sm" name="submit">
                            </div>
                        </div>
                    </form><hr>
                    <div class="row">
                       <?php
                        $get_query="SELECT * FROM media";
                        $get_run=mysqli_query($con,$get_query);
                        if(mysqli_num_rows($get_run) > 0){
                            while($get_row=mysqli_fetch_array($get_run)){
                                $get_image=$get_row['image'];
                           
                        ?>
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 thumb">
                            <a href="media/<?php echo $get_image;?>" class="thumbnail"><img src="media/<?php echo $get_image;?>" alt="media" width="100%"></a>
                        </div>
                        <?  }
                        }
                        else
                        {
                            echo"<center><h3>No media available.</h3></center>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php require_once('inc/footer.php');?>