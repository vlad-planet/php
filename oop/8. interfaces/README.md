# Интерфейсы

```php
// Создание интерфейса
interface Paintable{
	// Абстрактный метод
	function paint();
}
interface Brick{}
interface Panel{}

// Создание абстрактного класса
abstract class HouseAbstract{
	public $model = "";
	public $square;
	public $floors;
	
	function __construct($model, $square = 0, $floors = 1){
		if(!$model)
			throw new Exception('Ошибка! Укажите модель!');
		$this->model = $model;
		$this->square = $square;
		$this->floors = $floors;
	}
	
	function startProject(){
		echo "Start. Model: {$this->model}\n";
	}

	function stopProject(){
		echo "Stop. Model: {$this->model}\n\n";
	}
	
	// Абстрактный метод
	abstract function build();
}


// Создание супер-класса

class SimpleHouse extends HouseAbstract implements Paintable, Brick{
	
	// Свойства абстрактного класса +
	public $color = "none";
	
	// Обязательная реализация абстрактного метода
	function build(){
	 echo "Build. House: {$this->square}x{$this->floors}\n";
	}
	
	// Обязательная реализация абстрактного метода
	function paint(){
		echo "Paint. Color: {$this->color}\n";
	}
	
}


// Создание простого дома
$simple = new SimpleHouse("A-100-123", 120, 2);
$simple->color = "red";
$simple->startProject();
$simple->build();

// Проверка класса в цепочке предков

if($simple instanceOf Paintable)
	$simple->paint();
$simple->stopProject();

// Создание класса-наследника
class SuperHouse extends SimpleHouse{
	public $fireplace = true;
	public $patio = true;

	function fire(){
		if ($this->fireplace)
			echo "Fueled fireplace\n";
	}
}

$super = new SuperHouse("A-100-125", 320, 3);
$super->color = "green";
$super->startProject();
$super->build();

// Проверка класса в цепочке предков
if($super instanceOf Paintable)
	$super->paint();
$super->fire();
$super->stopProject();

// Создание супер-класса
class FabricHouse extends HouseAbstract implements Panel{
	
	// Обязательная реализация абстрактного метода
	function build(){
		echo "Build. Fabric: {$this->square}x{$this->floors}\n";
	}
	
}

$fabric = new FabricHouse("B-200-007", 3250, 5);
$fabric->startProject();
$fabric->build();

// Проверка класса в цепочке предков
if($fabric instanceOf Paintable)
	$fabric->paint();
$fabric->stopProject();

// Создание класса-наследника
class SuperFabricHouse extends FabricHouse{
	
	// Перегрузка метода
	function build(){
		echo "==============================================\n";
		
		// Вызов родительского метода
		echo parent::build();
		echo "==============================================\n";
	}
	
}

$super_fabric = new SuperFabricHouse("C-201-034", 5150, 7);
$super_fabric->startProject();
$super_fabric->build();

// Проверка класса в цепочке предков
if($super_fabric instanceOf Paintable)
	$super_fabric->paint();
$super_fabric->stopProject();
```