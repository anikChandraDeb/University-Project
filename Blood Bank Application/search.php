<?php require_once('inc/top.php');?>
  <body>
    <?php require_once('inc/header.php');
 
    ?>
    <section>
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-2">

 <div class="list-group">
  <a href="find-blood.php" class="list-group-item active">
      Blood donor by group
  </a>
  <a href="find-blood.php?b_id=<?php echo"AB"?>" class="list-group-item">
   
    <i class="fa fa-users"></i> AB+
  </a>
  <a href="find-blood.php?b_id=<?php echo"AB-"?>" class="list-group-item">
   
    <i class="fa fa-users"></i> AB-
  </a>
  <a href="find-blood.php?b_id=<?php echo"A"?>" class="list-group-item">
    <i class="fa fa-users"></i> A+
  </a>
  <a href="find-blood.php?b_id=<?php echo"A-"?>" class="list-group-item">
   
    <i class="fa fa-users"></i> A-
  </a>
  <a href="find-blood.php?b_id=<?php echo"B"?>" class="list-group-item">
   
    <i class="fa fa-users"></i> B+
  </a>
  <a href="find-blood.php?b_id=<?php echo"B-"?>" class="list-group-item">
   
    <i class="fa fa-users"></i> B-
  </a>
  <a href="find-blood.php?b_id=<?php echo"O"?>" class="list-group-item">
   
    <i class="fa fa-users"></i> O+
  </a>
  <a href="find-blood.php?b_id=<?php echo"O-"?>" class="list-group-item">
   
    <i class="fa fa-users"></i> O-
  </a>
</div>
                </div>
                <div class="col-md-10">
                    <h1 style="color: #2A9FC1;"><i class="fa fa-tachometer"></i> Find blood <small>Find blood donor </small></h1><hr>
                    
                     <?php
                        if(isset($_POST['search'])){
                            $district = strtolower($_POST['district']);
                            $blood_group = $_POST['blood_group'];
                            $search = "SELECT * FROM users WHERE blood_group = '$blood_group' and district = '$district'";
                            $all_run = mysqli_query($con,$search);
                        
                        }
                    ?>  
                        <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="well">
                    <form action="" method="post" class="form-horizontal">
                       
                        <div class="fieldset">
                            <legend>Search blood donor</legend>
                            <div class="col-md-12">
                                <?php
                                if(!empty($msg))
                                    echo "<span style='float:right;color:green;font-size:20px;'>$msg</span>";
                                else if(!empty($error))
                                    echo "<span style='float:right;color:red;font-size:20px;'>$error</span>";
                                ?>
                            </div>
       
                            <div class="form-group">
                               <label class="col-md-2 control-label">District</label>
                               <div class="col-md-10">
                                   <input type="text" class="form-control" name="district" value="<?php if(isset($district)) echo"$district"; ?>"/> 
                               </div>
                                
                            </div>
        
                            <div class="form-group">
                               <label class="col-md-2 control-label">Blood Group</label>
                               <div class="col-md-10">
                                   <select class="form-control" name="blood_group">
                                       <option value="AB+">AB+</option>
                                       <option value="AB-">AB-</option>
                                       <option value="A+">A+</option>
                                       <option value="A-">A-</option>
                                       <option value="B+">B+</option>
                                       <option value="B-">B-</option>
                                       <option value="O+">O+</option>
                                       <option value="O-">O-</option>
                                   </select>
                               </div>

                            </div>
                           
                            <div class="form-group">
                 
                               <div class="col-md-offset-2 col-md-10">
                                   <button type="submit" name="search" class="btn btn-primary col-md-12">Search</button>
                               </div>
                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                      <?php
                    if(isset($all_run)){
                        if(mysqli_num_rows($all_run) > 0){
                  
                    
                    ?>  
                    <table class="table table-bordered">
                        <tr>
                              <th>Name</th>
                              <th>Blood group</th>
                              <th>Phone</th>
                              <th>District</th>

                              <th>Gender</th>
                              <th>Email</th>
                              <th>Age</th>
                              
                              <th>Donor status</th>
                              <th>Massege</th>
                          </tr>
                          <?php
                          while($all_row=mysqli_fetch_array($all_run)){
                              $id=$all_row['id'];
                              $first_name=$all_row['first_name'];
                              $last_name=$all_row['last_name'];
                              $first_name .= " ";
                              $first_name .= $last_name;
                              $blood_group=$all_row['blood_group'];
                              $phone=$all_row['phone'];
                              $district=$all_row['district'];
                              $gender=$all_row['gender'];
                              $email=$all_row['email'];
                              $age=$all_row['age'];
                              $donor_status=$all_row['donor_status'];
                              
                        ?>
                          <tr>
                              <td><?php echo $first_name;?></td>
                              <td><?php echo $blood_group;?></td>
                              <td><?php echo $phone;?></td>
                              <td><?php echo $district;?></td>
                              <td><?php echo $gender;?></td>
                              <td><?php echo $email;?></td>
                              <td><?php echo $age;?></td>
                              <td><?php echo $donor_status;?></td>
                              <td><a href="comment.php?com=<?php echo $id;?>" class="btn btn-primary">Message him</a></td>
                          </tr>
                          <?php } ?>
                    </table>
                  <?php   }
                        else{
                            echo"No donor available here now please contact";
                        }
                    }
                        ?>
                    
                </div>
                
            </div>
        </div>
    </section>
<?php require_once('inc/footer.php');?>