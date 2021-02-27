<?php
	$host = 'localhost'; // адрес сервера 
	$user = 'root'; // имя пользователя
	$password = ''; // пароль
	$database = 'admin'; // имя базы данных

	$db = mysqli_connect($host, $user, $password, $database);
	mysqli_set_charset($db, "utf8");
	
	if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>
