<?php require_once('inc/top.php');?>

  <body>
    <?php require_once('inc/header.php');
        if(isset($_GET['post_id']))
        {
            $post_id=$_GET['post_id'];
            $views_query = "UPDATE `cms`.`posts` SET `views` = views + 1 WHERE `posts`.`id` =$post_id";
            mysqli_query($con,$views_query);
            $query = "SELECT * FROM posts WHERE status = 'publish' and id = $post_id";
            $run=mysqli_query($con,$query);
            if(mysqli_num_rows($run))
            {
                $row=mysqli_fetch_array($run);
                $id=$row['id'];
                $date=getdate($row['date']);
                $day=$date['mday'];
                $month=$date['month'];
                $year=$date['year'];
                $title=$row['title'];
                $author=$row['author'];
                $author_image=$row['author_image'];
                $image=$row['image'];
                $categories=$row['categories'];
                $tags=$row['tags'];
                $post_data=$row['post_data'];
            }
            else
            {
                header('Location: index.php');
            }
        }
      
    ?>
            
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                   <?php
                        if(isset($title))
                        {
                    ?>
                    <div class="post">
                        <div class="row">
                            <div class="col-md-2 post-date">
                                <div class="day"><?php echo $day;?></div>
                                <div class="month"><?php echo $month;?></div>
                                <div class="year"><?php echo $year;?></div>
                            </div>
                            <div class="col-md-8 post-title">
                                <a href="post.php?post_id=<?php echo $id;?>">
                                    <h2><?php echo $title;?>...</h2>
                                </a>
                                <p>Written by : <span><?php echo ucfirst($author);?></span></p>
                            </div>
                            <div class="col-md-2 profile-picture">
                                <img src="img/<?php echo $author_image;?>" alt="profile picture" class="img-circle">
                            </div>
                        </div>
                        <a href="img/<?php echo $image;?>"><img src="media/<?php echo $image;?>" alt="post-image"></a>
                        <p class="desc">
                            <?php echo $post_data;?>
                        </p>
                       
                        <div class="bottom">
                            <span style="margin-right: 20px;"><a href="#"><i class="fa fa-folder"></i> <?php echo ucfirst($categories);?></a></span>|
                            <span style="margin-left: 20px;"><a href="#"><i class="fa fa-comment"></i> Comment</a></span>
                        </div>
                        
                    </div >
                    <?php 
                        }
                        else
                            echo"<h3>No post available.</h3>";
                    ?>
                    <div class="related-posts">
                       <h2 style="color: #4DBEE6;">Related post.</h2><hr>
                        <div class="row">
                           <?php 
                                if(isset($title))
                                {
                                    $r_query="SELECT * FROM posts WHERE status = 'publish' and title LIKE '%$title%' LIMIT 3";
                                $r_run=mysqli_query($con,$r_query);
                                while($r_row=mysqli_fetch_array($r_run)){
                                    $r_id=$r_row['id'];
                                    $r_title=$r_row['title'];
                                    $r_image=$r_row['image'];
                               
                                
                            ?>
                            <div class="col-sm-4">
                                <a href="post.php?post_id=<?php echo $r_id;?>">
                                    <img src="media/<?php echo $r_image;?>" alt="post image">
                                    <h4><?php echo $r_title;?></h4>
                                </a>
                            </div>
                           <?php 
                                }
                                }
                            else
                                echo"<h3>No related post available.</h3>";
                            ?>
                        </div>
                    </div>
                    <?php
                    if(isset($title)){ 
                    ?>
                    <div class="author">
                        <div class="col-sm-3">
                            <img src="img/<?php echo $author_image;?>" alt="profile picture" class="img-circle">
                        </div>
                        <div class="col-sm-9">
                            <h4><?php echo ucfirst($author);?></h4>
                            <?php
                                $user_query = "SELECT * FROM users WHERE username = '$author'";
                                $user_run=mysqli_query($con,$user_query);
                                if(mysqli_num_rows($user_run) > 0){
                                    $user_row=mysqli_fetch_array($user_run);
                                    $datails =$user_row['datails'];
                                
                                
                        
                            ?>
                            <p>
                                <?php
                                echo $datails;
                                ?>
                            </p>
                            <?php }?>
                        </div>
                    </div>
                    <?php 
                        } 
                        $c_query = "SELECT * FROM comments WHERE status = 'approve' and post_id = $post_id ORDER BY id DESC";
                        $c_run = mysqli_query($con,$c_query);
                        if(mysqli_num_rows($c_run) > 0){
                    ?>
                    <div class="comment">
                       <h3>Comment</h3><hr>
                       <?php 
                                while($c_row=mysqli_fetch_array($c_run)){
                                    $c_id=$c_row['id'];
                                    $c_name=$c_row['name'];
                                    $c_username=$c_row['username'];
                                    $c_image=$c_row['image'];
                                    $c_comment=$c_row['comment'];
                                    $c_title=$c_row['website'];
                                    $r_username=$c_row['reply_username'];
                                
                            ?>
                            
                        <div class="row single-comment">
                           
                            <div class="col-sm-2">
                                <img src="img/<?php echo $c_image;?>" alt="comments picture" class="img-circle">
                            </div>
                            <div class="col-sm-10">
                                <h4><?php echo ucfirst($c_name); if(isset($r_username)) echo" :comemnt for: $r_username";?></h4>
                                <h6><?php echo ucfirst($c_title);?></h6>
                                <p>
                                    <?php echo $c_comment;?>
                                </p>
                            </div><hr>
                            
                        </div>
                        <div class="row">
                            <a href="comment.php?comr=<?php echo $c_id;?>" class="btn btn-primary btn-sm">Reply comment by email.</a>
                        </div><br><br>
                        <?php } ?>
                    </div>
                    <?php } 
                        if(isset($_POST['submit']))
                        {
                            $cs_name=$_POST['name'];
                            $cs_email=$_POST['email'];
                            $cs_website=$_POST['website'];
                            $cs_comment=$_POST['comment'];
                            $cs_date=time();
                            if(empty($cs_name) or empty($cs_email) or empty($cs_comment))
                            {
                                $error_msg="All (*) feilds are required";
                            }
                            else
                            {
                                $i_query= "SELECT * FROM users WHERE email = '$cs_email'";
                                $i_run = mysqli_query($con,$i_query);
                                if(mysqli_num_rows($i_run) > 0){
                                    $i_row= mysqli_fetch_array($i_run);
                                    $i_image= $i_row['image'];
                                }
                                else{
                                    $i_image="unknown.jpg";
                                }
                                $cs_query="INSERT INTO comments (`id` ,`date` ,`name` ,`username` ,`post_id` ,`email` ,`website` ,`image` ,`comment` ,`status`,post_title)VALUES (NULL , '$cs_date', '$cs_name', '$cs_name', '$post_id', '$cs_email', '$cs_website', '$i_image', '$cs_comment', 'pending','$title')";
                                if(mysqli_query($con,$cs_query)){
                                    $msg="Comment submitted and waiting for approve";
                                    $cs_name="";
                                    $cs_email="";
                                    $cs_website="";
                                    $cs_comment="";
                                    
                                }
                                else
                                {
                                    $error_msg="Comment has not submitted";
                                }
                            }
                        }
                    ?>
                    <div class="comment-box">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="full-name">Full name*</label>
                                        <input type="text" name="name" id="full-name" class="form-control" placeholder="Full name" value="<?php if(isset($cs_name)) echo $cs_name;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address*</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" value="<?php if(isset($cs_email)) echo $cs_email;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Comment title</label>
                                        <input type="text" name="website" id="website" class="form-control" placeholder="Comment title..." value="<?php if(isset($cs_website)) echo $cs_website;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment*</label>
                                        <textarea name="comment" class="form-control" id="comment" cols="30" rows="10" placeholder="Write your comment here....">
                                            
                                        </textarea>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Submit comment" name="submit">
                                    <?php
                                        if(isset($error_msg)){
                                            echo"<span style='color:red;' class='pull-right'>$error_msg</span>";
                                        }
                                        else if(isset($msg)){
                                            echo"<span style='color:green;' class='pull-right'>$msg</span>";

                                        }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <?php require_once('inc/sidebar.php');?>

                </div>
            </div>
        </div>
    </section>
<?php require_once('inc/footer.php');?>
