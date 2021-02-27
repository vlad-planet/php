<?php
//keithelp
//Pfxtvgfhjkm12345

    session_start();//не забываем во всех файлах писать session_start

	if (isset($_POST['user_login']) && isset($_POST['user_password'])){
		//немного профильтруем логин
        $user_login = htmlspecialchars($_POST['user_login']);
		//хешируем пароль т.к. в базе именно хеш
        $user_password = md5(trim($_POST['user_password']));

					//ставим метку в сессии 
					$_SESSION['user_login'] = $user_login;
					$_SESSION['user_password'] = $user_password;
	}

   //проверяем сессию, если она есть, то значит уже авторизовались
   if (isset($_SESSION['user_password']) && $_SESSION['user_password'] == '312857cbaf7cfc2b22266c0ccc25b48a' && $_SESSION['user_login'] == 'keithelp'){
		echo "Пользователь: ".htmlspecialchars($_SESSION['user_login'])." <br />"."Вы авторизованы <br /><br /><br />";

		include('config.php');

        ini_set("display_errors", 1);
        if(isset($_POST['registred'])) {
			//проверяем, нет ли у нас пользователя с таким логином
			$query = "SELECT COUNT(id) FROM users WHERE email='".htmlspecialchars($_POST['email'])."'";
		
			$result = mysqli_query($db,$query) or die(mysqli_error($db));
			// если такой пользователь есть
			$row = mysqli_fetch_assoc($result);	

			if($row["COUNT(id)"] > 0)  {
				
				//var_dump($row);
                echo 'Пользователь с таким логином уже существует';
			}else{

				$company = htmlspecialchars($_POST['company']);
				$fio = htmlspecialchars($_POST['fio']);
				$email = htmlspecialchars($_POST['email']);
				$phone = $_POST['phone'];
                // Убираем пробелы и хешируем пароль
                $password = md5(trim($_POST['password']));
				$date = $_POST['date'];

				$query = "INSERT INTO users (company,fio,email,phone,password,date) VALUES ('{$company}','{$fio}','{$email}','{$phone}','{$password}','{$date}')";

                $result = mysqli_query($db,$query) or die(mysqli_error($db));
				if($result){
					echo '<h3>Вы успешно зарегистрировали пользователя с логином - '.$email.'</h3>';
					//exit();
				}
			}
        }
		
        //по умолчанию данные будут отправляться на этот же файл
print <<< html
<h1>Регистрация нового партнера</h1>
<form method="POST">
<table border='0' id="rctb">
	<tr><td>Компания: </td><td><input name="company" type="text"></td></tr>
	<tr><td>ФИО: </td><td><input name="fio" type="text"></td></tr>
	<tr><td>Телефон: </td><td><input name="phone" type="tel"></td></tr>
	<tr><td>Email: </td><td><input name="email" type="email"></td></tr>
    <tr><td>Пароль: </td><td><input name="password" type="password"></td></tr>
	<tr><td>Дата окончания: </td><td><input name="date" type="date"></td></tr>
    <tr><td></td><td><button name="registred" type="submit" value="1">Зарегистрировать</button></td></tr>
</table>
</form>
html;

		$query = "SELECT * FROM users";
		$result = mysqli_query($db,$query) or die(mysqli_error($db));
		// если такой пользователь есть

		while($row = mysqli_fetch_assoc($result)){
			
			echo '<table class="ctb">';
			echo '<tr><th>Компания</th><th>ФИО</th><th>Email</th><th>Телефон</th><th>Дата окончания</th></tr>';
			echo '<tr><td>'.$row["company"].'</td><td>'.$row["fio"].'</td><td>'.$row["email"].'</td><td>'.$row["phone"].'</td><td><input name="date" type="date" value="'.$row["date"].'" id="date_'.$row["id"].'"></td><td><input type="button" id="'.$row["id"].'" class="self"  value="сохранить" ><span id="msg_'.$row["id"].'"></span></td></tr>';
			echo '</table>';
			
			$query = "SELECT * FROM statistic s INNER JOIN orders o ON s.order_id = o.id WHERE s.user_id = '{$row["id"]}' ";
			$orders = mysqli_query($db,$query) or die(mysqli_error($db));
			// если такой пользователь есть
			
			//if(!empty(mysqli_fetch_assoc($orders))){
				echo '<table border="1" class="tb">';
						echo '<tr><th>№</th><th>Марка</th><th>Модуль</th><th>С&nbsp;установкой</th><th>Модификация</th><th>Код</th><th>Тип</th><th>Модель</th><th>Объем</th><th>Мощность</th><th>Привод</th><th>Дата&nbsp;выпуска</th><th>Имя</th><th>Телефон</th><th>Email</th><th class="date">Дата заказа</th><th>Кликов</th></tr>';
					while($order = mysqli_fetch_assoc($orders)){
						//var_dump($order);
						echo '<tr><td>'.++$n.'</td><td>'.$order['marka'].'</td><td>'.$order['stock'].'</td><td>'.$order['installation'].'</td><td>'.$order['modification'].'</td><td>'.$order['code'].'</td><td>'.$order['type'].'</td><td>'.$order['model'].'</td><td>'.$order['volume'].'</td><td>'.$order['power'].'</td><td>'.$order['drive'].'</td><td>'.$order['year'].'</td><td>'.$order['name'].'</td><td>'.$order['phone'].'</td><td>'.$order['email'].'</td><td>'.$order['date'].'</td><td>'.$order['click'].'</td></tr>';
					
					}
				echo '</table>';
			//}
			
			echo '<br>';
		}
		
   } else {

//если пользователя нет, то пусть пробует еще
//простая формочка
print <<<html
<form action="" method="POST">
	Логин <input name="user_login" type="text" value = ''><br>
	Пароль <input name="user_password" type="password"><br>
    <input name="submit" type="submit" value="Войти">
</form>
html;

   }
?>
<style> 
body{
	background-image: url(img/mt-1517-home-pattern.jpg);
	background-position: top;
	background-repeat: repeat;
	background-size: auto;
}
#rctb input, #rctb button{
	padding:5px 10px;
	width:300px;
}
button{
	background: #93c638;
}
.tb{
	width:100%;
	background-color:#fff;
}
td,th{
	padding:2px 10px;
}
th{
	font-weight:bold;
}
.ctb th{
	color: #9a2a25;
}
</style>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
		$('.self').click(function (e){
			var id = $(this).attr('id');
			var date = $('#date_'+id).val();
			
			//alert(date);
			
			$.ajax({
				// метод отправки 
				type: "POST",
				// путь до скрипта-обработчика
				url: "/source.php",
				// какие данные будут переданы
				data: {
					'ID': id,
					'DATE': date
				},
				// тип передачи данных
				dataType: "json",
				// действие, при ответе с сервера
				success: function(data){
					// в случае, когда пришло success. Отработало без ошибок
					if(data.result){
						alert(data.result);
						//$('#msg_'+id).html(data.result);
						//e.preventDefault();
					// в случае ошибок в форме
					}else{
						// перебираем массив с ошибками
						for(var errorField in data.text_error){
							// выводим текст ошибок 
							$('#_error').html(data.text_error[errorField]);
							// обводим инпуты красным цветом
						}
					}
				}
			});

		});
			
			
			

			
			
</script>			