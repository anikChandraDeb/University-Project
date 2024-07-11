<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
              
              <div class="col-xs-12">Blood Donation</div>
          </a>
        </div>
        

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt"></i> Group <span class="caret"></span></a>
              <ul class="dropdown-menu">
               <?php
                  $query="SELECT * FROM categories ORDER BY id DESC";
                  $run=mysqli_query($con,$query);
                  if(mysqli_num_rows($run)>0)
                  {
                      while($row=mysqli_fetch_array($run))
                      {
                          $category=ucfirst($row['category']);
                          $id=$row['id'];
                          echo"<li><a href='index.php?cat=".$id."'>$category</a></li>";
                      }
                      
                  }
                  else
                  {
                      echo"<li><a href='#'>No category here</a></li>";
                  }
                ?>
               
                
              </ul>
            </li>
            <li><a href="find-blood.php">Find Blood</a></li>
            <li><a href="add-user.php"><span class="glyphicon glyphicon-user"> Registration</span></a></li>
            <li><a href="admin/login.php"><span class="glyphicon glyphicon-log-in"> LogIn</span></a></li>
            <li><a href="contact-us.php"><i class="fa fa-phone"></i> Contact Us</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="jumbotron">
        <div class="container">
            <div id="datails" class="animated fadeInLeft">
                <h1>BBPI <span>Blood donation group</span></h1>
                <p>We help you for find blood donor.</p>
            </div>
        </div>
        <img src="img/jumbotron.jpg" alt="top image">
    </div>