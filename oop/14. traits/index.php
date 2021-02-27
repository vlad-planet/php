<?
# Типажи (traits)

// Базовое использование
trait Hello{
	function getGreet(){
		return "Hello";
	}
}

trait User{
	function getUser($name){
		return ucfirst($name);
	}
}

class Welcome{
	use Hello, User;
}
$obj = new Welcome();
echo $obj->getGreet(), ', ', $obj->getUser('john'), '!';
// Hello, John!

// Наследование
trait Greeting{
	use Hello, User;

	function sayHello($name){
		echo $obj->getGreet(), ', ', $obj->getUser($name), '!';
	}
}

class Welcome{
	use Greeting;
}

(new Welcome())->sayHello('john');

// Изменение модификаторов доступа
trait Hello{
	private function sayHello($name){
		return "Hello, $name!";
	}
}

class Welcome{
	use Hello{
		sayHello as public;
	}
}

(new Welcome())->sayHello('John');

// Разрешение конфликтов имён
trait Hello{
	private function sayHello(){
		return "Hello";
	}
}

trait User{
	public function sayHello($name){
		return $name;
	}
}

class Welcome{
	use User, Hello{
		Hello::sayHello as public word;
		User::sayHello insteadof Hello;
	}
}

$obj = new Welcome();

echo $obj->word(), ', ', $obj->sayHello('John'), '!';
?>