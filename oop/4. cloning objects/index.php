<?
# Клонирование объектов

// Копирование значений переменных всех типов, кроме объектов
$x = 10;
$y = $x; // $y - копия $x
$y = 20;
echo $y; // 20
echo $x; // 10

// Создание ссылок для всех типов, кроме объектов
$x = 10;
$y = &$x; // $y - ссылка на $x
$y = 20;
echo $y; // 20
echo $x; // 20

class MyClass{
	public $param;

	// Конструктор класса
	function __construct($param){
		$this->param = $param;
	}

	// Перегружаем оператор clone
	function __clone(){
		echo "Object cloned";
	}
}

// Создание объекта
$objX = new MyClass(10); // $objX - ссылка на объект в памяти
$objY = $objX; // $objY - ссылка на $objX

$objY->param = 20;
echo $objX->param; // 20

$objZ = clone $objX; // $objZ копия $objX
$objZ->param = 30;
echo $objX->param; // 20
?>