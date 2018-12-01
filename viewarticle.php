<?php
//ini_set('error_reporting', 0);
session_start();
require_once('connect.php'); 
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-post.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              
              <?php if(isset($_SESSION['login_id'])){
                ?>
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              <?php
              }else{?>
              <a class="nav-link" href="login.php">Login</a>
              <?php } ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<br><br>
    <!-- Page Content -->
    <div class="container">

      <div class="row">
<?php
if(isset($_GET['p'])){

$pid = $_GET['p'];

$qry = "SELECT * FROM user as u inner join posts p on u.uid=p.uid and p.post_status='publish' and p.post_ID='$pid'  ";  

          if($result = mysqli_query($con, $qry)){
            if(mysqli_num_rows($result) > 0){
              $row = mysqli_fetch_array($result);

                ?>
        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <h1 class="mt-4"><?= $row['article_title']?></h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="#"><?= $row['name']?></a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo date_format(date_create($row['post_date']),"F d, Y H:i:s") ?></p>

          <hr>

          <!-- Preview Image -->
         <?php if($row['post_image']!=''){ ?>
            <img class="card-img-top" src="images/upload/<?= $row['post_image']?>" alt="Card image cap" width="750xp" height="300px">
            <?php } ?>

          <hr>

          <!-- Post Content -->
          <p class="lead"><?= $row['post_content']?></p>

           

          <p><?= $row['article_content']?></p>

          <hr>

          
      <?php
            }
          }
        }
      ?>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">Web Design</a>
                    </li>
                    <li>
                      <a href="#">HTML</a>
                    </li>
                    <li>
                      <a href="#">Freebies</a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">JavaScript</a>
                    </li>
                    <li>
                      <a href="#">CSS</a>
                    </li>
                    <li>
                      <a href="#">Tutorials</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
