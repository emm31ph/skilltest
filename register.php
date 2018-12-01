<?php
include_once'template/header.php';
 if(isset($_SESSION['login_id'])){
  header("location: dashboard.php");
}


 
function valid_email($str) {
return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

 
?>
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4">Register</h2>
            <div class="auto-form-wrapper">
              <form action="" method="post">
                <?php  
                 $error_message = array();
                 $msg = array();
                  if(isset($_POST['submit'])){

                    $name = trim($_POST['name']);
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    $password1 = trim($_POST['password1']);
                    if(empty($name)){
                      array_push($error_message,"Name is required");
                    }
                    if(empty($email)){
                      array_push($error_message,"Email Address is required");
                    }
                    if(empty($password)){
                      array_push($error_message,"Password is required");
                    }
                    if($password!=$password1){
                      array_push($error_message,"Password do not match");
                    }
                    if(strlen(trim($password)) < 8){
                      array_push($error_message,"Password must be 8 characters");
                    }
                     if(!valid_email($email) && $email!=''){
                      array_push($error_message, "Invalid email address");

                    }
                    // kug exists na ang email
                     $sql = "select * from user where email='$email'";
                    if($result = mysqli_query($con, $sql)){
                      if(valid_email($email) && (mysqli_num_rows($result) > 0) && count($error_message)==0){
                        array_push($error_message, "Email address is already used");
                      }
                    } 

                     // if wla nay error
                    if(count($error_message)== 0){
                      $pwd = md5($password);     
                      $sql = "insert into user (email,password,name) values ('$email','$pwd','$name')";
                      
                      mysqli_query($con, $sql) or die("error on insert register".mysqli_error());
                      array_push($msg, "Successfully Save");
                      $_SESSION['login_id'] = mysqli_insert_id($con);
                      $_SESSION["login_user"] = $name;
                      $_SESSION["uType"] = '0';
                      $_POST['name']="";
                      $_POST['email']="";
                      $_POST['password']="";

                      ?>
                      <script type="text/javascript">
                      
                      window.alert("Successfully Save"); 
                      <?php
                       echo "window.location.href = 'http://".$_SERVER['HTTP_HOST']."/skillTest/dashboard.php'";
                       ?>
                      </script>
                      <?php 

                    }

                  }
                ?>
                 <?php     
                    if(count($error_message) > 0):
                      ?>
                      <div class='text-danger'>
                      <?php
                      foreach ($error_message as $error):
                        # code...
                        echo "<p>".$error."</p>";
                      endforeach;
                      ?>
                    </div>
                    <?php
                    endif;
                 ?>   

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo  (isset($_POST['name'])?$_POST['name']:"") ?>" required  >
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email Address" name="email" value="<?php echo  (isset($_POST['email'])?$_POST['email']:"") ?>" required >
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo  (isset($_POST['password'])?$_POST['password']:"") ?>" required >
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password1" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> I agree to the terms
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary submit-btn btn-block" name="submit" value="Register">
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Already have and account ?</span>
                  <a href="login.php" class="text-black text-small">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
<?php include_once'template/footer.php' ?>