<?
# Доступ к недоступным свойствам и методам

class MyClass{}

$obj = new MyClass();
obj->param = 100;
echo obj->param; // 100
obj->func(10, 20); // Ошибка!


class MyClass{
	function __set($name, $value){
		echo "Set property '$name' to value $value";
	}

	function __get($name){
		return "Access to property '$name'";
	}

	function __call($name, $args){
		echo "Call method '$name' with arguments: " . implode(', ', $args);
	}
	
	static function __callStatic($name, $args){
		echo "Call static method '$name' with arguments: " . implode(', ', $args);
	}
}

$obj = new MyClass();
obj->param = 100; // Set property 'param' to value 100
echo obj->param; // Accsess to property 'param'
obj->func(10, 20); // Call method 'func' width arguments: 10, 20
MyClass::staticFunc(10, 20); // Call static method 'staticFunc' width arguments: 10, 20


// Использование "магических" сеттеров и геттеров
class HouseAbstract{
	private $model = "";
	private $square;
	private $floors;

	function __construct($model, $square = 0, $floors = 1){
		if(!$model)
			throw new Exception('Ошибка! Укажите модель!');
		$this->model = $model;
		$this->square = $square;
		$this->floors = $floors;
	}

	function __get($name){
		switch($name){
			case 'model': return $this->model;
			case 'square': return $this->square;
			case 'floors': return $this->floors;
			default: throw new Exception('Неизвестное свойство!');
		}
	}
	// Описание других методов
}


class SimpleHouse{
	private $color = "none";
	
	function __get($name){
		switch($name){
			case 'color': return $this->color;
			default: throw new Exception('Неизвестное свойство!');
		}
	}
	
	function __set($name, $value){
		switch($name){
			case 'color': $this->color = $value; break;
			default: throw new Exception('Неизвестное свойство!');
		}
	}
	// Описание других методов
}

$simple = new SimpleHouse("A-100-123", 120, 2);
$simple->color("red");
echo $simple->color;
?>