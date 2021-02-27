<?php
header('Content-Type: text/html; charset=utf-8');
require 'DeliveryDB.class.php';
$delivery = new DeliveryDB;
$errMsg = '';
if($_SERVER['REQUEST_METHOD']=='POST')
	include 'save_delivery.inc.php';

if(isset($_GET['del']))
	include 'delete_delivery.inc.php';
?>


<?
if(isset($_POST['id'])){ 
	
	$id = $_POST['id'];
	$kg = $_POST['kg'];
	$price;

	foreach($delivery as $item){
		if($item['id'] == $id){
			if($item['more'] == "" || $item['more'] > $kg){
				$price = $item['price'] * $kg;
			}else{
				$price = $item['more_price'] * $kg;
			}
		}	
	}
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>Способ доставки</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<? echo "<h1>Рассчитать стоимость перевозки</h1>" ?>
<form action="" method="post">
<label for="">Выберите способ доставки:</label>
<select name="id">
<?

foreach($delivery as $item){	
	$selected = '';
	if($item['id']==$id){ $selected = 'selected';}
	echo "<option {$selected}  value='{$item[id]}'>{$item[name]}</option>\n";
}
?>
</select>
<br>
<label for="">Укажите вес (кг)</label>
<input type="number" value="<? echo $kg; ?>" name="kg">
<input type="submit" value="Рассчитать" />
</form>
<? if($price){	echo "<h1>Стоимость доставки: {$price} руб.</h1>"; } ?>


<hr>
<br>
<br>
<br>
<br>
<br>

<? echo "<h1>Добавить перевозчика</h1>" ?>
<? echo "<h2>{$errMsg}</h2>" ?>
<form action="" method="post">
Наименование перевозчика*<input type="text" name="name" value="" /><br />
Цена перевозки за кг*<input type="number" name="price" value="" /><br /><br />
Дополнительные параметры (если нету оставтье пустым)<br />
Свыше кг<input type="number" name="more" value="" /><br />
Цена свыше<input type="number" name="more_price" value="" /><br />
<input type="hidden" name="add" value="1" /><br />
<br />
<input type="submit" value="Добавить!" />
</form>



<br>
<br>
<br>
<br>
<br>

<? echo "<h1>Удалить запись о перевозчике</h1>" ?>
<?php
 require 'get_delivery.inc.php';
?>

</body>
</html>