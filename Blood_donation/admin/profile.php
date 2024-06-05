<?php 
require_once('inc/top.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
$session_username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$session_username'";
$run = mysqli_query($con,$query);
$row=mysqli_fetch_array($run);

$image = $row['image'];
$id = $row['id'];
$date = getdate($row['date']);
$day=$date['mday'];
$month = substr($date['month'],0,3);
$year = $date['year'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$username = $row['username'];
$email = $row['email'];
$role = $row['role'];
$datails = $row['datails'];
$blood_group = $row['blood_group'];
$phone = $row['phone']; 
$district = $row['district'];
$age = $row['age'];
$donor_status = $row['donor_status'];
$gender = $row['gender'];

?>
  <body style="margin-top: 60px;" id="profile">
   <div id="wrapper">
       <?php require_once('inc/header.php');?>
        <div class="container-fluid body-section">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('inc/sidebar.php');?>
                </div>
                <div class="col-md-9">
                    <h1 style="color: #2A9FC1;"><i class="fa fa-user"></i> Profile <small>Personal datails</small></h1><hr>
                    <ol class="breadcrumb">
                      <li><a href="index.php"><i class="fa fa-tachometer"></i> Deshboard</a></li>
                      <li><i class="fa fa-user"></i> Profile</li>

                    </ol>
                    <center><a href="img/<?php echo $image;?>"><img src="img/<?php echo $image;?>" alt="profile-picture" id="profile-image" width="200px" class="img-circle img-thumbnail"></a></center><br>
                    <a href="edit-profile.php?edit=<?php echo $id;?>" class="btn btn-primary pull-right">Edit profile</a><br><br>
                    <center>
                        <h3>Profile datails</h3>
                    </center>
                    <br>
                    <table class="table table-bordered">
                        <tr>
                            <td width="20%"><b>User ID:</b></td>
                            <td width="30%"><?php echo $id;?></td>
                            <td width="20%"><b>SignUp date:</b></td>
                            <td width="30%"><?php echo"$day $month $year";?></td>
                        </tr>
                        <tr>
                            <td width="20%"><b>First Name:</b></td>
                            <td width="30%"><?php echo $first_name;?></td>
                            <td width="20%"><b>Last Name:</b></td>
                            <td width="30%"><?php echo $last_name;?></td>
                        </tr>
                        <tr>
                            <td width="20%"><b>Username:</b></td>
                            <td width="30%"><?php echo $username;?></td>
                            <td width="20%"><b>Email:</b></td>
                            <td width="30%"><?php echo $email;?></td>
                        </tr>
                        <tr>
                            <td width="20%"><b>Role:</b></td>
                            <td width="30%"><?php if($role == 'admin') echo"Donor"; else if($role == 'author') echo"User";?></td>
                            <td width="20%"><b>Blood group</b></td>
                            <td width="30%"><?php echo $blood_group;?></td>
                        </tr>
                        <tr>
                            <td width="20%"><b>Phone:</b></td>
                            <td width="30%"><?php echo $phone;?></td>
                            <td width="20%"><b>District</b></td>
                            <td width="30%"><?php echo ucfirst($district);?></td>
                        </tr>
                        <tr>
                            <td width="20%"><b>Donor status:</b></td>
                            <td width="30%"><?php echo ucfirst($donor_status);?></td>
                            <td width="20%"><b>Gender</b></td>
                            <td width="30%"><?php echo ucfirst($gender);?></td>
                        </tr>
                        
                    </table>
                    <div class="row">
                        <div class="col-lg-8 col-sm-12">
                            <b>Datails:</b>
                            <div>
                                <?php echo $datails;?>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
<?php require_once('inc/footer.php');?>