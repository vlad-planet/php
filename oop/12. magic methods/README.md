
# Магические методы

```php
// Преобразование объекта в строку
class MyClass{}

$obj = new MyClass();
echo obj; // Ошибка!

class MyClass{
	function __toString(){
		return 'Это объект, экземпляр класса ' . __CLASS__;
	}
}

$obj = new MyClass();
echo obj; // Это объект, экземпляр класса MyCLASS

// Обращение к объекту как к функции
class Math{
	function __invoke($num, $action){
		switch($action){
			case '+': return $num + $num;
			case '*': return $num - $num;
			default: throw new Exception('Неизвестное свойство!');
		}
	}
}

$obj = new Math();
echo obj(5, '+'); // 10
echo obj(5, '*'); // 25


// Сериализация объекта
class User{
	private $login;
	private $password;
	private $params = [];
	
	function __construct($login, $password){
		$this->login = $login;
		$this->password = $password;
		$this->params = $this->getUser();
	}

	function getUser(){
		// Что-то делаем
		// Например, возвращаем массив данных пользователя
	}

	// Вызывается перед сериализацией
	function __sleep(){
		return ['login', 'password'];
	}

	// Вызывается после сериализации
	function __wakeup(){
		$this->params = $this->getUser();
	}
}

$obj = new User("john", "1234");
$str = serialize($obj);
unset($obj);
$obj = unserialize($str);
```