
<?php


?> 
<script type="text/javascript">
  
      // Form validation code will come here.
      function validate()
      {
      
         if( document.myForm.title.value == "" )
         {
            alert( "Please provide Title!" );
            document.myForm.title.focus() ;
            return false;
         }else if( document.myForm.content.value == "" )
         {
            alert( "Please provide your content!" );
            document.myForm.content.focus() ;
            return false;
         }

          return( true );

	}
</script>
<?php  
$pid = '';
$title = '';
$content = '';
$description = '';
$img = '';
$post_status = '';

//for edit 

	if(isset($_GET['pid']) && $_SESSION['login_id']!=null){
		$pid = $_GET['pid'];
		$sql = "select * from posts where post_ID='$pid'";

		$result = mysqli_query($con, $sql)  or die(" error on display edit ".mysqli_error());;

		if(mysqli_num_rows($result) > 0){
	    	$row = mysqli_fetch_array($result);
	    	$title = $row['article_title'];
			$content = $row['article_content'];
			$description = $row['post_content'];
			$img = $row['post_image'];
			$post_status = $row['post_status'];
	    }
	}

function ImageChecker(){
	if(isset($_FILES["file"]["name"]) && ($_FILES["file"]["name"]!=null)){
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 10000000)
			&& in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				return "Return Code: " . $_FILES["file"]["error"] . "<br>";
			}
			else 
			{
				return "";
	        }
	    }
	    else
	    {
	    	return "Invalid Image";
	    }
	} 
} 

function ImageUpload(){
	if(isset($_FILES["file"]["name"]) && ($_FILES["file"]["name"]!=null)){
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 10000000)
			&& in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
			{
				return '';
			}
			else 
			{

				$fileName = $temp[0].".".$temp[1];
	            $temp[0] = rand(0, 3000); //Set to random number
	            $fileName;

	            if (file_exists("images/upload/" . $_FILES["file"]["name"]))
	            {
	            	return $_FILES["file"]["name"] . " already exists. ";
	            }else{
	            	$newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["file"]["name"]));
	            	move_uploaded_file($_FILES["file"]["tmp_name"], "images/upload/" . $newfilename);
	            	return $newfilename;
	            }
	        }
	    }
	    else
	    {
	    	return '';
	    }
	}
}
 
 


	$msg = array();
	$error_message = array();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
		# code...
		$title = $_POST['title'];
		$description = $_POST['description'];
		$content = $_POST['content'];
		$uid = $_SESSION['login_id'];

		if ((ImageChecker())!="") {
			 array_push($error_message, ImageChecker());
		}

		if (!empty($title) && !empty($content)) {
			$imgName = ''; 

			if((ImageChecker())==''){
				$imgName = ImageUpload();
			}
			
			if(count($error_message) == 0){
			

				if(isset($_GET['pages']) && $_GET['pages']=='edit'){

					  
					if((ImageChecker())!=''){
						$img = ImageUpload();
					}

					$postType = (isset($_POST['uPublish'])?"publish":"draft");
				 
					$sql = "UPDATE `posts` SET `post_content` = '$description', `post_status` = '".$postType."', `article_title` = '$title', `article_content` = '$content',`post_image`='".$img."' WHERE `posts`.`post_ID` = '$pid'";
  
					mysqli_query($con, $sql)or die(" error on saving edit ".mysqli_error());
	             	array_push($msg, "Successfully update");
	             	header('Location ');
				}else{
 
					$postType = (isset($_POST['draft'])?"draft":"publish");
					$qry = "INSERT INTO `posts` (`post_connt`, `post_status`,`article_title`,`post_image`, `article_content`,`uid`) VALUES ('$description', '$postType', '$title','$imgName','$content','$uid')";

					 mysqli_query($con, $qry);
		             array_push($msg, "Successfully ".$postType);
            	}
            }
		}

	} 
 		 
	if(count($msg) > 0):
		?>
		<div class="row">  
			<div class="col-12 grid-margin">	
				<div class='btn btn-success btn-block'>
					<?php
					foreach ($msg as $msg1):
            # code...
						echo "<p>".$msg1."</p>";
					endforeach;
					?>
				</div>
			</div>
		</div>      
		<?php
	endif;

		if(count($error_message) > 0):
		?>
		<div class="row">  
			<div class="col-12 grid-margin">	
				<div class='btn btn-warning btn-block'>
					<?php
					foreach ($error_message as $msg1):
            # code...
						echo "<p>".$msg1."</p>";
					endforeach;
					?>
				</div>
			</div>
		</div>      
		<?php
	endif;


	

?>   

<form method="post" id="myForm" name="myForm" action="" onsubmit="return(validate());"  enctype="multipart/form-data">
<input type="hidden" name="pid" value="<?= $pid ?>">
<div class="row">  
		<div class="col-8 grid-margin">			
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?= ($_GET['pages']=='edit')?"Edit Post":"Add Post" ;?></h4>
					<div class="form-group">
						<label>Title</label>
						<input id="title" name="title" type="text" class="form-control form-control-lg" value="<?= $title ?>" placeholder="Enter title here" aria-label="Title">
					</div>
					<div class="form-group">
						<label>Description</label>
						<input id="description" name="description" type="text" class="form-control form-control-lg" value="<?= $description ?>" placeholder="Description" aria-label="Discription">
					</div>
					<div class="form-group">
							<label>Media</label>
					   <div class="custom-file">
						  <input type="file" name="file"  class="custom-file-input" id="customFileLang" lang="es">
						  <label class="custom-file-label" for="customFileLang">Select file</label>
						</div>
					</div> 
					<div class="form-group">
						<label>Content</label>
						<textarea name="content" id="content" class="form-control form-control-lg" rows="10"><?= $content ?></textarea>
					</div>

					<div class="form-group">

					</div>
				</div>
			</div>
		</div>

		<div class="col-4 grid-margin">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Publish</h4> 
					<div class="form-group">
					 <?php
 
					 	if($post_status=='draft'){
					 	echo ' <input type="submit" name="uPublish" class="btn btn-light" value="Publish">';

					 	}else{

					 	echo ' <input type="submit" name="draft" class="btn btn-light" value="Save Draft" >';	
					 	}
					 ?>
						
						
					</div>


					<div class="form-group">
						<?php
						if(isset($_GET['pid'])){
						?>
						 <input type="submit" name="Update" class="btn btn-primary btn-fw" value="Update" >
						<?php						
						}else{
						?>
						 <input type="submit" name="submit" class="btn btn-primary btn-fw" value="Publish">
						<?php
						}	
						?>
					</div>

				</div>
			</div>
		</div>
</div>
</form>

