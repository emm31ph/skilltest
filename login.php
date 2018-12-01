   <?php

include_once('template/header.php');

 if(isset($_SESSION['login_id'])){
  header("location: index.php");
}
   ?>

 
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <?php

                  $error_message = array();

                  if(isset($_POST['submit']))
                  {
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    if(empty($email)){
                      array_push($error_message,"Userame is required");
                    }
                    if(empty($password)){
                      array_push($error_message,"Password is required");
                    }

                    

                    if(count($error_message)==0){
                      $pwd = md5($password);  
                      $qry = "select * from user where email='$email' and password='$pwd'";
                      

                      $result = mysqli_query($con, $qry);
                        if(mysqli_num_rows($result) > 0){
                          
                          $row = mysqli_fetch_array($result);

                           $_SESSION["login_user"] = $row['name'];

                           $_SESSION["login_id"] = $row['uid'];
                           $_SESSION["uType"] = $row['usertype'];

                            header("Location: dashboard.php");

                        }else{                        
                          array_push($error_message, "Account not found");
                        }
                      
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
               
              <form action="" method="post">
                <div class="form-group">
                  <label class="label">Email Address</label>
                  <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email Address" name="email">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="*********" name="password" >
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary submit-btn btn-block" name="submit" value="Login">
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                </div>
                <div class="form-group">
                  <button class="btn btn-block g-login">
                    <img class="mr-3" src="images/file-icons/icon-google.svg" alt="">Log in with Google</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="register.php" class="text-black text-small">Create new account</a>
                </div>
              </form>
            </div>
            <ul class="auth-footer">
              <li>
                <a href="#">Conditions</a>
              </li>
              <li>
                <a href="#">Help</a>
              </li>
              <li>
                <a href="#">Terms</a>
              </li>
            </ul>
            <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
   
   <?php
include_once('template/footer.php')
   ?>