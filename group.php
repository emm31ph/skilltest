<?php
 

$sql ="select * from permissions where perm_id='3'";
	if($result = mysqli_query($con, $sql)){
	    if(mysqli_num_rows($result) > 0){
	    	$row = mysqli_fetch_array($result);
	    	$original_array=unserialize($row['perm_desc']);
 

			foreach ($original_array as $key => $value) {
				 
			}
		}
	}

  
  


?>
 

<form action="" method="post">
<div class="form-group">
<label class="col-sm-2">
BackUp:									
</label>		

<div class="col-sm-2">
<label><small>
<input type="checkbox" name="urc_backup[view_records]"   > View Records											
</small></label>
</div>

<div class="col-sm-2">
<label><small>
<input type="checkbox" name="urc_backup[view_details]"    > View Details											
</small></label>
</div>

<div class="col-sm-2">
<label><small>
<input type="checkbox" name="urc_backup[delete_data]" > Delete Data											
</small></label>
</div>

<div class="col-sm-2">
<label><small>
<input type="checkbox" name="urc_backup[download_data]" > Download Data											
</small></label>
</div>
</div>
 <button type="submit" name="submit" class="btn btn-primary btn-sm required-form">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
				Update Data</button>

</form>
<?php

 


if(isset($_POST['submit'])){
	if(isset($_POST['urc_backup'])){
		echo "save";
		$serialize =  serialize($_POST['urc_backup']);
		$sql = "update permissions set perm_desc='$serialize' where perm_id='3'";
		mysqli_query($con, $sql) or die();
		// header("location: dashboard.php?pages=group");
	}
	// $original_array=unserialize($serialize);
	// var_export($original_array);
}

?>