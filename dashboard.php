
<?php
 
include_once('template/header.php');


 if(!isset($_SESSION['login_id'])){
  
  header("location: login.php");
}


?>
    <!-- partial:partials/_navbar.html -->
<?php
// top navigation ni xa
include_once('template/nav_top.php');
?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
<?php
// left navigation ni xa
include_once('template/nav_left.php');
?>     
      
      <!-- partial -->
      <div class="main-panel">

        <div class="content-wrapper">

        <?php
        $pages = '';
        
        $getPage = '';
      if(isset($_GET['pages']))
        $getPage = $_GET['pages'];
        
        switch ($getPage)
        {
          case 'post':
            include_once'pages/pages.php';
          break;
          case 'newpost':
            include_once'pages/newpost.php';
          break; 
          case 'view':
            include_once'pages/viewpages.php';
          break; 
          case 'edit':
            include_once'pages/newpost.php';
          break; 
          case 'users':
            include_once'users/userlist.php';
          break; 
          default:
            if($_SESSION['uType']==1){
             include_once'pages/dashboard.php';

            }else
            {

             include_once'pages/pages.php';
            }
        }
 
        
        ?>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i>
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
<?php
include_once('template/footer.php');
?>