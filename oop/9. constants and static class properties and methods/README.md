
# Константы и статические члены класса

```php
class СonstructionCompany{
	const NAME = "Рога и копыта";
	
	function printName(){
		// Обращение к константе из метода класса
		echo self::NAME;
	}
}

// Обращение к константе без создания экземпляра класса
echo СonstructionCompany::NAME; // Рога и копыта

$company = new СonstructionCompany();
$company->printName(); // Рога и копыта


class Worker{
	public name;
	
	// Статическое свойство класса
	public static workerCount = 0;

	function __construct($name){
		if(!$name)
			throw new Exception('Ошибка! Укажите имя рабочего!');
		$this->name = $name;
		
		// Изменение статического свойства класса
		++self::$workerCount;
	}

	// Статический метод класса
	static function welcome(){
		// Никаких $this в статическом методе класса!
		echo 'Добро пожаловать на стройплощадку! Нас уже ' . self::$workerCount . "\n";
	}
}

Worker::welcome();
$w1 = new Worker('Вася Пупкин');
$w2 = new Worker('Федя Сумкин');
echo 'Текущее количество рабочих: ' . Worker::$workerCount . "\n";


// Позднее статическое связывание (с PHP 5.4)
// Проблема

class A{
	static function whoAmI(){
		echo __CLASS__;
	}
	self::whoAmI();
		static function identity(){
	}
}

class B extends A{
	static function whoAmI(){
			echo __CLASS__;
	}
}
B::identity(); // A


// Позднее статическое связывание (с PHP 5.3)
class A{
	static function whoAmI(){
		echo __CLASS__;
	}
	static function identity(){
		static::whoAmI();
	}
}

class B extends A{
	static function whoAmI(){
		echo __CLASS__;
	}
}
B::identity(); // B
```