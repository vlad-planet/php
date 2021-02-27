<?
# Автоматическая загрузка класса

$myClass = new MyClass(); // Ошибка! Описание класса не найдено

function __autoload($class){
	echo $class;
}
$myClass = new MyClass(); // MyClass. Далее: Ошибка! Описание класса не найдено

#### Решение.
// Описываем класс в одноимённом файле, то есть MyClass.class.php
class MyClass{
	function __construct(){
		echo __CLASS__;
	}
}

// В текущем файле подключаем файл с описанием нужного класса
function __autoload($class){
	include $class.'.class.php';
}

$myClass = new MyClass(); // MyClass
?>