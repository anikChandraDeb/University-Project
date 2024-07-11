<?php require_once('inc/top.php');?>
  <body>
    <?php require_once('inc/header.php');
    $all_run = mysqli_query($con,"SELECT * FROM users WHERE role = 'admin'");
    $all_num =mysqli_num_rows($all_run);
      
    $abp_run = mysqli_query($con,"SELECT * FROM users WHERE blood_group = 'AB+' and role = 'admin'");
    $abp_num = mysqli_num_rows($abp_run);
    $abn_run = mysqli_query($con,"SELECT * FROM users WHERE blood_group = 'AB-' and role = 'admin'");
    $abn_num = mysqli_num_rows($abn_run);
      
    $ap_run = mysqli_query($con,"SELECT * FROM users WHERE blood_group = 'A+' and role = 'admin'");
    $ap_num = mysqli_num_rows($ap_run);    
    $an_run = mysqli_query($con,"SELECT * FROM users WHERE blood_group = 'A-' and role = 'admin'");
    $an_num = mysqli_num_rows($an_run);
      
    $bp_run = mysqli_query($con,"SELECT * FROM users WHERE blood_group = 'B+' and role = 'admin'");
    $bp_num = mysqli_num_rows($bp_run);     
    $bn_run = mysqli_query($con,"SELECT * FROM users WHERE blood_group = 'B-' and role = 'admin'");
    $bn_num = mysqli_num_rows($bn_run);
      
    $op_run = mysqli_query($con,"SELECT * FROM users WHERE blood_group = 'O+' and role = 'admin'");
    $op_num = mysqli_num_rows($op_run);
      
    $on_run = mysqli_query($con,"SELECT * FROM users WHERE blood_group = 'O-' and role = 'admin'");
    $on_num = mysqli_num_rows($on_run);
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
                    if(isset($_GET['b_id'])){
                        $b_id=$_GET['b_id'];
                        
                        
                        if($b_id== "all"){
                            $all_query = "SELECT * FROM users WHERE role = 'admin'";
                        }
                        else if($b_id == 'AB' or $b_id == 'A' or $b_id == 'B' or $b_id == 'O'){
                            $b_id .='+';
                            $all_query = "SELECT * FROM users WHERE blood_group = '$b_id' and role = 'admin'";
                        }
                        else{
                            $all_query = "SELECT * FROM users WHERE blood_group = '$b_id' and role = 'admin'";
                        }
                        
                        $all_run = mysqli_query($con,$all_query);
                        if(mysqli_num_rows($all_run) > 0){
                            
                                
                            
                    ?>
                       
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <a href="search.php" class="btn btn-primary">Search donor</a>    <hr>
                        </div>
                    </div>
                    
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
                              <td><?php
                                    if($donor_status == 'ready')
                                    echo"<span style='color:green;'>".ucfirst($donor_status)."</span>";
                                    else if($donor_status == 'unready')
                                    echo"<span style='color:red;'>".ucfirst($donor_status)."</span>";
                                    ?>
                                </td>
                              <td><a href="comment.php?com=<?php echo $id;?>" class="btn btn-primary">Message him</a></td>
                          </tr>
                          <?php } ?>
                    </table>
                    <?php
                  
                            
                            }
                        else{
                            echo"<center><h3>No donor available</h3></center>";
                        }
                            
                        }
                    
                    else{
                       
                    ?>
                    <div class="row tag-boxes">
                        <div class="col-md-12 col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $all_num;?></div>
                                            <div class="text-right">All blood donor</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"all"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All blood donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row tag-boxes">
                        <div class="col-md-3 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $abp_num;?></div>
                                            <div class="text-right">AB+ donor</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"AB"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all AB+ donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $abn_num;?></div>
                                            <div class="text-right">AB- donor</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"AB-"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all AB- donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $ap_num;?></div>
                                            
                                              <div class='text-right'>A+ donor</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"A"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all A+ donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-folder-open fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $an_num;?></div>
                                            <div class="text-right">A- donor</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"A-"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all A- donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><hr>
                    <div class="row tag-boxes">
                        <div class="col-md-3 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $bp_num;?></div>
                                            <div class="text-right">B+ donor</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"B"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all B+ donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $bn_num;?></div>
                                            <div class="text-right">B- donor</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"B-"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all B- donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $op_num;?></div>
                                            
                                           
                                               <div class='text-right'>O+ donor</div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"O"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all O+ donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                        <i class="fa fa-folder-open fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="text-right" style="font-size: 40px;"><?php echo $on_num;?></div>
                                            <div class="text-right">O- donor</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="find-blood.php?b_id=<?php echo"O-"?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">view all O- donor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><hr>
                    <?php
                    }
                    ?>
                    
                </div>
                
            </div>
        </div>
    </section>
<?php require_once('inc/footer.php');?>