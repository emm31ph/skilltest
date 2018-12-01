<?php

$qry = "SELECT count(*) as totalPost FROM user as u inner join posts p on u.uid=p.uid and p.post_status='publish'  ";  
$result = mysqli_query($con, $qry);
$row = mysqli_fetch_array($result);


?>

          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Post</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= $row['totalPost']?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>  
                  </p>
                </div>
              </div>
            </div>
<?php
$qry = "SELECT count(*) as totalPost FROM user as u where userType not in (1)  ";  
$result = mysqli_query($con, $qry);
$row = mysqli_fetch_array($result);
?>


            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt  text-warning  icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Users</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= $row['totalPost']?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>  
                  </p>
                </div>
              </div>
            </div>
        </div>