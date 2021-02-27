<?
# Свойства объектов

// Описание класса
class Pet{
	// Описание свойств
	public $type = "unknown";
	public $name;
}

// Создание объектов, экземпляров класса
$cat = new Pet();
$dog = new Pet();

// Изменяем значения свойств
$cat->type = "cat";
$cat->name = "Murzik";
$dog->type = "dog";
$dog->name = "Tuzik";

// Проверим, какого типа $cat?
echo $cat->type; // cat

// Проверим, как зовут собачку?
echo $dog->name; // Tuzik


# Методы объектов

// Описание класса
class Pet{
	// Описание свойств
	public $type = "unknown";
	public $name;
	// Описание методов
	function say($word){
		echo "Оbject said $word";
	}
}

// Создание объектов, экземпляров класса
$cat = new Pet();
$dog = new Pet();

// Изменяем значения свойств
$cat->type = "cat";
$cat->name = "Murzik";
$dog->type = "dog";
$dog->name = "Tuzik";

// Вызываем метод объекта
$cat->say("Myau"); // Object said Myau
$dog->say("Gav"); // Object said Gav


#Обращение к свойствам и методам внутри класса

// Описание класса
class Pet{
	
	// Описание свойств
	public $type = "unknown";
	public $name;
	
	// Описание методов
	function say($word){
		// Доступ к свойству
		echo $this->name . " said $word";
		// Доступ к методу
		$this->drawLine();
	}
	
	function drawLine(){
		echo "<hr>";
	}
	
	// Создание объектов, экземпляров класса
	$cat = new Pet();
	$cat = new Pet();
	
	// Изменяем значения свойств
	$cat->type = "cat";
	$cat->name = "Murzik";
	$dog->type = "dog";
	$dog->name = "Tuzik";
	
	// Вызываем метод объекта
	$cat->say("Myau"); // Murzik said Myau
	$dog->say("Gav"); // Tuzik said Gav
}


# Использование псевдоконсант

// Описание класса
class SuperClass{
	
	function functionName(){
		echo "<p>Вызвана функция " . __FUNCTION__;
	}
	
	function className(){
		echo "<p>Используем класс " . __CLASS__;
	}
	
	function methodName(){
		echo "<p>Вызван метод " . __METHOD__;
	}
	
}

// Создание объекта
$obj = new SuperClass();

// Используем псевдоконстаты
$obj->functionName(); // functionName
$obj->className(); // SuperClass
$obj->methodName(); // SuperClass::methodName
?>