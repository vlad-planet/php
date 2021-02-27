<?php
	include('config.php');

	session_start();//не забываем во всех файлах писать session_start
	
	
	if($_POST['DATE']){
		
		 //проверяем сессию, если она есть, то значит уже авторизовались
		if (isset($_SESSION['user_password']) && $_SESSION['user_password'] == '312857cbaf7cfc2b22266c0ccc25b48a' && $_SESSION['user_login'] == 'keithelp'){
			$row = $_POST['ID'];
			$query = "UPDATE users SET date='{$_POST["DATE"]}' WHERE id = '{$_POST["ID"]}'";
			$result = mysqli_query($db,$query);
			if($result){
				$row = 'сохранено!';
			}
		}

	}else{

		//проверяем сессию, если она есть, то значит уже авторизовались
		if (isset($_SESSION['password']) && $_SESSION['email']){

		   $query = "SELECT id, email FROM users WHERE email= '{$_SESSION['email']}' AND password = '{$_SESSION['password']}' LIMIT 1";
		   $result = mysqli_query($db,$query) or die(mysqli_error($db));
			// если такой пользователь есть
			$user = mysqli_fetch_assoc($result);	

			if ($user) {
				$id = htmlspecialchars($_POST['ID']);
				
				$query = "SELECT click FROM statistic WHERE user_id = {$user['id']} AND order_id = ".$id;
				$result = mysqli_query($db,$query) or die(mysqli_error($db));
				$statistic = mysqli_fetch_assoc($result);
				
				
				if($statistic){
					$click = $statistic['click'] + 1;
					$query = "UPDATE statistic SET click={$click} WHERE user_id = {$user['id']} AND order_id = ".$id;
					$result = mysqli_query($db,$query) or die(mysqli_error($db));
				}else{
					$query = "INSERT INTO statistic (user_id,order_id,click) VALUES ({$user['id']},{$id},1)";
					$result = mysqli_query($db,$query) or die(mysqli_error($db));
				}
				
				$query = "SELECT id,name,phone,email FROM orders WHERE id = ".$id;
				$result = mysqli_query($db,$query) or die(mysqli_error($db));
				$row = mysqli_fetch_assoc($result);
			}
		}
		
	}
// делаем ответ для клиента
if(empty($errorContainer)){
    // если нет ошибок сообщаем об успехе
    echo json_encode(array('result' => $row));
}else{
    // если есть ошибки то отправляем
    echo json_encode(array('result' => 'error', 'text_error' => $errorContainer));
}
?>
