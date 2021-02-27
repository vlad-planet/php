<?php

	include('config.php');

    ini_set("display_errors", 1);
    session_start();//не забываем во всех файлах писать session_start


	if (isset($_POST['email']) && isset($_POST['password'])){
		//ставим метку в сессии
		//немного профильтруем логин
		$_SESSION['email'] = htmlspecialchars($_POST['email']);
		//хешируем пароль т.к. в базе именно хеш
		$_SESSION['password'] = md5(trim($_POST['password']));
	}
   

// проверяем введенные данные
$query = "SELECT id, email FROM users WHERE email= '{$_SESSION['email']}' AND password = '{$_SESSION['password']}' LIMIT 1";
$result = mysqli_query($db,$query) or die(mysqli_error($db));
// если такой пользователь есть
$row = mysqli_fetch_assoc($result);	


if ($row) {
        echo htmlspecialchars($_SESSION['email'])." <br />"."Вы авторизованы <br />
        Т.е. мы проверили сессию и можем открыть доступ к определенным данным <br /><br />";


if($_GET['id']){
	$query = "UPDATE orders SET status = 1 WHERE id = ".$_GET['id'] ;
	mysqli_query($db,$query) or die(mysqli_error($db));
}

if(!isset($_GET['archive'])){ $_GET['archive'] = 0; }
$query = "SELECT * FROM orders WHERE status = ".$_GET['archive'];
$result = mysqli_query($db,$query) or die(mysqli_error($db));

echo '<form>';

if($_GET['archive']==0){
	echo '<button type="submit" name="archive" value="1">ПЕРЕЙТИ В АРХИВ</button>';
}else{
	echo '<button type="submit" name="archive" value="0">ПЕРЕЙТИ В ЗАЯВКИ</button>';
}

	echo '<table border="1" class="arhive_'.$_GET['archive'].'">';
	echo '<tr><th>№</th><th>Марка</th><th>Модуль</th><th>С&nbsp;установкой</th><th>Модификация</th><th>Код</th><th>Тип</th><th>Модель</th><th>Объем</th><th>Мощность</th><th>Привод</th><th>Дата&nbsp;выпуска</th><th class="date">Дата заказа</th><th>Просьба <br>не звонить</th><th>Контакт</th></tr>';

	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.++$n.'</td><td>'.$row['marka'].'</td><td>'.$row['stock'].'</td><td>'.$row['installation'].'</td><td>'.$row['modification'].'</td><td>'.$row['code'].'</td><td>'.$row['type'].'</td><td>'.$row['model'].'</td><td>'.$row['volume'].'</td><td>'.$row['power'].'</td><td>'.$row['drive'].'</td><td>'.$row['year'].'</td><td>'.$row['date'].'</td><td><button type="submit" name="id" value="'.$row['id'].'">в&nbsp;архив</button></td><td><input type="button" class="vis" id="'.$row['id'].'" value="+"></td></tr>';
	}
	echo '</table>'; 

echo '</form>';	
?>


<style>
.overlay {
    background-color: rgba(0, 0, 0, 0.7);
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
	position: fixed;
    visibility: hidden;
	z-index: 1;
}
.popup {
	background-color: #fff;
	border: 3px solid #fff;
	display: block;
	padding: 10px 15px;
	text-align: justify;
	max-width:400px;
	margin:15% auto;
	
}
.popup .close_window {
	margin-left: 98%;
    margin-top: -30px;
    font-size: 13px;
    display: block;
    padding: 5px 10px;
    cursor: pointer;
    color: #fff;
    background-color: #3d51c8;
    border: 1px solid #061fb8;
}
.popup .close_window:hover {
	background-color: #051fb8;
	border: 1px solid #00385E;
}
#contact_info td {width:100%;}
td,th {padding:2px 10px;}
th{background: #d81428;}
body{
	background-image: url(img/mt-1517-home-pattern.jpg);
	background-position: top;
	background-repeat: repeat;
	background-size: auto;
}
button{
	background: #9a2a25;
}
input{
	background: #93c638;
}
</style>

<div class="overlay">
<div class="popup">
<button title="Close (Esc)" type="button" class="close_window">×</button>

<div id="contact_info">
</div>

</div>
</div>

				
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
$('.popup .close_window').click(function (){
	$('.overlay').css({'visibility':'hidden'});
});

		$('.vis').click(function (e){
			var ID = $(this).attr('id');
			$.ajax({
				// метод отправки 
				type: "POST",
				// путь до скрипта-обработчика
				url: "/source.php",
				// какие данные будут переданы
				data: {
					'ID': ID,
				},
				// тип передачи данных
				dataType: "json",
				// действие, при ответе с сервера
				success: function(data){
					// в случае, когда пришло success. Отработало без ошибок
					if(data.result){
						
						var tb = '<table border="1">';
						tb += '<tr><td>Имя</td><td>Телефон</td><td>Email</td></tr>';
						tb += '<tr><td>'+data.result["name"]+'</td><td>'+data.result["phone"]+'</td><td>'+data.result["email"]+'</td></tr>';
						tb += '</table>';
						
						$('#contact_info').html(tb);
						$('.overlay').css({'visibility':'visible'});
						e.preventDefault();
						//alert(data.result['id']);
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
				
				
<?				
   }else {
	
//простая формочка
print <<<html
<form action="index.php" method="POST">
	Логин <input name="email" type="text" value = $email><br>
	Пароль <input name="password" type="password"><br>
    <input name="submit" type="submit" value="Войти">
</form>
html;
	
    }
?>
