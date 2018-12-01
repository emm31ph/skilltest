
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

 if($_SESSION['uType']==0){
$qry = "SELECT * FROM user as u inner join posts p on u.uid=p.uid and u.uid in ('$uid') order by post_date desc limit $strtpage, $limit";  
 }else{
$qry = "SELECT * FROM user as u inner join posts p on u.uid=p.uid and u.userType in ('$uType','0') order by post_date desc limit $strtpage, $limit";
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
				<h4 class="card-title">Posts</h4>
					<p class="card-description">
						All
					</p>
					<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  
                  <th>
                    Title
                  </th>         
                  <th width="250px">
                    Author
                  </th>
                  <th width="50px">
                    Date
                  </th> 
                  <th width="50px">
                    Status
                  </th> 
                  <th width="50px">
                    Action
                  </th> 
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
                    <?= $row['article_title']?>
                  </td>
                  <td>
                     <?= $row['name']?>
                  </td>
                  <td>
                    <?= $row['post_date']?>
                  </td> 
                  <td>
                    <?= $row['post_status']?>
                  </td> 
                  <td>
                    <a href="?pages=view&pid=<?= $row['post_ID'] ?>"> 
                    <i class="fa fa-list-alt text-info"></i>
                  </a> 

                    <a href="?pages=edit&pid=<?= $row['post_ID'] ?>"> 
                    <i class="fa fa-edit"></i>
                    <a href="?pages=post&d=<?= $row['post_ID'] ?>" Onclick="return ConfirmDelete()"> 
                    <i class="fa fa-window-close text-danger"></i>
                  </a>

                  </td> 
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
          $sql = "SELECT COUNT(post_id) FROM posts p where p.uid in ('$uid')";  
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