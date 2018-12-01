
<?php


 
$limit = 10;
if(isset($_GET['p'])){

  $p = $_GET['p'];
}else{
  $p = 1;
}
$strtpage = ($p - 1)* $limit;

$uid = $_SESSION['login_id'];
$uType = $_SESSION['uType'];
$search = '';


 if($_SESSION['uType']==0){
  header("Location:'http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

$qry = "SELECT * FROM user as u where uid not in ('$uid') order by dcreate desc limit $strtpage, $limit";  
 }else{

  if(isset($_POST['btnSearch']) && $_POST['txtSearch']!=''){
    $search = "and name like '%".$_POST['txtSearch']."%'";
     

  }
  $qry = "SELECT * FROM user as u where uid not in ('$uid') ".$search." order by dcreate desc limit $strtpage, $limit";

}


if(isset($_SESSION['action']) && $_SESSION['action']==1):
    ?>
    <div class="row">  
      <div class="col-12 grid-margin">  
        <div class='btn btn-success btn-block'>
         <p>Successfully Deleted!</p>
        </div>
      </div>
    </div>      
    <?php
    unset($_SESSION['action']);
  endif;

?>


<div class="row"> 
	<div class="col-12 grid-margin">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Users</h4> 
   
     
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">All</label>
                           
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" style="text-align: rigth"></label>
                          <div class="col-sm-9">
                            <form method="post" class="form-group" action="">
                            <div class="input-group">
                              
                            <input type="text" name="txtSearch" placeholder="Search" class="form-control" />
                            <span class="input-group-btn">
                              <button class="btn btn-secondary" name="btnSearch" type="submit">Go!</button>
                            </span>
                              
                          </div>
                        </form>
                          </div>
                        </div>
                      </div>
                    



					<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  
                  <th>
                    Name
                  </th>         
                  <th width="250px">
                    Email
                  </th> 
                  <th width="50px">
                    Date Create
                  <!-- <th width="50px">
                    Action
                  </th>  -->
                </tr>
              </thead>
              <tbody>
               
            <?php   

            if($result = mysqli_query($con, $qry)){
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  ?>

                <tr>
                  
                  <td class="py-1">
                    <!-- <img src="../../images/faces-clipart/pic-1.png" alt="image" /> -->
                    <?= $row['name']?>
                  </td>
                  <td>
                     <?= $row['email']?>
                  </td>
                  <td>
                    <?= $row['dcreate']?>
                  </td>  
                  <!-- <td>
                    <a href="?pages=users&pid=<?= $row['uid'] ?>"> 
                    <i class="fa fa-edit"></i>
                  </a> 
                    <a href="?pages=users&d=<?= $row['uid'] ?>" Onclick="return ConfirmDelete()"> 
                    <i class="fa fa-window-close text-danger"></i>
                  </a>

                  </td>  -->
                </tr>

                  <?php
                }
              }else{
                ?>
                <tr>
                  <td colspan="4" class="py-1" align="center">
                    No Records
                  </td>
                </tr>
                <?php

              }
            }
?>
              </tbody>
            </table>
          <?php
          // pra sa pagination area ni
          $sql = "SELECT COUNT(uid) FROM user p where p.uid not in ('$uid')";  
          
          $rs_result = mysqli_query($con, $sql); 

          $row = mysqli_fetch_row($rs_result);  
    

          $total_records = $row[0];  
 
          $total_pages = ceil($total_records / $limit);  
 
          $pagLink = "<div class='pagination'>";  
 

          for ($i=1; $i<=$total_pages; $i++) {  
                       $pagLink .= "<a href='?pages=post&p=".$i."' class='btn btn-outline-secondary'>".$i."</a>";  
          };  
          echo $pagLink . "</div>"; 


          ?>

          </div>
					 
			</div>
		</div>
	</div>
</div>
<script>
function ConfirmDelete()
{ 
  var r=confirm("Are you sure you want to delete?");
     if (r) {
       return true;
   } else {

      return false;

   }
}
</script>

<?php
//to delete post
if(isset($_SESSION['login_id']) && isset($_GET['d'])){
  $pid = $_GET['d'];


  $qry = "delete from posts where post_ID='$pid'";


  $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
  mysqli_query($con, $qry) or die("error on deleting posts ".mysqli_error());
    header("location: ".$actual_link."?pages=post&action=1");
    $_SESSION['action']=1;

}

?>