<?php
$id = $delivery->clearInt($_GET['del']);
if($id){
	if(!$delivery->deleteDelivery($id)){
		$errMsg = 'Произошла ошибка удаления записи.';
	}else{
		header('Location: index.php');
		exit;
	}
}
?>