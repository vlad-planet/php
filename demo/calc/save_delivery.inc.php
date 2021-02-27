<?php
if(isset($_POST['add'])){
	$name = $delivery->clearStr($_POST['name']);
	$price = $delivery->clearInt($_POST['price']);
	$more = $delivery->clearInt($_POST['more']);
	$more_price = $delivery->clearInt($_POST['more_price']);
	if(empty($name) or empty($price)){
		$errMsg = 'Заполните обязательные поля!';
	}else{
		if(!$delivery->saveDelivery($name, $price, $more, $more_price)){
			$errMsg = 'Ошибка при записи';
		}else{
			header('Location: index.php');
			exit;
		}
	}
}
?>