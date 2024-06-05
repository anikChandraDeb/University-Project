<div class="widgets">
   <form action="index.php" method="post">
    <div class="input-group">
      <input type="text" class="form-control" name="search-title" placeholder="Search for...">
      <span class="input-group-btn">
        <input type="submit" name="search" value="Go" class="btn btn-default">
      </span>
    </div><!-- /input-group -->
   </form>
</div>

<div class="widgets">
    <div class="popular">
        <h4>Recent Blood need</h4>
        <?php
            $p_query="SELECT * FROM posts WHERE status='publish' ORDER BY id DESC LIMIT 5";
            $p_run=mysqli_query($con,$p_query);
            if(mysqli_num_rows($p_run)>0)
            {
                while($p_row=mysqli_fetch_array($p_run))
                {
                    $p_id=$p_row['id'];
                    $p_title=$p_row['title'];
                    $p_image=$p_row['image'];
                    $p_date=getdate($p_row['date']);
                    $p_day=$date['mday'];
                    $p_month=$date['month'];
                    $p_year=$date['year'];
              
        ?>
        <div class="row">
            <div class="col-xs-4">
                <a href="post.php?post_id=<?php echo $p_id;?>"><img src="media/<?php echo $p_image;?>" alt="image"></a>
            </div>
            <div class="col-xs-8 datails">
                <a href="post.php?post_id=<?php echo $p_id;?>"><h5><?php echo $p_title;?></h5></a>
                <p><i class="fa fa-clock-o"></i> <?php echo"$p_day $p_month,$p_year";?></p>
            </div>
        </div>
        <?php 
                }
            }
            else
                echo"<h3>No post available</h3>";
        ?>
       
    </div>
</div>
<div class="widgets">
    <div class="popular">
        <h4>Most views donation posts.</h4>
        <?php
            $p_query="SELECT * FROM posts WHERE status='publish' ORDER BY views DESC LIMIT 5";
            $p_run=mysqli_query($con,$p_query);
            if(mysqli_num_rows($p_run)>0)
            {
                while($p_row=mysqli_fetch_array($p_run))
                {
                    $p_id=$p_row['id'];
                    $p_title=$p_row['title'];
                    $p_image=$p_row['image'];
                    $p_date=getdate($p_row['date']);
                    $p_day=$date['mday'];
                    $p_month=$date['month'];
                    $p_year=$date['year'];
              
        ?>
        <div class="row">
            <div class="col-xs-4">
                <a href="post.php?post_id=<?php echo $p_id;?>"><img src="media/<?php echo $p_image;?>" alt="image"></a>
            </div>
            <div class="col-xs-8 datails">
                <a href="post.php?post_id=<?php echo $p_id;?>"><h5><?php echo $p_title;?></h5></a>
                <p><i class="fa fa-clock-o"></i> <?php echo"$p_day $p_month,$p_year";?></p>
            </div>
        </div>
        <?php 
                }
            }
            else
                echo"<h3>No post available</h3>";
        ?>
       
    </div>
</div>
<div class="widgets">
   <div class="popular">
       <h4>Blood group</h4>
       <div class="row">
        <div class="col-xs-6">
            <ul>
                <?php 
                    $c_query="SELECT * FROM categories";
                    $c_run=mysqli_query($con,$c_query);
                    if(mysqli_num_rows($c_run)>0)
                    {
                        $count=2;
                        while($c_row=mysqli_fetch_array($c_run))
                        {
                            
                            $c_id=$c_row['id'];
                            $c_category=$c_row['category'];
                            $count=$count+1;
                            if($count % 2==1)
                            {
                                echo"<li>
                                    <a href='index.php?cat=".$c_id."'>".(ucfirst($c_category))."</a>
                                    
                                </li>";
                            }
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="col-xs-6">
            <ul>
                <?php 
                    $c_query="SELECT * FROM categories";
                    $c_run=mysqli_query($con,$c_query);
                    if(mysqli_num_rows($c_run)>0)
                    {
                        $count=2;
                        while($c_row=mysqli_fetch_array($c_run))
                        {
                            
                            $c_id=$c_row['id'];
                            $c_category=$c_row['category'];
                            $count=$count+1;

                            if($count % 2==0)
                            {
                                echo"<li>
                                    <a href='index.php?cat=".$c_id."'>".(ucfirst($c_category))."</a>
                                    
                                </li>";
                            }
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
   </div>

</div>
<div class="widgets">
    <div class="categories">
        <h4>Social icons</h4>
        <div class="row">
            <div class="col-xs-4">
                <a href="#"><img src="img/facebook.png" alt="icon"></a></a></a>
            </div>
            <div class="col-xs-4">
              <a href="#">
              <img src="img/twitter.png" alt="icon"></a>
            </div>
            <div class="col-xs-4">
                <a href="index.php">
<img src="img/icon.jpg" alt="icon"></a>
            </div>
        </div>
        <!--<hr>
        <div class="row">
            <div class="col-xs-4">
                <img src="img/icon.png" alt="icon">
            </div>
            <div class="col-xs-4">
                <img src="img/icon.png" alt="icon">
            </div>
            <div class="col-xs-4">
                <img src="img/icon.png" alt="icon">
            </div>
        </div>-->
    </div>
</div>
