<?
# Конструкторы и деструкторы

// Описание класса

class Pet{
	
	// Описание свойств
	public $type = "unknown";
	public $name;
	
	// Конструктор класса
	function __construct($type, $name){
		$this->type = $type;
		$this->name = $name;
	}
	
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
	
	// Деструктор класса
	function __destruct(){
		echo $this->name . " removed";
	}	
	
}

// Создание объектов, экземпляров класса
$cat = new Pet("cat", "Murzik");
$cat = new Pet("dog", "Tuzik");

// Вызываем метод объекта
$cat->say("Myau");
$dog->say("Gav");
?>