<pre>
<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		print_r($_FILES);
		
		$tmp = $_FILES['user']['tmp_name'];
		$name = $_FILES['user']['name'];
		//$tmp = $_FILES['tmp_name'];
		//$name = $_FILES['name'];
		move_uploaded_file($tmp, 'upload/'.$name);
		//copy($tmp, 'upload/'.$name);
	}
?>
<form action='upload.php' method='post' enctype='multipart/form-data'>
<input type='file' name='user'>
<input type='submit'>
</form>